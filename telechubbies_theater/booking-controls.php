<?php
	include 'connectDB.php';
	include 'session.php';

	/*---------------------------------AJAX------------------------------*/

	#if AJAX receives any data, put in $_SESSION
	if(isset($_POST['Branch_ID']))
		{
		$_SESSION['Branch_ID'] = $_POST['Branch_ID'];
		}
	if(isset($_POST['Theater_ID']))
		{
		$_SESSION['Theater_ID'] = $_POST['Theater_ID'];
		}
	if(isset($_POST['Audio']))
		{
		$_SESSION['Audio'] =  $_POST['Audio'];
		}
	if(isset($_POST['Movie_ID']))
		{
		$_SESSION['Movie_ID'] = $_POST['Movie_ID'];
		}

	$movie_id = filter_input(INPUT_GET, 'movie-id');

	#query all available rolls for selecting BRANCH ID
	$query = "SELECT DISTINCT Branch_ID FROM filmrolls
				WHERE Movie_ID = $movie_id
					AND Roll_ID IN (SELECT Roll_ID FROM showtimes);";

	$rolls_branches = mysqli_query($db, $query);


	#for AJAX, once branch is selected, get all available THEATERS for given movie and branch
	if(isset($_POST['Branch_ID']))
		{
		$branchid = $_SESSION['Branch_ID'];
		$movie_id = $_SESSION['Movie_ID'];
		$currentDateTime = date('Y-m-d H:i:s');
		$query = "SELECT No, Theater_ID
			FROM theater
			WHERE (Theater_ID IN (SELECT Theater_ID
                      			FROM showtimes
                      			WHERE Roll_ID IN (SELECT Roll_ID
                                			        FROM filmrolls
                                        			WHERE Movie_ID = $movie_id)  AND DateTime > '$currentDateTime' )) AND
        		(Branch_ID = $branchid);";

        $_SESSION['Theaterquery'] = $query;

		$rolls_theaters = mysqli_query($db, $query);

		#echo "NuMBER OF ROWS: " . mysqli_num_rows($rolls_theaters);

		if(mysqli_num_rows($rolls_theaters) > 0)
			{
			echo '<option selected>Please select theater.</option>';
			while($theaters = mysqli_fetch_assoc($rolls_theaters))
				{
				echo '<option value="' . $theaters['Theater_ID'] . '">' . $theaters['No'] . '</option>';
				}
			}
		else
			{
			echo '<option selected>No showtimes found! Sorry!</option>';
			}
		}

	#for AJAX, once audio has been selected get all available SHOWTIMES for given parameters
	if(isset($_POST['Audio']) || isset($_POST['Theater_ID']) && !isset($_POST['checkSeats']))
		{
		$audio = $_SESSION['Audio'];
		
		$theater = $_SESSION['Theater_ID'];
			
		$currentDateTime = date('Y-m-d H:i:s');

		$query = "SELECT `DateTime`
				FROM showtimes
				WHERE Theater_ID = $theater
					AND Audio LIKE '$audio'
					AND DateTime > '$currentDateTime';";	
		echo $query;	

		$available_showtimes = mysqli_query($db, $query);

		if(mysqli_num_rows($available_showtimes) > 0)
			{
			echo '<option selected>Please select showtime.</option>';
			while($showtimes = mysqli_fetch_assoc($available_showtimes))
				{
				echo '<option value="' . $showtimes['DateTime'] . '">' . $showtimes['DateTime'] . '</option>';
				}
			}
		else
			{
			echo '<option selected>There are no showtimes available, sorry!</option>';
			}
		}

	//handle unavailable seats
	if(isset($_POST['checkSeats']))
		{
		$theater_id = $_POST['Theater_ID'];
		$datetime = $_POST['datetime'];

		$query = "SELECT Seat_No FROM seats WHERE Theater_ID = $theater_id
										AND DateTime = '$datetime';";
		$_SESSION['DEBUGQUERY'] = $query;

		$result = mysqli_query($db, $query);

		$i = 0;

		if(mysqli_num_rows($result) > 0)
			{
			while($seat = mysqli_fetch_assoc($result))
				{
				$seats[$i] = $seat['Seat_No'];
				$i++;
				}
			}
		else
			{
			$seats = array();
			}

		echo json_encode(['seat_id' => $seats], JSON_FORCE_OBJECT);

		unset($seats);
		$seats = "";
		}


	/*AJAX for SHOPPING CART*/
	/*receive calculated subtotal*/
	if(isset($_GET['subtotal']))
		{
		$_SESSION['subtotal'] = $_GET['subtotal'];
		}


	/*add item*/
	if(isset($_POST['Item_ID']))
		{
		if(isset($_SESSION['shopping_cart']))
			{
		#count the number of elements in shopping_cart array
		$count = count($_SESSION['shopping_cart']);

			#create sequential array or matching array keys to product ids
		$product_ids = array_column($_SESSION['shopping_cart'], 'id');

			#check if product is already in array
		if(!in_array($_POST['Item_ID'], $product_ids))
		{
				#if not exist, proceed
			$_SESSION['shopping_cart'][$count] = array
			(
				'id' => $_POST['Item_ID'],
				'name' => $_POST['ItemName'],
				'price' => $_POST['Price'],
				'quantity' => 1
			);
		}
			else #if already exist, add to quantity
			{
				#loop through product ids and match array key to id of product being added to cart
				for($i = 0; $i < count($product_ids); $i++)
				{
					if($product_ids[$i] == $_POST['Item_ID'])
					{
						#add quantity to existing product in array
						$_SESSION['shopping_cart'][$i]['quantity'] += 1;
					}
				}
			}
			}
		else
			{
			$_SESSION['shopping_cart'][0] = array
				(
				'id' => $_POST['Item_ID'],
				'name' => $_POST['ItemName'],
				'price' => $_POST['Price'],
				'quantity' => 1
				);
			}
		}

	/*remove item*/
	if(filter_input(INPUT_GET, 'action') == 'delete')
		{
		#loop through products in shopping cart until matches with GET id var
			foreach($_SESSION['shopping_cart'] as $key => $product)
			{
				if($product['id'] == filter_input(INPUT_GET, 'Item_ID'))
				{
				#remove product from shopping cart when matches
					unset($_SESSION['shopping_cart'][$key]);
				}
			}

		#reset session array keys
			$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
		}


	/*--------------------------END AJAX-----------------------------------------*/

	/*-------------------------START: submission and inserting-------------------------*/
	if(isset($_POST['submit-seats']))
		{
		#pass stuff to SESSION for checking out
		$_SESSION['datetime'] = $_POST['showtime'];
		$_SESSION['seats'] = explode("|", $_POST['selected-seats']);
		$_SESSION['seattypes'] = explode("|", $_POST['seat-types']);

		header('Location: checkout-ticket.php');
		}

	if(isset($_POST['book-ticket']))
		{
		$theater_id = $_SESSION['Theater_ID'];
		$datetime = $_SESSION['datetime'];
		$seats = $_SESSION['seats'];
		$types = $_SESSION['seattypes'];


		/*first insert into ticket booking*/
		$bookingDateTime = date('Y-m-d H:i:s');
		$payment = $_POST['paymentMethod'];
		$cost = $_SESSION['subtotal'];

		$email = $_POST['email'];
		$query = "SELECT Member_ID from member WHERE Email LIKE '$email';";

		$result = mysqli_query($db, $query);

		$resultarray = mysqli_fetch_assoc($result);

		if(!empty($resultarray['Member_ID']))
			{
			$memberid = "'" . $resultarray['Member_ID'] . "'";
			}
		else
			{
			$memberid = 'NULL';
			}

		if(isset($_SESSION['discountCode']))
			{
			$discount = "'" . $_SESSION['discountCode'] . "'";
			}
		else
			{
			$discount = 'NULL';
			}

		$query = "INSERT INTO `ticketbooking` (`MovieDateTime`, `DateTime`, `PaymentMethod`, `Cost`, `Member_ID`, `Theater_ID`, `Discount_ID`)
				VALUES ('$datetime', '$bookingDateTime', '$payment', '$cost', $memberid, '$theater_id', $discount);";


		mysqli_query($db, $query);

		/*get booking id*/
		$query = "SELECT MAX(Booking_ID) as Booking_ID FROM ticketbooking;";

		$result = mysqli_query($db, $query);

		$assoc = mysqli_fetch_assoc($result);

		$bookingid = $assoc['Booking_ID'];

		$i = 0;

		for($i = 1; $i < count($seats); $i++)
			{
			$query = "INSERT INTO seats (`Theater_ID`,  `DateTime`,  `Seat_No`, `Seat_Type`, `Booking_ID`)
							VALUES ($theater_id, '$datetime', '$seats[$i]', '$types[$i]', $bookingid);";

			$_SESSION['query'][$i] = $query;

			mysqli_query($db, $query);

			}

		/*booking is now made, destroy session*/
		unset($_SESSION['shopping_cart']);
	    unset($_SESSION['discountStatus']);
	    unset($_SESSION['subtotal']);
	    unset($_SESSION['total']);
	    unset($_SESSION['discountPercent']);
	    unset($_SESSION['discount']);
	 	unset($_SESSION['discountCode']);
	 	unset($_SESSION['seats']);
	 	header('Location: home.php');
		}


?>
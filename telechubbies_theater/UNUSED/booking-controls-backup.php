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
		$query = "SELECT No, Theater_ID
			FROM theater
			WHERE (Theater_ID IN (SELECT Theater_ID
                      			FROM showtimes
                      			WHERE Roll_ID IN (SELECT Roll_ID
                                			        FROM filmrolls
                                        			WHERE Movie_ID = $movie_id))) AND
        		(Branch_ID = $branchid);";

        echo $query;

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
			

		$query = "SELECT `DateTime`
				FROM showtimes
				WHERE Theater_ID = $theater
					AND Audio LIKE '$audio';";	
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
				$_SESSION['seats'][$i] = $seat['Seat_No'];
				$i++;
				}
			}
		}

	/*--------------------------END AJAX-----------------------------------------*/

	/*-------------------------START: submission and inserting-------------------------*/
	if(isset($_POST['showtime']))
		{
		$theater_id = $_POST['theater'];
		$datetime = $_POST['showtime'];
		$seats = explode("|", $_POST['selected-seats']);

		$i = 0;

		for($i = 1; $i < count($seats); $i++)
			{
			$query = "INSERT INTO seats (`Theater_ID`,  `DateTime`,  `Seat_No`)
							VALUES ($theater_id, '$datetime', '$seats[$i]');";

			$_SESSION['query'][$i] = $query;

			/*mysqli_query($db, $query);*/
			}
		}


?>
<?php
if(isset($_POST['redeem']))
			{
			$_SESSION['discountStatus'] = 0;
			$_SESSION['discountPercent'] = 0;
			$_SESSION['discountCode'] = 0;

			if(!empty($_POST['discount-code']))
				{
				$_SESSION['discountCode'] = $_POST['discount-code'];

				if(isset($_POST['pickup_branch']))
					{
					$pickup_branch = $_POST['pickup_branch'];
					}
				else if(isset($_SESSION['Branch_ID']))
					{
					$pickup_branch = $_SESSION['Branch_ID'];
					}


				$codeQuery = $_POST['discount-code'];

				/*check if code is eligible for selected branch*/
				$query = "SELECT * FROM validdiscount WHERE Discount_ID LIKE '$codeQuery' AND Branch_ID = $pickup_branch;";

				$_SESSION['QUErY'] = $query;

				$result = mysqli_query($db,  $query);


				if(mysqli_num_rows($result) > 0)
					{
					$discountQuery = "SELECT * FROM discount WHERE (Discount_ID LIKE '$codeQuery');";

					$discountResult = mysqli_query($db, $discountQuery);


					if($discountResult)
						{
						if(mysqli_num_rows($discountResult) > 0)
							{
							$_SESSION['discountStatus'] = 1;
							$discount = mysqli_fetch_array($discountResult);
							$_SESSION['discountPercent'] = $discount['PercentDiscount'];
							}
						}
					$_SESSION['invalid_branch'] = 0;
					}
				else
					{
					$_SESSION['invalid_branch'] = 1;
					}
				
				}
			#echo $_SESSION['discountStatus'];
			}

    if(isset($_POST['checkout-submit']))
	    {
	  	#for if there is no discount code
    	$discountCode = 'NULL';

    	if(!empty($_SESSION['discountCode'])):
    		#concatenate single quotes to make it a value
    		$discountCode = "'" . $_SESSION['discountCode'] . "'";
    	endif;

  		#FIRST CHECK IF EMAIL IS VALID
    	$db_email = $_POST['email'];

  		#get member id of member
    	$query = "SELECT Member_ID FROM member WHERE (Email LIKE '$db_email')";
    	$result = mysqli_query($db, $query);

    	$memberid_assoc = mysqli_fetch_assoc($result);

		
    	if(!empty($memberid_assoc['Member_ID']))
    		{
    		#concatenate single quotes to make it a value
    		$memberid = "'" . $memberid_assoc['Member_ID'] . "'";
    		}
    	else
    		{
    		#for if there is no memberid
    		$memberid = 'NULL';
    		}
    	

    	#ADD MERCHANDISE TRANSACTION
		#ONLY ADD TO DATABASE IF NO MEMBER EMAIL PROVIDED OR VALID EMAIL PROVIDED
	    if($result OR empty($db_email)):
	    		if(mysqli_num_rows($result) > 0  OR empty($db_email)):
				#CHECK METHOD OF PAYMENT
	    		$payMethod = $_POST['paymentMethod'];

	    		switch($payMethod)
	    		{
	    			case 'credit':
	    			$db_paymentMethod = 'CREDIT';
	    			break;
	    			case 'debit':
	    			$db_paymentMethod = 'DEBIT';
	    			break;
	    			case 'paypal':
	    			$db_paymentMethod = 'ONLINE';
	    			break;
	    			case 'cash':
	    			$db_paymentMethod = 'CASH';
	    			break;
	    		}

			  	#CHECK AND SET EMAIL
			  	$db_email = NULL;
	    		if(!empty($_POST['email']))
	    		{
	    			$db_email = $_POST['email'];
	    		}

			  	#GET DATETIME
	    		$dateTime = date('Y-m-d H:i:s');

			  	#ADD TO DATABASE
	    		echo 'ADDING TO DB';

			  	#SQL STATEMENT TO RECORD
			  	#NOTE:  $memberid and $discountCode have no single quote because it must be able to be SQL's NULL (without quotes)
			  	#quotes are controlled by prior checks.
	    		$record_merch = "INSERT INTO `merchandise` (`DateTime`, `PaymentMethod`, `Member_ID`, `Discount_ID`)
	    		VALUES ('$dateTime', '$db_paymentMethod', $memberid, $discountCode);";

	    		echo $record_merch;

	    		mysqli_query($db, $record_merch);

	    	endif;
	    endif;


	    #ADD ITEMSOLD
	    #first get transaction id, using datetime
	    $query = "SELECT TransactionID FROM merchandise WHERE (DateTime LIKE '$dateTime');";
	    $result = mysqli_query($db, $query);

	    $transactionId_assoc = mysqli_fetch_assoc($result);

	    $transactionId = $transactionId_assoc['TransactionID'];

	    foreach($_SESSION['shopping_cart'] as $key => $product):

	    	$itemID = $product['id'];
	    	$itemQuantity = $product['quantity'];

	    	$record_itemsold = "INSERT INTO itemsold (`TransactionID`, `ItemID`, `Quantity`)
	    							VALUES ('$transactionId', '$itemID', '$itemQuantity');";

	    	mysqli_query($db, $record_itemsold);

	    endforeach;

	    #FINALLY EVERYTHING IS DONE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	    #clear shopping cart
	    unset($_SESSION['shopping_cart']);
	    unset($_SESSION['discountStatus']);
	    unset($_SESSION['subtotal']);
	    unset($_SESSION['total']);
	    unset($_SESSION['discountPercent']);
	    unset($_SESSION['discount']);
	 	unset($_SESSION['discountCode']);
	    header('Location: home.php');

	  	#session_destroy();
	  	#unset($_SESSION);
		}	

?>
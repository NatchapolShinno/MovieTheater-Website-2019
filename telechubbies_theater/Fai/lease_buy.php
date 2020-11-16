

<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');


$queryBranch = "SELECT * FROM cinemabranch;";
$queryMovie = "SELECT * FROM movie;";
$queryExpenses = "SELECT * FROM expenses;";
$queryFilmroll = "SELECT * FROM filmrolls;";

$resultBranch = mysqli_query($db, $queryBranch);
$resultMovie = mysqli_query($db, $queryMovie);

#add new expenses into expense table
if(isset($_POST['submit']))
	{
	$submit_DateTime = date('Y-m-d H:i:s');
	$manager_id = $_POST['manager_id'];

	$queryExpenses = "INSERT INTO `expenses`(`Manager_ID`, `DateTime`)
	VALUES('$manager_id ', '$submit_DateTime');";

	mysqli_query($db, $queryExpenses);
	$last_insert_expensesid = mysqli_insert_id($db); 
	#check
	echo $queryExpenses;
	}


#check if newest expense id has been added then add details into film rolls table
if(isset($last_insert_expensesid))
    {
	$movie_id = $_POST['movie_id'];
	$distributor = addslashes($_POST['distributor']);
	$filmroll_no = $_POST['filmroll_no'];
	$amount = $_POST['amount'];
	$branch_id = $_POST['branch_id'];
	$lease_date = $_POST['lease_date'];
	$period = $_POST['period'];
  	$choice = $_POST['choice'];

		#check if manager choose buy, then let period equal to null
		if($choice == '2') 
		{
		$queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`, `Amount`, `Expense_ID`)
							VALUES('$movie_id ', '$branch_id', '$lease_date','$distributor', NULL, '$amount', '$last_insert_expensesid');";
		}
		else
		{
		$queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`, `Amount`, `Expense_ID`)
							VALUES('$movie_id', '$branch_id', '$lease_date','$distributor', '$period', '$amount', '$last_insert_expensesid');";
		}
		#add film roll with a given number of lease
		for($i = 0; $i < $filmroll_no; $i++)
				{
				mysqli_query($db, $queryFilmroll);
				}
		#check
		echo $queryFilmroll;
		}

?>






<!DOCTYPE html>
<html lang="en">
<head>
<title>Telechubbies Theater | Lease/Buy Form</title>
 
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Space Register Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->

	<!-- css files -->
	<link href="lease_buy_css/lease_buy_style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- css files -->

	<!-- Online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<!-- //Online-fonts -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body>

	<!-- Main Content -->
	<div class="main">
		<div class="main-w3l">
			<h1 class="logo-w3">Lease/Buy Form </h1>
			<div class="w3layouts-main">

					<form method="POST">

						<!--------------------------- MOVIE ------------------------->
			
						<p for="movie_id">Movie</p>
						<select id="movie_id" name="movie_id" class="form-control" required>
						<option selected>Select</option>
						<?php foreach($resultMovie as $key => $value)
							{
						?>
							<option value="<?php echo $value['Movie_ID'];?>"><?php echo $value['Movie_Name'];?></option>
						<?php } ?>
						</select>

						<!--------------------------- DISTRIBUTOR ------------------------->
						<div class="form-control">
						<p>Distributor Name</p>
						<input type="text" name="distributor" placeholder="Distributor Name" required="">
						</div>

						<!--------------------------- No. of film roll ------------------------->
						<div class="form-control">
							<p>Number of Film Roll</p> 
							<input type="number" id="filmroll_no" name="filmroll_no"  min="1" max="15" placeholder="Enter only 1 to 15" required="">
						</div>			
						
						<!--------------------------- Amount of each film roll ------------------------->
						<div class="form-control">
							<p>Amount฿ [for each]</p> 
							<input type="number" id="amount" name="amount" min="1" max="10000" placeholder="Enter only 1 to 10000" required="">
						</div>			
						
						<!--------------------------- Manager ID ------------------------->
						<div class="form-control">
                  		<p>Manager ID</p>
                  		<input type="text" name="manager_id" placeholder="Manager ID" maxlength="6"required="">
						</div>
					
						<!--------------------------- Branch ------------------------->
						<div class="form-control">
						<p for="branch_id">Cinema Branch</p>
						<select id="branch_id" name="branch_id" class="form-control" required>
							<option selected>Select</option>
							<?php foreach($resultBranch as $key => $value)
							{
							?>
							<option value="<?php echo $value['Branch_ID'];?>"><?php echo $value['Location'];?></option>
							<?php } ?>
						</select>
						</div>

						<!--------------------------- CHOICE ------------------------->
						<div class="form-control">
							<p for="choice">Choice</p>
								<select id= "choice" name = "choice" required>
								<option selected>Select</option>
								<option value="1">Lease</option>       
								<option value="2">Buy</option>     
							</select>
						</div>

						<!--------------------------- Period ------------------------->
						
						<div class="form-control">
						<p>Period [month]</p> 
						<input type="text"  name="period" pattern="[1-12]" placeholder="Enter 1 to 12 For Lease | 0 For Buy "required="">
						</div>

						<!--------------------------- LEASE DATE ------------------------->

						<div class="form-control">
						<p for = "lease_date">Lease/Buy Date</p>
							<input type="text" id="datepicker" name="lease_date" class="form-control member-info-field" value="<?php echo $lease_date;?>" required/>
								<script>
								$('#datepicker').datepicker({
									uiLibrary: 'bootstrap4',
									format: 'yyyy-mm-dd',
									width: 200
								});
								</script>
						</div>    
						<br>
						<!--------------------------- SUBMIT ------------------------->
						<div>
							<input type="submit" value="submit" name="submit"/>
						</div>
						<!------------------------------------------------------------->


					</form>
			</div>
		<!--footer-->
			<div class="footer-w3l">
				<p>&copy; 2020 | Telechubbies Theater</a></p>
			</div>
			<!--//footer-->
			
		</div>
	</div>
	<!-- //Main Content -->

</body>
</html>

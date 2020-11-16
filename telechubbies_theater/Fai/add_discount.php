
<?php

#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');

$queryDiscount = "SELECT * FROM discount;";
$queryBranch = "SELECT * FROM cinemabranch;";
$queryValiddiscount = "SELECT * FROM validdiscount;";


$resultBranch = mysqli_query($db, $queryBranch);

#When press submit data will insert into discount table
if(isset($_POST['submit']))
	{
	$discount_id = addslashes($_POST['discount_id']);
	$percent_discount = $_POST['percent_discount'];
	$discount_details = addslashes($_POST['discount_details']);
	$discount_condition = addslashes($_POST['discount_condition']);
	
	$queryDiscount = "INSERT INTO `discount`(`Discount_ID`, `PercentDiscount`, `DiscountDetails`, `DiscountCondition`)
			   VALUES('$discount_id', '$percent_discount', '$discount_details', '$discount_condition');";

	mysqli_query($db, $queryDiscount);	
	$last_insert_discountid = mysqli_insert_id($db);   
	#check
	echo $queryDiscount;
	}

#check if newest discount id has been added then add details into validdiscount table
if(isset($last_insert_discountid))
	{
		foreach ($_POST['branch_id'] as $branch_id)
		{
		$queryValiddiscount= "INSERT INTO `validdiscount`(`Discount_ID`, `Branch_ID`)
		VALUES('$discount_id', '$branch_id');";
		mysqli_query($db, $queryValiddiscount);
		}	
	
	#check
	echo $queryValiddiscount;
	}	
	
?>







<!DOCTYPE html>
<html lang="en">
<head>
<title>Telechubbies Theater | Add Discount</title>
 
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
	<link href="add_discount_css/add_discount_style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- css files -->

	<!-- Online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<!-- //Online-fonts -->

	<!-- Add Remove Select Box  -->
	<title>Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</title>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

	<!-- Main Content -->
	<div class="main">
		<div class="main-w3l">
			<h1 class="logo-w3">Add Discount </h1>
			<div class="w3layouts-main">

					<form method="POST">

						<!--------------------------- Discount ID ------------------------->
						<div class="form-control">
                  		<p>Discount ID</p>
                  		<input type="text" name="discount_id" placeholder="maximum at eight characters" maxlength="8"required="">
						</div>

						<!--------------------------- Percent Discount ------------------------->
						<div class="form-control">
                  		<p>Percent Discount</p>
                  		<input type="number" name="percent_discount" min="1" max="100" placeholder="Enter only 1 to 100" required=""/> 
						</div>

						<!--------------------------- Discount Details ------------------------->
						<div class="form-control">
                  		<p>Discount Details</p>
                  		<input type="text" name="discount_details"  placeholder="Details of discount" required="" /> 
						</div>

						<!--------------------------- Discount Condition ------------------------->
						<div class="form-control">
                  		<p>Discount Condition</p>
                  		<input type="text" name="discount_condition"  placeholder="Condition of discount" required="" /> 
						</div>	
						
						<!--------------------------- Branch ------------------------->
						<div class="form-control">
						<p for="branch_id">Cinema Branch   (ctrl-click to select multiple branch)</p>
						<select id="branch_id" name="branch_id[]" class="form-control"  multiple = "multiple"  required >
							<?php foreach($resultBranch as $key => $value)
							{
							?>
							<option value="<?php echo $value['Branch_ID'];?>"><?php echo $value['Location'];?></option>
							<?php } ?>
						</select>
						</div>

						<input type="submit" value="Add New Discount" name="submit">


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

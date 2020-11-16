<?php


  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
  if(!isset($_SESSION))
    {
    session_start();
  }
//pre_r($_SESSION); 

  include 'account-controls.php';

  include 'manager-profile-controls.php';

  include 'intranet-controls.php';

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
	//echo $queryExpenses;
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
		//echo $queryFilmroll;
		}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Telechubbies Theater</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="styleSidebar.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
  	<!-- css files -->
	<link href="lease_buy_css/lease_buy_style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>-->

  <!--INCLUDE THESE----->

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!---------------------->

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
  <header class="header-fade" style="background: #2f3640;">
    <div class="inner-width">
      <a href="#" class="logo"><img src="logo.png" alt="" /></a>
      <div class="internal-welcome"><h3>Telechubbies Cinemas Internal Management System</h3></div>
      <nav class="navigation-menu">

          <!--check if user is already logged in from session-->
          <?php
            if(!isset($_SESSION['employee-id']))
            {
          ?>
          <form method="POST" action = "login.php?prev=<?php echo $curPageName;?>">
            <input type="submit" class="btn btn-info" name="sign-in" value = "Sign In"/>
          </form>
          <?php
            }
          ?>

          <?php
            if(isset($_SESSION['employee-id'])) 
            {
            $profile_name = $_SESSION['employee-name'];
          ?>
          <a href="home-manager.php"><?php echo "$profile_name"; ?></a>
          <form method="POST" action="home.php">
            <input type="submit" class="btn btn-danger" name="sign-out" value = "Sign Out"/>
          </form>
          <?php
            }
          ?>


        </nav>
    </div>
    </header>

<!--Sidebar menu-->


<!--Profile-->
    <div class="wrapper" style="margin-top: 90px;">
        <!-- Sidebar Holder -->
<nav id="sidebar">
            <div class="sidebar-header">
                <h3>Telechubbies Cinemas</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome, <?php echo $_SESSION['employee-name'];?>!</p>
                <li>
                    <a href="./home-manager.php">Profile</a>

                </li>
                <li>
                  <a href="#manageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Management</a>
                  <ul class="collapse list-unstyled show" id="manageSubmenu">
                    <li>
                        <a href="managerClock.php">Clock In/Out</a>
                    </li>
                    <li>
                        <a href="showtimesPage.php">Manage Showtimes</a>
                    </li>
                    <li>
                        <a href="managerExpense.php">Manage Expenses</a>
                    </li>
                    <li>
                        <a href="addItems.php">Add Merchandise</a>
                    </li>
                    <li class="active">
                        <a href="film_buy.php">Buy/Lease Film Rolls</a>
                    </li>
                    <li>
                        <a href="add_movie.php">Add Movie</a>
                    </li>
                    <li>
                        <a href="add_discount.php">Add Discount</a>
                    </li>
                    <li>
                        <a href="./managerEmploy.php">Add Employee</a>
                    </li>
                    <li class="active">
                        <a href="managerEvaluate.php">Evaluate Employee</a>
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                  <ul class="collapse list-unstyled" id="reportSubmenu">
                      <li>
                        <a href="sales_report.php">Merchandise Sales</a>
                      </li>
                      <li>
                        <a href="movies_report.php">Movie Sales</a>
                      </li>
                      <li>
                        <a href="expenseAnalysis.php">Expense Report</a>
                      </li>
                      <li>
                        <a href="profit_report.php">Profit Analysis</a>
                      </li>
                  </ul>
                </li>
               
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content Holder -->
        <div id="content">
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
							<input type="number" id="amount" name="amount" placeholder="Cost of each film roll" required="">
						</div>			
						
						<!--------------------------- Manager ID ------------------------->
						<div class="form-control">
                  		<p>Buying Manager</p>
                  		<input type="text"  placeholder="<?php echo $_SESSION['employee-name'];?>" disabled>
                  		<input type="hidden" name="manager_id" value="<?php echo $_SESSION['employee-id'];?>"/>
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
						<input type="text"  name="period" placeholder="Enter 1 to 12 if leasing">
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

            
      </div>


<!-- jQuery CDN - Slim version (=without AJAX) -->

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.js" crossorigin="anonymous"></script>

    

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    <script>
      window.addEventListener("scroll", function() {

        if(window.scrollY > 0)
            {
            $("header").removeClass("header-fade");
            }
        else
            {
            $("header").addClass("header-fade");   
            }
    });
    </script> 




</body>

</html>
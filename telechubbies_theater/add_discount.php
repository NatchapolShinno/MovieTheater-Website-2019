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

  include 'intranet-controls.php';


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
  //echo $queryDiscount;
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
  //echo $queryValiddiscount;
  } 

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Telechubbies Theater</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="add_discount_css/add_discount_style.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="styleProfile.css" />
  <link rel="stylesheet" href="styleSidebar.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
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
                    <li>
                        <a href="film_buy.php">Buy/Lease Film Rolls</a>
                    </li>
                    <li>
                        <a href="add_movie.php">Add Movie</a>
                    </li>
                    <li class="active">
                        <a href="add_discount.php">Add Discount</a>
                    </li>
                    <li>
                        <a href="./managerEmploy.php">Add Employee</a>
                    </li>
                    <li>
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
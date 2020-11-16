<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');

  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
session_start();
//pre_r($_SESSION);
$queryEmployee = "SELECT * FROM employees;";
$resultEmployee = mysqli_query($db, $queryEmployee);


if(isset($_POST['submit']))
  {
  $submit_DateTime = date('Y-m-d H:i:s');
  $managerid = $_SESSION['employee-id'];
  $employeeid = $_POST['inputEmployee'];
  $details = addslashes($_POST['details']);

  $query = "INSERT INTO `employeeevaluation`(`Employee_ID`, `DateTime`, `Manager_ID`, `Details`)
  VALUES('$employeeid ', '$submit_DateTime', '$managerid', '$details');";

  mysqli_query($db, $query); 
  #check
  //echo $queryExpenses;
  }

error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Telechubbies Theater | Employee Evaluation Form </title>
    <link rel="stylesheet" href="styleProfile.css" />
  <link rel="stylesheet" href="styleSidebar.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script>
            $( function() 
            {
              $( "#BirthDate" ).datepicker({ dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
            } );
            </script>

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
                      <li class="active">
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
          <!-- Sidebar Holder -->
<div id="content" style="margin-top: 100px;">
          <body>
            <center><h1>Employee Evaluation</h1></center>
  <form method="POST" action="managerEvaluate.php">

                  <!----------Employee ID ---------->

  <div class ="container-fluid" style="width: 500px;">
          <div class="row">
          <label for="inputEmployee">Employee<br></label>
          </div>
          <div class="row">
          <select id="inputEmployee" name="inputEmployee" class="form-control" required>
              <option selected>Choose...</option>
                  <?php foreach ($resultEmployee as $key => $value) { 
                        if($value['Employee_ID'] != $_SESSION['employee-id']) {?>
              <option value="<?= $value['Employee_ID']; ?>"><?= $value['Employee_Name']; ?></option>
                  <?php }} ?>
          </select>
          </div>
          <div class="row">
                  <!----------Manager id ---------->
          <label for ="managername">Evaluating Manager<br></label>
          </div>
          <div class="row">
          <input class="form-control" type="text" id="managername" name="managername" placeholder="<?php echo $_SESSION['employee-name'];?>" disabled/>
          </div>
                  <!----------Feedback ---------->
          <div class="row">
          <label for = "details">Details<br></label> 
          </div>
          <div class="row">
          <textarea class="form-control" id="details" name="details" placeholder="Write any feedback to employee"required="" rows="6"></textarea>
          </div>
          <input  type="hidden" id="managerid" name="managerid" value="<?php echo $_SESSION['employee-id'];?>"/>
        <!-- Page Content Holder -->
   

<!--    <div class = "form-group col-md-6"> -->
                <!----------Submit---------->
                <br>     
             <center><input class="btn btn-info" type="submit" value="submit" name="submit"/></center>
      </form> 
      </div>     
</div>
  </body>
</body>


            
            
               




</body>

</html>
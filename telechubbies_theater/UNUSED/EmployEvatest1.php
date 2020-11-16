<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');


$queryEmployee = "SELECT * FROM employees;";
$resultEmployee = mysqli_query($db, $queryEmployee);


if(isset($_POST['submit']))
  {
  $submit_DateTime = date('Y-m-d H:i:s');
  $managerid = $_POST['managerid'];

  $queryExpenses = "INSERT INTO `expenses`(`managerid`, `datetime`)
  VALUES('$managerid ', '$submit_DateTime');";

  mysqli_query($db, $queryExpenses);
  $last_insert_expensesid = mysqli_insert_id($db); 
  #check
  //echo $queryExpenses;
  }

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['submit'])) {
    $managerid = $_POST['ManagerID'];
    $employeeid = $_POST['EmployeeID'];
    $datetime = $_POST['Datetime'];
    $option = $_POST['option'];
}

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
                <li class="active">
                    <a href="./home-employee.php">Profile</a>

                </li>
                 <li>
                    <a href="employeeClock.php">Clock In/Out</a>
                </li>
                <li>
                    <a href="employeeMaintenance.php">Log Maintenance</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>
          <!-- Sidebar Holder -->
<div id="content">
          <body>
  <form method="POST" action="EmployEvatest1.php">

                  <!----------Employee ID ---------->
      <div class="form-group col-md-6">
          
          <label for="inputBranch">Branch<br></label>
          <select id="inputBranch" name="inputEmployeeID" class="form-control" required>
              <option selected>Choose...</option>
                  <?php foreach ($resultEmployee as $key => $value) { ?>
              <option value="<?= $value['Employee_ID']; ?>"><?= $value['Location']; ?></option>
                  <?php } ?>
          </select>
      </div>

  <div class ="container-fluid">
                  <!----------Manager id ---------->
    <div class="form-row">
      <div class = "form-group col-md-6">
          <label for ="managerid">ManagerID<br></label>
          <input type="text" id="managerid" name="managerid" placeholder="ManagerID" maxlength="6"required="">
      </div>
    </div>
                  <!----------Feedback ---------->

    <div class="form-row">
      <div class = "form-group col-md-6">
          <label for = "detail">Period <br></label> 
          <input type="text" id="detail" name="detail" placeholder="Write any feedback to employee"required="">
      </div>
    </div>
                  <!----------Date time ---------->

    <p><label>date_time:</label>
        </p><input type="datetime-local" name="BirthDate" >
  <!---  <div class="form-row"> 
      <div class="form-group col-md-6">
          <label for = "date_time">Select Datetime<br></label>
          <input type="datetime" name="date_time" required/>
            <script>
            $('#datepicker').datepicker({
              uiLibrary: 'bootstrap4',
              format: 'yyyy-mm-dd',
              width: 200
            });
            </script>
      </div>
    </div> --->
  </div>

</div>   
        <!-- Page Content Holder -->
  </form>  

    <div class = "form-group col-md-6">
                <!----------Submit---------->     
        <div class="form-row">
          <div class = "form-group col-md-6">
             <input type="submit" value="submit" name="submit"/>
          </div>
        
      </div>
    </div>
  </body>
</body>


            
            
               




</body>

</html>
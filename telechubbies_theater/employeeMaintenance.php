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

  include 'maintenance-controls.php';

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Telechubbies Theater</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                    <a href="./home-employee.php">Profile</a>

                </li>
                 <li>
                    <a href="employeeClock.php">Clock In/Out</a>
                </li>
                <li class="active">
                    <a href="employeeMaintenance.php">Log Maintenance</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content Holder -->
        <div id="content" style="margin-top: 100px;">
          <center><h1>Maintenance Logging</h1></center>
          <div class="container-fluid" style="padding-left: 100px; padding-right: 100px;">
            <form method="POST">
              <div class="row">
                <div class="col">
                  <label for="employee-name">Name</label>
                  <input type="text" name="employee-name" class="form-control" value="<?php echo $employee_name ?>" disabled/>
                  <input type="hidden" name="employee-id" value="<?php echo $employeeid ?>"/>
                  <label for="maintain-datetime">Date & Time of Maintenance</label>
                  <input type="datetime-local" name="maintain-datetime" class="form-control" id="inputDate4"/>
                  <label for="maintain-type">Type of Maintenance Job</label>
                  <select class="form-control" name="maintain-type">
                    <option selected>Select a job type...</option>
                    <option value="REPAIR">Equipment Repair</option>
                    <option value="CLEANING">Cleaning</option>
                    <option value="GENERAL">General Equipment Maintenance</option>
                    <option value="OTHER">Other</option>
                  </select>
                  <label for="maintain-details">Description</label>
                  <textarea name="maintain-details" class="form-control" placeholder="Please describe the maintenance job." rows="5"></textarea>
                  <br>
                  <center><button type="submit" name="maintain-submit" class="btn btn-info">Log Maintenance</button></center>
                </div>
              </div>
            </form>
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
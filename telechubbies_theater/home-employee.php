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
        <!-- Page Content Holder -->
        <div id="content">

            
            
                <!--profile picture-->
    <center>

      <?php
      $profile_img = './employee-img/' . $_SESSION['employee-id'] . '.jpg';

      if(file_exists($profile_img) == TRUE)
          {
      ?>

      <img src="./employee-img/<?php echo $_SESSION['member-id'] ?>.jpg" class="profile-img"/>

      <?php
          }
      else
          {
      ?>

      <img src="./employee-img/anon.png" class="profile-img"/>

      <?php
          }
      ?>

    </center>


    <center><span>Click here to edit profile picture</span></center>
    

    <!--user info-->
      <!--if the user is NOT editing profile-->
      <div class="container-fluid" style="padding-left: 100px; padding-right: 100px;">
      <?php
        if(empty(filter_input(INPUT_GET, 'edit')))
          {
      ?>
         <!--get user information-->
      <form method="POST" action="profile.php?edit=1">
            <div class="row">
        <div class="col">
          <label for="employee-name">Name</label>
          <input type="text" name="employee-name" class="form-control member-info-field" value="<?php echo $employee_name;?>" disabled/>

          <label for="employee-position">Position</label>
          <input type="text" name="employee-position" class="form-control member-info-field" value="<?php echo $employee_position;?>" disabled/>

          <label for="employee_salary">Salary</label>
          <input type="text" name="employee_salary" class="form-control member-info-field" value="<?php echo $employee_salary;?>" disabled/>

          <label for="employee_branch">Parent Branch</label>
          <input type="text" name="employee_branch" class="form-control member-info-field" value="<?php echo $employee_branch;?>" disabled/>

          <label for="employee_phone">Phone Number</label>
          <input type="text" name="employee_phone" class="form-control member-info-field" value="<?php echo $employee_phone;?>" disabled/>
        </div>

        <div class="col">
          <label for="employee_address">Contact Address</label>
          <input type="text" name="employee_address" class="form-control member-info-field" value="<?php echo $employee_address;?>" disabled/>

          <label for="employee_dob-dob">Date of Birth</label>
          <input type="text" name="employee_dob" class="form-control member-info-field" value="<?php echo $employee_dob;?>" disabled/>

          <label for="employee_hours">Required Work Hours/Week</label>
          <input type="text" name="employee_hours" class="form-control member-info-field" value="<?php echo $employee_hours;?>" disabled/>
        </div>
      </div>

       <center><input type="submit" class="btn btn-info" value="Edit Profile"/></center>

      </form>

      <!--if the user is editing profile-->
      <?php
          }
        else
          {
      ?>

      <form method="POST">
    <div class="row">
        <div class="col">
          <label for="member-name">Name</label>
          <input type="text" name="member-name" class="form-control member-info-field" value="<?php echo $member_name;?>"/>

          <label for="member-type">Membership Type</label>
          <input type="text" name="member-type" class="form-control member-info-field" value="<?php echo $member_type;?>" disabled/>

          <label for="member-regdate">Registered Date</label>
          <input type="text" name="member-regdate" class="form-control member-info-field" value="<?php echo $member_regdate;?>" disabled/>

          <label for="member-point">Points</label>
          <input type="text" name="member-point" class="form-control member-info-field" value="<?php echo $member_point;?>" disabled/>
        </div>

        <div class="col">
          <label for="member-contact">Contact Information</label>
          <input type="text" name="member-contact" class="form-control member-info-field" value="<?php echo $member_contact;?>"/>

          <!--DATE PICKER FOR BIRTHDATE-->


          <label for="member-dob">Date of Birth</label>
          <input type="text" id="datepicker" name="member-dob" class="form-control member-info-field" value="<?php echo $member_dob;?>"/>
          
          <script>
              $('#datepicker').datepicker({
                  uiLibrary: 'bootstrap4',
                  format: 'yyyy-mm-dd',
                  width: 300
              });
          </script>

          <label for="member-email">E-mail</label>
          <input type="text" name="member-email" class="form-control member-info-field" value="<?php echo $member_email;?>"/>
        </div>
      </div>

      <center><input type="submit" name="submit-profile" class="btn btn-info" value="Submit"/></center>

      </form>


      <?php
          }
      ?>

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
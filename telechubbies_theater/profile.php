<?php

  session_start();

  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

// pre_r($_POST); 

  include 'account-controls.php';

  include 'profile-controls.php';

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
      <nav class="navigation-menu">
          <a href="home.php"><i class="fas fa-home home"></i> Home</a>
          <a href="#"><i class="fas fa-align-left about"></i> About</a>
          <a href="movielist.php"><i class="fas fa-film"></i> Movies</a>
          <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
          <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
          <a href="snacks.php"><i class = "fas fa-cookie snacks"></i>Snacks</a>

          <!--check if user is already logged in from session-->
          <?php
            if(!isset($_SESSION['member-id']))
            {
          ?>
          <form method="POST" action = "login.php?prev=<?php echo $curPageName;?>">
            <input type="submit" class="btn btn-info" name="sign-in" value = "Sign In"/>
          </form>
          <?php
            }
          ?>

          <?php
            if(isset($_SESSION['member-id'])) 
            {
            $profile_name = $_SESSION['member-name'];
          ?>
          <a href="profile.php"><?php echo "$profile_name"; ?></a>
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
                <p>Welcome, <?php echo $_SESSION['member-name'];?>!</p>
                <li class="active">
                    <a href="./profile.php">Profile</a>

                </li>
                <li>
                    <a href="./profile-history.php">Movie History</a>
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
      $profile_img = './profile-img/' . $_SESSION['member-id'] . '.jpg';

      if(file_exists($profile_img) == TRUE)
          {
      ?>

      <img src="./profile-img/<?php echo $_SESSION['member-id'] ?>.jpg" class="profile-img"/>

      <?php
          }
      else
          {
      ?>

      <img src="./profile-img/anon.png" class="profile-img"/>

      <?php
          }
      ?>

    </center>


    <center><span>Click here to edit profile picture</span></center>
    

    <!--user info-->
      <!--if the user is NOT editing profile-->
      <div class="container-fluid">
      <?php
        if(empty(filter_input(INPUT_GET, 'edit')))
          {
      ?>
         <!--get user information-->
      <form method="POST" action="profile.php?edit=1">
            <div class="row">
        <div class="col">
          <label for="member-name">Name</label>
          <input type="text" name="member-name" class="form-control member-info-field" value="<?php echo $member_name;?>" disabled/>

          <label for="member-type">Membership Type</label>
          <input type="text" name="member-type" class="form-control member-info-field" value="<?php echo $member_type;?>" disabled/>

          <label for="member-regdate">Registered Date</label>
          <input type="text" name="member-regdate" class="form-control member-info-field" value="<?php echo $member_regdate;?>" disabled/>

          <label for="member-point">Points</label>
          <input type="text" name="member-point" class="form-control member-info-field" value="<?php echo $member_point;?>" disabled/>
        </div>

        <div class="col">
          <label for="member-contact">Contact Information</label>
          <input type="text" name="member-contact" class="form-control member-info-field" value="<?php echo $member_contact;?>" disabled/>

          <label for="member-dob">Date of Birth</label>
          <input type="text" name="member-dob" class="form-control member-info-field" value="<?php echo $member_dob;?>" disabled/>

          <label for="member-email">E-mail</label>
          <input type="text" name="member-email" class="form-control member-info-field" value="<?php echo $member_email;?>" disabled/>
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
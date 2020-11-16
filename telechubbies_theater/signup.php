<?php

  function pre_r($array)
  {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
  }

  session_start();

  include 'account-controls.php';

  #pre_r($_SESSION);



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login Telechubbies</title>
    <link rel="stylesheet" href="styleLogin.css" />
    <link rel="stylesheet" href="navMenuBodyStyle.css" />
    <meta name="viewport" content="width = device-width, initial-scale=1.0" />

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />

             <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <header>
    <div class="inner-width">
      <a href="#" class="logo"><img src="logo.png" alt="" /></a>
      <nav class="navigation-menu">
          <a href="home.php"><i class="fas fa-home home"></i> Home</a>
          <a href="#"><i class="fas fa-align-left about"></i> About</a>
          <a href="movielist.php"><i class="fas fa-film"></i> Movies</a>
          <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
          <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
          <a href="snacks.php"><i class = "fas fa-cookie snacks"></i>Snacks</a>
          
          <form method="POST" action = "login.php?<?php echo $_SERVER['QUERY_STRING'];?>">
            <input type="submit" class="btn btn-info" name="sign-in" value = "Sign In"/>
          </form>

        </nav>
    </div>
    </header>


    <!---<canvas id="fixImage"></canvas>
    <script src="fixImage.js"></script>-->

    <!--BOOTSTRAP CONTAINER-->
    <div class="container">

    <center><h1 style="margin-top: 50px;" class="sign-up-title">Sign Up</h1></center>
   <form method="POST">

    <!--error messages--------------------------------------------------------->

    <!--ERROR: password mismatch-->
    <?php
      if(isset($password_nomatch) AND isset($password_invalid_length) AND isset($email_invalid) AND isset($branch_invalid))
          {
          if($password_nomatch == 1)
             {
    ?>

  <div class="alert alert-danger" role="alert">
        Password don't match!
  </div>

    <?php
             }
    ?>

    <!--ERROR: password too short-->
    <?php
          if($password_invalid_length == 1)
             {
    ?>
    <div class="alert alert-danger" role="alert">
        Password too short! Must have at least 8 characters.
    </div>

    <?php
              }
    ?>

    <!--ERROR: email already exists-->
    <?php
         if($email_invalid == 1)
              {
    ?>
    <div class="alert alert-danger" role="alert">
        User with this e-mail already exists!
    </div>
    <?php
             }
    ?>

    <!--ERROR: branch invalid-->
    <?php
         if($branch_invalid == 1)
             {
    ?>
    <div class="alert alert-danger" role="alert">
        Branch does not exist!
    </div>

    <?php
           }
        }
    ?>

    <!--END: ERROR MESSAGES================================================-->


      <div class="row login-container">
        <div class="col-sm col-centered">
              <label for="email">E-Mail</label>
              <input type="text" class="form-control" placeholder="electronic@mail.com" name="email"/>
              <small class="text-muted">This e-mail will be used for logging in as member.</small>
              <br>
              <label for="email">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password"/>
              <br>
              <label for="email">Confirm Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password_repeat"/>
              <small class="text-muted">Must consist of at least 8 characters. Encryption not guaranteed.</small>
              <br>
              <label for="email">Full Name</label>
              <input type="text" class="form-control" placeholder="John Doe" name="member-name"/>
              <small class="text-muted">This will be your display name in the system.</small>
              </div>
             <div class="col-sm col-centered">
              <label for="email">Register Branch</label>
              <select id="inputBranch" name="branch" class="form-control"required>
                                <option selected>Choose...</option>
                                <?php foreach($resultBranch as $key => $value){?>
                                    <option value="<?php echo $value['Branch_ID'];?>"><?php echo $value['Location'];?></option>
                                <?php } ?>
                            </select>
              <small class="text-muted">Please choose the branch that you go to the most often.</small>
              <br>
              <label for="email">Contact Information</label>
              <input type="text" class="form-control" placeholder="Phone number, address, etc." name="contact-info"/>
              <br>
              <label for="email">Date of Birth</label>
              <input type="text" id="datepicker" name="member-dob" class="form-control"/>
              <script>

                  $('#datepicker').datepicker({
                      uiLibrary: 'bootstrap4',
                      format: 'yyyy-mm-dd',
                      value: '2000-01-01'
                  });
              </script>
            </div>
        

        </div>

        <div class="row">
          <div class="col col-centered">
                        <center><input type = "submit" name = "sign-up-submit" class = "btn btn-info" style="width: 200px;" value = "Sign Up"/></center>
          </div>
        </div>


      </div>
    </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.js" crossorigin="anonymous"></script>

  </body>
</html>

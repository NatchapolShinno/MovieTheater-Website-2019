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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
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

      <center>
      <div class="row login-container">
        <div class="col-sm col-centered">
          <div class="login-box">
            <h1>Sign In</h1>
            <!--info message after signing up-->
             <?php
              if(isset($_SESSION['signup_complete']))
                {
            ?>

            <div class="alert alert-success" role="alert">
              Signup is complete! You may now sign in.
            </div>

            <?php
              unset($_SESSION['signup_complete']);
                }
            ?>



            <!--invalid login alert message-->
            <?php
              if(isset($invalid_login))
                {
            ?>

            <div class="alert alert-danger" role="alert">
            Invalid username or password!
            </div>

            <?php
                }
            ?>

            <form method="POST">
              <input type="text" class="form-control" placeholder="E-mail" name="email">
              <br>
              <input type="password" class="form-control" placeholder="Password" name="password">
              <br>
              <center><input type = "submit" name = "sign-in-submit" class = "btn btn-info" value = "Sign In"/></center>
            </form>
          </div>
        </div>

      </div>

              <div class="signup">
          <br>
          <span style="color: black;"
          >Not registered?
          <a href="signup.php"
            ><span class="signup">Create an account</span></a
          >
          </span><br><br>
        </div>


    </center>
    </div>

    <!--
    <div class="login-box">
      <h1>Login</h1>
      <div class="textbox">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="E-mail" />
      </div>
      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Password" />
      </div>

      <a href="fallingCount.html" class = "btn btn-info">Log In</a>
      <br />
      <div class="signup">
        <br>
        <span style="color: black;"
          >Not registered?
          <a href="signup.html"
            ><span class="signup">Create an account</span></a
          >
        </span><br><br>
      </div>
    </div>-->



  </body>
</html>

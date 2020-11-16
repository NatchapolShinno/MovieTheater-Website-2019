<?php

  session_start();

  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

//pre_r($_POST); 

  include 'account-controls.php';

  include 'connectDB.php';

  include 'profile-controls.php';

  $memberid = $_SESSION['member-id'];

  //category summary
  $query = "SELECT COUNT(*) AS categoryCount, Genre
FROM movie JOIN (
          SELECT Movie_ID
                FROM  filmrolls JOIN (
                             SELECT Roll_ID
                             FROM showtimes JOIN (
                                                 SELECT DISTINCT  Theater_ID, DateTime
                                                 FROM seats JOIN (
                                                                   SELECT Booking_ID
                                                                   FROM ticketbooking
                                                                   WHERE Member_ID = 1
                                     )seatsBooking
                                                      ON seatsBooking.Booking_ID = seats.Booking_ID
                                               )showtimeSeats
                                    ON showtimeSeats.Theater_ID = showtimes.Theater_ID
                                      AND showtimeSeats.DateTime  = showtimes.DateTime
                             )rollShowtimes
                  ON rollShowtimes.Roll_ID = filmrolls.Roll_ID
        )movieRolls
           ON movie.Movie_ID = movieRolls.Movie_ID
GROUP BY Genre
ORDER BY categoryCount DESC;";

  $categories = mysqli_query($db, $query);

  //all past viewings
  $query = "SELECT DISTINCT
    Movie_ID,
    Movie_Name,
    bookingSeats.DateTime,
    Cost,
    Subgenre,
    Genre
FROM
    ticketbooking tb
JOIN(
    SELECT Booking_ID,
        seats.Theater_ID,
        seats.DateTime,
        Movie_ID,
        Movie_Name,
        Genre,
      Subgenre
    FROM
        seats
    RIGHT JOIN(
        SELECT showtimes.DateTime,
            showtimes.Theater_ID,
            showtimes.Roll_ID,
            Movie_ID,
            Movie_Name,
            Genre,
          Subgenre
        FROM
            showtimes
        RIGHT JOIN(
            SELECT Roll_ID,
                rollMovie.Movie_ID,
                Movie_Name,
                Genre,
              Subgenre
            FROM
                filmrolls
            RIGHT JOIN(
                SELECT Movie_ID,
                    Movie_Name,
                    Genre,
                  Subgenre
                FROM
                    movie
            ) rollMovie
        ON
            rollMovie.Movie_ID = filmrolls.Movie_ID
        ) showtimeRolls
    ON
        showtimeRolls.Roll_ID = showtimes.Roll_ID
    ) seatsShowtime
ON
    seatsShowtime.Theater_ID = seats.Theater_ID AND seatsShowtime.DateTime = seats.DateTime
) bookingSeats
ON
    tb.Booking_ID = bookingSeats.Booking_ID
WHERE
    Member_ID = 1
ORDER BY bookingSeats.DateTime DESC;";

  $pastViewings = mysqli_query($db, $query);

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
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

         <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


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
                <li>
                    <a href="./profile.php">Profile</a>

                </li>
                <li  class="active">
                    <a href="./profile-history.php">Movie History</a>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>
        <!-- Page Content Holder -->
        <div id="content" style="margin-top: 50px; padding-left: 100px; padding-right: 100px;">
          <center><h1>Your Top Categories</h1></center>
          <!--SUMMARY-->
          <div class="row">
            <table class="table">
               <thead>
              <tr>
                <th>Movies Watched</th>
                <th>Category</th>
              </tr>
            </thead>

            <tbody>

              <?php
              if(!empty($categories))
                {
              while($category = mysqli_fetch_assoc($categories))
                {
              ?>

                <tr>
                  <td><?php echo $category['categoryCount'];?></td>
                  <td><?php echo $category['Genre'];?></td>
                </tr>


              <?php }} ?>
            </tbody>
            </table>
          </div>
          <!---------------->


          <center><h1>Your Past Viewings</h1></center>
          <!--PAST VIEWINGS LIST-->
          <table class="table">
            <thead>
              <tr>
                <th>Movie Name</th>
                <th>Date & Showtime</th>
                <th>Genre</th>
                <th>Cost</th>
              </tr>
            </thead>

            <tbody>

              <?php
              if(!empty($pastViewings))
                {
              while($movie = mysqli_fetch_assoc($pastViewings))
                {
              ?>

                <tr>
                  <td><?php echo $movie['Movie_Name'];?></td>
                  <td><?php echo $movie['DateTime'];?></td>
                  <td><?php echo $movie['Genre'];?> <?php echo $movie['Subgenre'];?></td>
                  <td>฿ <?php echo $movie['Cost'];?></td>
                </tr>


              <?php }} ?>
            </tbody>

          </table>
          <!------------------->

        </div>
            
      </div>


<!-- jQuery CDN - Slim version (=without AJAX) -->

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.js" crossorigin="anonymous"></script>

    
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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>




</body>

</html>
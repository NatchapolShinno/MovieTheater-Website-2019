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

  //get all movies names and sales
    $query = "SELECT COUNT(case Seat_Type when 'HNM' then 1 else null end) AS hnmSales, COUNT(case Seat_Type when 'REG' then 1 else null end) AS regSales, COUNT(*) AS totalSales, Movie_Name, Movie_ID
FROM seats s JOIN (SELECT DateTime, Theater_ID, Roll_ID, Movie_ID, Movie_Name
                   FROM showtimes sh JOIN (SELECT Roll_ID AS filmRollID, Movie_ID, Movie_Name
                                           FROM filmrolls f RIGHT JOIN (SELECT Movie_ID as movieID, Movie_Name
                                                                        FROM movie)movie
                                                          ON (movie.movieID = f.Movie_ID)) movieRolls
                                   ON (movieRolls.filmRollID = sh.Roll_ID)) movieShowtimes
             ON (movieShowtimes.DateTime = s.DateTime AND movieShowtimes.Theater_ID = s.Theater_ID)
GROUP BY movieShowtimes.Movie_ID
ORDER BY totalSales DESC;";

    $sales_result = mysqli_query($db, $query);
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
  <link rel="stylesheet" href="moviesReport.css"/>
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
                  <a href="#manageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Management</a>
                  <ul class="collapse list-unstyled" id="manageSubmenu">
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
                    <li>
                        <a href="managerEvaluate.php">Evaluate Employee</a>
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Reports</a>
                  <ul class="collapse list-unstyled show" id="reportSubmenu">
                      <li>
                        <a href="sales_report.php">Merchandise Sales</a>
                      </li>
                      <li class="active">
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
        <div id="content" style="padding-left: 100px; padding-right: 100px; margin-top: 50px;">

          <center><h1>Movie Sales Report</h1></center>
          <br>
          <br>

          <table class="table table-striped table-bordered table-dark table-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col" class="th-lg">Movie Name</th>
                <th scope="col" class="th-sm">Regular Seats (฿200)</th>
                <th scope="col" class="th-sm">Honeymoon Seats (฿300)</th>
                <th scope="col" class="th-sm">Total Seats Sold</th>
                <th scope="col">Total Revenue (pre-discount)</th>
              </tr>
            </thead>
            <tbody>


              <?php
              $i = 1;
              while($movie_sales = mysqli_fetch_assoc($sales_result))
                {
              ?>
                <tr>
                  <th scope="row"><p><?php echo $i;?></p></th>
                  <td><img src="./movie-img/<?php echo $movie_sales['Movie_ID'];?>.jpg" style="height: 100px; margin-right: 20px;"><?php echo $movie_sales['Movie_Name']; ?></td>
                  <td><p><?php echo $movie_sales['regSales']; ?></p></td>
                  <td><p><?php echo $movie_sales['hnmSales']; ?></p></td>
                  <td><p><?php echo $movie_sales['totalSales']; ?></p></td>
                  <td><p>฿ <?php echo ($movie_sales['regSales'] * 200) + ($movie_sales['hnmSales'] * 300);?></p></td>
                </tr>

              <?php
                $i++;
                }
              ?>



            </tbody>
          </table>

            
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
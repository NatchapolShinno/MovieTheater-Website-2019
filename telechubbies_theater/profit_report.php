<?php
include_once 'connectDB.php';
$queryExpense = "SELECT SUM(Amount*Quantity) AS Total FROM expenseitems";
$resultExpense = mysqli_query($conn, $queryExpense);
$queryFilmRolls = "SELECT SUM(Amount) AS Total FROM filmrolls";
$resultFilmRolls = mysqli_query($conn, $queryFilmRolls);
$queryTicket = "SELECT SUM(Cost) AS Total FROM ticketbooking";
$resultTicket = mysqli_query($conn, $queryTicket);
$queryMerchandise = "SELECT SUM(itemsold.Quantity*items.ItemPrice) AS Total FROM itemsold LEFT JOIN items ON itemsold.ItemID = items.ItemID";
$resultMerchandise = mysqli_query($conn, $queryMerchandise);

session_start();

$rowExpense = mysqli_fetch_array($resultExpense);
$rowFilmRolls = mysqli_fetch_array($resultFilmRolls);
$rowTicket = mysqli_fetch_array($resultTicket);
$rowMerchandise = mysqli_fetch_array($resultMerchandise);

$Total = ($rowTicket["Total"] + $rowMerchandise["Total"]) - ($rowExpense["Total"] + $rowFilmRolls["Total"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Telechubbies Theater | Employee Evaluation Form </title>
    <link rel="stylesheet" href="styleProfile.css" />
  <link rel="stylesheet" href="styleSidebar.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   

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
                      <li>
                        <a href="movies_report.php">Movie Sales</a>
                      </li>
                      <li>
                        <a href="expenseAnalysis.php">Expense Report</a>
                      </li>
                      <li class="active">
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
<div id="content" style="margin-top: 50px;">
      <div class="container">

        <h2 align="center">Revenue Analysis</h2>
        <br>
        <div class="row">
        <div class="col-md-3">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
        </div>
        <div class="col-md-3">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
        </div>
        <div class="col-md-5">
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
        </div>
      </div>
        <div style="clear:both"></div>
        <br />
        <div id="order_table">
            <h3 align="center">Summary of Revenue</h3><br />
            <div>
                <table class="table table-hover table-sm table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ticket Sales</td>
                            <td style="color:green">฿ <?php echo $rowTicket["Total"]; ?></td>
                        </tr>
                        <tr>
                            <td>Merchandise Sales</td>
                            <td style="color:green">฿ <?php echo $rowMerchandise["Total"]; ?></td>
                        </tr>
                        <tr>
                            <td>Expenses</td>
                            <td style="color:red">฿ - <?php echo $rowExpense["Total"]; ?></td>
                        </tr>
                        <tr>
                            <td>Film Licensing and Purchase</td>
                            <td style="color:red">฿ - <?php echo $rowFilmRolls["Total"]; ?></td>
                        </tr>

                        <?php
                        if($Total > 0)
                          {
                        ?>
                        <tr class="table-success">
                            <td>Profit</td>
                            <td style="font-weight: bold; color: green;">฿ <?php echo $Total; ?></td>
                        </tr>
                        <?php
                          }
                        else
                          {
                        ?>

                        <tr class="table-danger">
                            <td>Profit</td>
                            <td style="font-weight: bold; color: red;">฿ <?php echo $Total; ?></td>
                        </tr>

                        <?php
                          }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
      </div>     
</div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<script>
    jQuery(document).ready(function() {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function() {
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $.ajax({
                    url: "revenueFilter.php",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        $('#order_table').html(data);
                    }
                });
            } else {
                alert("Please Select Date");
            }
        });
    })(jQuery);
</script>

</html>
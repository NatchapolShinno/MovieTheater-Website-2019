<?php
include_once 'connectDB.php';
include 'account-controls.php';
include 'intranet-controls.php';
$query = "  
           SELECT * FROM expenseitems LEFT JOIN expenses ON expenseitems.Expense_ID=expenses.Expense_ID
              LEFT JOIN (SELECT Employee_Name AS Manager_Name, Employee_ID FROM employees)manager on expenses.Manager_ID = manager.Employee_ID  
           ORDER BY expenses.DateTime DESC;
      ";
$result = mysqli_query($conn, $query);
$query2 = "SELECT expenseitems.ExpenseType, SUM(expenseitems.Amount*expenseitems.Quantity) AS Total FROM expenseitems LEFT JOIN expenses ON expenseitems.Expense_ID = expenses.Expense_ID GROUP BY expenseitems.ExpenseType";
$result2 = mysqli_query($conn, $query2);
$queryFilm = "";
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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <!-- Font Awesome JS -->

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
                    <li class="active">
                        <a href="add_discount.php">Add Discount</a>
                    </li>
                    <li>
                        <a href="./managerEmploy.php">Add Employee</a>
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
                      <li class="active">
                        <a href="expenseAnalysis.php">Expense Report</a>
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
          <h2 align="center">Expense Analysis</h2>
        <br>
        <div class="row align-middle">
        <div class="col-md-3 my-auto">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
        </div>
        <div class="col-md-3 my-auto">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
        </div>
        <div class="col-md-5 my-auto">
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
        </div>
      </div>
        <div style="clear:both"></div>
        <br />
        <div id="order_table">
            <h3 align="center">Expense Summary</h3>
            <center><span class="text-muted">for selected time period</span></center>
            <br>
            <div>
                <table class="table table-hover table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Expense Type</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row2 = mysqli_fetch_array($result2)) {
                    ?>
                        <tbody>
                            <tr>
                                <td ><?php echo $row2["ExpenseType"]; ?></td>
                                <td>฿ <?php echo $row2["Total"]; ?></td>

                            </tr>
                        <?php
                    }
                        ?>
                        </tbody>
                </table>
            </div>
            <br>
            <h3 align="center">Expense Data</h3>
            <center><span class="text-muted">all expenses made in the selected time period</span></center>
            <br>
            <table class="table table-hover table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Expense Datetime</th>
                        <th>Spending Manager</th>
                        <th>Expense ID</th>
                        <th>Expense Type</th>
                        <th>Amount</th>
                        <th>Quantity</th>

                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["DateTime"]; ?></td>
                        <td><?php echo $row["Manager_Name"]; ?></td>
                        <td><?php echo $row["Expense_ID"]; ?></td>
                        <td><?php echo $row["ExpenseType"]; ?></td>
                        <td>฿ <?php echo $row["Amount"]; ?></td>
                        <td><?php echo $row["Quantity"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <br>
          
      </div>
    </div>

    



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
                    url: "expenseFilter.php",
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




</body>

</html>
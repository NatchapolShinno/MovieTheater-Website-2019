<?php 
    include_once 'connectDB.php';
    include 'account-controls.php';
    $selectBranch = "SELECT * FROM `cinemabranch`";
    $resultBranch = mysqli_query($conn,$selectBranch);
    $selectPosition = "SELECT * FROM `positions` ";
    $resultPosition = mysqli_query($conn,$selectPosition);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Telechubbies Theater</title>

    <link rel="stylesheet" href="styleHome.css" />
    <link rel="stylesheet" href="navMenuBodyStyle.css" />
    <script>
        $.noConflict();
    </script>



    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styleSidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                  <a href="#manageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Management</a>
                  <ul class="collapse list-unstyled show" id="manageSubmenu">
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
                    <li class="active">
                        <a href="./managerEmploy.php">Add Employee</a>
                    </li>
                    <li>
                        <a href="managerEvaluate.php">Evaluate Employee</a>
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                  <ul class="collapse list-unstyled" id="reportSubmenu">
                      <li>
                        <a href="sales_report.php">Merchandise Sales</a>
                      </li>
                      <li>
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
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
                </div>
            </nav>
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <form action="insertEmployee.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFirstNamel4">Name</label>
                            <input type="text" name = "FirstName"class="form-control" id="inputFirstNamel4" placeholder="FirstName"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastName4"><br> </label>
                            <input type="text" name = "LastName"class="form-control" id="inputLastName4" placeholder="LastName"required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCitizenID">CitizenID</label>
                            <input type="text" name="CitizenID" class="form-control" id="inputCitizenID" placeholder="x-xx-xx-xxxxx-xx-x"  required>
                        </div>
                        <!--Date of Birth-->
                        <div class="form-group col-md-6">
                            <label for="inputDate4">Date of Birth</label>
                            <input type="date" name="DOB" class="form-control" id="inputDate4" placeholder="Date"required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">E-mail</label>
                            <input type="email" name="Email" class="form-control" id="inputEmail4" placeholder="Email"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword">Password</label>
                            <input type="password" name="Password" class="form-control" id="inputPassword" placeholder="Password"required>
                            <small class="text-muted">This will be used to log in to the internal management system.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone4">Phone</label>
                            <input type="text" name="Phone" class="form-control" id="inputPhone4" placeholder="0xx-xxx-xxxx" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputGender">Gender</label>
                            <select id="inputGender" name="Gender" class="form-control" required>
                                <option selected>Choose...</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputWH4">WorkHours</label>
                            <input type="number" name="WorkHours" class="form-control" id="inputWH4" placeholder="WorkHours"required>
                        </div>


                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" name="AddressEmployee" class="form-control" id="inputAddress" placeholder="....."required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputBranch">Branch</label>
                            <select id="inputBranch" name="BranchID" class="form-control"required>
                                <option selected>Choose...</option>
                                <?php foreach($resultBranch as $key => $value){?>
                                    <option value="<?=$value['Branch_ID'];?>"><?=$value['Location'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPosition">Position</label>
                            <select id="inputPosition" name="PositionID" class="form-control"required>
                            <option selected>Choose...</option>
                                <?php foreach($resultPosition as $key => $value){?>
                                    <option value="<?=$value['Position_ID'];?>"><?=$value['Position_Name'];?></option>
                                <?php } ?>
                            </select>
                        </div>


                    </div>
                    <div class="form-row">
                    <button type="submit" name = 'submit'class="btn btn-primary">Employ</button>
                    <div class="col-sm-1"></div>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
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
<?php
    include 'account-controls.php';
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styleSidebar.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#inputBranch').on('change', function() {
                var BranchID = $(this).val();
                if (BranchID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxData.php',
                        data: {
                            "Branch_ID": BranchID
                        },
                        success: function(html) {
                            $('#inputTheaterNo').html(html);
                        }
                    })
                } else {
                    $('#inputTheaterNo').html('<option selected>Select Branch ...</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#inputMovie').on('change', function() {
                var MovieID = $(this).val();
                var Branch = $(inputBranch).val();
                if (MovieID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxData.php',
                        data: {
                            "Movie_ID": MovieID,
                            "Branch": Branch
                        },
                        success: function(html) {
                            $('#inputFilmRoll').html(html);
                        }
                    })
                } else {
                    $('#inputFilmRoll').html('<option selected>Select Movie ...</option>');
                }
            });
        });
    </script>
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
                    <a href="./home-employee.php">Profile</a>

                </li>
                 <li class="active">
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
            <div class="col-sm-9" style="padding-left: 100px;">
                <center><h1>Log Clocking Time</h1></center>
                <form action="" method="POST">
                    <?php
                    include_once "connectDB.php";
                    error_reporting(E_ALL ^ E_NOTICE);
                    $id = "";
                    $currentTime = "";
                    $clockType = "";
        
                    $id = $_SESSION['employee-id'];
                    $currentTime = date("yy-m-d h:i:s");
                
                    $query = "SELECT * FROM employees WHERE Employee_ID = '$id'";
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();
                    $Branch = "SELECT * FROM cinemabranch WHERE Branch_ID = '$row[Branch_ID]'";
                    $Location = $conn->query($Branch);
                    $rowBranch = $Location->fetch_assoc();
                    $Position = "SELECT * FROM positions WHERE Position_ID = '$row[Position_ID]'";
                    $PositionName = $conn->query($Position);
                    $rowPosition = $PositionName->fetch_assoc();
                    $Clock = "SELECT * FROM clockinout WHERE Employee_ID = '$id' ORDER BY DateTime DESC LIMIT 1";
                    $clockInOut = $conn->query($Clock);
                    $rowClock = $clockInOut->fetch_assoc();

                    if ($rowClock['Type'] == 1) {
                        $clockType = "OUT";
                    } else if ($rowClock['Type'] == 0 && $rowClock['DateTime'] != 0) {
                        $clockType = "IN";
                    } else if ($rowClock['Type'] == 0 && $rowClock['Employee_ID'] != " ") {
                        $clockType = "OUT";
                    } 

                    echo '<br><h6 class = "text-md" >Employee_ID:   ' . $row['Employee_ID'] . '</h6>';
                    echo '<br><h6 class = "text-md" > Name:   ' . $row['Employee_Name'] . '</h6>';
                    echo '<br><h6 class = "text-md" >Branch:   ' . $rowBranch['Location'] . '</h6>';
                    echo '<br><h6 class = "text-md" >Position:   ' . $rowPosition['Position_Name'] . '</h6>';
                    echo '<br><h6 class = "text-md" >Clock:   ' . $clockType . '</h6>';
                    echo '<br><h6 class = "text-md" >Current Time:   ' . $currentTime . '</h6>';
                    ?><br><br>

                </form>
                <form action="insertClock.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRuntime4">Confirm your EmployeeID: </label>
                            <input type="text" name="employeeID" class="form-control" id="inputRuntime4" placeholder="Confirm your ID..." required>
                        </div>
                        <div class="form-group col-md-6">
                            <br>
                            <h2> </h2>
                            <button type="submit" name=clock class="btn btn-primary btn">Clock</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
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
</body>

</html>
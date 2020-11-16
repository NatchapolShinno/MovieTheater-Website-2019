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
    <header>
        <div class="inner-width">
            <a href="#" class="logo"><img src="logo.png" alt="" /></a>
            <nav class="navigation-menu">
                <a href="home.php"><i class="fas fa-home home"></i> Home</a>
                <a href="#"><i class="fas fa-align-left about"></i> About</a>
                <a href="movielist.php"><i class="fas fa-film"></i> Movies</a>
                <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
                <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
                <a href="snacks.php"><i class="fas fa-cookie snacks"></i>Snacks</a>

                <!--check if user is already logged in from session-->
                <?php
                if (!isset($_SESSION['member-id'])) {
                ?>
                    <form method="POST" action="login.php?prev=<?php echo $curPageName; ?>">
                        <input type="submit" class="btn btn-info" name="sign-in" value="Sign In" />
                    </form>
                <?php
                }
                ?>

                <?php
                if (isset($_SESSION['member-id'])) {
                    $profile_name = $_SESSION['member-name'];
                ?>
                    <a href="profile.php"><?php echo "$profile_name"; ?></a>
                    <form method="POST">
                        <input type="submit" class="btn btn-danger" name="sign-out" value="Sign Out" />
                    </form>
                <?php
                }
                ?>


            </nav>
        </div>
    </header>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Telechubbies</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Manager</p>
                <li class="active">
                    <a href="managerHome.php">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                    <a href="managerShowtimes.php">Schedule Movie</a>
                </li>
                <li>
                    <a href="managerEmploy.php">Employ</a>
                </li>
                <li>
                    <a href="employeeClock.php">Contact</a>
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

            <?php
            include_once 'connectDB.php';

            $query = "SELECT * FROM cinemabranch ORDER BY 'Location' ASC";
            $result = $conn->query($query);
            $query2 = "SELECT * FROM movie ORDER BY 'Movie_Name' ASC";
            $result2 = $conn->query($query2);
            ?>


            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <form action="insertShowtimes.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputBranch">Branch</label>
                            <select id="inputBranch" name="BranchID" class="form-control" required>
                                <option selected>Choose...</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['Branch_ID'] . '">' . $row['Location'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputTheaterNo">Theater No.</label>
                            <select id="inputTheaterNo" name="Theater" class="form-control">
                                <option>Select Branch First...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputMovie">Movie</label>
                            <select id="inputMovie" name="MovieID" class="form-control" required>
                                <option selected>Choose...</option>
                                <?php
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo '<option value="' . $row2['Movie_ID'] . '">' . $row2['Movie_Name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputFilmRoll">Film Roll</label>
                            <select id="inputFilmRoll" name="FilmRoll" class="form-control" required>
                                <option>Select Movie First...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAudio">Audio</label>
                            <select id="inputAudio" name="Audio" class="form-control" required>
                                <option selected>Choose...</option>
                                <option value="EN">EN/TH</option>
                                <option value="TH">TH</option>
                                <option value="N">Other</option>
                            </select></div>
                        <div class="form-group col-md-6">
                            <label for="inputDate4">Showtimes</label>
                            <input type="datetime-local" name="Showtimes" class="form-control" id="inputDate4" required>
                        </div>
                    </div>


                    <div class="form-row">
                        <button type="submit" name='submit' class="btn btn-primary">Add Schedule</button>
                        <div class="col-sm-1"></div>
                        <button type="reset" class="btn btn-primary">Reset</button>
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
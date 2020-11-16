<?php

  include 'account-controls.php';
  include 'intranet-controls.php'

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="navMenuBodyStyle.css">
  <link rel="stylesheet" href="styleSidebar.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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

<script>
    $(document).ready(function() {
      $('#inputBranchUpdate').on('change', function() {
        var BranchID = $(this).val();
        if (BranchID) {
          $.ajax({
            type: 'POST',
            url: 'ajaxData.php',
            data: {
              "Branch_ID": BranchID
            },
            success: function(html) {
              $('#inputTheaterNoUpdate').html(html);
            }
          })
        } else {
          $('#inputTheaterNoUpdate').html('<option selected>Select Branch ...</option>');
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#inputMovieUpdate').on('change', function() {
        var MovieID = $(this).val();
        var Branch = $(inputBranchUpdate).val();
        if (MovieID) {
          $.ajax({
            type: 'POST',
            url: 'ajaxData.php',
            data: {
              "Movie_ID": MovieID,
              "Branch": Branch
            },
            success: function(html) {
              $('#inputFilmRollUpdate').html(html);
            }
          })
        } else {
          $('#inputFilmRollUpdate').html('<option selected>Select Movie ...</option>');
        }
      });
    });
  </script>
  <style type="text/css">
    .wrapper {
      /*width: 650px;
      margin: 0 auto;*/
    }

    .page-header h2 {
      margin-top: 0;
    }

    table tr td:last-child a {
      margin-right: 15px;
    }

    .dataTables_filter {

      float: right;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#Table').DataTable();
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
                    <a href="./home-manager.php">Profile</a>

                </li>
                 <li>
                    <a href="managerClock.php">Clock In/Out</a>
                </li>
                <li class="active">
                    <a href="showtimes_sidebar.php">Manage Showtimes</a>
                </li>
                <li>
                    <a href="managerExpense.php">Manage Expenses</a>
                </li>
                <li>
                    <a href="addItems.php">Add Merchandise</a>
                </li>
                <li>
                    <a href="add_movie.php">Add Movie</a>
                </li>
                <li>
                    <a href="add_discount.php">Add Discount</a>
                </li>
                <li>
                    <a href="./managerEmploy.php">Add Employee</a>
                    <!--<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>-->
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

        </nav>


  <div class="container-fluid" style="margin-left: 0 !important; margin-right: 0 !important; width: 100% !important;">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="page-header clearfix">
          <h2 class="pull-left">Showtime Details</h2>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="float: right">
            Add Showtime Schedule
          </button>
        </div>
        <?php
        // Include config file
        require_once "connectDB.php";
        $query = "SELECT * FROM cinemabranch ORDER BY 'Location' ASC";
        $result = $conn->query($query);
        $query2 = "SELECT * FROM movie ORDER BY 'Movie_Name' ASC";
        $result2 = $conn->query($query2);
        $query5 = "SELECT * FROM cinemabranch ORDER BY 'Location' ASC";
        $result5 = $conn->query($query);
        $query6 = "SELECT * FROM movie ORDER BY 'Movie_Name' ASC";
        $result6 = $conn->query($query2);

        // Attempt select query execution
        $sql = "SELECT * FROM `showtimes` LEFT JOIN filmrolls ON filmrolls.Roll_ID = showtimes.Roll_ID LEFT JOIN movie ON filmrolls.Movie_ID = movie.Movie_ID LEFT JOIN cinemabranch ON filmrolls.Branch_ID = cinemabranch.Branch_ID LEFT JOIN theater ON showtimes.Theater_ID = theater.Theater_ID ORDER BY DateTime";

        if ($result3 = mysqli_query($conn, $sql)) {
          if (mysqli_num_rows($result3) > 0) {
            echo "<table id = 'Table' class='table table-hover table-sm' style = width:100%>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Datetime</th>";
            echo "<th>Theater_ID</th>";
            echo "<th>Branch Location</th>";
            echo "<th>Theater No</th>";
            echo "<th>Roll_ID</th>";
            echo "<th>Movie_Name</th>";
            echo "<th>Audio</th>";
            echo "<th>Action</th>";

            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_array($result3)) {
              echo "<tr>";
              echo "<td>" . $row['DateTime'] . "</td>";
              echo "<td>" . $row['Theater_ID'] . "</td>";
              echo "<td>" . $row['Location'] . "</td>";
              echo "<td>" . $row['No'] . "</td>";
              echo "<td>" . $row['Roll_ID'] . "</td>";
              echo "<td>" . $row['Movie_Name'] . "</td>";
              echo "<td>" . $row['Audio'] . "</td>";
              echo "<td>";
              echo "<a href='#' data-role = 'update' data-date = " . $row['DateTime'] . " data-id = " . $row['Theater_ID'] . " title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil edit'></span></a>";
              echo "<a href='#' data-role = 'delete' data-date = " . $row['DateTime'] . " data-id = " . $row['Theater_ID'] . " title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash delete'></span></a>";
              echo "</td>";

              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            // Free result set
            mysqli_free_result($result3);
          } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
          }
        } else {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
        // Close connection
        mysqli_close($conn);
        ?>

      </div>
    </div>
  </div>

</div>
  <!-- Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Showtimes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Update Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Showtimes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="showtimesUpdate.php" method="POST">
            <div class="form-row">
              <input type="hidden" name="update_date" id="update_date">
              <input type="hidden" name="update_id" id="update_id">


              <div class="form-group col-md-6">
                <label for="inputBranchUpdate">Branch</label>
                <select id="inputBranchUpdate" name="BranchID" class="form-control" required>
                  <option selected>Choose...</option>
                  <?php
                  if ($result5->num_rows > 0) {
                    while ($row = $result5->fetch_assoc()) {
                      echo '<option value="' . $row['Branch_ID'] . '">' . $row['Location'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputTheaterNoUpdate">Theater No.</label>
                <select id="inputTheaterNoUpdate" name="Theater" class="form-control">
                  <option>Select Branch First...</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputMovieUpdate">Movie</label>
                <select id="inputMovieUpdate" name="MovieID" class="form-control" required>
                  <option selected>Choose...</option>
                  <?php
                  if ($result6->num_rows > 0) {
                    while ($row2 = $result6->fetch_assoc()) {
                      echo '<option value="' . $row2['Movie_ID'] . '">' . $row2['Movie_Name'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="inputFilmRollUpdate">Film Roll</label>
                <select id="inputFilmRollUpdate" name="FilmRoll" class="form-control" required>
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
                <label for="inputDate">Showtimes</label>
                <input type="datetime-local" name="Showtimes" class="form-control" id="inputDate" required>
              </div>
            </div>
            

            <div class="form-row">
              <button type="submit" name='submit' class="btn btn-primary">Save</button>
              <button type="reset" class="btn btn-primary">Reset</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <h4>Are you sure you want to delete this item?</h4>
          <form action="showtimesDelete.php" method="POST">
            <div class="form-row">
              <input type="hidden" name="delete_date" id="delete_date">
              <input type="hidden" name="delete_id" id="delete_id">

              <div class="modal-footer">
                <button type="submit" name='delete' class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </form>
        </div>


      </div>
    </div>
  </div>
</body>
<script>
  $(document).ready(function() {
    $('.edit').on('click', function() {
      $('#exampleModal').modal('show');
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      console.log(data);

      $('#update_date').val(data[0]);
      $('#update_id').val(data[1]);

    });

  });
</script>
<script>
  $(document).ready(function() {
    $('.delete').on('click', function() {

      $('#del').modal('show');
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();
      console.log(data);

      $('#delete_date').val(data[0]);
      $('#delete_id').val(data[1]);

    });

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



</html>
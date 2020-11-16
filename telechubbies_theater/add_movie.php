<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');

session_start();

$queryBranch = "SELECT * FROM cinemabranch;";
$queryMovie = "SELECT * FROM movie;";
$queryFilmroll = "SELECT * FROM filmrolls;";


$resultBranch = mysqli_query($db, $queryBranch);


#Add new movie into movie table 
if(isset($_POST['submit']))
  {
     
        $movie_name = addslashes($_POST['movie_name']);
        $movie_studio = addslashes($_POST['movie_studio']);
        $release_year = $_POST['release_year'];
        $genre = $_POST['genre'];
        $subgenre = $_POST['subgenre'];
        $director = addslashes($_POST['director']);
        $cast = addslashes($_POST['cast']);
        $synopsis = addslashes($_POST['synopsis']);
        $rating = $_POST['rating'];
        $runtime = $_POST['runtime'];
        
        $queryMovie = "INSERT INTO `movie`(`MovieStudio`, `Movie_Name`, `ReleaseYear`, `Genre`, `Subgenre`, `Director`, `Cast`, `Synopsis`, `Rating`, `Runtime`)
                            VALUES('$movie_studio ', '$movie_name', '$release_year','$genre', '$subgenre', '$director', '$cast', '$synopsis', '$rating',  '$runtime');";

        mysqli_query($db, $queryMovie);
       # $last_insert_movieid = mysqli_insert_id($db); 
        #check
        /*upload poster image*/
        $query = "SELECT MAX(Movie_ID) As MaxID FROM movie;";

$result = mysqli_query($db, $query);

$resultarr = mysqli_fetch_assoc($result);

$maxid = $resultarr['MaxID'];

//echo $maxid;

$target_dir = "./movie-img/";
$target_file = $target_dir . $maxid . '.jpg';

//echo $target_file;

$uploadOk = 1;
$ImageType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["Image"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
   // $uploadOk = 1;
  } else {
   // echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size: COMMENTED
/*if ($_FILES["Image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/

// Allow certain file formats
if($ImageType != "jpg" && $ImageType != "png" && $ImageType != "jpeg"
&& $ImageType != "gif" ) {
 // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
   // echo "The file ". basename( $_FILES["Image"]["name"]). " has been uploaded.";
  } else {
    //echo "Sorry, there was an error uploading your file.";
  }

}
    }
 



#Lease or Buy film rolls from movie that has been added.
#check if newest movie has been added then add a film rolls
#if(isset($last_insert_movieid))
 #   {
  #      $distributor = addslashes($_POST['distributor']);
  #      $filmroll_no = $_POST['filmroll_no'];
  #      $branch_id = $_POST['branch_id'];
  #      $lease_date = $_POST['lease_date'];
  #      $period = $_POST['period'];
  #       $choice = $_POST['choice'];

        #check if manager choose buy, then let period equal to null
  #       if($choice == '2') 
  #       {
    #     $queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`)
     #                        VALUES('$last_insert_movieid ', '$branch_id', '$lease_date','$distributor', NULL);";
      #   }
    #     else
     #    {
      #   $queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`)
       #                      VALUES('$last_insert_movieid', '$branch_id', '$lease_date','$distributor',$period);";
   #      }
    #     #add film roll with a given number of lease
     #    for($i = 0; $i < $filmroll_no; $i++)
      #           {
       #          mysqli_query($db, $queryFilmroll);
    #             }
        #check
    #     echo $queryFilmroll;
  #   }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Telechubbies Theater</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="movie_css/add_movie.css" type="text/css" media="all" />
  <link rel="stylesheet" href="styleProfile.css" />
  <link rel="stylesheet" href="styleSidebar.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
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
                    <li class="active">
                        <a href="add_movie.php">Add Movie</a>
                    </li>
                    <li>
                        <a href="add_discount.php">Add Discount</a>
                    </li>
                    <li>
                        <a href="./managerEmploy.php">Add Employee</a>
                    </li>
                    <li class="active">
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
          <section class="header">
          <div class="heading">
            <h1><span class="image"></span>Add Movie </h1>
          </div>

          <form method = "POST" enctype="multipart/form-data">
          <div class="form">
          <div class="w3layouts-main">
    
             <!--------------------------- Movie Name ------------------------->
            <div class="form-control">
              <p>Movie Name</p>
              <input type="text" name="movie_name" placeholder="name of movie" required="">
            </div>

             <!--------------------------- Movie Studio ------------------------->
             <div class="form-control">
              <p>Movie Studio</p>
              <input type="text" name="movie_studio" placeholder="Movie Studio" required="">
             </div>

            <!--------------------------- Release Year ------------------------->
              <div class="form-control">
                <p>Release Year</p> 
                    <input type="text" id= "release_year" name = "release_year" required>
                  </input>
              </div>

            <!--------------------------- Genre ------------------------->    
            <div class="form-control">
                <p>Genre</p>
                <input type="text" name="genre" placeholder="Only one main genre" required="">
            </div>

            <div class="form-control">
                <p>Sub-genres</p>
                <input type="text" name="subgenre" placeholder="Space to separate genres" required="">
            </div>
              
             <!--------------------------- Movie Studio ------------------------->        
             <div class="form-control">
              <p>Director</p>
              <input type="text" name="director" placeholder="name of director of movie" required="">
             </div>
            
             <!--------------------------- Cast ------------------------->         
             <div class="form-control">
              <p>Cast</p>
              <textarea type="text" name="cast" placeholder="names of main cast in movie" required="" rows="6" class="form-control"></textarea>
             </div>

             <!--------------------------- Synopsis ------------------------->       
             <div class="form-control">
              <p>Synopsis</p>
              <textarea type="text" name="synopsis" placeholder="synopsis of movie" required="" rows="6" class="form-control"></textarea>
             </div>

             <!--------------------------- Rating ------------------------->  
             <div class="form-control">
                  <p for="rating">Rating</p>
                    <select id= "rating" name = "rating" required>
                    <option selected>Select</option>
                    <option value="G">G</option>       
                    <option value="PG">PG</option>   
                    <option value="PG-13">PG-13</option>  
                    <option value="R">R</option>     
                    <option value="NC-17">NC-17</option>
                  </select>
              </div>

            <!--------------------------- Run Time ------------------------->
            <div class="form-control">
                <p>Runtime (minutes)</p> 
                <input type="number" id="runtime" min="1" max="300" name="runtime" required="">
              </div>
          <div class="form-control">
                <p>Upload Movie Poster</p> 
                <input type="file" id="Image" name="Image" required="">
              </div>

        
            <!--------------------------- SUBMIT ------------------------->
              <div>
                 <input type="submit" value="submit" name="submit" class="add-movie"/>
              
              </div>

            <!-------------------------------------------------------------------------------------------------------->
                        </div>
                </form>
              </div>
              
          <div class="clear"></div>
      
      </section>
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
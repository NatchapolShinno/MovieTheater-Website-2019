
<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');

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
        $director = addslashes($_POST['director']);
        $cast = addslashes($_POST['cast']);
        $synopsis = addslashes($_POST['synopsis']);
        $rating = $_POST['rating'];
        $runtime = $_POST['runtime'];
        
        $queryMovie = "INSERT INTO `movie`(`MovieStudio`, `Movie_Name`, `ReleaseYear`, `Genre`, `Director`, `Cast`, `Synopsis`, `Rating`, `Runtime`)
                            VALUES('$movie_studio ', '$movie_name', '$release_year','$genre', '$director', '$cast', '$synopsis', '$rating',  '$runtime');";
        
        
        mysqli_query($db, $queryMovie);
       # $last_insert_movieid = mysqli_insert_id($db); 
        #check
        echo $queryMovie;
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
  <html lang="en">

      <head>
        <title>Telechubbies Theater | Add Movie </title>
        <!-- metatags-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="wedlock register form a Flat Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Meta tag Keywords -->
        <!-- css -->
        <link rel="stylesheet" href="movie_css/add_movie.css" type="text/css" media="all" />
        <!-- Online-fonts -->
        <link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
        <!-- //Online-fonts -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      </head>



      <body>
        <section class="header">
          <div class="heading">
            <h1><span class="image"></span>Add Movie </h1>
          </div>

          <form method = "POST">
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
                    <select id= "release_year" name = "release_year" required>
                    <option selected>Select</option>
                    <option value="2019">2019</option>       
                    <option value="2020">2020</option> 
                    <option value="2021">2021</option>     
                  </select>
              </div>

            <!--------------------------- Genre ------------------------->    
            <div class="form-control">
                <p>Genre</p>
                <input type="text" name="genre" placeholder="Give a Space if genre is more than one" required="">
            </div>
              
             <!--------------------------- Movie Studio ------------------------->        
             <div class="form-control">
              <p>Director</p>
              <input type="text" name="director" placeholder="name of director of movie" required="">
             </div>
            
             <!--------------------------- Cast ------------------------->         
             <div class="form-control">
              <p>Cast</p>
              <input type="text" name="cast" placeholder="names of main cast in movie" required="">
             </div>

             <!--------------------------- Synopsis ------------------------->       
             <div class="form-control">
              <p>Synopsis</p>
              <input type="text" name="synopsis" placeholder="synopsis of movie" required="">
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
                <p>Run Time [minute]</p> 
                <input type="number" id="runtime" min="1" max="300" name="runtime" required="">
              </div>

        
            <!--------------------------- SUBMIT ------------------------->
              <div>
                 <input type="submit" value="submit" name="submit"/>
              
              </div>

            <!-------------------------------------------------------------------------------------------------------->
                        </div>
                </form>
              </div>
              
          <div class="clear"></div>
        <footer>
          &copy;2020 | Telechubbies Theater
        </footer>
      
      </section>

  </body>
</html>
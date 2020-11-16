

<?php

#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');

$queryBranch = "SELECT * FROM cinemabranch;";
$queryMovie = "SELECT * FROM movie;";
$queryFilmroll = "SELECT * FROM filmrolls;";

$resultBranch = mysqli_query($db, $queryBranch);
$resultMovie = mysqli_query($db, $queryMovie);


if(isset($_POST['submit']))
	{
	$movie_id = $_POST['movie_id'];
	$distributor = addslashes($_POST['distributor']);
	$filmroll_no = $_POST['filmroll_no'];
	$branch_id = $_POST['branch_id'];
	$lease_date = $_POST['lease_date'];
  $period = $_POST['period'];
  $choice = $_POST['choice'];

    #check if manager choose buy, then let period equal to null
      if($choice == '2') 
      {
      $queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`)
                        VALUES('$movie_id ', '$branch_id', '$lease_date','$distributor', NULL);";
      }
    else
      {
      $queryFilmroll = "INSERT INTO `filmrolls`(`Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`)
                        VALUES('$movie_id ', '$branch_id', '$lease_date','$distributor',$period);";
      }
  #add film roll with a given number of lease
  for($i = 0; $i < $filmroll_no; $i++)
				{
          mysqli_query($db, $queryFilmroll);
        }

	echo $queryFilmroll;
	}

?>






  <!DOCTYPE html>
  <html lang="en">

      <head>
        <title>Telechubbies Theater | Lease/Buy Form</title>
        <!-- metatags-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="wedlock register form a Flat Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Meta tag Keywords -->
        <!-- css -->
        <link rel="stylesheet" href="lease_css/movie_lease.css" type="text/css" media="all" />
        <!--// css -->
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
            <h1><span class="image"></span>Lease/Buy Form</h1>
          </div>

          <form method = "POST">
          <div class="form">
          <div class="w3layouts-main">
         
                  <!--------------------------- MOVIE ------------------------->
                
                  <p for="movie_id">MovieID</p>
                      <select id="movie_id" name="movie_id" class="form-control" required>

                            <option selected>Select</option>
                            <?php foreach($resultMovie as $key => $value)
                              {
                            ?>

                                <option value="<?php echo $value['Movie_ID'];?>"><?php echo $value['Movie_Name'];?></option>

                            <?php } ?>
                      </select>
                      
                <!--------------------------- DISTRIBUTOR ------------------------->
              
                <div class="form-control">
                  <p>Distributor Name</p>
                  <input type="text" name="distributor" placeholder="Distributor Name" required="">
                </div>

                <!--------------------------- No. of film roll ------------------------->

                  <div class="form-control">
                    <p>Number of Film Roll</p> 
                    <input type="number" id="filmroll_no" min="1" max="15" name="filmroll_no" required="">
                  </div>

                <!--------------------------- Branch ------------------------->
                  <div class="form-control">
                    <p for="branch_id">Cinema Branch</p>

                      <select id="branch_id" name="branch_id" class="form-control" required>

                                      <option selected>Select</option>
                                      <?php foreach($resultBranch as $key => $value)
                                        {
                                      ?>

                                          <option value="<?php echo $value['Branch_ID'];?>"><?php echo $value['Location'];?></option>

                                      <?php } ?>
                      </select>
                  </div>

                <!--------------------------- CHOICE ------------------------->
                  <div class="form-control">
                      <p for="choice">Choice</p>
                        <select id= "choice" name = "choice" required>
                        <option selected>Select</option>
                        <option value="1">Lease</option>       
                        <option value="2">Buy</option>     
                      </select>
                  </div>

                <!--------------------------- Period ------------------------->
                  
                  <div class="form-control">
                      <p>Period [month]</p> 
                      <input type="number"  min="1" max="12" name="period" required="">
                    </div>

                <!--------------------------- LEASE DATE ------------------------->

                    <div class="form-control">
                      <p for = "lease_date">Lease/Buy Date</p>
                          <input type="text" id="datepicker" name="lease_date" class="form-control member-info-field" value="<?php echo $lease_date;?>" required/>
                            <script>
                              $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4',
                                format: 'yyyy-mm-dd',
                                width: 200
                              });
                            </script>
                    </div>    
            
                <!--------------------------- SUBMIT ------------------------->
                  <div>
                    <input type="submit" value="submit" name="submit"/>
                  </div>
                <!------------------------------------------------------------->

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
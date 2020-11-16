<?php

function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

include 'account-controls.php';
include 'booking-controls.php';
//include 'session.php';
include 'connectDB.php';
/*initialize shopping cart before beginning*/

/*unset($_SESSION);
session_destroy();*/

#pre_r($matching_rolls);

//pre_r($_SESSION);


#initialize variables in _SESSION for CHECKOUT
$_SESSION['discountStatus'] = 0;


#initialize global variable for checking if discount code has been applied
#$GLOBALS['discountStatus'] = 0;
if(isset($_POST['submit-seats']))
{
  $seats = explode("|", $_POST['selected-seats']);
  #pre_r($seats);
  $seattypes = explode("|", $_POST['seat-types']);
}



#pre_r($_SESSION);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Telechubbies Theater: Checkout</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
  <link rel="stylesheet" href="book-ticket.css"/>
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
  <script>
    $.noConflict();
  </script>

  <!--SEAT CHART STUFF-->
  <link rel="stylesheet" href="cssSeatChart/jquery.seat-charts.css">
<link rel="stylesheet" href="cssSeatChart/styleSeatChart.css">


</head>




<body>

  <!--PHP TO HANDLE PAYMENT-->
  <?php include 'checkout_payment.php';?>


  <!--navbar header-->
  <header>
    <div class="inner-width">
      <a href="#" class="logo"><img src="logo.png" alt="" /></a>
      <nav class="navigation-menu">
        <a href="home.php"><i class="fas fa-home home"></i> Home</a>
        <a href="#"><i class="fas fa-align-left about"></i> About</a>
        <a href="movielist.php"><i class="fas fa-film"></i> Movies</a>
        <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
        <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
        <a href="snacks.php"><i class = "fas fa-cookie snacks"></i>Snacks</a>
        

        <?php
            if(!isset($_SESSION['member-id']))
            {
          ?>
          <form method="POST" action = "login.php?prev=<?php echo $curPageName;?>">
            <input type="submit" class="btn btn-info" name="sign-in" value = "Sign In"/>
          </form>
          <?php
            }
          ?>

          <?php
            if(isset($_SESSION['member-id'])) 
            {
            $profile_name = $_SESSION['member-name'];
          ?>
          <a href="profile.php"><?php echo "$profile_name"; ?></a>
          <form method="POST">
            <input type="submit" class="btn btn-danger" name="sign-out" value = "Sign Out"/>
          </form>
          <?php
            }
          ?>
      </nav>
    </div>
  </header>

<!--GET MOVIE DETAILS FIRST-->
<?php

  #get movie id from GET
  $movie_id = filter_input(INPUT_GET, 'movie-id');

  #query movie name and release year for displaying
  $query = "SELECT Movie_Name, ReleaseYear FROM movie WHERE Movie_ID = $movie_id;";

 // echo $query;

  $result = mysqli_query($db, $query);

  $movie_details = mysqli_fetch_assoc($result);
?>

<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
      type: 'POST',
      url: 'booking-controls.php',
      data: {"Movie_ID": <?php echo $movie_id;?>}
    })
  });
</script>

<div class="container" style="padding-left: 5px !important; padding-right: 5px !important;">

    <!--SEATS SELECTION-->
        <div id="seat-map" class="seatCharts-container">
          <div class="front" id="screen">SCREEN</div>         
        </div>

            <!--FORM FOR SENDING SELECTED SEATS TO DB-->
    <!---->


    <!--SUMMARY-->
    <div class="booking-details">
      <div class="movie_poster">
      <img src="./movie-img/<?php echo $movie_id; ?>.jpg"/>
      </div>

      <div style="height: 100px;">
      <ul class="book-left">
        <li>Movie: </li>
        <li>Branch: </li>
        <li>Theater: </li>
        <li>Audio: </li>
        <li>Time: </li>
        <li>Total: </li>
      </ul>

      <ul class="book-right">
        <li><?php echo $movie_details['Movie_Name'];?> (<?php echo $movie_details['ReleaseYear'];?>)</li>
        <form method="POST" id="seats-form">
        <li>
            <select id="inputBranch" name="branch" class="form-control input" required>
              <option selected>Select a branch.</option>
              <?php
              if(mysqli_num_rows($rolls_branches) > 0)
                {
              while($roll = mysqli_fetch_assoc($rolls_branches)):
              ?>   
                <option value="<?php echo $roll['Branch_ID'];?>">
                  <?php
                    //get branch name
                    $branchid = $roll['Branch_ID'];
                    $query = "SELECT Location FROM cinemabranch WHERE Branch_ID = $branchid;";

                    $result = mysqli_query($db, $query);

                    $branch = mysqli_fetch_assoc($result);

                    echo $branch['Location'];
                  ?>
                </option>
              <?php
              endwhile;
                }
              else
                {
              ?>
                <option selected>Sorry! No showings found.</option>
              <?php
                }
              ?>

            </select>
        </li>

        <li>
           <select id="inputTheater" name="theater" class="form-control input" required>
              <option selected>Please select theater.</option>
           </select>
        </li>        

        <li>
          <select id="inputAudio" name="audio" class="form-control input" required>
            <option selected>Please select audio language.</option>
            <option value="EN">English</option>
            <option value="TH">Thai</option>
          </select>
        </li>

        <li>
         <select id="inputShowtime" name="showtime" class="form-control" required>
            <option selected>Please select all options first.</option>
         </select>
        </li>

        <li>: <b><i>฿</i><span id="total">0</span></b></li>
      </ul>
    </div>

      <div class="submit-form" style="text-align:center;">
          <input id="selected-seats" type="hidden" name="selected-seats"/>
          <input id="seat-types" type="hidden" name="seat-types"/>
          <input id="movie_id" type="hidden" name="movie-id" value="<?php echo $movie_id; ?>"/>
          <input class="btn btn-info" name="submit-seats" id="submit-seats" value="Checkout"/>
       </div>
    </form>

    </div>


</div>


<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">© 2019-2020 Telechubbies Theater Group</p>
  <ul class="list-inline">
    <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Privacy</a></li>
    <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Terms</a></li>
    <li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Support</a></li>
  </ul>
</footer>

</div>



    <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="./CHECKOUT_EXAMPLE_files/jquery-3.2.1.slim.min.js.download" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="./CHECKOUT_EXAMPLE_files/popper.min.js.download"></script>
      <script src="./CHECKOUT_EXAMPLE_files/bootstrap.min.js.download"></script>
      <script src="./CHECKOUT_EXAMPLE_files/holder.min.js.download"></script>
      <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
      }, false);
      })();
  </script>

<!--JS FOR SEAT CHART-->
<script type="text/javascript">
        $(document).ready(function() {
          var $cart = $('#selected-seats'), //Sitting Area
          $counter = $('#counter'), //Votes
          $total = $('#total'); //Total money
          
          var sc = $('#seat-map').seatCharts({
            map: [  //Seating chart
              '_bb_bb_bb_',
              '_bb_bb_bb_',
              '__________',
              'aaaaaaaaaa',
              'aaaaaaaaaa',
              '__________',
              'aaaaaaaaaa',
              'aaaaaaaaaa',
              'aaaaaaaaaa',
              '__aaaaaa__'
            ],
            seats: {
                a: {
                  price: 200,
                  type: 'REG',
                  itemid: -1
                },
                b: {
                  price: 300,
                  type: 'HNM',
                  itemid: -2
                }
            },
            naming : {
              top : false,
              rows: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'],
              getLabel : function (character, row, column) {
                return column;
              },
              getId: function(character, row, column) {
                return column + row;
              }
            },
            legend : { //Definition legend
              node : $('#legend'),
              items : [
                [ 'a', 'available',   'Available' ],
                [ 'a', 'unavailable', 'Sold'],
                [ 'a', 'selected', 'Selected']
              ]         
            },
            click: function () { //Click event
              if (this.status() == 'available') { //optional seat
                $('<li>Row'+(this.settings.row+1)+' Seat'+this.settings.label+'</li>')
                  .attr('id', 'cart-item-'+this.settings.id)
                  .data('seatId', this.settings.id)
                  .appendTo($cart);

                $counter.text(sc.find('selected').length+1);

                var subtotal = recalculateTotal(sc)+this.data().price;

                $total.text(subtotal);

                $.ajax({
                    type: 'GET',
                    url: 'booking-controls.php',
                    data: {"subtotal": subtotal}
                  }); 

                itemid = this.data().itemid;
                seattype = this.data().type;
                itemprice = this.data().price;

                /*handle shopping cart for linking with checkout*/
                $.ajax({
                  type: 'POST',
                  url: 'booking-controls.php',
                  data: {"Item_ID": itemid, "ItemName": seattype, "Price": itemprice}
                });
                      
                return 'selected';
              } else if (this.status() == 'selected') { //Checked
                  //Update Number
                  $counter.text(sc.find('selected').length-1);
                  //update totalnum
                  var subtotal =  recalculateTotal(sc)-this.data().price;

                  $total.text(subtotal);

                  $.ajax({
                    type: 'GET',
                    url: 'booking-controls.php',
                    data: {"subtotal": subtotal}
                  }); 

                    
                  itemid = this.data().itemid;
                  /*remove entry from shopping cart*/
                  $.ajax({
                    type: 'GET',
                    url: 'booking-controls.php',
                    data: {"action": 'delete', "Item_ID": itemid}
                  });


                  //Delete reservation
                  $('#cart-item-'+this.settings.id).remove();
                  //optional
                  return 'available';
              } else if (this.status() == 'unavailable') { //sold
                return 'unavailable';
              } else {
                return this.style();
              }
            }
          });


          //sold seat
        
        $("#submit-seats").click(function() {
          text = getSelectedSeats(sc);
          types = getSelectedSeatTypes(sc);

          /*alert(text);*/
          $("#selected-seats").val(text);
          $("#seat-types").val(types);
          $("#seats-form").submit();
        });


    //update seat chart when showtime changes
    $('#inputShowtime').change(function() {
      theater_id = $('#inputTheater').val();
      datetime = $('#inputShowtime').val();

     sc.find('unavailable').status('available');


    $.ajax({
      type: 'POST',
      url: 'booking-controls.php',
      data: {"checkSeats": 1, "Theater_ID": theater_id, "datetime": datetime},
      dataType: 'json',
      success: function(response) {
        $.each(response, function(index, seat_id) {
          console.log(seat_id);
          sc.status(seat_id, 'unavailable');
        });
    }
  })    
    });
        //sc.get('2A').status('unavailable');

        });


        function getSelectedSeats(sc) {
          var selectedSeatsString = "";

          sc.find('selected').each(function () {
            selectedSeatsString = selectedSeatsString + "|" + this.settings.id;

          });

          return selectedSeatsString;
        }

         function getSelectedSeatTypes(sc) {
          var selectedTypes = "";

          sc.find('selected').each(function () {
            selectedTypes = selectedTypes + "|" + this.data().type;

          });

          return selectedTypes;
        }

        function recalculateTotal(sc) {
          var total = 0;
          sc.find('selected').each(function () {
            total += this.data().price;
            });
              
          return total;
        }
      </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>

<!--JS FOR SELECTING THEATER AND TIME-->
<script type="text/javascript">
  $(document).ready(function() {

    function branchChange()
      {
      var branchId = $('#inputBranch').val();
      var movieId = <?php echo filter_input(INPUT_GET, 'movie-id');?>;
      if(branchId)
        {
        $.ajax({
          type: 'POST',
          url: 'booking-controls.php',
          data: {"Branch_ID":branchId, "Movie_ID":movieId},
          success: function(html) {
            $('#inputTheater').html(html);
          }
        })
        }
      else
        {
        $('#inputTheater').html('<option selected>Please select branch first!.</option>');
        }
      }

    function audioChange()
      {
      var selectedAudio = $('#inputAudio').val();
      var theater = $('#inputTheater').val();
      if(selectedAudio)
        {
        $.ajax({
          type: 'POST',
          url: 'booking-controls.php',
          data: {"Audio":selectedAudio, "Theater_ID":theater},
          success: function(html) {
            $('#inputShowtime').html(html);
          }
        })
        }

      }


    function theaterChange() 
    {
      var theater = $('#inputTheater').val();

      if(theater)
       {
        $.ajax({
          type: 'POST',
          url: 'booking-controls.php',
          data: {"Theater_ID":theater},
          success: function(html) {
            $('#inputShowtime').html(html);
          }
        })
       }
    }

    $('#inputBranch').change(function() {
      theaterChange();
      branchChange();
      audioChange();
    });

    $('#inputTheater').change(function() {
      theaterChange();
      audioChange();
    });

    $('#inputAudio').change(function(){
      audioChange();
    });

  });


   /* $('#inputAudio').change(function() {
      audioChange();
    });


    $('#inputTheater').change(function() {
      theaterChange();
    });
  });*/
</script>

<!--HANDLE UNAVAILABLE SEATS-->
<script type="text/javascript">
 
</script>



<script src="jsSeatChart/scripts.js"></script>
<script src="jsSeatChart/jquery.seat-charts.js"></script>

</body>

</html>
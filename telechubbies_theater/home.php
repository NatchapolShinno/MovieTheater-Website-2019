<?php

  session_start();

  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

#pre_r($_SESSION); 

  include 'account-controls.php';
  include 'movie-controls.php';

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>Telechubbies Theater</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styleHome.css" />
  <link rel="stylesheet" href="movie-slides.css" />
  <link rel="stylesheet" href="navMenuBodyStyle.css" />
  <script src="glide.min.js" charset="utf-8"></script>


  <!--USING LOWER VERSION OF JQUERY HERE BC BOOTSTRAP'S JS NEED LOW VERSION-->
  <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!--<script>$.noConflict();</script>-->
  <link rel="stylesheet" href="glide.core.min.css">
  <link rel="stylesheet" href="glide.theme.min.css">
  


</head>

<body>
  <header class="header-fade">
    <div class="inner-width">
      <a href="#" class="logo"><img src="logo.png" alt="" /></a>
      <nav class="navigation-menu">
          <a href="home.php"><i class="fas fa-home home"></i> Home</a>
          <a href="#"><i class="fas fa-align-left about"></i> About</a>
          <a href="movielist.php"><i class="fas fa-film"></i> Movies</a>
          <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
          <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
          <a href="snacks.php"><i class = "fas fa-cookie snacks"></i>Snacks</a>

          <!--check if user is already logged in from session-->
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
  <!-- Slide Show-->

<div class="container">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./img/promo1.jpg">
    </div>
    <div class="item">
      <img src="./img/promo5.jpg">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>

  <!-- Buy a Ticket
  <a href="seatChart.html">
    <div class="container">
      <button class="btn btn1"><i class="fas fa-ticket-alt"></i>    GET A TICKET</button>
    </div>
  </a>-->


      <!-----------------------------ALL MOVIES------------------------------->
    <h1 class="category-name">Now Showing</h1>
    <div class="all_movies glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

                <!-------------MOVIE CARDS------------------>
                
                <?php
                foreach($all_movies as $key => $movie):
                ?>

                <li class="glide__slide"><a href="./book-ticket.php?movie-id=<?php echo $movie['Movie_ID'];?>" target = "_blank">
                    <div class="card">

                        <div class="poster"><img src="./movie-img/<?php echo $movie['Movie_ID'];?>.jpg" style="width: 100%;"></div>


                        <div class="detail">
                            <div class="preview_detail">
                            <h2><?php echo $movie['Movie_Name']; ?><br><span style="margin-bottom: 10px;">Directors: <?php echo $movie['Director'];?></span></h2>
                            <!--<div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>7.0/10</span>
                            </div>-->
                            <div class="tag" style="margin-bottom: 20px;">


                                <?php
                                $tags = explode(" ", $movie['Genre']);

                                foreach($tags as $tag):
                                ?>

                                <span class="<?php echo strtolower($tag); ?>"><?php echo $tag; ?></span>

                                <?php
                                endforeach;
                                ?>
                            </div>
                            </div>

                            <div class="info">
                                <?php echo $movie['Synopsis']; ?>
                            </div>

                            <!--<div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castFrozen1.jpg" alt=""></li>
                                    <li><img src="./img/castFrozen2.jpg" alt=""></li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                    </a>
                </li>
                
            <?php
            endforeach;
            ?>

            </ul>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i
                    class="fas fa-arrow-left"></i></button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i
                    class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <script>
        new Glide(".all_movies", {
            type: 'carousel',
            perView: 6,
            focusAt: 'center',
            gap: 40,
            breakpoints: {
                1200: {
                    perView: 3
                },
                800: {
                    perView: 2
                }
            }
        }).mount();
      </script>



  <script type="text/javascript">
    $(".menu-toggle-btn").click(function () {
      $(this).toggleClass("fa-times");
      $(".navigation-menu").toggleClass("active");
    })(jQuery);
  </script>

  <script type="text/javascript">
        window.addEventListener("scroll", function() {

        if(window.scrollY > 0)
            {
            $("header").removeClass("header-fade");
            }
        else
            {
            $("header").addClass("header-fade");   
            }
    })(jQuery);
    </script> 

</body>

</html>
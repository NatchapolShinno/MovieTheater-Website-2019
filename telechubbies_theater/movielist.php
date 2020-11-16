<?php


include 'account-controls.php';

include 'movie-controls.php';

  function pre_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}


#pre_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Telechubbies Theater</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <link rel="stylesheet" href="movielist.css" />
    <link rel="stylesheet" href="movie-slides.css" />
    <link rel="stylesheet" href="navMenuBodyStyle.css" />

    <script
  src="https://code.jquery.com/jquery-3.5.0.js"
  integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
  crossorigin="anonymous"></script>

  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

    <script src="glide.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="glide.core.min.css">
    <link rel="stylesheet" href="glide.theme.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

    <link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />
        <script src="https://vjs.zencdn.net/7.7.5/video.js"></script>

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
    <!--<div class="promo-text"><h1 style="color: white;">MULAN COMING SOOON</h1></div>-->
    <div class="promo-video">

            <video autoplay style="max-width: 100%;" class="video-js"  poster="./movie-img/coming-soon-mulan.jpg"  data-setup='{"controls": false}'>
                <source src="./movie-img/promo.mp4" type="video/mp4">
            </video>
            <div class="bottom-overlay"></div>
            <div class="promo-logo"><p> To save her ailing father from serving in the Imperial Army, a fearless young woman disguises herself as a man to battle northern invaders in China.</p></div>
        <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/R-eFm--k21c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <h2>COMING SOON</h2>
        <h1>Mulan</h1>
        <h3>this summer</h3>-->
    </div>
    <!--END PROMO-->

    <!--BEGIN MOVIES SLIDES-->
    <div class="container">
    <!-----------------------------ALL MOVIES------------------------------->
    <h1 class="category-name" style="margin-top: 200px;">Now Showing</h1>
    <div class="all_movies glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

                <!-------------MOVIE CARDS------------------>
                
                <?php
                foreach($all_movies as $key => $movie):
                ?>

                <li class="glide__slide "><a href="./book-ticket.php?movie-id=<?php echo $movie['Movie_ID'];?>" target = "_blank">
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
                                $tags = explode(" ", $movie['Subgenre']);
                                array_push($tags, $movie['Genre']);

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

    <!-----------------------------COMEDY MOVIES------------------------------->
    <h1 class="category-name">Action</h1>
    <div class="action_movies glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

                <!-------------MOVIE CARDS------------------>
                
                <?php
                foreach($comedy_movies as $key => $movie):
                ?>

                <li class="glide__slide "><a href="./book-ticket.php?movie-id=<?php echo $movie['Movie_ID'];?>" target = "_blank">
                    <div class="card">

                        <div class="poster"><img src="./movie-img/<?php echo $movie['Movie_ID'];?>.jpg" style="width: 100%;"></div>


                        <div class="detail">
                            <h2 style="margin-bottom: 10px;"><?php echo $movie['Movie_Name']; ?><br><span style="margin-bottom: 10px;">Directors: <?php echo $movie['Director'];?></span></h2>
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
                                $tags = explode(" ", $movie['Subgenre']);
                                array_push($tags, $movie['Genre']);

                                foreach($tags as $tag):
                                ?>

                                <span class="<?php echo strtolower($tag); ?>"><?php echo $tag; ?></span>

                                <?php
                                endforeach;
                                ?>


                            </div>

                            <div class="info">
                                <?php echo $movie['Synopsis']; ?>
                            </div>

                           <!-- <div class="star">
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


    <!--ACTION MOVIES-->
    <h1 class="category-name">Comedy</h1>
    <div class="comedy_movies glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

                <!-------------MOVIE CARDS------------------>
                
                <?php
                foreach($action_movies as $key => $movie):
                ?>

                <li class="glide__slide "><a href="./book-ticket.php?movie-id=<?php echo $movie['Movie_ID'];?>" target = "_blank">
                    <div class="card">

                        <div class="poster"><img src="./movie-img/<?php echo $movie['Movie_ID'];?>.jpg" style="width: 100%;"></div>


                        <div class="detail">
                            <h2 style="margin-bottom: 10px;"><?php echo $movie['Movie_Name']; ?><br><span style="margin-bottom: 10px;">Directors: <?php echo $movie['Director'];?></span></h2>
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
                                $tags = explode(" ", $movie['Subgenre']);
                                array_push($tags, $movie['Genre']);

                                foreach($tags as $tag):
                                ?>

                                <span class="<?php echo strtolower($tag); ?>"><?php echo $tag; ?></span>

                                <?php
                                endforeach;
                                ?>


                            </div>

                            <div class="info">
                                <?php echo $movie['Synopsis']; ?>
                            </div>

                           <!-- <div class="star">
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

    <div class="footer-img">
        .
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

        new Glide(".comedy_movies", {
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
        new Glide(".action_movies", {
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

    var promo = videojs(document.querySelector('.video-js'));

    var promo_no_js = document.querySelector('.video-js');

    var bottom_gradient = document.querySelector('.promo-overlay-bottom');

    var video_height = $(document.querySelector('.video-js')).height();

    $(window).ready(function() {
        PosterImage(promo).addClass("poster-videojs");
    });

    promo.ready(function() {
        promo.play();
    });

    promo.ended(function() {
        promo.posterImage.show();
    });

    $(window).scroll(function() {
        //$(document.querySelector('.category-name')).text(scrollheight);
        if($(window).scrollTop() > 650)
            {
              //  promo.pause();   
            promo.pause();
            } 
        else
            {
            promo.play();
            }
    });

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
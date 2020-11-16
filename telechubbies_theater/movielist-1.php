<?php

		function pre_r($array)
		{
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		}


include 'account-controls.php';


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Telechubbies Theater: Snacks</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
<link rel="stylesheet" href="movieList.css"/>
<link rel="stylesheet" href="navMenuBodyStyle.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    <script src="glide.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="glide.core.min.css">
    <link rel="stylesheet" href="glide.theme.min.css">

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



  	<div class="images glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

                <!--------------------------------Frozen-------------------------------------->
                
                <li class="glide__slide "><a href="https://www.youtube.com/watch?v=J_i1XQmp0e0" target = "_blank">
                    <div class="card">
                        <div class="poster"><img src="./img/posFrozen.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>Frozen II<br><span>Directors: Chris Buck, Jennifer Lee</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>7.0/10</span>
                            </div>
                            <div class="tag">
                                <span class="animation">Animation</span>
                                <span class="comedy">Comedy</span>
                            </div>
                            <div class="info">
                                <p>Anna, Elsa, Kristoff, Olaf and Sven leave Arendelle to travel to an ancient,
                                    autumn-bound forest of an enchanted land. They set out to find the origin of Elsa's
                                    powers in order to save their kingdom. </p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castFrozen1.jpg" alt=""></li>
                                    <li><img src="./img/castFrozen2.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </a>
                </li>
                <!--------------------------------Black Panther-------------------------------------->

                <li class="glide__slide ">
                    <div class="card">
                        <div class="poster"><img src="./img/posBlackPan.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>Black Panther<br><span>Director: Ryan Coogler</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>7.3/10</span>
                            </div>
                            <div class="tag">
                                <span class="action">Action</span>
                                <span class="fantasy">Fantasy</span>

                            </div>
                            <div class="info">
                                <p>T'Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to
                                    lead his people into a new future and must confront a challenger from his country's
                                    past.</p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castBlackPan1.jpg" alt=""></li>
                                    <li><img src="./img/castBlackPan2.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!--------------------------------Dunkirk-------------------------------------->

                <li class="glide__slide ">
                    <div class="card">
                        <div class="poster"><img src="./img/posDunkirk.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>Dunkirk<br><span>Director: Christopher Nolan</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>7.9/10</span>
                            </div>
                            <div class="tag">
                                <span class="action">Action</span>
                                <span class="drama">Drama</span>
                            </div>
                            <div class="info">
                                <p>Allied soldiers from Belgium, the British Empire, and France are surrounded by the
                                    German Army, and evacuated during a fierce battle in World War II.</p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castDunkirk1.jpg" alt=""></li>
                                    <li><img src="./img/castDunkirk2.jpg" alt=""></li>
                                    <li><img src="./img/castDunkirk3.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!--------------------------------Test-------------------------------------->

                <li class="glide__slide ">
                    <div class="card">
                        <div class="poster"><img src="./img/joeyTest.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>สุดหล่อกระชากใจสาว<br><span>Directors: Fai & Jamie</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>100/5</span>
                            </div>
                            <div class="tag">
                                <span class="action">Drama</span>

                            </div>
                            <div class="info">
                                <p>Anna, Elsa, Kristoff, Olaf and Sven leave Arendelle to travel to an ancient,
                                    autumn-bound forest of an enchanted land. They set out to find the origin of Elsa's
                                    powers in order to save their kingdom. </p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/joeyStar.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!--------------------------------BigHero-------------------------------------->

                <li class="glide__slide ">
                    <div class="card">
                        <div class="poster"><img src="./img/posBigHero.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>Big Hero 6<br><span>Directors: Don Hall, Chris Williams</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>7.8/10</span>
                            </div>
                            <div class="tag">
                                <span class="action">Action</span>
                                <span class="animation">Animation</span>
                            </div>
                            <div class="info">
                                <p>The special bond that develops between plus-sized inflatable robot Baymax, and
                                    prodigy Hiro Hamada, who team up with a group of friends to form a band of high-tech
                                    heroes.</p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castBigHero1.jpg" alt=""></li>
                                    <li><img src="./img/castBigHero2.jpg" alt=""></li>
                                    <li><img src="./img/castBigHero3.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <!--------------------------------Your Name-------------------------------------->

                <li class="glide__slide ">
                    <div class="card">
                        <div class="poster"><img src="./img/posYourName.jpg" style="width: 100%;"></div>
                        <div class="detail">
                            <h2>Your Name<br><span>Directors: Makoto Shinkai</span></h2>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>8.4/10</span>
                            </div>
                            <div class="tag">
                                <span class="animation">Animation</span>
                                <span class="drama">Drama</span>
                                <span class="fantasy">Fantasy</span>

                            </div>
                            <div class="info">
                                <p>Two strangers find themselves linked in a bizarre way. When a connection forms, will distance be the only thing to keep them apart?</p>
                            </div>
                            <div class="star">
                                <h4>Cast</h4>
                                <ul>
                                    <li><img src="./img/castBigHero1.jpg" alt=""></li>
                                    <li><img src="./img/castBigHero2.jpg" alt=""></li>
                                    <li><img src="./img/castBigHero3.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>


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
        new Glide(".images", {
            type: 'carousel',
            perView: 5,
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








	<footer class="my-5 pt-5 text-muted text-center text-small">
	<p class="mb-1">© 2019-2020 Telechubbies Theater Group</p>
	<ul class="list-inline">
		<li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Privacy</a></li>
		<li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Terms</a></li>
		<li class="list-inline-item"><a href="https://getbootstrap.com/docs/4.0/examples/checkout/#">Support</a></li>
	</ul>
	</footer>


</body>

</html>
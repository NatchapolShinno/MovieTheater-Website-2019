<?php

function pre_r($array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

session_start();

include 'account-controls.php';

//pre_r($_SESSION);

$_SESSION['total'] = $_SESSION['subtotal'];

#initialize global variable for checking if discount code has been applied
#$GLOBALS['discountStatus'] = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Telechubbies Theater: Checkout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
	<link rel="stylesheet" href="shopping-cart.css"/>
	<link rel="stylesheet" href="navMenuBodyStyle.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>


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

  <!--jQuery for updating pickupbranch in discount  form-->
  <script type="text/javascript">
    function updateDiscountBranch() {
    var value = $('#branch option:selected').val();
    $('#pickup_branch').val(value);
  }
  </script>

	<!--checkout page-->
	<!------------------- HIDDEN DYNAMIC ELEMENT TO CLONE ------------->
      <!--CREDIT/DEBIT FORM-->
      <div class="form-group credit-form debit-form" style="display:none">
      	<div class="row">
      		<div class="col-md-6 mb-3">
      			<label for="cc-name">Name on Card</label>
      			<input type="text" class="form-control" id="cc-name" placeholder="" required="">
      			<small class="text-muted">Full name as displayed on card</small>
      			<!--<div class="invalid-feedback">
      				Name on card is required
      			</div>-->
      		</div>
      		<div class="col-md-6 mb-3">
      			<label for="cc-number">Card Number</label>
      			<input type="text" class="form-control" id="cc-number" placeholder="" required="">
      			<!--<div class="invalid-feedback">
      				Credit card number is required
      			</div>-->
      		</div>
      	</div>

      	<div class="row">
      		<div class="col-md-3 mb-3">
      			<label for="cc-expiration">Expiration</label>
      			<input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
      			<div class="invalid-feedback">
      				Expiration date required
      			</div>
      		</div>
      		<div class="col-md-3 mb-3">
      			<label for="cc-expiration">CVV</label>
      			<input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
      			<div class="invalid-feedback">
      				Security code required
      			</div>
      		</div>
      	</div>

      </div>

      <!--PAYPAL FORM-->
      <div class="form-group paypal-form" style="display:none">
      	<div class="row">
      		<div class="col-md-2"></div>

      		<!-- Replace these fields -->
      		<div class="col-md-4">
      			<select id="profesor" name="profesor[]" class="form-control">
      				<option value="1">PAYPAL</option>
      			</select>
      		</div>
      		<div class="col-md-3">
      			<select id="rol" name="rol[]" class="form-control">
      				<option>Rol</option>
      				<option value="1">Guia</option>
      				<option value="2">Co-Guia</option>
      				<option value="3">Presidente</option>
      				<option value="4">Invitado</option>
      			</select>
      		</div>
      		<!-- End of fields-->
      		<div class="col-md-1">
      			<p class="delete">x</p>
      		</div>
      	</div>
      </div>



	<div class="container" style="margin-top: 50px;">
		<div class="py-5 text-center">
			<!--<img class="d-block mx-auto mb-4" src="./CHECKOUT_EXAMPLE_files/bootstrap-solid.svg" alt="" width="72" height="72">-->
		</div>

		<!--CUSTOMER DETAILS-->
		<div class="row">
			<div class="col-md-8 order-md-1">

        <?php
        if(isset($_SESSION['invalid_branch']) AND $_SESSION['invalid_branch'] == 1)
            {
        ?>
        <div class="alert alert-danger">Sorry! The chosen branch is not eligible for the discount code: <?php echo $_SESSION['discountCode'];?></div>

        <?php
            }
        ?>

        <?php
        if(isset($_SESSION['discountStatus']) AND $_SESSION['discountStatus'] == 0)
          {
        ?>
        <div class="alert alert-danger">Invalid discount code!</div>
        <?php
          }
        ?>

				<h4 class="mb-3">Member Information</h4>
				<!-- <form class="needs-validation" novalidate="">-->
	<form action="" method="POST">

						<div class="mb-3">
							<label for="username">Member E-Mail (if applicable)</label>
							<div class="input-group">
                <!--<div class="input-group-prepend">
                  <span class="input-group-text">@</span>
              </div>-->
              <input type="text" class="form-control" id="username" name="email" placeholder="name@mail.com"
              <?php
                if(isset($_SESSION['member-email']))
                  {
                  $email = $_SESSION['member-email'];
                  echo "value='$email'";
                  unset($email);
                  }
              ?>
              >
            <small class="text-muted">Leave blank if purchasing as non-member.</small>
            <br>

              <label for="branch">Pick-up Branch</label><br>
              <select class="form-control" id="branch">
                <option selected>Please select a branch for pickup.</option>
                <?php

                    if(isset($_SESSION['member-id']))
                      {
                      $memberid = $_SESSION['member-id'];
                      $query = "SELECT RegisterBranch_ID FROM member WHERE Member_ID = $memberid;";

                      $result = mysqli_query($db, $query);

                      $query_array = mysqli_fetch_assoc($result);

                      $default_branch = $query_array['RegisterBranch_ID'];
                      }
                    else
                      {
                      $default_branch = 0;
                      }

                    $query = "SELECT Branch_ID, Location FROM cinemabranch;";

                    $result = mysqli_query($db, $query);

                  if(mysqli_num_rows($result) > 0)
                    {
                    while($branch = mysqli_fetch_assoc($result))
                      {
                      echo '<option value="' . $branch['Branch_ID'] . '"';

                      if($branch['Branch_ID'] == $default_branch)
                        {
                        echo 'selected';
                        echo  '>';

                          echo '<script type="text/javascript">jQuery(function() {updateDiscountBranch();});</script>';

                        echo $branch['Location'] . '</option>';
                        }
                      else
                        {
                       echo  '>';
                        echo $branch['Location'] . '</option>';
                        }

                      /*also update discount code in discount form*/
                      }
                    }
                  else
                    {
                    echo "<option selected>Uh oh! It seems our database is down!</option>";
                    }
                ?>
              </select>
              <small class="text-muted">Your product will be ready at the selected branch.</small>

              <!--jQUERY for sending this selection data to discount form-->
              <script type="text/javascript">

                $('#branch').change(function() {
                  updateDiscountBranch();
                });


              </script>
          </div>
      </div>

      <hr class="mb-4">

      <h4 class="mb-3">Payment</h4>

      <div class="d-block my-3">
      	<div class="custom-control custom-radio">
      		<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" required="" value="credit">
      		<label class="custom-control-label" for="credit">Credit Card</label>
      	</div>
      	<div class="custom-control custom-radio">
      		<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="" value="debit">
      		<label class="custom-control-label" for="debit">Debit Card</label>
      	</div>

      	<div class="custom-control custom-radio">
      		<input id="cash" name="paymentMethod" type="radio" class="custom-control-input" required="" value="cash">
      		<label class="custom-control-label" for="cash">Cash</label>
      		<small class="text-muted">Customers must pay upon receiving product at concession stand.</small>
      	</div>
      </div>

      <!--SCRIPT FOR DYNAMIC PAYMENT FORM-->
      <script src="checkout_payment.js"></script>

      <!------------------------------------------------------------------->

      <!--SPACE FOR FORM-->
      <div class="payment-form">
      </div>


          <hr class="mb-4">
          <button name="checkout-submit" class="btn btn-primary btn-lg btn-block" type="submit">Confirm</button>

      </form>
  </div>





  <!--SHOPPING CART-->
  <div class="col-md-4 order-md-2 mb-4">
  	<h4 class="d-flex justify-content-between align-items-center mb-3">
  		<span class="text-muted">Your Cart</span>
  		<span class="badge badge-secondary badge-pill"><?php echo count($_SESSION['shopping_cart']);?></span>
  	</h4>

  	<!--SHOPPING CART SUMMARY-->
  	<ul class="list-group mb-3">

  		<!--LIST SHOPPING CART ITEMS-->
  		<?php
  		foreach($_SESSION['shopping_cart'] as $key => $product):
  			?>
  			<li class="list-group-item d-flex justify-content-between lh-condensed">



  				<div>
  					<h6 class="my-0"><?php echo $product['name']; ?> @ <?php echo $product['price']; ?> ฿</h6>
  					<small class="text-muted">Quantity: <?php echo $product['quantity'];?></small>
  				</div>
  				<span class="text-muted">฿ <?php echo number_format($product['price'] * $product['quantity'], 2);?></span>

  			</li>
  			<?php
  		endforeach;
  		?>



  		<?php
  		#echo $_SESSION['discountStatus'];

          if($_SESSION['discountStatus'] == 1):
          	$_SESSION['discount'] = $_SESSION['subtotal'] * ($_SESSION['discountPercent'] / 100);
          	$_SESSION['total'] = $_SESSION['subtotal'] - $_SESSION['discount'];
        ?>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo Code</h6>
                <small><?php echo $_POST['discount-code'];?></small>
              </div>
              <span class="text-success">-฿ <?php echo number_format($_SESSION['discount'] ,2);?></span>
          </li>

      	<?php
	  	endif
    	?>


          <li class="list-group-item d-flex justify-content-between">
          	<span>Total (THB)</span>
          	<strong>฿ <?php echo number_format($_SESSION['total'], 2); ?></strong>
          </li>



      </ul>


      <form class="card p-2" method="POST">
      	<div class="input-group">

          <input type="hidden" id="pickup_branch" name="pickup_branch"/>
      		<input type="text" class="form-control" name="discount-code" placeholder="Promo Code"/>

      		<div class="input-group-append">
      			<button type="submit" class="btn btn-info" name="redeem">Redeem</button>
      		</div>
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

  <!--JAVASCRIPT FOR PROMO CODE BOX-->
  <script>
  </script>

</body>

</html>
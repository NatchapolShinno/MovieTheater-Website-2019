<?php

	function pre_r($array)
	{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	}


	session_start();

	#initialize session
	#session_destroy();

	$product_ids = array();

	#check if add to cart button has been submitted
	if(filter_input(INPUT_POST, 'add-to-cart'))
		{
		if(isset($_SESSION['shopping_cart']))
			{
			#count the number of elements in shopping_cart array
			$count = count($_SESSION['shopping_cart']);

			#create sequential array or matching array keys to product ids
			$product_ids = array_column($_SESSION['shopping_cart'], 'id');

			#check if product is already in array
			if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids))
				{
				#if not exist, proceed
				$_SESSION['shopping_cart'][$count] = array
								(
								'id' => filter_input(INPUT_GET, 'id'),
								'name' => filter_input(INPUT_POST, 'name'),
								'price' => filter_input(INPUT_POST, 'price'),
								'quantity' => filter_input(INPUT_POST, 'quantity'),
								'image' => filter_input(INPUT_POST, 'image')
								);
				}
			else #if already exist, add to quantity
				{
				#loop through product ids and match array key to id of product being added to cart
				for($i = 0; $i < count($product_ids); $i++)
					{
					if($product_ids[$i] == filter_input(INPUT_GET, 'id'))
						{
						#add quantity to existing product in array
						$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
						}
					}
				}

			#pre_r($product_ids);

			#keep track of product ids
			}
		else #if shopping cart does not exist, create first product with array key 0
			{
			#create array using submitted form data, starting from key 0, and fill with values
			$_SESSION['shopping_cart'][0] = array
											(
											'id' => filter_input(INPUT_GET, 'id'),
											'name' => filter_input(INPUT_POST, 'name'),
											'price' => filter_input(INPUT_POST, 'price'),
											'quantity' => filter_input(INPUT_POST, 'quantity'),
											'image' => filter_input(INPUT_POST, 'image')
											);
			}
		}

#check for remove
if(filter_input(INPUT_GET, 'action') == 'delete')
	{
	#loop through products in shopping cart until matches with GET id var
	foreach($_SESSION['shopping_cart'] as $key => $product)
		{
		if($product['id'] == filter_input(INPUT_GET, 'id'))
			{
			#remove product from shopping cart when matches
			unset($_SESSION['shopping_cart'][$key]);
			}
		}

	#reset session array keys
	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
	}


#preview shopping cart array
#pre_r($_SESSION);


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
<link rel="stylesheet" href="shopping-cart.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

</head>




<body>

	<header>
 		<div class="inner-width">
			<a href="#" class="logo"><img src="logo.png" alt="" /></a>
			<nav class="navigation-menu">
	        <a href="#"><i class="fas fa-home home"></i> Home</a>
	        <a href="#"><i class="fas fa-align-left about"></i> About</a>
	        <a href="movieList.html"><i class="fas fa-film"></i> Movies</a>
	        <a href="index.html#team-section"><i class="fas fa-users team"></i> Team</a>
	        <a href="contact.html"><i class="fas fa-headset contact"></i> Contact</a>
	        <a href="snacks.php"><i class = "fas fa-cookie snacks"></i>Snacks</a>
      	</nav>
		</div>
  	</header>

	<div class="container" style="margin-top: 50px;">

	<?php
			#connect to database
			$db = mysqli_connect('localhost', 'root', '', 'telechubbies_theater');

			#query products
			$query = 'SELECT * FROM Items ORDER BY ItemID ASC';
			$result = mysqli_query($db, $query);

			#check if product table  is empty
			if ($result):
				if(mysqli_num_rows($result) > 0):
					while($product = mysqli_fetch_assoc($result)):
						?>
						<div class = "col-sm-4 col-md-3">
							<form method = "POST" action = "code-test.php?action=add&id=<?php echo $product['ItemID']; ?>">
								<div class = "products">
									<center><img src="products/<?php echo $product['Image']; ?>" class = "img-responsive product-img"/></center>
									<h4 class = "text-info product-name"><?php echo $product['ItemName']; ?></h4>
									<h4>฿ <?php echo $product['ItemPrice']; ?></h4>
									<input type = "text" name = "quantity" class = "form-control" value = "1"/>
									<input type = "hidden" name = "name" value = "<?php echo $product['ItemName']; ?>"/>
									<input type = "hidden" name = "price" value = "<?php echo $product['ItemPrice']; ?>"/>
									<input type = "hidden" name = "image" value = "<?php echo $product['Image']; ?>"/>
									<center><input type = "submit" name = "add-to-cart" class = "btn btn-info" value = "Add to Cart"/></center>
								</div>
							</form>
						</div>
						<?php
					endwhile;
				endif;
			endif;
		?>
	</div>
	

	<div class = "table-responsive summary">
		<table class = "table table-striped">
			<tr><th colspan="6"><h3>Order Summary</h3></th></tr>
			<tr>
				<th width="10%"></th>
				<th width="40%">Product Name</th>
				<th width="10%">Quantity</th>
				<th width="20%">Price</th>
				<th width="15%">Total</th>
				<th width="5%">Action</th>
			</tr>

			<!--loop and print out all shopping cart items-->
			<?php
				if(!empty($_SESSION['shopping_cart']))
					{

					#total variable to calculate grand total
					$total = 0;

					foreach($_SESSION['shopping_cart'] as $key => $product):

			?>

			<tr>
				<td><img src="products/<?php echo $product['image']; ?>" class = "img-responsive cart-img"/></td>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['quantity']; ?></td>
				<td>฿ <?php echo $product['price']; ?></td>
				<td>฿ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
				<td>
					<a href="code-test.php?action=delete&id=<?php echo $product['id'];?>">
						<div class = "btn btn-danger">Remove</div>
					</a>
				</td>
			</tr>

			<!--calculate grand total-->
			<?php 
						$total = $total + ($product['quantity'] * $product['price']);
					endforeach;
					}
				else
					{
					$total = 0;
					}

			?>

			<!--print grand total-->
			<tr>
				<td colspan = "3" align = "right">Total</td>
				<td align = "right"><b>฿ <?php echo number_format($total, 2); ?></b></td>
				<td></td>
			</tr>


			<!--checkout button-->
			<tr>
				<td colspan = "5">
					<?php
						if(isset($_SESSION['shopping_cart'])):
							if(count($_SESSION['shopping_cart']) > 0):
					?>
						<a href="#" class = "button">Checkout</a>
					<?php
							endif;
						endif;
					?>
				</td>
			</tr>



		</table>

	</div>


</body>

</html>
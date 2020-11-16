

<?php
error_reporting(~E_NOTICE);
#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies','telechubbies_theater');


#Report a total quantity of each item and show in a descending order. 
$queryItemsold_count= "SELECT ItemID, SUM(Quantity) FROM itemsold GROUP BY ItemID ORDER BY SUM(Quantity) DESC"; 
$resultItemsold_count = mysqli_query($db,$queryItemsold_count);	 
#Show to manager about details of each itemID
$queryItems = "SELECT * FROM items;";
$resultItems = mysqli_query($db,$queryItems);



#match item id
$query= "SELECT itemsold.ItemID, SUM(itemsold.Quantity), items.ItemName , items.ItemPrice, SUM(itemsold.Quantity)*items.ItemPrice
			FROM itemsold,items 
			WHERE itemsold.ItemID = items.ItemID 
			GROUP BY itemsold.ItemID 
			ORDER BY SUM(itemsold.Quantity) DESC"; 
$result = mysqli_query($db,$query);	





 




?>




<!DOCTYPE html>
<html lang="en">
<head>
<title>Telechubbies Theater | Manager Sales Report</title>
 
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Space Register Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->

	<!-- css files -->
	<link href="sales_report_css/sales_report_style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- css files -->

	<!-- Online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<!-- //Online-fonts -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body>

	<!-- Main Content -->
	<div class="main">
		<div class="main-w3l">
			<h1 class="logo-w3">Manager Sales Report</h1>
			
				<p>Summarize The Sales Amount, Price, Total Price Of Each And Sort Item From The Best Seller</p>
				<table class="w3-table">
				<tr>
				<th>Item Name</th>
				<th>Item ID</th>
				<th>Quantity</th>
				<th>Item Price</th>
				<th>Total Price</th>
				</tr>
				<?php
				if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["ItemName"]. "</td><td>" . $row["ItemID"] . "</td><td>" . $row["SUM(itemsold.Quantity)"]. "</td><td>" . $row["ItemPrice"]. "</td><td>" . $row["SUM(itemsold.Quantity)*items.ItemPrice"]. "</td></tr>";	
				}
				echo "</table>";
				} else { echo "0 results"; }
				?>
				
				</table>

		<!--footer-->
			<div class="footer-w3l">
				<p>&copy; 2020 | Telechubbies Theater</a></p>
			</div>
			<!--//footer-->
			
		</div>
	</div>
	<!-- //Main Content -->

</body>
</html>

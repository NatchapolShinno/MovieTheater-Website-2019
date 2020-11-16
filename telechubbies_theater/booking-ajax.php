<?php
	include 'connectDB.php';

		$audio = $_POST['Audio'];
		$theater = $_POST['Theater_ID'];
		$branchid = $_POST['Branch_ID'];
		$movieid = $_POST['Movie_ID'];

#for AJAX, once branch is selected, get all available THEATERS for given movie and branch
	if(!empty($_POST['Branch_ID']))
		{

		$query = "SELECT No, Theater_ID
			FROM theater
			WHERE (Theater_ID IN (SELECT Theater_ID
                      			FROM showtimes
                      			WHERE Roll_ID IN (SELECT Roll_ID
                                			        FROM filmrolls
                                        			WHERE Movie_ID = $movieid))) AND
        		(Branch_ID = $branchid);";

		$rolls_theaters = mysqli_query($db, $query);

		#echo "NuMBER OF ROWS: " . mysqli_num_rows($rolls_theaters);

		if(mysqli_num_rows($rolls_theaters) > 0)
			{
			while($theaters = mysqli_fetch_assoc($rolls_theaters))
				{
				echo '<option value="' . $theaters['Theater_ID'] . '">' . $theaters['No'] . '</option>';
				}
			}
		else
			{
			echo '<option selected>No showtimes found! Sorry!</option>';
			}
		}

	#for AJAX, once audio has been selected get all available SHOWTIMES for given parameters
	if(!empty($_POST['Audio']) || !empty($_POST['Theater_ID']))
		{


		$query = "SELECT `DateTime`
				FROM showtimes
				WHERE Theater_ID = $theater
					AND Audio LIKE '$audio';";		

		$available_showtimes = mysqli_query($db, $query);

		if(mysqli_num_rows($available_showtimes) > 0)
			{
			while($showtimes = mysqli_fetch_assoc($available_showtimes))
				{
				echo '<option value="' . $showtimes['DateTime'] . '">' . $showtimes['DateTime'] . '</option>';
				}
			}
		else
			{
			echo '<option selected>There are no showtimes available, sorry!</option>';
			}
		}


?>
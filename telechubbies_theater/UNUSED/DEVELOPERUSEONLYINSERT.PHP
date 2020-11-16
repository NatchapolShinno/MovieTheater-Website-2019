<?php

include 'account-controls.php';






for($i = 9; $i  < 13; $i++)
	{
	$query = "INSERT INTO theater (`No`, `Branch_ID`, `Theater_Type`)
			VALUES ($i, 3, '3DM');";
	mysqli_query($db, $query);
	}


?>
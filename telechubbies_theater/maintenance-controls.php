<?php


if(isset($_POST['maintain-submit']))
	{
	$employeeid = $_POST['employee-id'];
	$datetime = $_POST['maintain-datetime'];
	$details = $_POST['maintain-details'];
	$jobtype  = $_POST['maintain-type'];

	$query = "INSERT INTO maintenance (`Employee_ID`, `DateTime`, `Details`, `Job_Type`)
			  VALUES ($employeeid, '$datetime', '$details', '$jobtype');";

	mysqli_query($db, $query);
	}

?>
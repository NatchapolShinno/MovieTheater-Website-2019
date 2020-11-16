<?php


#submitting edit profile
if(isset($_POST['submit-profile']))
	{
	#use add slashes to prevent errors with special characters
	$employee_id = $_SESSION['employee-id'];
	$employee_name = addslashes($_POST['employee-name']);
	$employee_phone = addslashes($_POST['employee_phone']);
	$employee_address = $_POST['employee_address'];
	$employee_dob = $_POST['employee_dob'];

	$query = "UPDATE employees SET Employee_Name = '$employee_name',
								PhoneNumber = '$employee_phone',
								DateOfBirth = '$employee_dob',
								Address = '$employee_address' WHERE (Employee_ID LIKE '$employee_id');";
	echo $query;

	mysqli_query($db, $query);

	#update name in current session
	$_SESSION['employee-name'] = stripslashes($employee_name);

	header('Location: home-manager.php');
	}

?>
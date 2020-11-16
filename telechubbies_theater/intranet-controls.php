<?php

#GET PROFILE DATA

#query user from database
$employeeid = $_SESSION['employee-id'];

//echo $employeeid;

$query = "SELECT * FROM employees WHERE (Employee_ID LIKE $employeeid);";

//echo $query;

$result = mysqli_query($db, $query);


#check if it exists
if($result)
	{
	$employee = mysqli_fetch_assoc($result);


	$employee_name = $employee['Employee_Name'];
	/*get position data*/
	$positionid = $employee['Position_ID'];
	$query = "SELECT * FROM positions WHERE Position_ID = $positionid;";

	$result = mysqli_query($db, $query);

	$positiondata = mysqli_fetch_assoc($result);
	/***********************************/
	$employee_position = $positiondata['Position_Name'];
	$employee_salary = $positiondata['Salary'];

	/*get parent branch data*/
	$branchid = $employee['Branch_ID'];
	$query = "SELECT Location FROM cinemabranch WHERE Branch_ID = $branchid;";

	$result = mysqli_query($db, $query);

	$branchdata = mysqli_fetch_assoc($result);
	/****************************/
	$employee_branch = $branchdata['Location'];
	$employee_dob = $employee['DateOfBirth'];
	$employee_phone = $employee['PhoneNumber'];
	$employee_address = $employee['Address'];
	$employee_hours = $employee['WorkHours'];
	}


#submitting edit profile
/*if(isset($_POST['submit-profile']))
	{
	#use add slashes to prevent errors with special characters
	$employee_name = addslashes($_POST['employee-name']);
	$employee_contact = addslashes($_POST['employee-contact']);
	$employee_dob = $_POST['employee-dob'];
	$employee_email = $_POST['employee-email'];

	$query = "UPDATE employee SET employee_Name = '$employee_name',
								Contact_Info = '$employee_contact',
								DateOfBirth = '$employee_dob',
								Email = '$employee_email' WHERE (employee_ID LIKE '$employeeid');";
	echo $query;

	mysqli_query($db, $query);

	#update name in current session
	$_SESSION['employee-name'] = stripslashes($employee_name);
	$_SESSION['employee-email'] = $employee_email;

	header('Location: profile.php');
	}*/

?>
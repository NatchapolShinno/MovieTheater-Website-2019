<?php

#GET PROFILE DATA

#query user from database
$memberid = $_SESSION['member-id'];

$query = 'SELECT * FROM member WHERE (Member_ID LIKE ' .  $memberid . ');';

$result = mysqli_query($db, $query);


#check if it exists
if($result)
	{
	$member = mysqli_fetch_assoc($result);
	
	$member_name = $member['Member_Name'];
	$member_type = $member['Member_Type'];
	$member_regdate = $member['RegisterDate'];
	$member_point = $member['Point'];
	$member_contact = $member['Contact_Info'];
	$member_dob = $member['DateOfBirth'];
	$member_email = $member['Email'];
	}


#submitting edit profile
if(isset($_POST['submit-profile']))
	{
	#use add slashes to prevent errors with special characters
	$member_name = addslashes($_POST['member-name']);
	$member_contact = addslashes($_POST['member-contact']);
	$member_dob = $_POST['member-dob'];
	$member_email = $_POST['member-email'];

	$query = "UPDATE member SET Member_Name = '$member_name',
								Contact_Info = '$member_contact',
								DateOfBirth = '$member_dob',
								Email = '$member_email' WHERE (Member_ID LIKE '$memberid');";
	echo $query;

	mysqli_query($db, $query);

	#update name in current session
	$_SESSION['member-name'] = stripslashes($member_name);
	$_SESSION['member-email'] = $member_email;

	header('Location: profile.php');
	}

?>
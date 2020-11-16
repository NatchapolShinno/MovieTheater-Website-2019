<?php

	#connect to db
  $db = mysqli_connect('34.87.179.193', 'root', 'telechubbies', 'telechubbies_theater');

  if(!isset($_SESSION))
  	{
  	session_start();
	}

 #get  current page name for back referring
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) . "?" . $_SERVER['QUERY_STRING'];  

 #SIGN OUT
  if(isset($_POST['sign-out']))
    {
    unset($_SESSION['member-id']);
    unset($_SESSION['member-name']);
    unset($_SESSION['member-email']);
    }

  #SIGN IN
  #check if login button has been pressed
  if(isset($_POST['sign-in-submit']))
    {
    #get email and password from POST

    #query login information with database
    $email = $_POST['email'];
    $password = $_POST['password'];

    /*query for member*/
    $query = "SELECT * FROM member WHERE (Email LIKE '$email') AND (Password LIKE '$password');";
    $result = mysqli_query($db, $query);

    $member = mysqli_fetch_assoc($result);

    /*query for employee*/
    /*position_id != 1 to exclude manager, MANAGER ID IS ALWAYS 1 !!*/
    $query = "SELECT * FROM employees WHERE (Email LIKE '$email') AND (Password LIKE '$password') AND (Position_ID != 1);";

    echo $query;

    $result = mysqli_query($db, $query);

    $employee = mysqli_fetch_assoc($result);

    /*query for manager*/
    $query = "SELECT * FROM employees WHERE (Email LIKE '$email') AND (Password LIKE '$password') AND (Position_ID = 1);";

    echo $query;

    $result = mysqli_query($db, $query);

    $manager= mysqli_fetch_assoc($result);

    #if there is valid user, load member information into _SESSION, and redirect
    if(!empty($member))
      {
      #load member id into session
    	$_SESSION['member-id'] = $member['Member_ID'];
    	$_SESSION['member-name'] = $member['Member_Name'];
    	$_SESSION['member-email'] = $member['Email'];

    	#login is now complete, go to home
    	unset($invalid_login);
    	$prev_page = filter_input(INPUT_GET, 'prev');


    	if(!empty($prev_page))
	    	{
	    	header('Location: ' . $prev_page);
    		}
    	else
    		{
    		header('Location: home.php');
    		}
      }
     else if(!empty($employee))
      {
      #load member id into session
    	$_SESSION['employee-id'] = $employee['Employee_ID'];
    	$_SESSION['employee-name'] = $employee['Employee_Name'];
    	$_SESSION['employee-email'] = $employee['Email'];

    	#login is now complete, go to home
    	unset($invalid_login);
    	$prev_page = filter_input(INPUT_GET, 'prev');


    	header('Location: home-employee.php');
      }
    else if(!empty($manager))
      {
      #load member id into session
    	$_SESSION['employee-id'] = $manager['Employee_ID'];
    	$_SESSION['employee-name'] = $manager['Employee_Name'];
    	$_SESSION['employee-email'] = $manager['Email'];

    	#login is now complete, go to home
    	unset($invalid_login);
    	$prev_page = filter_input(INPUT_GET, 'prev');

    	header('Location: home-manager.php');
      }
    else
    	{
    	$invalid_login = 1;
    	}

    pre_r($member);


    }

   #SIGN UP
    $query = "SELECT * FROM cinemabranch";

    $resultBranch = mysqli_query($db, $query);

    #$resultBranch = mysqli_fetch_assoc($result);


   if(isset($_POST['sign-up-submit']))
   	{
	   	#verify matching password#############################
	   	if(strcmp($_POST['password'], $_POST['password_repeat']) == 0)
		   	{
		   	#PASSSWORDS MATCH
		   	$password_nomatch = 0;
		   	}
		 else
		 	{
		 	$password_nomatch = 1;
		 	}
		 #######################################################

	   	#verify password length###################################
	   	if(strlen($_POST['password']) < 8)
	   		{
	   		$password_invalid_length = 1;
	   		}
	   	else
	   		{
	   		$password_invalid_length = 0;
	   		}
	   	############################################################

	   	#verify email#################################################
	   	$email = $_POST['email'];

	   	$query = "SELECT * FROM member WHERE (Email LIKE '$email');";

	   	$result = mysqli_query($db, $query);
	   	$email_array = mysqli_fetch_assoc($result);

	   	if(!empty($email_array))
	   		{
	   		$email_invalid = 1;
	   		}
	   	else
	   		{
	   		$email_invalid = 0;
	   		}
	   	##############################################################

	   	#verify branch###############################################
		$regbranch = $_POST['branch'];
		
	   	$query = "SELECT * FROM cinemabranch WHERE (Branch_ID LIKE '$regbranch');";

	   	$result = mysqli_query($db, $query);
	   	$branch_array = mysqli_fetch_assoc($result);

	   	if(!empty($branch_array))
	   		{
	   		$branch_invalid = 0;
	   		}
	   	else
	   		{
	   		$branch_invalid = 1;
	   		}	
	   	############################################################


	   	if($password_nomatch == 0 AND $password_invalid_length == 0 AND $email_invalid == 0 AND $branch_invalid == 0)
	   		{
	   		$date = getdate();

		   	$year = $date['year'];
		   	$month= $date['mon'];
		   	$day = $date['mday'];

		   	#handle 0s in day and month
		   	if($month < 10)
		   		{
		   		$month = '0' . $month;
		   		}

		   	if($day < 10)
		   		{
		   		$day = '0' . $day;
		   		}

		   	$regdate = $year . '-' . $month . '-' . $day;
		   	$password = $_POST['password'];
		   	$name = addslashes($_POST['member-name']);
		   	$contact = addslashes($_POST['contact-info']);
		   	$dob = $_POST['member-dob'];


		   	$query = "INSERT INTO `member`(`RegisterBranch_ID`, `Member_Name`, `Member_Type`, `RegisterDate`, `Point`, `Contact_Info`, `DateOfBirth`, `Email`, `Password`)
		   			  VALUES('$regbranch', '$name', 'REGULAR', '$regdate', '0', '$contact', '$dob', '$email', '$password');";

		   	echo $query;

		   	mysqli_query($db, $query);

		   	#sign up complete, go to login page
		   	$_SESSION['signup_complete'] = 1;

		   	header('Location: login.php');
	   		}

   	}

?>
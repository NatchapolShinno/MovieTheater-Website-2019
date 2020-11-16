<?php

#connect to db
$db = mysqli_connect('34.87.179.193', 'root', 'telechubbies', 'telechubbies_theater');

if(mysqli_connect_error())
{
	die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM cinemabranch;";

$resultBranch = mysqli_query($db, $query);
;


if(isset($_POST['submit']))
	{
	$email = $_POST['email'];
	$name = $_POST['member-name'];
	$password = $_POST['password'];
	$dob = $_POST['member-dob'];
	$contact = $_POST['contact-info'];
	$regbranch = $_POST['regbranch'];
	$regdate = "2020-03-05";

	$query = "INSERT INTO `Member`(`RegisterBranch_ID`, `Member_Name`, `Member_Type`, `RegisterDate`, `Point`, `Contact_Info`, `DateOfBirth`, `Email`, `Password`)
		   	VALUES('$regbranch', '$name', 'REGULAR', '$regdate', '0', '$contact', '$dob', '$email', '$password');";

	mysqli_query($db, $query);

	echo $query;
	}

?>




		<form method="POST">
 			<label for="email">E-Mail</label>
              <input type="text" class="form-control" placeholder="electronic@mail.com" name="email"/>

              <br>
              <label for="email">Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password"/>

              <br>
              <label for="email">Confirm Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password_repeat"/>
 
              <br>
              <label for="email">Full Name</label>
              <input type="text" class="form-control" placeholder="John Doe" name="member-name"/>

              </div>
             <div class="col-sm col-centered">


              <label for="email">Register Branch</label>


              <select id="inputBranch" name="branch" class="form-control" required>

                              <option selected>Choose...</option>
	                            <?php foreach($resultBranch as $key => $value)
	                            	{
	                            ?>

	                                <option value="<?php echo $value['Branch_ID'];?>"><?php echo $value['Location'];?></option>

	                            <?php } ?>


               </select>


              <small class="text-muted">Please choose the branch that you go to the most often.</small>



              <br>
              <label for="email">Contact Information</label>
              <input type="text" class="form-control" placeholder="Phone number, address, etc." name="contact-info"/>
              <br>
              <label for="email">Date of Birth</label>
              <input type="text" id="datepicker" name="member-dob" class="form-control"/>

              <input type="submit" value="submit" name="submit"/>
         </form>
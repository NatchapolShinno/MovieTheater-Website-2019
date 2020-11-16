<?php
include_once 'connectDB.php';
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_POST['submit'])) {
    $employee_name = addslashes($_POST['FirstName'] . " " . $_POST['LastName']);
    $CitizenID = $_POST['CitizenID'];
    $DOB = $_POST['DOB'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Gender = $_POST['Gender'];
    $AddressEmployee = addslashes($_POST['AddressEmployee']);
    $BranchID = $_POST['BranchID'];
    $PositionID = $_POST['PositionID'];
    $WorkHours = $_POST['WorkHours'];
    $password = $_POST['Password'];
}


/*check for existing email*/

$query = "SELECT Email FROM member WHERE Email = '$Email'
            UNION SELECT Email FROM employees WHERE Email = '$Email';";

$result = mysqli_query($db, $query);

if(mysqli_num_rows($result) > 0)
    {
    header("Location: managerEmploy.php?employ=invalidemail");
    }
else
    {

    $sql = "INSERT INTO employees (Branch_ID, ID_Card_Number, Employee_Name, Gender, DateOfBirth, PhoneNumber, Address, Email, Position_ID, WorkHours, Password) VALUES ('$BranchID','$CitizenID', '$employee_name','$Gender','$DOB','$Phone','$AddressEmployee','$Email','$PositionID','$WorkHours', '$password');";

    if($conn->query($sql) === TRUE){
        header("Location: managerEmploy.php?employ=success");
    }$conn->close();
    }
?>

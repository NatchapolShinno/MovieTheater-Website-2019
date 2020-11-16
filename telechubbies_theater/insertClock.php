<?php
include_once 'connectDB.php';
error_reporting(E_ALL ^ E_NOTICE);

$employeeID = $_POST['employeeID'];
if(isset($_POST['clock'])){
    $query = "SELECT * FROM clockinout WHERE Employee_ID = '$employeeID' ORDER BY DateTime DESC LIMIT 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if($row['Type'] == 1){
        $clockType = 0;
    }else if ($row['Type'] == 0 && $row['DateTime'] != 0){
        $clockType = 1;
    }else{
        $clockType = 0;
    }
    $sql = "INSERT INTO `clockinout`(`Employee_ID`, `Type`, `DateTime`) VALUES ('$employeeID','$clockType',CURRENT_TIMESTAMP())";

    if($conn->query($sql) === TRUE){
        header("Location: employeeClock.php?addshowtimes=success");
    }$conn->close();
}

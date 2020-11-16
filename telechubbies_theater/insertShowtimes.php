<?php
include_once 'connectDB.php';

error_reporting(E_ALL ^ E_NOTICE);

$BranchID = $_POST['BranchID'];
$TheaterNo = $_POST['Theater'];
$MovieID = $_POST['MovieID'];
$FilmRollID = $_POST['FilmRoll'];
$Audio = $_POST['Audio'];

$Showtimes = $_POST['Showtimes'];


$query = "SELECT DISTINCT Theater_ID FROM theater WHERE Branch_ID = '$BranchID' AND No = '$TheaterNo'";
$result = $conn->query($query);
$TheaterID = mysqli_fetch_assoc($result);

$sql2 = "INSERT INTO showtimes(DateTime, Theater_ID, Roll_ID, Audio) VALUES ('$Showtimes','$TheaterNo','$FilmRollID','$Audio')";
if($conn->query($sql2) === TRUE){
    header("Location: showtimesPage.php?addshowtimes=success");
}$conn->close();
    
?>
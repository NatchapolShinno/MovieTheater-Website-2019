<?php

require_once "connectDB.php";
error_reporting(E_ALL ^ E_NOTICE);
// Process delete operation after confirmation
// Include config file

$Date = $_POST["update_date"];
$ID_Theater = $_POST["update_id"];

$BranchID = $_POST['BranchID'];
$TheaterNo = $_POST['Theater'];
$MovieID = $_POST['MovieID'];
$FilmRollID = $_POST['FilmRoll'];
$Audio = $_POST['Audio'];
$Runtime = $_POST['Runtime'];
$Showtimes = $_POST['Showtimes'];

// Prepare a delete statement
$update = "UPDATE `showtimes` SET `DateTime`='$Showtimes',`Theater_ID`='$TheaterNo',`Roll_ID`='$FilmRollID',`Audio`='$Audio' WHERE DateTime = '$Date' AND Theater_ID = '$ID_Theater'";

if ($conn->query($update) === TRUE) {
    header("Location: showtimesPage.php?UpdateShowtimes=success");
}


// Close connection
mysqli_close($conn);

<?php

require_once "connectDB.php";
error_reporting(E_ALL ^ E_NOTICE);
// Process delete operation after confirmation
// Include config file

$deleteDate = $_POST["delete_date"];
$deleteID = $_POST["delete_id"];

// Prepare a delete statement
$delete = "DELETE FROM `showtimes` WHERE DateTime = '$deleteDate' AND Theater_ID = '$deleteID'";
if ($conn->query($delete) === TRUE) {
    header("Location: showtimesPage.php?deleteShowtimes=success");
}


// Close connection
mysqli_close($conn);

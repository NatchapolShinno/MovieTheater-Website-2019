<?php
include_once 'connectDB.php';

$_SESSION["Branch"] = $_POST["Branch_ID"];
if(!empty($_POST["Branch_ID"])){
    
    $query = "SELECT * FROM theater WHERE Branch_ID = ".$_POST['Branch_ID']." ORDER BY No ASC";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        echo '<option value="">Select Theater No</option>';
        while($row = $result->fetch_assoc()){
            echo '<option value="'.$row['Theater_ID'].'">'.$row['No'].'</option>';
        }
    }else{
            echo '<option selected>Select Branch First...</option>';
        }
}

if(!empty($_POST["Movie_ID"] )){
    $query2 = "SELECT * FROM filmrolls WHERE Movie_ID = ".$_POST['Movie_ID']." AND Branch_ID = ".$_POST['Branch']."  ORDER BY Roll_ID ASC";
    $result2 = $conn->query($query2);
    
    if($result2->num_rows > 0){
        echo '<option value="">Select Film Roll No</option>';
        while($row2 = $result2->fetch_assoc()){
            echo '<option value="'.$row2['Roll_ID'].'">'.$row2['Roll_ID'].'</option>';
        }
    }else{
            echo '<option selected>Select Movie First...</option>';
        }
}
?>
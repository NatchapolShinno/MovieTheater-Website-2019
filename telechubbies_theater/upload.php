<?php
#get movie id
$query = "SELECT MAX(Movie_ID) As MaxID FROM movie;";

$result = mysqli_query($db, $query);

$resultarr = mysqli_fetch_assoc($result);

$maxid = $resultarr['Maxid'] + 1;
$ImageType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$target_dir = "./movie-img/";
$target_file = $target_dir . $maxid . $ImageType;

$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["Image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["Image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($ImageType != "jpg" && $ImageType != "png" && $ImageType != "jpeg"
&& $ImageType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["Image"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

}
?>
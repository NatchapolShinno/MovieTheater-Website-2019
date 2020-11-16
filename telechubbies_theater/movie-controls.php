<?php
#query movies
$query = "SELECT * FROM movie;";

$all_movies = mysqli_query($db, $query);

$query = "SELECT * FROM movie WHERE (Genre LIKE '%Comedy%' OR Subgenre LIKE '%Comedy%');";

$comedy_movies = mysqli_query($db, $query);

$query = "SELECT * FROM movie WHERE (Genre LIKE '%Action%' OR Subgenre LIKE '%Action%');";

$action_movies = mysqli_query($db, $query);
?>
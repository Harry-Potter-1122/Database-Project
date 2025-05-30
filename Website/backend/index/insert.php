<?php

include('../connection.php');

if (isset($_POST['submit'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $movietitle = $_POST['movietitle'];
    $year = $_POST['year'];
    $language = $_POST['language'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];

   

}
// Insert new user
$data_insert = "INSERT INTO movies (moviename, releaseyear, language, genre, rating, description) VALUES ('$movietitle', '$year', '$language', '$genre', '$rating', '$description')";
$query = mysqli_query($connection, $data_insert);


if ($query) {
    header('Location: list.php');
} else {
    echo "Error: " . mysqli_error($connection);
}


?>
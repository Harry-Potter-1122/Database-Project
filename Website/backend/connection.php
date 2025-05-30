<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "project";

$connection = new mysqli($hostname,$username,$password, $database);

if(!$connection){
    echo "database is created successfully";
}
?>
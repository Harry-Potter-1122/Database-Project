<?php

include('../connection.php');

$id= isset($_GET['id']) ? $_GET['id'] :'';

$que="Delete from movies where id = $id";


$a = mysqli_query($connection , $que);

if($a){
        header('location:list.php');
}
else{
        mysqli_error($connection);
}

?>
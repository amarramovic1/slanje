<?php
    include '../db.php';

    $name = $_POST['name'];
    if(empty($name) || strlen($name) < 2){
        header('location: ./index.php?error=1');
        exit;
    }

    $query = "INSERT INTO hobbies (name) VALUES ('$name')";
    $result = mysqli_query($connection, $query);

    header('location: ./index.php');
?>

<?php
    include '../db.php';

    $name = $_POST['name'];
    if(empty($name) || strlen($name) < 2){
        header('location: ./index.php?error=1');
        exit;
    }
    $countryId = $_POST['country_id'];

    $query = "INSERT INTO cities (name, country_id) VALUES ('$name', $countryId)";
    $result = mysqli_query($connection, $query);

    header('location: ./index.php');
?>

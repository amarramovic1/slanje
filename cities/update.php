<?php

    include '../db.php';

    $idToEdit = $_POST['id'];
    $name = $_POST['name'];
    $countryId = $_POST['country_id'];

    if(empty($name) || strlen($name) < 2){
        header("location: ./edit.php?error=1&id=$idToEdit");
        exit;
    }

    // pisemo upit za izmjenu podatka u bazi
    $query = "UPDATE cities SET 
                  name = '$name', 
                  country_id = $countryId 
              WHERE id = $idToEdit ";

    $res = mysqli_query($connection, $query);

    header('location: ./index.php');
?>
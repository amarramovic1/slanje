<?php

    include '../db.php';

    $idToEdit = $_POST['id'];
    $name = $_POST['name'];

    if(empty($name) || strlen($name) < 2){
        header("location: ./edit.php?error=1&id=$idToEdit");
        exit;
    }

    // pisemo upit za izmjenu podatka u bazi
    $query = "UPDATE countries SET name = '$name' WHERE id = $idToEdit ";
    $res = mysqli_query($connection, $query);

    header('location: ./index.php');
?>
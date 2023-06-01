<?php
    include '../db.php';

    $idToEdit = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    //provjere
    if(empty($firstName) || strlen($firstName) < 2){
        header("location: ./edit.php?error=1&id=$idToEdit");
        exit;
    }
    if(empty($lastName) || strlen($lastName) < 2){
        header("location: ./edit.php?error=2&id=$idToEdit");
        exit;
    }
    if(empty($phone) || strlen($phone) < 2){
        header("location: ./edit.php?error=3&id=$idToEdit");
        exit;
    }
    if(empty($email) || strlen($email) < 2){
        header("location: ./edit.php?error=4&id=$idToEdit");
        exit;
    }

    // Ažurirajte podatke u bazi koristeći SQL UPDATE izraz
    $query = "UPDATE contacts SET 
                firstName = '$firstName',
                lastName = '$lastName', 
                phone = '$phone',
                email = '$email' 
            WHERE id = $idToEdit";

    $res = mysqli_query($connection, $query);
    header('location: ./index.php');
?>


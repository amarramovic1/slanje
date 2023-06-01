<?php
    include '../db.php';
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    //za dobijanje trenutnog id-a
    $query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'phonebook_db' AND TABLE_NAME = 'contacts'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $id = $row['AUTO_INCREMENT'];
    //var_dump($id);
    //exit;
    if(empty($firstName) || strlen($firstName) < 2){
        header('location: ./index.php?error=5');
        exit;
    }
    if(empty($lastName) || strlen($lastName) < 2){
        header('location: ./index.php?error=6');
        exit;
    }
    if(empty($phone) || strlen($phone) < 2){
        header('location: ./index.php?error=7');
        exit;
    }
    if(empty($email) || strlen($email) < 2){
        header('location: ./index.php?error=8');
        exit;
    }
    

    $query = "INSERT INTO contacts (firstName, lastName, phone, email) VALUES ('$firstName', '$lastName','$phone','$email')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Ako je unos kontakta uspešan, proveravamo da li su izabrani hobiji
        if (isset($_POST['hobbies'])) {
            $selectedHobbies = $_POST['hobbies'];
            foreach ($selectedHobbies as $hobby_id) {
                $insertQuery = "INSERT INTO pivot_table (contact_id, hobby_id) VALUES ($id, $hobby_id)";
                $result1 = mysqli_query($connection, $insertQuery);
            }
        }
    }
    header('location: ./index.php');
?>
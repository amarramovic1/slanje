<?php

    include '../db.php';

    $idToDelete = $_GET['id'];

    // pravimo upit za brisanje reda iz tabele gradova
    $query = "DELETE FROM contacts WHERE id = $idToDelete";
    $res = mysqli_query($connection, $query);

    // $query1 = "DELETE FROM pivot_table WHERE contact_id = $idToDelete";
    // $res1 = mysqli_query($connection, $query1);

    header('location: ./index.php?msg=Uspješno brisanje!');
    ?>
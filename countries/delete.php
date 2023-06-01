<?php

    include '../db.php';

    $idToDelete = $_GET['id'];

    // pravimo upit za brisanje reda iz tabele drzava
    $query = "DELETE FROM countries WHERE id = $idToDelete";
    $res = mysqli_query($connection, $query);

    header('location: ./index.php?msg=Uspješno brisanje!');
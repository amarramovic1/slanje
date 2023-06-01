<?php
    include '../db.php';

    $searchTerm = "";
    if(isset($_GET['searchTerm'])){
        $searchTerm = $_GET['searchTerm'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhoneBook PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h3 class="text-center mt-3">Lista kontakta i njihovi hobiji</h3>

    <div class="row">
        <div class="col-6 table-responsive">
        <form action="./hobbies.php" method="GET">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="searchTerm" class="form-control mt-4" value="<?=$searchTerm?>" placeholder="Pretraga kontakt ili hobija">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary w-100 mt-4">Pretraži</button>
                        
                    </div>
                    <div class="col-4">
                        <a href="./index.php" class="form-control mt-4 bg-primary-subtle">Dodaj novi kontakt..</a>
                    </div>
                    
                </div>
            </form>

            <?php

            if(isset($_GET['msg']) && !empty($_GET['msg'])){
                echo "<p class='text-success text-center mt-3'>{$_GET['msg']}</p>";
            }

            ?>

        <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Hobi</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
            $query = "SELECT c.firstName, c.lastName, h.name
            FROM contacts c
            JOIN pivot_table pt ON c.id = pt.contact_id
            JOIN hobbies h ON pt.hobby_id = h.id";

            if(!empty($searchTerm)){
                $query .= " WHERE c.firstName LIKE '%$searchTerm%' OR c.lastName LIKE '%$searchTerm%'OR h.name LIKE '%$searchTerm%'";
            }
            $result = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($result)){

            echo "
                    <tr>
                        <td>{$row['firstName']}</td>
                        <td>{$row['lastName']}</td>
                        <td>{$row['name']}</td>
                    </tr>
            ";
            }
        ?>
    </tbody>
    </table>
    </div>   
</div>
</body>
</html>
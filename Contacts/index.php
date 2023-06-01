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
    <h3 class="text-center mt-3">Lista kontakta</h3>

    <div class="row">
        <div class="col-6 table-responsive">
            <form action="./index.php" method="GET">
                <div class="row">
                    <div class="col-8">
                        <input type="text" name="searchTerm" class="form-control" value="<?=$searchTerm?>" placeholder="Pretraga kontakt">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary w-100">Pretraži</button>
                    </div>
                </div>
            </form>

            <?php

            if(isset($_GET['msg']) && !empty($_GET['msg'])){
                echo "<p class='text-success text-center mt-3'>{$_GET['msg']}</p>";
            }

            ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Broj telefona</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        $query = "select * from contacts";
                        if(!empty($searchTerm)){
                            $query .= " WHERE contacts.firstName like '%$searchTerm%' OR contacts.lastName like '%$searchTerm%' ";
                        }
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($result)){

                           echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['firstName']}</td>
                                    <td>{$row['lastName']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td> <a href='./edit.php?id={$row['id']}'>izmjena</a> </td>
                                    <td> <a href='#' onclick='confirmDelete({$row['id']})'>brisanje</a> </td>
                                </tr>
                           ";
                        }

                    ?>

                </tbody>
            </table>

        </div>
        <div class="col-6">
            <form action="./save.php" method="POST">
                <input type="hidden" name="id" value="0"><!--dodato za dobijanje id-a -->
                <label for="firstName">Ime:</label>
                <input type="text" id="firstName" class="form-control" name="firstName">
                    <?php
                    if(isset($_GET['error']) && $_GET['error'] == 5){
                        echo "<p class='text-danger'>Morate unijeti ispravno ime!</p>";
                    }
                    ?>
                <label for="lastName">Prezime:</label>
                <input type="text" id="lastName" class="form-control" name="lastName">
                    <?php
                    if(isset($_GET['error']) && $_GET['error'] == 6){
                        echo "<p class='text-danger'>Morate unijeti ispravno prezime!</p>";
                    }
                    ?>
                <label for="phone">Broj telefona:</label>
                <input type="text" id="phone" class="form-control" name="phone">
                    <?php
                    if(isset($_GET['error']) && $_GET['error'] == 7){
                        echo "<p class='text-danger'>Morate unijeti ispravan broj telefona!</p>";
                    }
                    ?>
                <label for="email">Email:</label>
                <input type="email" id="email" class="form-control" name="email">
                    <?php
                    if(isset($_GET['error']) && $_GET['error'] == 8){
                        echo "<p class='text-danger'>Morate unijeti ispravan email!</p>";
                    }
                    ?>
                
                <?php
                    $queryHobbies = "SELECT * FROM hobbies";
                    $resultHobbies = mysqli_query($connection, $queryHobbies);
                    while ($hobby = mysqli_fetch_assoc($resultHobbies)) {
                    echo "<input type='checkbox' name='hobbies[]' value='{$hobby['id']}' id='{$hobby['id']}'>";
                    echo "<label for='{$hobby['id']}' >{$hobby['name']}</label><br>";
                    }
                ?>
                <button class="btn btn-success w-100 mt-3" id="saveBtn">Sačuvaj</button>
                <div class="col-6">
                    <a href="./hobbies.php" class="form-control mt-4 bg-primary-subtle">Hobiji kojima se bave tvoji kontakti!</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="./contacts.js"></script>
</body>
</html>
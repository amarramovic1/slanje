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
    <h3 class="text-center mt-3">Lista država</h3>

    <div class="row">
        <div class="col-6 table-responsive">
            <form action="./index.php" method="GET">
                <div class="row">
                    <div class="col-8">
                        <input type="text" name="searchTerm" class="form-control" value="<?=$searchTerm?>" placeholder="Pretraga država">
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
                        <th>Naziv</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        $query = "SELECT * FROM countries";
                        if(!empty($searchTerm)){
                            $query .= " WHERE name like '%$searchTerm%' ";
                        }
                        $result = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($result)){
                           echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td> <a href='./edit.php?id={$row['id']}'>izmjena</a> </td>
                                    <td> <a href='#' onclick='confirmDelete({$row['id']})' >brisanje</a> </td>
                                </tr>
                           ";
                        }

                    ?>

                </tbody>
            </table>

        </div>
        <div class="col-6">
            <form action="./save.php" method="POST">
                <label for="taskName">Naziv države:</label>
                <input type="text" class="form-control task-input" name="name">
                <?php
                    if(isset($_GET['error']) && $_GET['error'] == 1){
                        echo "<p class='text-danger'>Morate unijeti ispravan naziv!</p>";
                    }
                ?>
                <button class="btn btn-success w-100 mt-3" id="saveBtn">Sačuvaj</button>
            </form>
        </div>
    </div>
</div>
<script src="./countries.js"></script>
</body>
</html>
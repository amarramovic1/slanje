<?php
    include '../db.php';

    if(isset($_GET['id'])){
        $idToEdit = $_GET['id'];
    }else{
        header('location: ./index.php');
    }

    // Trazimo red u tabeli drzava koji zelimo da mijenjamo
    $query = "SELECT * FROM countries WHERE id = $idToEdit";
    $result = mysqli_query($connection, $query);
    $country = mysqli_fetch_assoc($result);
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
    <h3 class="text-center mt-3">Izmjena države</h3>

    <div class="row">
        <div class="col-6 offset-3">
            <form action="./update.php" method="POST">
                <label for="taskName">Naziv države:</label>
                <input type="text" class="form-control task-input" value="<?=$country['name']?>" name="name">
                <?php
                    if(isset($_GET['error']) && $_GET['error'] == 1){
                        echo "<p class='text-danger'>Morate unijeti ispravan naziv!</p>";
                    }
                ?>
                <input type="hidden" name="id" value="<?=$country['id']?>">
                <button class="btn btn-success w-100 mt-3" id="saveBtn">Sačuvaj</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
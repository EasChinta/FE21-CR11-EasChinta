<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';
include_once 'components/boot.php';
include_once 'components/navigation.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Pet Sanctuary</title>
</head>

<!-- AJAX SEARCH BAR -->

<!-- AJAX SEARCH BAR -->

<body>
    <div class="container" style="width: 70%;">
        <h1 class="my-3 text-center">Adopt a pet.<br> Save a life.</h1>
        <div class="row justify-content-evenly py-5">
            <?php
            $query = "SELECT * FROM animals LEFT JOIN location ON animals.location_id = location.location_id WHERE status = 'available'";
            $result = mysqli_query($connect, $query);
            for ($set = array(); $row = mysqli_fetch_assoc($result); $set[] = $row);

            if (mysqli_num_rows($result) >= 0 && isset($_SESSION['adm'])) {
                echo
                '<div class="d-flex justify-content-center my-3">
            <a href= "create.php" class="btn btn-outline-dark">Add Pets</a>
        </div>';
                foreach ($set as $value) {
                    echo '<div class="col-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <div style="background-image: url(' . $value['picture'] . '); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name: ' . $value['name'] . '</h5>
                            <p class="card-text">Description: ' . $value['description'] . '</p>
                            <p class="card-text">Age: ' . $value['age'] . '</p>
                            <p class="card-text">Location:<br>' . $value['address'] . '<br>' . $value['city'] . '<br>ZIP: ' . $value['zip'] . '</p>
                        </div>
                        <div class="card-body">
                        <a href="adopt.php?id=' . $value['animal_id'] . '" class="btn btn-outline-dark btn-sm">Take me home</a>
                        <a href="update.php?id=' . $value['animal_id'] . '" class="btn btn-outline-dark btn-sm">Edit</a>
                        <a href="delete.php?id=' . $value['animal_id'] . '" class="btn btn-outline-danger btn-sm">Delete</a>
                        </div>
                    </div>
                    </div>';
                }
            } else if (mysqli_num_rows($result) > 0 && isset($_SESSION['user'])) {
                foreach ($set as $value) {
                    echo '<div class="col-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <div style="background-image: url(' . $value['picture'] . '); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name: ' . $value['name'] . '</h5>
                            <p class="card-text">Description: ' . $value['description'] . '</p>
                            <p class="card-text">Age: ' . $value['age'] . '</p>
                            <p class="card-text">Location:<br>' . $value['address'] . '<br>' . $value['city'] . '<br>ZIP: ' . $value['zip'] . '</p>
                        </div>
                        <div class="card-body">
                            <a href="adopt.php?id=' . $value['animal_id'] . '" class="btn btn-outline-dark btn-sm">Take me home</a>
                            <a href="details.php?id=' . $value['animal_id'] . '" class="btn btn-outline-success mt-2 btn-sm">Read More</a>
                        </div>
                    </div>
                    </div>
                ';
                }
            } else {
                echo "<div>No data to display</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>
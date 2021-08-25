<?php
session_start();

require_once 'actions/db_connect.php';
include_once 'components/boot.php';

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

    <title>Senior - Pet Sanctuary</title>
</head>

<body>
    <header>
        <?php
        include_once 'components/navigation.php';
        ?>
    </header>

    <div class="container" style="width: 70%;">
        <div class="row justify-content-evenly py-5">
            <?php
            $query = "SELECT * FROM animals LEFT JOIN location ON animals.location_id = location.location_id WHERE animals.age >= 8 AND animals.status = 'available'";
            $result = mysqli_query($connect, $query);
            for ($set = array(); $row = mysqli_fetch_assoc($result); $set[] = $row);
            if (mysqli_num_rows($result)) {
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
<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';
require_once 'components/functions.php';
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
                    echo showPetAdmin($value['picture'], $value['name'], $value['description'], $value['age'], $value['address'], $value['city'], $value['zip'], $value['animal_id']);
                }
            } else if (mysqli_num_rows($result) > 0 && isset($_SESSION['user'])) {
                foreach ($set as $value) {
                    echo showPet($value['picture'], $value['name'], $value['description'], $value['age'], $value['address'], $value['city'], $value['zip'], $value['animal_id']);
                }
            } else {
                echo "<div>No data to display</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>
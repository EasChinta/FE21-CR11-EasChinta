<?php

session_start();

require_once 'db_connect.php';
include_once '../components/functions.php';
include_once '../components/boot.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

if ($_POST) {
    $id = $_POST['id'];

    $query = "UPDATE animals SET status = 'available' WHERE animal_id = {$id}";
    if (mysqli_query($connect, $query) === true) {
        $class = "dark";
        $message = "Successfully taken back!";
    } else {
        $class = "danger";
        $message = "The entry was not taken back due to: <br>" . $connect->error;
    }
    $connect->close();
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cancelation</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="d-flex flex-column align-items-center mt-3 mb-3">
                <h1>Cancelation Successful</h1>
            </div>
            <div class="alert alert-<?= $class; ?> d-flex flex-column align-items-center" role="alert">
                <p><?= $message; ?></p>
                <a href='../home.php' class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</body>

</html>
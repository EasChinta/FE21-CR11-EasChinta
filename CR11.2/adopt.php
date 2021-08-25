<?php
ob_start();
session_start();

include_once 'actions/db_connect.php';

include_once 'actions/a_select.php';
include_once 'components/boot.php';
include_once 'components/navigation.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: adopted.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adopt Pet</title>
</head>

<body>
    <div class="container" style="width: 70%;">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1><?php echo $data['name'] ?></h1>
                <?php echo '<div class="col-6 col-md-4 col-lg-3 my-3">
                    <div class="card">
                        <div style="background-image: url(' . $data['picture'] . '); background-repeat: no-repeat; background-size: contain; height: 350px; background-position: center;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Name: ' . $data['name'] . '</h5>
                            <p class="card-text">Description: ' . $data['description'] . '</p>
                            <p class="card-text">Age: ' . $data['age'] . '</p>
                            <p class="card-text">Location:<br>' . $data['address'] . '<br>' . $data['city'] . '<br>ZIP: ' . $data['zip'] . '</p>
                        </div>
                        <div class="card-body">
                            <a href="adopt.php?id=' . $data['animal_id'] . '" class="btn btn-outline-dark btn-sm">Take me home</a>
                            <a href="details.php?id=' . $data['animal_id'] . '" class="btn btn-outline-success mt-2 btn-sm">Read More</a>
                        </div>
                    </div>
                    </div>
                '; ?>
                <h3 class="mb-4">Do you really want to adopt <?php echo $data['name'] ?>?</h3>
                <a href="actions/a_adopt.php?id=<?php echo $id ?>" class="btn btn-outline-dark">Yes</a>
                <a href="javascript:history.back()" class="btn btn-outline-danger">No</a>
            </div>
        </div>
    </div>

</body>

</html>
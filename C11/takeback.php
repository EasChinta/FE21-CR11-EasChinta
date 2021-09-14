<?php

session_start();

include_once 'actions/db_connect.php';
include_once 'components/functions.php';
include_once 'actions/a_select.php';
include_once 'components/boot.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cancel</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Cancel this adoption</h1>
                <?php echo showPet($data['picture'], $data['name'], $data['description'], $data['age'], $data['address'], $data['city'], $data['zip'], $data['animal_id']); ?>
                <h3 class="mb-4">Do you really want to cancel this adoption?</h3>
                <form action="actions/a_takeback.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <button class="btn btn-outline-dark" type="submit">Yes</button>
                    <a href="home.php" class="btn btn-outline-danger">No</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<?php
include_once 'components/boot.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Error</title>
</head>

<body>
    <header>
        <?php
        include_once 'components/navigation.php';
        ?>
    </header>

    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Invalid Request</h1>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>You've made an invalid request. Please <a href="home.php" class="alert-link">go back</a> and try again.</p>
        </div>
    </div>

</body>

</html>
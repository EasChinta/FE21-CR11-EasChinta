<?php

session_start();

include_once 'actions/db_connect.php';
include_once 'components/boot.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $query = "SELECT animals.animal_id, animals.picture, name, date_collected, first_name, last_name, animals.status FROM pet_adoption LEFT JOIN `user` ON pet_adoption.user_id = user.user_id LEFT JOIN animals ON pet_adoption.animal_id = animals.animal_id WHERE pet_adoption.user_id = {$id} AND animals.status = 'adopted'";
    $result = mysqli_query($connect, $query);
}

if (isset($_SESSION['adm'])) {
    $query = "SELECT animals.animal_id, animals.picture, name, date_collected, first_name, last_name, animals.status FROM pet_adoption LEFT JOIN `user` ON pet_adoption.user_id = user.user_id LEFT JOIN animals ON pet_adoption.animal_id = animals.animal_id WHERE animals.status = 'adopted'";
    $result = mysqli_query($connect, $query);
}

$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
        <td><img class='img-thumbnail' style='height: 150px;' src='" 
        . $row['picture'] . "'</td>
        <td>" . $row['name'] . "</td>
        <td>" . $row['date_collected'] . "</td>
        <td>" . $row['first_name'] . "</td>
        <td>" . $row['status'] . "</td>
    </tr>";;
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adopted Pets</title>
</head>

<body>
    <header>
        <?php
        include_once 'components/navigation.php';
        ?>
    </header>

    <div class="container">
        <div class="d-flex flex-column align-items-center py-2" style="margin: 5vw 5vw 0 15vw">
            <table class='table table-striped'>
                <thead class='table-dark'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Date collected</th>
                        <th>By user</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tbody; ?>
                </tbody>
            </table>
            <a href="home.php" class='btn btn-outline-dark my-3'>Back</a></td>
        </div>
    </div>

</body>

</html>
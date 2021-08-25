<?php
session_start();
require_once 'actions/db_connect.php';
require_once 'components/navigation.php';
require_once 'components/boot.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM user WHERE status != '$status'";
$result = mysqli_query($connect, $sql);


$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone_number'] . "</td>
            <td>" . $row['address'] . "</td>
            <td><a href='edit_user.php?user_id=" . $row['user_id'] . "'><button class='btn btn-outline-light btn-sm' type='button'>Edit</button></a>
            <a href='delete_user.php?user_id=" . $row['user_id'] . "'><button class='btn btn-outline-danger btn-sm mt-2' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Adm-DashBoard</title>
</head>

<body>
    <div class="container" style="width: 70%;">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/611f861f44446.jpg" alt="Admin Pic">
                <p class="">Administrator</p>
            </div>
            <div class="col-8 mt-2">
                <p class='h2'>Users</p>
                <table class='table table-striped table-dark'>
                    <thead class='table-dark'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
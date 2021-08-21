<?php
session_start();
require_once 'actions/db_connect.php';
require_once 'components/navigation.php';
require_once 'components/boot.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}
$class = 'd-none';

if ($_GET['user_id']) {
    $id = $_GET['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $picture = $data['picture'];
    }
}
if ($_GET) {
    $id = $_GET['user_id'];
    $sql = "DELETE FROM user WHERE user_id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" .
            $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>

<body>
    <div class="container" style="width: 70%;">
        <h1 class="mb-4">User deleted!</h1>
    </div>
</body>

</html>
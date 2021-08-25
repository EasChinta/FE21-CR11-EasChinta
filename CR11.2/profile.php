<?php
session_start();

require_once 'actions/db_connect.php';
include_once 'components/boot.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    $res = mysqli_query($connect, "SELECT * FROM user WHERE user_id=" . $_SESSION['adm']);
}
if (isset($_SESSION['user'])) {
    $res = mysqli_query($connect, "SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
}
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile - Pet Sanctuary</title>
</head>

<body>
    <header>
        <?php
        include_once 'components/navigation.php';
        ?>
    </header>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center text-dark">My Profile</h1>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center mt-3">
            <img class="rounded-circle" src='pictures/<?php echo $row['picture'] ?>' style="width: 20%;" alt="<?php echo $row['picture'] ?>">
            <p class="text-dark"> Hey <?php echo $row['first_name']; ?></p>
        </div>

        <div class="d-flex justify-content-center align-items-center ">
            <table class="table table-dark w-50 mt-3">
                <tr>
                    <th>First Name</th>
                    <td><?php echo $row['first_name']; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $row['last_name']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><?php echo $row['phone_number']; ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $row['address']; ?></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <a href="update_profile.php?id=<?php echo $row['user_id'] ?>" class="btn btn-outline-light mx-2">Update Profile</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
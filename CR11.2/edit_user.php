<?php
ob_start();

session_start();
require_once 'actions/db_connect.php';
require_once 'actions/file_upload.php';
require_once 'components/navigation.php';
require_once 'components/boot.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}



if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $phone_number = $data['phone_number'];
        $address = $data['address'];
        $picture = $data['picture'];
    }
}

$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $id = $_POST['id'];
    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture']);
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email',
        phone_number = '$phone_number', address = '$address', picture = '$pictureArray->fileName' WHERE user_id = {$id}";
    } else {
        $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone_number = '$phone_number', address = '$address' WHERE user_id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    }
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <div class="container" style="width: 70%;">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>

        <h2>Update</h2>
        <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        <form method="post" enctype="multipart/form-data">
            <table class="table table-dark">
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $f_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $l_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><input class="form-control" type="text" name="phone_number" placeholder="Phone Number" value="<?= $phone_number ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class="form-control" type="text" name="address" placeholder="Address" value="<?= $address ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['user_id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                    <td><button name="submit" class="btn btn-outline-light" type="submit">Save Changes</button></td>
                    <td><a href="users.php"><button class="btn btn-outline-danger" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
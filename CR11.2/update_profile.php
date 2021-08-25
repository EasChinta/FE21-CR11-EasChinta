<?php
ob_start();
session_start();

require_once 'actions/db_connect.php';
require_once 'actions/file_upload.php';
include_once 'components/boot.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$message = '';
$uploadError = '';

$class = 'd-none';
$error = false;
$f_name = $l_name = $email = $picture = '';
$fnameError = $lnameError = $emailError = $picError = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE user_id = $id";
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $phone_number = $data['phone_number'];
        $address = $data['address'];
        $picture = $data['picture'];
    }
}

if (isset($_POST["submit"])) {


    $f_name = trim($_POST['first_name']);
    $f_name = strip_tags($f_name);
    $f_name = htmlspecialchars($f_name);


    $l_name = trim($_POST['last_name']);
    $l_name = strip_tags($l_name);
    $l_name = htmlspecialchars($l_name);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $phone_number = trim($_POST['phone_number']);
    $phone_number = strip_tags($phone_number);
    $phone_number = htmlspecialchars($phone_number);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);




    if (empty($f_name) || empty($l_name)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($f_name) < 3 || strlen($l_name) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $f_name) || !preg_match("/^[a-zA-Z]+$/", $l_name)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {

        $query = "SELECT user_id, email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count != 0 && $row['user_id'] != $id) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }


    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture'], 'user');
    $picture = $pictureArray->fileName;

    if (!$error) {

        if ($pictureArray->error === 0) {
            ($_POST["picture"] == "avatar.webp") ?: unlink("pictures/{$_POST["picture"]}");
            $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone_number = '$phone_number', address = '$address', picture = '$pictureArray->fileName' WHERE user_id = {$id}";
        } else {
            $sql = "UPDATE user SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone_number = '$phone_number', address = '$address' WHERE user_id = {$id}";
        }
        if ($connect->query($sql) === true) {
            $class = "alert alert-success";
            $message = "The record was successfully updated";
            $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
            header("refresh:3;url=update_profile.php?id={$id}");
        } else {
            $class = "alert alert-danger";
            $message = "Error while updating record : <br>" . $connect->error;
            $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
            header("refresh:3;url=update_profile.php?id={$id}");
        }
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Profile</title>
</head>
<header>
    <?php
    include_once 'components/navigation.php';
    ?>
</header>

<body>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center text-dark">Update Profile</h1>
    </div>
    <div class="container">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo $message; ?></p>
            <p><?php echo $uploadError; ?></p>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' style="width: 20%;" alt="<?php echo $f_name ?>">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <form method="post" enctype="multipart/form-data">
                <table class="table table-dark w-70 mt-3">
                    <tr>
                        <th>First Name</th>
                        <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $f_name ?>" />
                            <span class="text-danger"> <?php echo $fnameError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $l_name ?>" />
                            <span class="text-danger"> <?php echo $fnameError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" />
                            <span class="text-danger"> <?php echo $emailError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><input class="form-control" type="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo $phone_number ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><input class="form-control" type="address" name="address" placeholder="Address" value="<?php echo $address ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control" type="file" name="picture" />
                            <span class="text-danger"> <?php echo $picError; ?> </span>
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $data['user_id'] ?>" />
                        <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                        <td> </td>
                        <td><button name="submit" class="btn btn-outline-light mx-2" type="submit">Save Changes</button><a href="profile.php"><button class="btn btn-outline-danger mx-2" type="button">Cancel</button></a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

</body>

</html>
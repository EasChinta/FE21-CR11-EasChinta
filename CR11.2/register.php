<?php
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php");
}
require_once 'actions/db_connect.php';
require_once 'actions/file_upload.php';
require_once 'components/boot.php';
$error = false;
$fname = $lname = $email = $pass = $phone_number = $address = $picture = '';

$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = '';
if (isset($_POST['btn-signup'])) {


    $fname = trim($_POST['fname']);
    $fname = strip_tags($fname);
    $fname = htmlspecialchars($fname);


    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $phone_number = trim($_POST['phone_number']);
    $phone_number = strip_tags($phone_number);
    $phone_number = htmlspecialchars($phone_number);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $uploadError = '';
    $picture = file_upload($_FILES['picture']);


    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {

        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }


    $password = hash('sha256', $pass);

    if (!$error) {

        $query = "INSERT INTO user(first_name, last_name, password, email, phone_number, address, picture)
                  VALUES('$fname', '$lname', '$password', '$email', '$phone_number', '$address', '$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pet Sanctuary - Register</title>
</head>

<body>
    <div class="container">
        <section class="vh-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 text-black">
                        <form style="width: 23rem;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                            <h2>Register</h2>
                            <hr />
                            <?php
                            if (isset($errMSG)) {
                            ?>
                                <div class="alert alert-<?php echo $errTyp ?>">
                                    <p><?php echo $errMSG; ?></p>
                                    <p><?php echo $uploadError; ?></p>
                                </div>

                            <?php
                            }
                            ?>

                            <div class="form-outline mb-4">
                                <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
                                <span class="text-danger"> <?php echo $fnameError; ?> </span>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50" value="<?php echo $lname ?>" />
                                <span class="text-danger"> <?php echo $fnameError; ?> </span>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                                <span class="text-danger"> <?php echo $emailError; ?> </span>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" maxlength="50" value="<?php echo $phone_number ?>" />
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" name="address" class="form-control" placeholder="Address" maxlength="50" value="<?php echo $address ?>" />
                            </div>




                            <div class="d-flex mb-4">
                                <input class='form-control' type="file" name="picture">
                                <span class="text-danger"> <?php echo $picError; ?> </span>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                                <span class="text-danger"> <?php echo $passError; ?> </span>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
                            <hr />
                            <a href="login.php">Sign in Here...</a>
                        </form>
                    </div>
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="https://www.erblicken.com/wp-content/uploads/2017/10/Funny_Rosa_2.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: center;">
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>

</html>
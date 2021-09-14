<?php
ob_start();
session_start();

require_once 'actions/db_connect.php';
require_once 'components/functions.php';
include_once 'components/boot.php';


if (isset($_SESSION['user']) != "" || isset($_SESSION['adm']) != "") {
  header("Location: home.php");
  exit;
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {


  $email = sanitize($_POST['email']);
  $pass = sanitize($_POST['pass']);



  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email address.";
  } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $error = true;
    $emailError = "Please enter valid email address.";
  }

  if (empty($pass)) {
    $error = true;
    $passError = "Please enter your password.";
  }

  if (!$error) {

    $password = hash('sha256', $pass);

    $sqlSelect = "SELECT user_id, first_name, password, status FROM user WHERE email = ? ";
    $stmt = mysqli_prepare($connect, $sqlSelect);
    $stmt->bind_param("s", $email);
    $work = $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $result->num_rows;
    if ($count == 1 && $row['password'] == $password) {
      if ($row['status'] == 'adm') {
        $_SESSION['adm'] = $row['user_id'];
        header("Location: home.php");
      } else {
        $_SESSION['user'] = $row['user_id'];
        header("Location: home.php");
      }
    } else {
      $errMSG = "Incorrect Credentials, Try again...";
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

  <title>Pet Sanctuary</title>
</head>

<body>

  <div class="container">


    <section class="vh-100">
      <?php
      if (isset($errMSG)) {
        echo $errMSG;
      }
      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-black">

            <div class="px-5 ms-xl-4">
              <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
              <span class="h1 fw-bold mb-0 mt-3">Pet Sanctuary</span>
            </div>

            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

              <form style="width: 23rem;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                <div class="form-outline mb-4">
                  <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                  <label class="form-label" for="form2Example17">Email address</label>
                  <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                  <label class="form-label" for="form2Example27">Password</label>
                  <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-outline-dark btn-lg btn-block" type="submit" name="btn-login">Login</button>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                <p>Don't have an account? <a href="register.php">Register here</a></p>

              </form>

            </div>

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
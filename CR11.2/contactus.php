<?php
session_start();
require_once 'actions/db_connect.php';
include_once 'components/boot.php';
include_once 'components/navigation.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Contact - Pet Sanctuary</title>
</head>

<body>
  <div class="container" style="margin-left: 5vw;">
    <div class="d-flex justify-content-end align-items-center" style="background-image: url(https://i.ytimg.com/vi/FHytoCvj90w/maxresdefault.jpg); height: 50vh; background-size: cover; background-repeat: no-repeat; background-position: 50% 30%;">
      <h1 class="text-right text-dark mx-5">Make an animal <br> happy today ❤️</h1>
    </div>
    <main>
      <div class="container mt-3" style="width:80%">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
              <div>
                <form class="form-horizontal" method="post">
                  <fieldset>


                    <div class="form-group">
                      <label class="col-md-3 control-label mt-3" for="email">Your E-mail</label>
                      <div class="col-md-9">
                        <input id="email" name="email" type="email" placeholder="name@example.com" class="form-control">
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="col-md-3 control-label mt-3" for="message">Your message</label>
                      <div class="col-md-9">
                        <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                      </div>
                    </div>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                      $msg = filter_var($_POST["message"], FILTER_SANITIZE_STRING);


                      $headers = "FROM : " . $email . "\r\n";
                      $myEmail = "petsanctuary@gmail.com";
                      if (mail($myEmail, "message coming from the contact form", $msg, $headers)) {
                        echo "<div class='alert alert-success my-2'>Sent successfully</div>";
                      } else {
                        echo "<div class=alert alert-danger my-2'>Error, please try again later</div>";
                      }
                    }
                    ?>


                    <div class="form-group">
                      <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">Send</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>

</html>
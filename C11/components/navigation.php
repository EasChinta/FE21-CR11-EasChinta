<?php
include_once 'boot.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>



  <div class="w3-sidebar w3-amber w3-bar-block w3-collapse w3-card w3-opacity-min" style="width:200px;" id="mySidebar">

    <?php
    if (isset($_SESSION['adm'])) {
      echo '<button class="w3-bar-item w3-button w3-hide-large"
        onclick="w3_close()">Close &times;</button>
        <a href="home.php" class="w3-bar-item w3-button">Home</a>
        <a href="adopted.php" class="w3-bar-item w3-button">Adopted</a>
        <a href="profile.php" class="w3-bar-item w3-button">My Profile</a>
        <a href="users.php" class="w3-bar-item w3-button">Manage Users</a><br>
        <a href="actions/logout.php?logout" class="w3-bar-item w3-button mt-5">Logout</a>';
    }
    if (isset($_SESSION['user'])) {
      echo '<button class="w3-bar-item w3-button w3-hide-large"
        onclick="w3_close()">Close &times;</button>
        <a href="home.php" class="w3-bar-item w3-button">Home</a>
        <a href="senior.php" class="w3-bar-item w3-button">Senior Pets</a>
        <a href="adopted.php" class="w3-bar-item w3-button">My adopted Pets</a>
        <a href="contactus.php" class="w3-bar-item w3-button">Contact us</a>
        <a href="profile.php" class="w3-bar-item w3-button">My Profile</a><br>
        <a href="actions/logout.php?logout" class="w3-bar-item w3-button mt-5">Logout</a>';
    }
    ?>
  </div>

  <div class="w3-main " style="margin-left:200px">

    <div class="w3-amber">
      <button class="w3-button w3-amber w3-xlarge " onclick="w3_open()">&#9776;</button>
      <div class="w3-container w3-amber">
        <h1>Pet Sanctuary</h1>
      </div>
    </div>
  </div>




  <script>
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
    }
  </script>



</body>

</html>
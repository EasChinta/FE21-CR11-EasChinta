<?php
$hostname = "173.212.235.205"; 
$username = "eascodef_eas"; 
$password = "Mr.Robot19!"; 
$dbname = "eascodef_pet_adoption" ; 
            
$connect = new mysqli($hostname, $username, $password, $dbname);
            
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
    }

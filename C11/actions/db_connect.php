<?php
$hostname = "127.0.0.1"; 
$username = "root"; 
$password = ""; 
$dbname = "fswd13_CR11_PetAdoption_EasChinta" ; 
            
$connect = new mysqli($hostname, $username, $password, $dbname);
            
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
    }

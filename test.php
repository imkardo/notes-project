<?php
require_once 'inc/db.php';

session_start();
$username = $_SESSION['loggedIn'];
$getUser = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
$userArray = mysqli_fetch_array($getUser);
echo $userArray['id'];
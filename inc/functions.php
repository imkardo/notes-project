<?php 
require_once 'db.php';
if(isset($_POST['do-register'])){
$displayname = $_POST['display-name'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordConf = $_POST['password-conf'];

mysqli_query($db, "INSERT INTO users(display_name, username, password) VALUES ('$displayname','$username','$password')");
}
<?php 
if(isset($_POST['do-register'])){
$displayname = $_POST['display-name'];
$username = $_POST['username'];
$password = $_POST['password'];
$passwordConf = $_POST['password-conf'];

echo $displayname . $username . $password . $passwordConf;
}
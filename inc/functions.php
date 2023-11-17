<?php
require_once 'db.php';

if (isset($_POST['do-register'])) {
    $displayname = $_POST['display-name'];
    $username = $_POST['username'];
    $password = $_POST['user-password'];
    $passwordConf = $_POST['password-conf'];

    $check_username = mysqli_query($db, "SELECT * from users WHERE username='$username'");
    if (mysqli_num_rows($check_username) > 0) {
        //echo 'Sb logged in in the past';
        setMessage('کاربری با این نام کاربری قبلا وارد شده است !');
        header('Location: ../register.php');
    } else {

        if ($password != $passwordConf) {
            setMessage('رمز عبور با تکرار رمز عبور برابر نیست !');
            header('Location: ../register.php');
        } else {
            $insert = mysqli_query($db, "INSERT INTO users(display_name, username, password) VALUES ('$displayname','$username','$password')");

            if ($insert) {
                setMessage('ثبت نام با موفقیت انجام شد، هم اکنون وارد شوید');
                header('Location: ../login.php');
            } else {
                echo 'error';
            }
        }
    }
}

// check user login
if (isset($_POST['do-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkUser = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    if (mysqli_num_rows($checkUser) > 0) {
        session_start();
        $_SESSION['loggedIn'] = $username;
        header('Location: ../index.php');
    } else {
        setMessage('کاربری با این مشخصات پیدا نشد');
        header('Location: ../login.php');
    }
}

// do logout
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['loggedIn']);
    header('Location: login.php');
}

// Get user note
if (isset($_POST['user-note'])) {
    $userNote = $_POST['user-note'];
    $addToNote = mysqli_query($db, "INSERT INTO notes (note_text) VALUES('$userNote')");
    if ($addToNote) {
        header('Location: ../index.php');
    }
}

// Set Message
function setMessage($message)
{
    session_start();
    $_SESSION['message'] = $message;
}


// show messages
function showMessage()
{
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-warning m-3'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
}

// check login
function checkLogin()
{
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
    }
}

// get user notes
function getUserNotes($limit = false)
{
    global $db;
    if($limit){
    $getNotes = mysqli_query($db, "SELECT * FROM notes ORDER BY id DESC LIMIT $limit");
    }else{
        $getNotes = mysqli_query($db, "SELECT * FROM notes ORDER BY id DESC ");
    }
    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }
    return $userNotes;
}

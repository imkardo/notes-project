<?php
require_once 'db.php';
session_start();
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
        $_SESSION['loggedIn'] = $username;
        header('Location: ../index.php');
    } else {
        setMessage('کاربری با این مشخصات پیدا نشد');
        header('Location: ../login.php');
    }
}

// do logout
if (isset($_GET['logout'])) {

    unset($_SESSION['loggedIn']);
    header('Location: login.php');
}

//Add to note
if (isset($_POST['user-note'])) {
    $userNote = $_POST['user-note'];
    $userId = getUserId();
    $addToNote = mysqli_query($db, "INSERT INTO notes (note_text, user_id) VALUES('$userNote', '$userId')");
    if ($addToNote) {
        header('Location: ../index.php');
    }
}

// Set Message
function setMessage($message)
{
    $_SESSION['message'] = $message;
}


// show messages
function showMessage()
{
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-warning m-3'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
}

// check login
function checkLogin()
{
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: login.php');
    }
}

// get user notes
function getUserNotes($limit = false)
{
    global $db;
    $userId = getUserId();
    if ($limit) {
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0' ORDER BY id DESC LIMIT $limit");
    } else {
        $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='0' ORDER BY id DESC ");
    }
    $userNotes = [];
    while ($notes = mysqli_fetch_array($getNotes)) {
        $userNotes[] = $notes;
    }
    return $userNotes;
}
// Show Done Notes
function showDoneNotes()
{
    global $db;
    $userId = getUserId();
    $getNotes = mysqli_query($db, "SELECT * FROM notes WHERE user_id='$userId' AND is_done='1' ORDER BY id DESC");
    $doneNotes = [];
    while ($showDoneNotes = mysqli_fetch_array($getNotes)) {
        $doneNotes[] = $showDoneNotes;
    }
    return $doneNotes;
}

// Get user id
function getUserId()
{
    global $db;
    $username = $_SESSION['loggedIn'];
    $getUser = mysqli_query($db, "SELECT * FROM users WHERE username ='$username' ");
    $userArray = mysqli_fetch_array($getUser);
    return $userArray['id'];
}

//  Get user display name
function getUserDisplayName()
{
    global $db;
    $username = $_SESSION['loggedIn'];
    $getUser = mysqli_query($db, "SELECT * FROM users WHERE username ='$username' ");
    $userArray = mysqli_fetch_array($getUser);
    return $userArray['display_name'];
}

// Is done
if (isset($_GET['isDone'])) {
    // echo $_GET['isDone']; 
    $noteId = $_GET['isDone'];
    $updateDone = mysqli_query($db, "UPDATE notes SET is_done = '1' WHERE id ='$noteId'");
    if ($updateDone) {
        header('Location: notes.php');
    }
}

//Delete Notes
if (isset($_GET['delete'])) {
    $deleteNoteId = $_GET['delete'];
    $deleteNotes = mysqli_query($db, "DELETE FROM notes WHERE id='$deleteNoteId'");
    if ($deleteNotes) {
        header('Location: notes.php');
    }
}
// Undo Done Notes
if (isset($_GET['undo'])) {
    $undoNoteId = $_GET['undo'];
    $undoDone = mysqli_query($db, "UPDATE notes SET is_done = '0' WHERE id ='$undoNoteId'");
    if ($undoDone) {
        header('Location: notes.php');
    }
}
// Search Notes 
if (isset($_GET['search'])) {
    function getSearchResult()
    {
        global $db;
        $searchValue = $_GET['search'];
        $userId = getUserId();
        $search = mysqli_query($db, "SELECT * FROM notes WHERE note_text LIKE '%$searchValue%' AND user_id = '$userId' AND is_done='0'");
        $searchResults = [];
        while ($results = mysqli_fetch_array($search)) {
            $searchResults[] = $results;
        }
        return $searchResults;
    }
}

// Get user data for setting page
function getUserData()
{
    global $db;
    $userId = getUserId();

    $getUsername = mysqli_query($db, "SELECT * FROM users WHERE id ='$userId'");
    $userData = mysqli_fetch_array($getUsername);
    return $userData;
}

// Update User Data from setting
if (isset($_POST['do-update'])) {
    $newDisplayName =  $_POST['display-name'];
    $newTitle =  $_POST['title'];
    $newSubtitle =  $_POST['subtitle'];
    $userId = getUserId();
    $updateSetting = mysqli_query($db, "UPDATE users SET display_name='$newDisplayName' , title='$newTitle' , subtitle='$newSubtitle' WHERE id='$userId'");
    if ($updateSetting) {
        setMessage('اطلاعات با موفقیت بروزرسانی شد');
        header('Location: ../setting.php');
    }
}

<?php
require_once 'inc/db.php';

$getNotes = mysqli_query($db, "SELECT * FROM notes");
// $notes = mysqli_fetch_array($getNotes);
$userNotes = [];
while($note = mysqli_fetch_array($getNotes)){
$userNotes[] = $note;
}
print_r($userNotes);

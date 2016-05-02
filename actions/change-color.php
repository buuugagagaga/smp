<?php
require_once("../functions.php");
require_once("../model/notes.php");

if(!isLoggedIn())
    exit(wrapMessage("Access denied!", true));
if(!isset($_POST["note-id"])||!isset($_POST["color"]))
    exit(wrapMessage("Something went wrong. <a href='../index.php'>Homepage</a>",true));

$id = $_POST["note-id"];
$note = Notes::getNoteById($id);
$title = $note[0]["title"];
$text = $note[0]["text"];
$colorId = $_POST["color"];
Notes::changeNote($id,$title,$text,$colorId);
header("Location: ../pages/notes-page.php");
exit();
<?php
require_once ("../functions.php");
require_once ("../model/notes.php");
require_once ("../model/users.php");


if(!isLoggedIn())
    exit(wrapMessage("Access denied", true));
if(!isset($_POST["note-id"])&&!isset($_POST["recipient-id"]))
    exit(wrapMessage("Something went wrong. <a href='../pages/notes-page.php'>Back</a>",true));

if(Notes::checkNoteAlreadyShared($_POST["note-id"], $_POST["recipient-id"]))
    exit(wrapMessage("You already shared this note with ".Users::getUserEmail($_POST["recipient-id"]), true));

if(!Notes::shareNote($_POST["note-id"], $_POST["recipient-id"]))
    exit(wrapMessage("Error. Incorrect recipient ID. <a href='../pages/notes-page.php'>Back</a>",true));

header("Location: ../pages/notes-page.php");
exit();

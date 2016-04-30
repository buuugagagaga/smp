<?php
require_once ("../functions.php");
require_once ("../model/notes.php");

if(!isLoggedIn())
    exit(wrapMessage("Access denied", true));
if(!isset($_GET["note-id"]))
    exit(wrapMessage("Something went wrong. <a href='../index.php'>Homepage</a>",true));
Notes::deleteNote($_GET["note-id"]);
header("Location: ../pages/notes-page.php");
exit();
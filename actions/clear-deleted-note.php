<?php
require_once ("../functions.php");
require_once ("../model/notes.php");

if(!isLoggedIn())
    exit(wrapMessage("Access denied", true));
if(!isset($_GET["note-id"]))
    exit(wrapMessage("Something went wrong. <a href='../index.php'>Homepage</a>",true));
Notes::clearDeletedNote($_GET["note-id"]);
header("Location: ../pages/archive-notes-page.php");
exit();
<?php
require_once ("../functions.php");
require_once ("../model/notes.php");
require_once ("../model/users.php");


if(!isLoggedIn())
    exit(wrapMessage("Access denied", true));
if(!isset($_GET["note-id"])&&!isset($_GET["recipient-id"]))
    exit(wrapMessage("Something went wrong. <a href='../pages/notes-page.php'>Back</a>",true));
Notes::dismissRecipient($_GET["note-id"], $_GET["recipient-id"]);
header("Location: ../pages/notes-page.php");
exit();

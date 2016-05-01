<?php
require_once ("../functions.php");
require_once ("../model/notes.php");
require_once ("../model/users.php");


if(!isLoggedIn())
    exit(wrapMessage("Access denied", true));
if(!isset($_GET["note-id"]))
    exit(wrapMessage("Something went wrong. <a href='../pages/notes-page.php'>Back</a>",true));


$note = Notes::getNoteById($_GET["note-id"]);
Notes::createNote($note[0]["title"], $note[0]["text"], $_SESSION["UserId"]);
Notes::dismissRecipient($_GET["note-id"], $_SESSION["UserId"]);

header("Location: ../pages/shared-notes-page.php");
exit();

<?php
require_once("../functions.php");
require_once("../model/notes.php");

if(!isLoggedIn())
    exit(wrapMessage("Access denied!", true));

$notes = Notes::getAllUserNotes($_SESSION["UserId"]);
foreach ($notes as $note) {
    if($note["deleted"])
        Notes::clearDeletedNote($note["id"]);
}

header("Location: ../pages/archive-notes-page.php");
exit();
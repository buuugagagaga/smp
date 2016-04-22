<?php
require_once("../functions.php");
require_once("../model/notes.php");
if(!isset($_POST["note-id"])||!isset($_POST["note-text"])||!isset($_POST["note-title"]))
    exit(wrapMessage("Something went wrong. <a href='../index.php'>Homepage</a>",true));

Notes::changeNote($_POST["note-id"],$_POST["note-title"],$_POST["note-text"], Notes::getNoteById($_POST["note-id"])[0]["typeId"]);
header("Location: ../notes-page.php");
exit();
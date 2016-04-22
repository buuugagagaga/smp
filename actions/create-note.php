<?php

//todo: Сделать изменение цвета

require_once("../functions.php");
require_once("../model/notes.php");
if(!isLoggedIn())
    exit(wrapMessage("Access denied!", true));

if(!isset($_POST["user-id"])||!isset($_POST["note-text"])||!isset($_POST["note-title"]))
    exit(wrapMessage("Something went wrong. <a href='../index.php'>Homepage</a>",true));

Notes::createNote($_POST["note-title"], $_POST["note-text"], $_POST["user-id"]);
header("Location: ../notes-page.php");
exit();
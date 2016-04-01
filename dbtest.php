<?php
require_once("functions.php");
require_once("model/users.php");
require_once("model/notes.php");
echo "Database class test <br>";

$email = "testUser";
$password = "testPassword";

$title = "TestNote#";
$text = "Bla-bla-bla";


//    Users::createUser($email, $password);
//    Users::createUser($email."2", $password."2");
//    Users::createUser($email."3", $password."3");
//    Users::createUser($email."4", $password."4");
//
//
//    if(Users::checkUserEmailAndPassword($email,$password)){
//        echo "OK";
//    }else echo "NOT OK";
//    echo "<br>";
//
//
//    for($i=0;$i<20;$i++){
//        Notes::createNote($title."$i",$text,Users::getUserId($email));
//    }
//    Notes::changeNote(20,"CHANGED TITLE", "CHANGED TEXT", 12);
//    echo "<hr>";
//    $userId = Users::getUserId($email);
//    $allNotes = Notes::getAllUserNotes($userId);
//    echo $allNotes[1]["title"];
//    foreach($allNotes as $note){
//        echo "<span style='background-color: #".Notes::getNoteTypeColor($note["typeId"])."'>";
//        echo $note["date"]." ".$note["title"].": ".$note["text"];
//        echo "</span><br>";
//    }
//    Notes::shareNote(20, 3);
//    Notes::shareNote(21, 3);
//    Notes::shareNote(22, 3);
    $sharedNotes = Notes::getSharedNotes(3);
    foreach($sharedNotes as $note){
        echo "<span style='background-color: #".Notes::getNoteTypeColor($note["typeId"])."'>";
        echo $note["date"]." ".$note["title"].": ".$note["text"];
        echo "</span><br>";
    }
?>
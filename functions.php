<?php // Example 26-1: functions.php

$appname = "Doodle Deep &beta;";

require_once "model/database.php";

$database = DataBase::getDB();
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

function destroySession()
{
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    global $database;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $database->real_escape_string($var);
}


?>

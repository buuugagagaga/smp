<?php
require_once("../functions.php");
if(!isset($_SESSION["UserId"])) header("Location: ../login.html");
else header("Location: ../notes-page.php");

exit();



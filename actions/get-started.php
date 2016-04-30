<?php
require_once("../functions.php");
if(!isLoggedIn()) header("Location: ../pages/login.html");
else header("Location: ../pages/notes-page.php");

exit();



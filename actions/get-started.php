<?php
require_once("../functions.php");
if(!isLoggedIn()) header("Location: ../login.html");
else header("Location: ../notes-page.php");

exit();



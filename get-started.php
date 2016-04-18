<?php
require_once ("functions.php");
if(!isset($_SESSION["UserId"]))
    include ("login.html");
else include ("notes-page.php");

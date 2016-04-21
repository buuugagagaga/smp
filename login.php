<?php
require_once("functions.php");
require_once("model/users.php");
require_once("model/notes.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if ($email == '') {
        unset($email);
    }
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
if (empty($email) or empty($password))
{
    exit (wrapMessage("Some fields are empty!<a href='login.html'> Try again</a>"));
}

$email = sanitizeString($email);
$password = sanitizeString($password);
$email = trim($email);
$password = trim($password);

if (!Users::checkUserEmailAndPassword($email, $password))
{
    exit (wrapMessage("Incorrect email or password. <a href='login.html'>Try again</a>"));
}
else {
    $_SESSION['UserId'] = Users::getUserId($email);
    $_SESSION['UserEmail'] = $email;
    require('notes-page.php');
}
?>
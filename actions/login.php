<?php
require_once("../functions.php");
require_once("../model/users.php");

if(!isset($_SESSION["UserId"])){
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (empty($email) or empty($password))
    {
        exit (wrapMessage("Some fields are empty!<a href='../pages/login.html'> Try again</a>", true));
    }

    $email = sanitizeString($email);
    $password = sanitizeString($password);
    $email = trim($email);
    $password = trim($password);

    if (!Users::checkUserEmailAndPassword($email, $password))
    {
        exit (wrapMessage("Incorrect email or password. <a href='../pages/login.html'>Try again</a>",true));
    }
    $_SESSION['UserId'] = Users::getUserId($email);
    $_SESSION['UserEmail'] = $email;
}
header("Location: ../pages/notes-page.php");
exit();
?>
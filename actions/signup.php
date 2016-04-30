<?php
require_once("../functions.php");
require_once("../model/users.php");
require_once("../model/notes.php");
    if (isset($_POST['email'])) { 
        $email = $_POST['email']; 
        if ($email == '') {
            
            unset($email);
        } 
    }
    if (isset($_POST['password']) && isset($_POST['password-check'])) {
        $password=$_POST['password'];
        $password_check = $_POST['password-check'];
        if($password != $password_check)
            exit(wrapMessage("Passwords are different! <a href='../pages/signup.html'>Try again</a>", true));
        if ($password =='') { 
            unset($password);
        } 
    }


    if (empty($email) or empty($password)) {
        exit (wrapMessage("Fields are not filled! <a href='../pages/signup.html'>Try again</a>", true));
    }

$email = sanitizeString($email);
$email = trim($email);

$password = sanitizeString($password);
$password = trim($password);

if(!Users::isAlreadyRegistered($email))
    Users::createUser($email,$password);
else exit(wrapMessage("This email is already registered. Go <a href='../pages/signup.html'>back</a> or <a href='../pages/login.html'>try to log in</a> ", true));

exit(wrapMessage("User $email has been registered. Now you can  <a href='../pages/login.html'>log in</a>",false));





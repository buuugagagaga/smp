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
    if (isset($_POST['password']) && isset($_POST['password-check'])) {
        $password=$_POST['password'];
        $password_check = $_POST['password-check'];
        if($password != $password_check)
            exit(messageWrapper("Passwords are different! <a href='signup.html'>Try again</a>"));
        if ($password =='') { 
            unset($password);
        } 
    }


    if (empty($email) or empty($password)) {
        exit (messageWrapper("Fields are not filled! <a href='signup.html'>Try again</a>"));
    }

$email = sanitizeString($email);
$email = trim($email);

$password = sanitizeString($password);
$password = trim($password);

if(!Users::isAlreadyRegistered($email))
    Users::createUser($email,$password);
else exit(messageWrapper("This email is already registered. Go <a href='signup.html'>back</a> or <a href='login.html'>try to log in</a> "));

exit(messageWrapper("User $email has been registered. Now you can  <a href='login.html'>log in</a>"));



function messageWrapper($message){

    return <<<EOL
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>
    Sign Up Result
    </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">
        Sign Up
        </a>
    </div>
  </nav>

<div style="margin-top: 100px; margin-bottom:100px" class="container">
        <p class="flow-text">
        $message
    </p>

</div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
EOL;

}

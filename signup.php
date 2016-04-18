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
        $password=$_POST['password']; 
        if ($password =='') { 
            unset($password);
        } 
    }


    if (empty($email) or empty($password)) {
        exit ("Fill all form fields!");
    }

$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);

$email = trim($email);
$password = trim($password);

if(!Users::isAlreadyRegistered($email))
    Users::createUser($email,$password);
else exit("Email is already taken");

echo <<<EOL
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>
    <?php echo $appname;?> - Sign Up
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
        <p class="flow-text">Your account $email has been created, now you can
        <a href="login.html">log in</a>
        !
    </p>

</div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
EOL;

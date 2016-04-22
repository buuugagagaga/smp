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

function wrapMessage($message, $isError)
{
    if(!$isError) $color = "teal lighten-1";
    else $color = "red darken-4";
    return <<<EOL
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>
  Doodle Deep
    </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="$color" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="../index.php" class="brand-logo">
        Doodle Deep
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
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>

  </body>
</html>
EOL;

}
?>

<?php
require_once("../model/notes.php");
require_once("../model/users.php");
require_once("../functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Inbox</title>
    <!-- CSS  -->
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>

<div class="navbar-fixed">
    <nav class="amber accent-4" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#"
                                              class="brand-logo center"><?php echo(substr($_SESSION["UserEmail"], 0, strpos($_SESSION["UserEmail"], "@")) . "(ID = ${_SESSION["UserId"]})"); ?></a>
            <ul class="left hide-on-med-and-down">
                <li><a href="notes-page.php" class="white-text">Your notes</a></li>
                <li><a href="archive-notes-page.php" class="white-text">Archive</a></li>
            </ul>
            <ul class="right hide-on-med-and-down">
                <li><a href="../actions/logout.php">Log out</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="notes-page.php">Your notes</a></li>
                <li><a href="archive-notes-page.php">Archive</a></li>
                <li><a href="../actions/logout.php">Log out</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>

</div>

<div class="container" id="container">

    <div class="section">
        <div class="row">
            <?php
            $notes = Notes::getSharedNotes($_SESSION["UserId"]);
            $rowLeft = 12;
            echo '<div class="row">';
            foreach ($notes as $note) {
                if ($note["deleted"] == 0) {
                    if (strlen(trim($note["title"])) < 33 && strlen(trim($note["text"])) < 129)
                        $m = 4;
                    else if (strlen(trim($note["title"])) < 65 && strlen(trim($note["text"])) < 257)
                        $m = 6;
                    else if (strlen(trim($note["title"])) < 65 && strlen(trim($note["text"])) < 513)
                        $m = 8;
                    else $m = 12;
                    $color = Notes::getNoteTypeColor($note["typeId"]);
                    $author = Users::getUserEmail($note["userId"]);

                    $rowLeft -= $m;
                    if ($rowLeft < 0) {
                        $rowLeft = 12 - $m;
                        echo '</div><div class="row">';
                    }
                    echo <<<EOL
                    <div class="col s12 m$m"">
                        <div class="card $color">
                            <div class="card-content white-text">
                                <span id="title-${note["id"]}" class="card-title">${note["title"]}</span>
                                <p>FROM : $author</p>
                                <p id="text-${note["id"]}" >${note["text"]}</p>
                            </div>
                            <div class="card-action">
                                <a href="../actions/create-note.php" class="white-text large">CLIP TO MY NOTES</a>
                                <a href="../actions/delete-note.php?note-id=${note['id']}" class="white-text">DISMISS</a>
                            </div>
                        </div>
                    </div>
EOL;
                }
            }
            echo '</div>';
            ?>
        </div>
    </div>
</div>


</body>
</html>
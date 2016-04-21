<!DOCTYPE html>
<html lang="en" ng-app="noteApp">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>Note-Taking App</title>
        <!-- CSS  -->
        <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body ng-controller="noteCtrl">
        <nav class="amber accent-4" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><?php echo("Welcome, ".$_SESSION["UserEmail"]."!");?></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Log out</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="#">Log out</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        </nav>

        <div class="container" id="container">
            <div class="section">
                <?php
                    $notes = Notes::getAllUserNotes($_SESSION["UserId"]);

                ?>
                <!--   Icon Section   -->
                <div class="row">
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="card blue-grey darken-1">
                                <div class="card-content white-text">
                                    <span class="card-title">Card Title</span>
                                    <p>I am a very simple card. I am good at containing small bits of information.
                                        I am convenient because I require little markup to use effectively.</p>
                                </div>
                                <div class="card-action">
                                    <a href="#">This is a link</a>
                                    <a href="#">This is a link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Small note</span>
                                <p>Hello world! I'm using Doodle Deep</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
    </body>
</html>
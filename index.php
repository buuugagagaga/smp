<?
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>
    <?php echo $appname;?>
    </title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="teal lighten-1" role="navigation">
    <div class="nav-wrapper container navbar fixed"><a id="logo-container" href="#" class="brand-logo">    
        <?php
            echo $appname;
        ?>
        </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="get-started.php">Get Started</a></li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        <li><a href="get-started.php">Get Started</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
        <h1 class="header center orange-text">Welcome, my friend!</h1>
        <h1 class="header center teal-text">I'm <b><?php echo $appname;?></b>!</h1>
      <div class="row center">
          <h5 class="header col s12 light">A new Google Keep <strike>clone</strike> analog made for free usage!</h5>
      </div>
      <div class="row center">
        <a href="get-started.php" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Speed up your work</h5>

            <p class="light">If you still using paper, you need a help! Use 
                        <?php
            echo $appname;
        ?>
                and only!!! </p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Collaborate with your teammates</h5>

            <p class="light">You can share your note with every user of our service! Just try!</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">        <?php
            echo $appname;
        ?>
                is very simple! Even stupid <a href="https://www.youtube.com/watch?v=qYodWEKCuGg">code monkey</a> can start using It in 5 seconds!!!</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l9 s12">
          <h5 class="white-text">About me</h5>
          <p class="grey-text text-lighten-4">My name is Daniel, I'm studying Software Engineering in NURE. This is my project for SMP labs</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="white-text" href="http://samantsov.kh.ua/smr/index.html">Labs website</a></li>
            <li><a class="white-text" href="https://github.com/buuugagagaga/smp">Git</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="https://vk.com/danielslupskiy">Daniel Slupskiy. </a>Don't even try to steal my work, I will kill you!!! 
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
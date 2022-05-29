<?php

include "dbconfig.php";

session_start();
if(!isset($_SESSION['myusername'])){
    header("Location: login.php");
    exit;
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&family=Indie+Flower&family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="like.css"/>
    <script src="like.js" defer="true"></script>
</head>

<body>
<nav>
      <div id="logo">
        <img src="img/rosso.png">
      </div>
      
      <div id="links">
      <a href="home.php" id="home"></a>
      <a href="like.php" id="like"></a>
      <a href="private.php" id="user"></a>
      <a href="logout.php" id="logout"></a>
      </div>
    </nav>

<article>
    <section>
        
        <div class="head">
            <div class="hi">Ciao <?php echo $_SESSION['myusername']; ?>,</div>
            <div>questi sono tutti i contenuti che ami!</div>
        </div>

        <div class="container">
        </div>
    </section>
</article>
</body>

</html>
<?php
include "dbconfig.php";
session_start();

if(!isset($_SESSION['myusername'])){
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect($dbconfig["host"], 
$dbconfig["user"], 
$dbconfig["password"], 
$dbconfig["name"])
or die(mysqli_error($conn));

$user_id = mysqli_real_escape_string($conn, $_SESSION['myusername']);
$query = "SELECT * FROM users WHERE username = '$user_id'";
$res = mysqli_query($conn, $query);
$user_info = mysqli_fetch_assoc($res);


if(isset($_POST['email'])){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errore = "Email non valida";
    }else{
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    $q1 = "UPDATE users SET email = '$new_email' WHERE username = '$user_id'";
    $res1 = mysqli_query($conn, $q1);
    header("Location:logout.php");
    }
}

if(isset($_POST['username'])){
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        $errore = "Username non valido";
    }else{
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $q2 = "UPDATE users SET username = '$new_username' WHERE username = '$user_id'";
    $res2 = mysqli_query($conn, $q2);
    header("Location:logout.php");
    }
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
    <link rel="stylesheet" href="private.css"/>
    <script src="private.js" defer="true"></script>
</head>


<body>
    <article>
        <div class="yours">
            <div> IL TUO ACCOUNT <strong> HOT </strong> PLATE</div>
            <a href="home.php" class="home"></a>
        </div>

        <div class="nome">
            <?php echo"<p>" .$user_info['name']. "</p>"; ?>
        </div>

        <div class="cognome">
            <?php  echo"<p>" .$user_info['surname']. "</p>"; ?>
        </div>


        <div class="email">
            <?php  echo"<p>" .$user_info['email']. "</p>"; ?>
            <div class="pencil" id="pencil_email"></div>
        </div>

        <div id="new_email" class="hidden">
        <form method='post'>
        <input type="text" name="email" placeholder="inserisci una nuova email">
        <img src="img/x.png">
        </form>
        <span></span>
        </div>

        <div class="username">
            <?php  echo"<p>" .$user_info['username']. "</p>";?>
            <div class="pencil" id="pencil_username"></div>
        </div>

        <div id="new_username" class="hidden">
        <form method='post'>
        <input type="text" name="username" placeholder="inserisci un nuovo username">
        <img src="img/x.png">
        </form>
        <span></span>
        </div>

    </article>
</body>


</html>
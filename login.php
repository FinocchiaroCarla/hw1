<?php
include "dbconfig.php";

session_start();
if(isset($_SESSION["username"])){
    header("Location: home.php");        
    exit;
}

if(isset($_POST["username"]) && isset($_POST["password"])){
    $conn = mysqli_connect($dbconfig["host"], $dbconfig["user"], $dbconfig["password"], $dbconfig["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $query = "SELECT id, username, password  FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0){
        $entry = mysqli_fetch_assoc($res);

        if(password_verify($_POST['password'],$entry['password'])){
            $_SESSION["myusername"] = $_POST["username"];
            $_SESSION["myuser_id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            mysqli_free_result($res);
            header("Location: home.php");
            exit;
        }else{
            $errore = "password errata";
        }

    }else{
        $errore = "username e/o password errati";
    }

}else{
    $errore = "";
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Entra</title>
    <link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&family=Indie+Flower&family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css"/>
    <script src="login.js" defer="true"></script>
</head>

<body>
    <div id="article">
        <div class="logo">
            <img src="img/rosso.png">
        </div>

            <form name='login' method='post' enctype="multipart/form-data" autocomplete="off">
                <div class="username">
                    <label>Nome Utente<input type="text" name="username">
                    <div></div>
                    </label>
                </div>

                <div class="password">
                    <label>Password<input type="password" name="password">
                    <div></div>
                    </label>
                </div>

                <div class="submit">
                <label>
                <input type="submit" value="Entra">
                <div>
                    
                <?php 
                if(isset($errore)){
                    echo "$errore";
                }
                ?>

                </div>

                </label>
                </div>

            </form>

            <div class="signup">
                <p>Non hai ancora un account?</p>
                <a href="signup.php">Registrati</a>
            </div>
        </div>
    </div>
</body>

</html>
<?php

include "dbconfig.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["name"]) && 
    isset($_POST["surname"]) && isset($_POST["confirm_password"]))
    {
    
    $error = array();
    $conn = mysqli_connect($dbconfig["host"], 
                            $dbconfig["user"], 
                            $dbconfig["password"], 
                            $dbconfig["name"])
                            or die(mysqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if(!preg_match('/^[a-zA-Z]+$/', $name)) {
        $error[] = "Nome non valido";
    }

    if(!preg_match('/^[a-zA-Z _]+$/', $surname)) {
        $error[] = "Cognome non valido";
    } 
    
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $username)) {
        $error[] = "Username non valido";
       
    } else {
        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Username già in uso";
        }
    }

    if (strlen($_POST["password"]) < 8) {
        $error[] = "La password deve contenere almeno 8 caratteri";
    }

    if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
        $error[] = "Le password non coincidono";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Email non valida";
    } else {
        $q = "SELECT email FROM users WHERE email = '$email'";
        $res = mysqli_query($conn, $q);
        if (mysqli_num_rows($res) > 0) {
            $error[] = "Email già in uso";
        }
    }

    if(count($error)==0){
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $email = mysqli_real_escape_string($conn, strtolower($_POST["email"]));
        $username = mysqli_real_escape_string($conn, $_POST["username"]);


        $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";

        if (mysqli_query($conn, $query)) {
            $_SESSION["myusername"] = $_POST["username"];
            $_SESSION["myuser_id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }

    }

    mysqli_close($conn);
}
else if(isset($_POST["username"])) {
    $error = array("Riempi tutti i campi");
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registrati</title>
    <link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch&family=Indie+Flower&family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="signup.css"/>
    <script src="signup3.js" defer="true"></script>
</head>
<body>

    <article>

    <div id="left">

        <div id="logo">
            <img src="img/rosso.png">
        </div>

        <div id="pres">
            <div class="chiave">
                <div></div>
                <p>Accedi al nostro mondo</p>
            </div>
            <div class="cuore">
                <div></div>
                <p>Salva i contenuti che ami</p>
            </div>
            <div class="domanda">
                <div></div>
                <p>Chiedi tutto ciò che vuoi</p>
            </div>
        </div>
    </div>  

    <div id="right">
        <div class="title">PRESENTATI</div>
            <form name='submit' method='post' autocomplete="off">

            <div class=uno>
                <div class="name">
                    <label>Nome<input type="text" name="name">
                    <span></span>
                    </label>
                </div>

                <div class="surname">
                    <label>Cognome<input type="text" name="surname">
                    <span></span>
                    </label>
                </div>
            </div>

            <div class="email">
                <label>E-mail<input type="text" name="email">
                <span></span>
                </label>
            </div>

            <div class="username">
                <label>Username<input type="text" name="username">
                <span></span>
                </label>
            </div>
            
            <div class="psw">
                <label>Password<input type="password" name="password">
                <span></span>
                </label>
            </div>
            
            <div class="confirm">
                <label>Conferma Password<input type="password" name="confirm_password">
                <span></span>
                </label>
            </div>
        

            <div class="submit">
                <label><input type="submit" value="Registrati" id="submit">
                <span></span>
                </label>
            </div>

            </form>

            <div class="login">
                <p>Hai già un account?</p>
                <a href="login.php">Accedi</a>
            </div>
        </div>
    </div>

    </article>  

</body>

</html>
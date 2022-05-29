<?php
include "dbconfig.php";
session_start();

$conn = mysqli_connect($dbconfig["host"], 
                                $dbconfig["user"], 
                                $dbconfig["password"], 
                                $dbconfig["name"])
                                or die(mysqli_error($conn));

$element = array();
$username = $_SESSION['myusername'];
$query = "SELECT id, content FROM saved WHERE user = (SELECT username FROM users WHERE username='$username')";

$res = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($res)){
    $element[] = array($row['id'], json_decode($row['content']));
}

mysqli_free_result($res);
mysqli_close($conn);


echo json_encode($element);

?>
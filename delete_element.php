<?php
//eliminiamo un elemento salvato
include "dbconfig.php";

if(isset($_GET['element_id'])){
    $conn = mysqli_connect($dbconfig["host"], 
                            $dbconfig["user"], 
                            $dbconfig["password"], 
                            $dbconfig["name"])
                            or die(mysqli_error($conn));

    $element_id = mysqli_real_escape_string($conn, $_GET['element_id']);
    $query = "DELETE FROM saved WHERE id = '".$element_id."'";
    mysqli_query($conn, $query);
    mysqli_close($conn);
    }

?>
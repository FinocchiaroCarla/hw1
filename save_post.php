<?php

//inserisce nel database il post salvato

include "dbconfig.php";
session_start();

$app_id = '1c7bc491';
$app_key = '66bce3e1769989a794858ed5acf1ed48';
$userid = $_SESSION["myusername"];

$url = 'https://api.edamam.com/api/recipes/v2/'.$_POST['id'].'?type=public&app_id='.$app_id.'&app_key='.$app_key;

    $dati = file_get_contents($url);

    $arr = json_decode($dati, true);

    $conn = mysqli_connect($dbconfig['host'], 
                            $dbconfig['user'],
                            $dbconfig['password'],
                            $dbconfig['name']);

    $id_rec = mysqli_real_escape_string($conn, $_POST['id']);
    $url = mysqli_real_escape_string($conn, $arr['recipe']['images']['REGULAR']['url']);
    $label = mysqli_real_escape_string($conn, $arr['recipe']['label']);
    $type = mysqli_real_escape_string($conn, $arr['recipe']['cuisineType'][0]);
        
    $query = "INSERT INTO saved(user, content) VALUES('$userid', JSON_OBJECT('id', '$id_rec', 'label','$label','type','$type','url', '$url'))";

       if(mysqli_query($conn, $query)){
            echo json_encode(array('ok' => true));
            exit;
       }else{
            echo json_encode(array('ok' => false));
            exit;
       }
    

?>
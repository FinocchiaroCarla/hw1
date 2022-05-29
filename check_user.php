<?php
//controllo unicità dell'username
include "dbconfig.php";

$conn=mysqli_connect($dbconfig['host'], 
                    $dbconfig['user'], 
                    $dbconfig['password'], 
                    $dbconfig['name']);

$username=mysqli_real_escape_string($conn, $_GET['q']);
$query="SELECT username FROM users WHERE username ='$username'";
$val=mysqli_query($conn,$query);

if(mysqli_num_rows($val)>0){
    $response=array('exists'=>true);
}else{
    $response=array('exists'=>false);
}
echo json_encode($response);
mysqli_close($conn);
?>
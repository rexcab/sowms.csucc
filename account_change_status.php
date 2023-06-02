<?php 

require_once("msql.php");

$con = $userClass->connection();

$id =   $_POST['id'];
$status =  $_POST['status'];

if($status=="Active"){
    $status="Deactivate";
}else{
    $status="Active";
}

$sql = "UPDATE users SET status = '$status' WHERE id = '$id' ";



if($con->query($sql))
    echo 1;
else
    echo  die ($con->error);  

?>
<?php


require_once("msql.php");
$con=$userClass->connection();


$pon = mysqli_real_escape_string($con,$_GET['pon']);
$a = mysqli_real_escape_string($con,$_GET['description']);
$b = mysqli_real_escape_string($con,$_GET['unit']);
$c = mysqli_real_escape_string($con,$_GET['qty']);
$d = mysqli_real_escape_string($con,$_GET['u_cost']);
$e = mysqli_real_escape_string($con,$_GET['t_cost']);
$f = mysqli_real_escape_string($con,$_GET['office']);

$sql= "INSERT INTO `items`(`pon`,`description`,`unit`,`qty`,`unitcost`,`totalcost`,`office`,`stock`,`waiting`,`arrived_status`,`withdraw_status`, `remaining`,`withdrew`,`arrived`) VALUES ('$pon','$a','$b','$c','$d','$e','$f','0','$c','awaiting','incomplete','$c','0','0')";

if($con->query($sql) == true){
    echo true;
}else{
    echo false." ".die($con->error);
} 







         
?>

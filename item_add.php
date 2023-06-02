
<?php


require_once("msql.php");
$con=$userClass->connection();


$a = mysqli_real_escape_string($con,$_GET['description']);

$sql= "INSERT INTO `item`(`description`) VALUES ('$a')";

if($con->query($sql) == true){
    echo 1;
}else{
    echo false." ".die($con->error);
} 







         
?>
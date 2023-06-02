<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");


$con=$userClass->connection();
$entry_no = $_POST['entry_no'];
$status= $_POST['status'];
$date_added = $_POST['date_added'];
//get offices on pon

$rows=[];
$stmt = "UPDATE trans_arrived SET status = '$status', sent_date = '$date_added' where entry_no = '$entry_no'";


$con->query($stmt) or die ($con->error);
    return true;

if($con->query($stmt) )
    return true;
else
 return $con->error;

?>
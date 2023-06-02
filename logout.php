<?php

require_once("msql.php");

$con = $userClass->connection();

session_start();

$event = "logout";
$name = $_SESSION['name'];
$username = $_SESSION['username'];

if($_SESSION['accesstype']!="Superadmin"){
    $sql= "INSERT INTO `logs`(`name`, `username`, `event`) VALUES ('$name','$username','$event')";
    $con->query($sql) or die ($con->error);
}


unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['isername']);
unset($_SESSION['accesstype']);

 header("Location: index.php");

?>
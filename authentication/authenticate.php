<?php
require_once("../msql.php");

$con = $userClass->connection();
$username =  mysqli_real_escape_string($con, $_POST['username']);
$password =  mysqli_real_escape_string($con, $_POST['password']);
$password = md5($password);
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$user = $con->query($sql) or die ($con->error);  
$row = $user->fetch_assoc(); 
$total = $user->num_rows;

if($total > 0){   

    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['firstname']." ".$row['lastname'];
    $_SESSION['accesstype']= $row['accesstype'];
    $event = "login";

    $name = mysqli_real_escape_string($con, $_SESSION['name']);
    $username = mysqli_real_escape_string($con, $_SESSION['username']);
    
    if($row['accesstype']=="Superadmin"){
       echo 2;
    }else{
        if($row['status']=="Deactivate"){
           echo 3;
        }else{
            $sql= "INSERT INTO `logs`(`name`, `username`, `event`) VALUES ('$name','$username','login')";
            $con->query($sql) or die ($con->error); 
            echo 1;
        }
        
     
    }


}else{
    echo 0;
}





?>
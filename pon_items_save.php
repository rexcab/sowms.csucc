<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}
$con=$userClass->connection();

$tablecount = $_POST["tablecount"];
$office_and_item_row = $_POST["office_and_item_row"];
$input_description = $_POST["input_description"];
$unit = $_POST["unit"];
$qty = $_POST["qty"];
$u_price = $_POST["u_price"];
$t_price = $_POST["t_price"];
$pon = $_POST["pon"];


$temp = 0;

for($j=0;$j<$tablecount;$j++){
    for($w=0;$w<$office_and_item_row[$j][1];$w++){
        $vv = $w+$temp;
    } $temp = $vv+1;
}
$temp = 0;
for($j=0;$j<$tablecount;$j++){
    for($w=0;$w<$office_and_item_row[$j][1];$w++){
        $vv = $w+$temp;
        $pon = $pon;
        $a = $input_description[$vv];
        $b = $unit[$vv];
        $c = $qty[$vv];
        $d = $u_price[$vv];
        $e = $t_price[$vv];
        $f = $office_and_item_row[$j][0];
        
            $sql= "INSERT INTO `items`(`pon`,`description`,`unit`,`qty`,`unitcost`,`totalcost`,`office`,`stock`,`waiting`,`arrived_status`,`withdraw_status`, `remaining`,`withdrew`,`arrived`) VALUES ('$pon','$a','$b','$c','$d','$e','$f','0','$c','awaiting','incomplete','$c','0','0')";

            if($con->query($sql) == true){
                $sql1= "INSERT INTO `boolrecord`(`pon`,`record_stat`) VALUES ('$pon','true')";
                $con->query($sql1) or die($con->error);
              $vt = true;
            }else{
               $vt = false." ".die($con->error);
            } 
    } $temp = $vv+1;
}

echo $vt;
/* */
?>







<?php
/*

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


*/




         
?>

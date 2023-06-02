<?php

require_once("msql.php");


$connect=$userClass->connection();
$search = mysqli_real_escape_string($connect, $_POST['id']);

$text="";

$text=" <table class='table' >
<thead class='table'>
    <tr>
        <th >#</th>
        <th >Purchased Order Number</th>
    </tr>
    </thead>
<tbody>";



$stmt =  "SELECT * FROM supply_records WHERE purchasedOrderNumber LIKE '%".$search."%'";
$users = $connect->query($stmt) or die ($connect->error);

$rows = [];
$pon = [];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row['purchasedOrderNumber'];
    }

    $rows= array_unique($rows); 

}else{
    
}








$i=1;
foreach($rows as $row){

    $text=$text."
    <tr class='tr_id' onclick='therow(this)'>
    <td style='font-size: 14px;'>".$i."</td>
    <td style='font-size: 14px;'>".$row."</td>
    </tr>";
      
      $i++;
}
echo $text=$text."</tbody> </table>";
?>
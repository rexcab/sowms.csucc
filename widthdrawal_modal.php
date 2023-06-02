<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$office = $_POST['office'];
//get offices on pon

$stmt =  "SELECT * FROM supply_records where purchasedOrderNumber = '$pon' and office = '$office' ";
$users = $con->query($stmt) or die ($con->error);

$rows = [];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row;
    } 
}else{
    return false;
}
function peso($t){
    $n = number_format($t);
    $whole = $t-floor($t); 
    $whole = substr($whole, 2, 2);
    if(!$whole){
        $whole="00";
    }
    $t = $n.".".$whole;
    return $t;
}

$str =  "<div>
<h6>P.O.N. : <span style='font-size:20px'>$pon</span></h6>
<h6>Office: <span style='font-size:20px'>".$rows[0]['office']."</span></h6>
<h6>Supplier: <span style='font-size:20px'>".$rows[0]['supplier']."</span></h6>
<h6>Date: <span style='font-size:20px'>".$rows[0]['date']."</span></h6>
</div>
<hr>
<div>
<div><h5>List of items</h5></div>
<div>
    <table class='table'>
        <thead>
            <tr>
            <th scope='col'>Articles</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Qty</th>
            <th scope='col'>Unit cost</th>
            <th scope='col'>Total Cost</th>
            </tr>
        </thead>
        <tbody>";
foreach($rows as $row){

  $str=$str."<tr>
  
    <td scope='row'>".$row['articles']."</td>
    <td scope='row'>".$row['unit']."</td>
    <td scope='row'>".$row['qty']."</td>
    <td scope='row'>".$row['unitcost']."</td>
    <td scope='row'>".$row['totalcost']."</td>
        </tr>";
}
            
$str=$str."        
        </tbody>
    </table>
</div>
</div>";
echo $str;
?>
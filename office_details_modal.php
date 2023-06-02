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

$str =  "<div style='display:flex'>
<h5>P.O.N. &nbsp &nbsp &nbsp : <input type='text' name='pon' readonly value='$pon' style='margin-right:20px;' /></h5>
<h5>Office &nbsp : <input type='text' name='office' style='margin-right:20px;' readonly value='".$rows[0]['office']."'/></h5>
</div>
<div style='display:flex'>
<h5>Supplier &nbsp : <input type='text' name='supplier' style='margin-right:20px;' readonly value='".$rows[0]['supplier']."'/></h5>
<h5>Date&nbsp &nbsp : <input type='text' name='office' style='margin-right:20px;' readonly value='".$rows[0]['date']."'/></h5>
</div>
<hr>
<div>
<div><h5>List of Requested Supply Items</h5></div>
<div>
    <table class='table table-bordered'>
        <thead>
            <tr>
            <th scope='col'>Articles</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Qty</th>
            <th scope='col'>Unit cost</th>
            <th scope='col'>Total Cost</th>
            <th scope='col' style='color: #3ac500; width:14%;'>Available Qty</th>
            <th scope='col' style='color: #3ac500; width:15%;'>Available Total Cost</th>
            </tr>
        </thead>
        <tbody>";
foreach($rows as $row){
   $t = peso($row['totalcost']);
   $u = peso($row['unitcost']);
  $str=$str."<tr>
    <td scope='row'>".$row['articles']."</td>
    <td scope='row'>".$row['unit']."</td>
    <td scope='row'>".$row['qty']."</td>
    <td scope='row'>₱ $u</td>
    <td scope='row'>₱ $t</td>
    <td scope='row'>".$row['qty_available']."</td>
    <td scope='row'>₱ ".peso($row['totalcost_available'])."</td>

        </tr>";
}
            
$str=$str."        
        </tbody>
    </table>
</div>
</div>";
echo $str;
?>
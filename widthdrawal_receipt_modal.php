
<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$trans = $_POST['transaction'];
$date = $_POST['date']; 
$office= $_POST['office']; 
//get offices on pon

$stmt =  "SELECT * FROM records where purchasedOrderNumber = '$pon' and trans_num = '$trans' ";
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

$str = "<div class='slip-logo-header'>
<img src='img/csucc-header.png' id='pic1' style=''/>

</div>
<div class='slip-text-header'>
<h5>PROPERTY AND SUPPLY MANAGEMENT OFFICE (PSMO)</h5>
<H5>WIDHDRAWAL SLIP FORM</H5>
</div>   
<div class='slip-upper-information'>
<div style='width:68%'>
    <div class='flex'>
        <h6>Department &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp</h6><div class='left'><h6>$office</h6></div>
    </div>
    <div class='flex'>
        <h6>Project/Purpose &nbsp&nbsp:&nbsp&nbsp</h6> <div class='left'><h6 style='opacity:0'>NULL</h6></div>
    </div>
</div>
<div style='width:30%'>
    <div class='flex'>
        <h6>P.O. # &nbsp&nbsp:&nbsp&nbsp</h6><div class='right'><h6>$pon</h6></div>
    </div>
    <div class='flex'>
        <h6>Date &nbsp&nbsp&nbsp:&nbsp&nbsp </h6><div class='right'><h6>$date</h6></div> 
    </div>
</div>
</div>  
<div class='slip-table'>
<table class='table table-bordered' style='padding:2px'>
    <thead>
        <tr>
            <th>QTY</th>
            <th>UNIT</th>
            <th>NAME & DESCRIPTION</th>
            <th>S & M Balance</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>";
$cc = 1;
foreach($rows as $row){
    $t = peso($row['totalcost']);
    $u = peso($row['unitcost']);
  $str=$str."<tr>
        <td>".$row['qty']."</td>
        <td>".$row['unit']."</td>
        <td>".$row['articles']."</td>
        <td></td>
        <td>₱ $u</td>
        <td>₱ $t</td>
        </tr>
        ";
    $cc++;
}
for($cc;$cc<11;$cc++){
    $str=$str."<tr>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
    </tr>";
}

            
$str=$str."        
</tbody>
</table>
</div>
<div class='slip-lower-information'>
<div class='box'>
    <h6>Requested by:</h6>
    <div class='lign'>
        <h5>".$row['enduser']."</h5>
    </div>
    <h5>
        Sign Over Printed Name of Dean/Unit Head/Project In-charge
    </h5>
</div>
<div class='box'>
    <h6>Widthdraw by:</h6>
    <div class='lign'>
        <h5>".$row['withdrawby']."</h5>
    </div>
    <h5>
        Sign Over Printed Name of Dean/Unit Head/Project In-charge
    </h5>
</div>
<div class='box'>
    <h6>Approved by:</h6>
    <div class='lign'>
        <h5>CYRIL JUDAH G. MORTOLA, MPA</h5>
    </div>
    <h5>
        Supply Officer I
    </h5>
</div>
<div class='box'>
    <h6>Released by:</h6>
    <div class='lign'>
        
    </div>
    <h5>
        Signature Over Printed Name
    </h5>
</div>
</div><br><br> <div style='border-bottom:1px dashed grey'></div>";


//////////////////
$str = $str."<br><div class='slip-logo-header'>
<img src='img/csucc-header.png' id='pic2' style=''/>

</div>
<div class='slip-text-header'>
<h5>PROPERTY AND SUPPLY MANAGEMENT OFFICE (PSMO)</h5>
<H5>WIDHDRAWAL SLIP FORM</H5>
</div>   
<div class='slip-upper-information'>
<div style='width:68%'>
    <div class='flex'>
        <h6>Department &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp</h6><div class='left'><h6>$office</h6></div>
    </div>
    <div class='flex'>
        <h6>Project/Purpose &nbsp&nbsp:&nbsp&nbsp</h6> <div class='left'><h6 style='opacity:0'>NULL</h6></div>
    </div>
</div>
<div style='width:30%'>
    <div class='flex'>
        <h6>P.O. # &nbsp&nbsp:&nbsp&nbsp</h6><div class='right'><h6>$pon</h6></div>
    </div>
    <div class='flex'>
        <h6>Date &nbsp&nbsp&nbsp:&nbsp&nbsp </h6><div class='right'><h6>$date</h6></div> 
    </div>
</div>
</div>  
<div class='slip-table'>
<table class='table table-bordered' style='padding:2px'>
    <thead>
        <tr>
            <th>QTY</th>
            <th>UNIT</th>
            <th>NAME & DESCRIPTION</th>
            <th>S & M Balance</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>";
$cc = 1;
foreach($rows as $row){
    $t = peso($row['totalcost']);
    $u = peso($row['unitcost']);
  $str=$str."<tr>
        <td>".$row['qty']."</td>
        <td>".$row['unit']."</td>
        <td>".$row['articles']."</td>
        <td></td>
        <td>₱ $u</td>
        <td>₱ $t</td>
        </tr>
        ";
    $cc++;
}
for($cc;$cc<11;$cc++){
    $str=$str."<tr>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
        <td style='opacity:0'>NULL </td>
    </tr>";
}

            
$str=$str."        
</tbody>
</table>
</div>
<div class='slip-lower-information'>
<div class='box'>
    <h6>Requested by:</h6>
    <div class='lign'>
        <h5>".$row['enduser']."</h5>
    </div>
    <h5>
        Sign Over Printed Name of Dean/Unit Head/Project In-charge
    </h5>
</div>
<div class='box'>
    <h6>Widthdraw by:</h6>
    <div class='lign'>
        <h5>".$row['withdrawby']."</h5>
    </div>
    <h5>
        Sign Over Printed Name of Dean/Unit Head/Project In-charge
    </h5>
</div>
<div class='box'>
    <h6>Approved by:</h6>
    <div class='lign'>
        <h5>CYRIL JUDAH G. MORTOLA, MPA</h5>
    </div>
    <h5>
        Supply Officer I
    </h5>
</div>
<div class='box'>
    <h6>Released by:</h6>
    <div class='lign'>
        
    </div>
    <h5>
        Signature Over Printed Name
    </h5>
</div>
</div> ";

echo $str;
?>



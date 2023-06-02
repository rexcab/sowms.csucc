<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$entry_no = $_POST['entry_no'];
$date_m= $_POST['date_m'];
//get offices on pon

$rows=[];
$stmt = "SELECT * FROM trans_arrived where entry_no = '$entry_no'";
$users = $con->query($stmt) or die ($con->error);

if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row;
    }
}
$stmts = "SELECT * FROM offices where office_name = '".$rows[0]['office']."'";
$userss = $con->query($stmts) or die ($con->error);


$office_email =  $userss->fetch_assoc();
$office_email = $office_email['office_email'];

$str = "<div class='slip-logo-header' 
style='width:100%; '>
<img src='img/csucc-header.png' style='width:inherit; height:auto'  id='pic1' style=''/>
<img  style='width:inherit; height:auto'  id='pic2' style=''/>
</div>
<div class='slip-text-header'>
<h5>PROPERTY AND SUPPLY MANAGEMENT OFFICE (PSMO)</h5>
<H5>WIDHDRAWAL SLIP FORM</H5>
</div>   
<div class='slip-upper-information'>
<div style='width:68%'>
    <div class='flex'>
        <h6>Department &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp</h6><div class='left'><h6>".$rows[0]['office']."</h6></div>
    </div>
    <div class='flex'>
        <h6>Project/Purpose &nbsp&nbsp:&nbsp&nbsp</h6> <div class='left'><h6 style='opacity:0'>NULL</h6></div>
    </div>
</div>
<div style='width:30%'>
    <div class='flex'>
        <h6>P.O. # &nbsp&nbsp:&nbsp&nbsp</h6><div class='right'><h6>".$rows[0]['pon']."</h6></div>
    </div>
    <div class='flex'>
        <h6>Date &nbsp&nbsp&nbsp:&nbsp&nbsp </h6><div class='right'><h6>".$rows[0]['date']."</h6></div> 
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

    $i=1;

    if(count($rows) > 0){
        foreach ($rows as $row){
            $str=$str."<tr class='s_off'>
            <td scope='row'>".$row['withdrew_qty']."</td>
            <td scope='row'>".$row['unit']."</td>
            <td scope='row'>".$row['description']."</td>
            <td style='opacity:0'>NULL </td>
            <td scope='row'>₱".number_format($row['unitcost'], 2, '.', ',')."</td>
            <td scope='row'>₱".number_format($row['totalcost'], 2, '.', ',')."</td>
            </tr>"; 
            $i++;
        }
    }




for($i;$i<16;$i++){
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
        <h5>".$rows[0]['end_user']."</h5>
    </div>
    <h5>
        Sign Over Printed Name of Dean/Unit Head/Project In-charge
    </h5>
</div>
<div class='box'>
    <h6>Widthdraw by:</h6>
    <div class='lign'>
        <h5>".$rows[0]['withdraw_by']."</h5>
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
</div><br>
<div class='modal-footer' id='foot'>
                            <button type='button' class='btn btn-primary ' onclick='print()'>Print</button>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        </div>
                        <br> ";
    
echo $str;
?>
<?php

require_once("msql.php");


$connect=$userClass->connection();
$search = mysqli_real_escape_string($connect, $_POST['name']);


$text="";
$stmt =  "SELECT * FROM supply_records WHERE office LIKE '%".$search."%' OR articles LIKE '%".$search."%' OR purchasedOrderNumber LIKE '%".$search."%' OR supplier LIKE '%".$search."%' OR date LIKE '%".$search."%' "; // LIKE or wild card search
$result = mysqli_query($connect,$stmt);
$count= mysqli_num_rows($result);

$text=" <table class='table'>
<thead class='table'>
    <tr>
        <th >#</th>
        <th style='width:105px;'>Date</th>
        <th style='width:90px;'>P.O.N.</th>
        <th style='width:130px;'>office</th>
        <th style='width:50px;'>Qty</th>
        <th style='width:60px;'>Unit </th>
        <th style='width:120px;'>Articles</th>
        <th style='width:80px;'>Unit Cost </th>
        <th style='width:80px;'>Total Cost </th>
        <th style='width:120px;'>Supplier</th>
        <th >Action</th>
    </tr>
    </thead>
    <tbody>";
if(mysqli_num_rows($result)>0){
    $i=1;


    while($var=mysqli_fetch_assoc($result)){

        $text=$text."
        <tr>
    <td style='font-size: 14px;'>".$i."</td>
    <td style='font-size: 14px;'>".$var['date']."</td>
    <td style='font-size: 14px;'>".$var['purchasedOrderNumber']."</td>
    <td style='display:none;'>".$var['id']."</td>
    <td style='font-size: 14px;'>".$var['office']."</td>
    <td style='font-size: 14px;'>".$var['qty']."</td>
    <td style='font-size: 14px;'>".$var['unit']."</td>
    <td style='font-size: 14px;'>".$var['articles']."</td>
    <td style='font-size: 14px;'>".$var['unitcost']."</td>
    <td style='font-size: 14px;'>".$var['totalcost']."</td>
    <td style='font-size: 14px;'>".$var['supplier']."</td>

    <td ><span style='display:flex;'><button type='button' class='btn btn-primary btn-sm ' onclick='edit(this)' style='height:29px; margin-right:3px;'>update</button>

    </td>
</tr>";
        $i++;
    }
    echo $text=$text."</tbody> </div>";
    
}else{

    echo $text=$text."<tr><td>no found</td></tr>";
    
}
?>
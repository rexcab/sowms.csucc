<?php

require_once("msql.php");


$connect=$userClass->connection();
$search = $_POST['name'];
$text="";
$stmt =  "SELECT * FROM records WHERE office LIKE '%".$search."%' OR articles LIKE '%".$search."%' OR purchasedOrderNumber LIKE '%".$search."%' OR enduser LIKE '%".$search."%' OR supplier LIKE '%".$search."%' OR datewithdraw LIKE '%".$search."%' OR withdrawby LIKE '%".$search."%'"; // LIKE or wild card search
$result = mysqli_query($connect,$stmt);
$count= mysqli_num_rows($result);

$text=" 
    
        <table class='table'>
            <thead class='table'>
                        <tr>
                        <th >#</th>
                        <th style='width:105px;'>Date Withdraw</th>
                        <th style='width:130px;'>office</th>
                        <th style='width:50px;'>Qty</th>
                        <th style='width:60px;'>Unit </th>
                        <th style='width:120px;'>Articles</th>
                        <th style='width:80px;'>Unit Cost </th>
                        <th style='width:80px;'>Total Cost </th>
                        <th style='width:90px;'>P.O.N.</th>
                        <th style='width:120px;'>End-user</th>
                        <th style='width:120px;'>Supplier</th>
                        <th style='width:120px;'>Widthdraw By</th>
                        <th >Action</th>
                            
                        </tr>
                        </thead>
                        <tbody >";
if(mysqli_num_rows($result)>0){
    $i=1;


    while($var=mysqli_fetch_assoc($result)){

        $text=$text."
         <tr >
            <td style='font-size: 14px;'>".$i."</td>
            <td style='display:none;'>".$var['id']."</td>
            <td style='font-size: 14px;'>".$var['datewithdraw']."</td>
            <td style='font-size: 14px;'>".$var['office']."</td>
            <td style='font-size: 14px;'>".$var['qty']."</td>
            <td style='font-size: 14px;'>".$var['unit']."</td>
            <td style='font-size: 14px;'>".$var['articles']."</td>
            <td style='font-size: 14px;'>".$var['unitcost']."</td>
            <td style='font-size: 14px;'>".$var['totalcost']."</td>
            <td style='font-size: 14px;'>".$var['purchasedOrderNumber']."</td>
            <td style='font-size: 14px;'>".$var['enduser']."</td>
            <td style='font-size: 14px;'>".$var['supplier']."</td>
            <td style='font-size: 14px;'>".$var['withdrawby']."</td>


<td ><span style='display:flex;'><button type='button' class='btn btn-primary btn-sm editbtn' onclick='edit(this)' style='height:29px; margin-right:3px;'>update</button>


        </tr>";
        $i++;
    }
    echo $text=$text."</tbody>";
}else{

    echo $text=$text."<tr><td>no found</td></tr>";
    
}
?>
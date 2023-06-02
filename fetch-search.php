<?php

require_once("msql.php");


$connect=$userClass->connection();
$search = mysqli_real_escape_string($connect, $_POST['name']);


$text="";
$stmt =  "SELECT * FROM records WHERE office LIKE '%".$search."%' OR articles LIKE '%".$search."%' OR purchasedOrderNumber LIKE '%".$search."%' OR enduser LIKE '%".$search."%' OR supplier LIKE '%".$search."%' OR datewithdraw LIKE '%".$search."%' OR withdrawby LIKE '%".$search."%'"; // LIKE or wild card search
$result = mysqli_query($connect,$stmt);
$count= mysqli_num_rows($result);

$text="        <div class='dates'>
    <h6>Total of ".$count."</h6>
</div> 
<div class=''>
        <table class='table'>
            <thead class='table'>
                        <tr>
                        <th style='width:50px'>#</th>
                        <th style='width:105px;'>Date Withdraw</th>
                        <th style='width:130px;'>office</th>
                        <th style='width:50px;'>Qty</th>
                        <th style='width:60px;'>Unit </th>
                        <th style='width:120px;'>Articles</th>
                        <th style='width:80px;'>Unit Cost </th>
                        <th style='width:80px;'>Total Cost </th>
                        <th style='width:80px;'>P.O.N.</th>
                        <th style='width:120px;'>End-user</th>
                        <th style='width:120px;'>Supplier</th>
                        <th style='width:120px;'>Widthdraw By</th>
                        
                            
                        </tr>
                        </thead>
                        <tbody >";
if(mysqli_num_rows($result)>0){
    $i=1;


    while($var=mysqli_fetch_assoc($result)){

        $text=$text."
         <tr >
            <td>".$i."</td>
            <td style='display:none;'>".$var['id']."</td>
            <td>".$var['datewithdraw']."</td>
            <td>".$var['office']."</td>
            <td>".$var['qty']."</td>
            <td>".$var['unit']."</td>
            <td>".$var['articles']."</td>
            <td>".$var['unitcost']."</td>
            <td>".$var['totalcost']."</td>
            <td>".$var['purchasedOrderNumber']."</td>
            <td>".$var['enduser']."</td>
            <td>".$var['supplier']."</td>
            <td>".$var['withdrawby']."</td>

        </tr>";
        $i++;
    }
    echo $text=$text."</tbody> </div>";
    
}else{

    echo $text=$text."<tr><td>no found</td></tr>";
    
}
?>
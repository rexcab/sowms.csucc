<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$sup = $_POST['supplier'];
$date = $_POST['date'];

//get offices on pon


$rows=[];
$stmt = "SELECT * FROM items where pon = '$pon'";
$users = $con->query($stmt) or die ($con->error);

if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        
        $rows[] = $row['office'];
    }
    $rows= array_unique($rows);
}


$i=1;
$stat = [];




$str =  "

<div class='card' style='width: 100%;'>
                    <div class='card-body'>

                        <h4 class='card-title'>Purchased Order Number Details</h4>
                       
                        <div style='display: flex; width:100%;  padding:10px;  background:white'>

                            <div style='display:block; width:200px'>
                                <h6 id='pon_office' >P.O.N</h6>  
                                <h6>Supplier</h6>  
                                <h6>Date issued</h6>
                            
                            </div>
                            <div style='display:block'>
                                <h6 id='pon_office' >: <span id='pp_pon' style='color:rgb(28, 126, 3);font-weight:900;'>".$pon."</span></h6>  
                                <h6>: <span id='pp_supplier' style='color:rgb(28, 126, 3);font-weight:900;'>".$sup."</span></h6>  
                                <h6>: <span id='pp_date' style='color:rgb(28, 126, 3);font-weight:900;'>".$date."</span></h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class='card-body' id='office-items'>  ";
                    
                    foreach($rows as $row){

                    $str=$str."
                   
                        <table class='table table-bordered' >
                            <thead class='table'>
                                <tr>
                                    <th colspan='10' style='font-size:20px'>$row</th>
                                </tr>
                                <tr>
                                    <th>Item name/Description</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Unit Price (₱)</th>
                                    <th>Total Price (₱)</th>
                                </tr>
                                </thead>
                            <tbody>
                        "; 
                        $stmt = "SELECT * FROM items where pon = '$pon' AND office = '$row'";
                        $usersa = $con->query($stmt) or die ($con->error);
                        
                        while ( $rowx= $usersa->fetch_assoc()){
                    
                        $str=$str."

                                <tr>
                                    <td>".$rowx['description']."</td>
                                    <td>".$rowx['unit']."</td>
                                    <td>".$rowx['qty']."</td>
                                    <td>₱".number_format($rowx['unitcost'], 2, '.', ',')."</td>
                                    <td>".$rowx['totalcost']."</td>
                                </tr>";
                            }
                            
                            $str=$str."       </tbody>    
                        </table>";

                   }
                    
                    $str=$str."  
                    </div>
                  
                    
                </div>";


         

echo $str;
?>
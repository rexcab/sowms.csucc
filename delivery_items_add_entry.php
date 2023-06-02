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
foreach($rows as $row){

    $stmt = "SELECT * FROM items where pon = '$pon'";
    $users = $con->query($stmt) or die ($con->error);
    
        while ($rowx = $users->fetch_assoc()){
            
            $stat[] = $rowx['arrived_status'];
            break;
        }
       
}




$str =  "

<div class='card' style='width: 100%;'>
                    <div class='card-body'>

                        <h4 class='card-title'>Purchased Order Number Details</h4>
                       
                        <div style='display: flex; width:100%;  padding:10px;  background:white'>

                            <div style='display:block; width:200px'>
                                <h6 id='pon_office' >P.O.N</h6>  
                                <h6>Supplier</h6>  
                                <h6>Date issued</h6>
                                <h6 style='margin:7px 10px 0 0'>Relevant Offices </h6>
                            </div>
                            <div style='display:block'>
                                <h6 id='pon_office' >: <span id='pp_pon' style='color:rgb(28, 126, 3);font-weight:900;'>".$pon."</span></h6>  
                                <h6>: <span id='pp_supplier' style='color:rgb(28, 126, 3);font-weight:900;'>".$sup."</span></h6>  
                                <h6>: <span id='pp_date' style='color:rgb(28, 126, 3);font-weight:900;'>".$date."</span></h6>
                                <select onclick='s_office(this)' class='form-select' aria-label='Default select example' style='width:400px; font-weight: 700;' id='office' >
                                    <option selected>Select office first (Total of ".count($rows).")</span></option>
                                    ";
                                    $t = 0;
                                    if(count($rows) > 0){
                                        foreach ($rows as $row){  
                                            

                                            $str = $str."<option style=' font-weight: 700;' value='".$row."'>".$row."</option>";
                                        }
                                    }
                                    
                                    $str = $str."
                                        
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr style='margin:0 20px;'>
                    </div>
                    <div>
                        <div class='card-body' id='office-items'>
                                
                        </div>
                    </div>
                    
                </div>";


         

echo $str;
?>
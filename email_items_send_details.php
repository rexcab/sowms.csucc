<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");


$con=$userClass->connection();
$entry_no = $_POST['entry_no'];
$textarea = nl2br($_POST['textarea']);
$textarea_footer = nl2br($_POST['textarea_footer']);
$subject = $_POST['subject'];
$type = $_POST['type'];
//get offices on pon
$sessionValue = $_SESSION['name'];
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

$imageURL = "https://drive.google.com/uc?export=view&id=1OojjYubvmdJXbyiB0gB9KcfbUXI1yG96";
$office_email =  $userss->fetch_assoc();
$office_email = $office_email['office_email'];
if($type=="Arrived"){

    $str =  "

    <div>$textarea $textarea_footer</div>
    
    <br><br><br>
    <div style='width:100%; height:30&'><img src='$imageURL' style='width:100%; height:30%' alt='Example Image' style='display: block;' /></div>
                                    <div style='padding:5px 10px; border-bottom: solid 1px black; border-bottom-style:dashed;'>
                                        <h2>Information Details</h2>
                                        <div style='width:100%; display:flex'>
                                            <div style='padding:0 10px; width:100px'>
                                                <h6 style='font-size:13px;  margin:0'>P.O.N </h6>
                                                <h6 style='font-size:13px;  margin:0'>Supplier </h6>
                                                <h6 style='font-size:13px;  margin:0' >Date issued </h6>
                                                <h6 style='font-size:13px;  margin:0' >Office </h6>
                                            </div>
                                            <div style='padding:0 10px; '>
                                                <h6 style='font-size:13px; margin:0'>: <span id='s_pon' style='font-weight:600'>".$rows[0]['pon']."</span></h6>
                                                <h6 style='font-size:13px; margin:0'>: <span id='s_supplier' style='font-weight:600'>".$rows[0]['supplier']."</span></h6>
                                                <h6 style='font-size:13px; margin:0'>: <span id='s_date' style='font-weight:600'></span> ".$rows[0]['date']."</h6>
                                                <h6 style='font-size:13px; margin:0'>: <span id='s_office' style='font-weight:600'></span> ".$rows[0]['office']."</h6>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <br>
                                    <h3>Item Withdraw Details</h3>
                                    <div style='width:100%; height:500px;' id='table-items'>
                                        <table class='table '>
                                            <thead>
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col' style='padding:5px 10px'>Description</th>
                                                   
                                                    <th scope='col' style='padding:5px 10px'>Unit Cost<span style='font-weight:400; font-size:15px'>(per item)</span></th>
                                                    <th scope='col' style='padding:5px 10px'>Qty <span style='font-weight:400; font-size:15px'>(arrived)</span></th>
                                                    <th scope='col' style='padding:5px 10px'>Total Cost</th>
                                                    <th scope='col' style='padding:5px 10px'>Waiting <span style='font-weight:400; font-size:15px'>(item qty)</span> </th>
    
                                                </tr>
                                            </thead>
                                            <tbody id='table-datasx'>";
    
                                            $i=1;
    
                                            if(count($rows) > 0){
                                                foreach ($rows as $row){
                                                    $str=$str."<tr class='s_off'>
                                                    <td scope='row' >".$i."</td>
                                                    <td scope='row' style='padding:5px 10px'>".$row['description']."</td>
                                                   
                                                    <td scope='row' style='padding:5px 10px'>₱".number_format($row['unitcost'], 2, '.', ',')."</td>
                                                    <td scope='row' style='padding:5px 10px'>".$row['arrived']."</td>
                                                    <td scope='row' style='padding:5px 10px'>₱".number_format($row['totalcost'], 2, '.', ',')."</td>
                                                    <td scope='row' style='padding:5px 10px'>".$row['waiting']."</td>
                                                    </tr>"; 
                                                    $i++;
                                                }
                                            }else{
                                                $str=$str.count($row);
                                            }
                                            
    
                                                
                                            $str=$str."</tbody>
                                        </table>
                                    </div>
                            ";
}else{
    
$str =  "

<div>$textarea $textarea_footer</div>

<br><br><br>
<div style='width:100%; height:30&'><img src='$imageURL' style='width:100%; height:30%' alt='Example Image' style='display: block;' /></div>
                                <div style='padding:5px 10px; border-bottom: solid 1px black; border-bottom-style:dashed;'>
                                    <h2>Information Details</h2>
                                    <div style='width:100%; display:flex'>
                                        <div style='padding:0 10px; width:100px'>
                                            <h6 style='font-size:13px;  margin:0'>P.O.N </h6>
                                            <h6 style='font-size:13px;  margin:0'>Supplier </h6>
                                            <h6 style='font-size:13px;  margin:0' >Date issued </h6>
                                            <h6 style='font-size:13px;  margin:0' >Office </h6>
                                        </div>
                                        <div style='padding:0 10px; '>
                                            <h6 style='font-size:13px; margin:0'>: <span id='s_pon' style='font-weight:600'>".$rows[0]['pon']."</span></h6>
                                            <h6 style='font-size:13px; margin:0'>: <span id='s_supplier' style='font-weight:600'>".$rows[0]['supplier']."</span></h6>
                                            <h6 style='font-size:13px; margin:0'>: <span id='s_date' style='font-weight:600'></span> ".$rows[0]['date']."</h6>
                                            <h6 style='font-size:13px; margin:0'>: <span id='s_office' style='font-weight:600'></span> ".$rows[0]['office']."</h6>
                                        </div>
                                    </div>
                                    <div style='padding:5px 10px; border-top: solid 1px black; border-top-style:dashed;'>
                                    <h4 style='margin:0'>Additional Details</h4>
                                    <div style='width:100%; display:flex'>
                                        <div style='padding:0 10px; width:110px'>
                                            <h6 style='font-size:13px; margin:0'>End-user</h6>
                                            <h6 style='font-size:13px; margin:0'>Widthdraw by: </h6>
                                        </div>
                                        <div style='padding:0 10px; width:110px'>
                                            <h6 style='font-size:13px; margin:0'>".$rows[0]['end_user']."</h6>
                                            <h6 style='font-size:13px; margin:0'>".$rows[0]['withdraw_by']." </h6>
                                        </div>
                                       
                                    </div>
                                </div>
                               
                                <br>
                                <h3>Item Arrived Details</h3>
                                <div style='width:100%; height:500px;' id='table-items'>
                                    <table class='table '>
                                        <thead>
                                            <tr>
                                                <th scope='col'>#</th>
                                                <th scope='col' style='padding:5px 10px'>Description</th>
                                               
                                                <th scope='col' style='padding:5px 10px'>Withdraw Cost<span style='font-weight:400; font-size:15px'>(qty)</span></th>
                                                <th scope='col' style='padding:5px 10px'>Unit cost <span style='font-weight:400; font-size:15px'>(per item)</span></th>
                                                <th scope='col' style='padding:5px 10px'>Total Cost</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody id='table-datasx'>";

                                        $i=1;

                                        if(count($rows) > 0){
                                            foreach ($rows as $row){
                                                $str=$str."<tr class='s_off'>
                                                <td scope='row' >".$i."</td>
                                                <td scope='row' style='padding:5px 10px'>".$row['description']."</td>
                                                 <td scope='row' style='padding:5px 10px'>".$row['withdrew_qty']."</td>
                                                <td scope='row' style='padding:5px 10px'>₱".number_format($row['unitcost'], 2, '.', ',')."</td>
                                              
                                                <td scope='row' style='padding:5px 10px'>₱".number_format($row['totalcost'], 2, '.', ',')."</td>
                                              
                                                </tr>"; 
                                                $i++;
                                            }
                                        }else{
                                            $str=$str.count($row);
                                        }
                                        

                                            
                                        $str=$str."</tbody>
                                    </table>
                                </div>
                        ";
}


$ss= $userClass->sendEmail($subject,$str,$office_email);
                        if($ss==true){
                            return $ss;
                        }else{
                           return true;
                        }

?>
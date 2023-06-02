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

$str =  "<script>console.log('".$office_email."')</script><br>
<h4>Withdrawal Request</h4>
                                <div style='padding:5px 10px; border-top: solid 1px black; border-bottom: solid 1px black;'>
                                <br>
                                <h5><span style='font-weight:400'>Entry Number:</span> #$entry_no</h5>
                                <h5><span style='font-weight:400'>Date Withdraw:</span> $date_m</h5>
                                <br>
                                    <h5>Information Details</h6>
                                    <div style='width:100%; display:flex'>
                                        <div style='padding:0 10px; width:100px'>
                                            <h6 style='font-size:13px'>P.O.N </h6>
                                            <h6 style='font-size:13px'>Supplier </h6>
                                            <h6 style='font-size:13px;' >Date issued </h6>
                                            <h6 style='font-size:13px;' >Office </h6>
                                        </div>
                                        <div style='padding:0 10px; '>
                                        <h6 style='font-size:13px'>: <span id='s_pon' style='font-weight:600'>".$rows[0]['pon']."</span></h6>
                                        <h6 style='font-size:13px'>: <span id='s_supplier' style='font-weight:600'>".$rows[0]['supplier']."</span></h6>
                                        <h6 style='font-size:13px'>: <span id='s_date' style='font-weight:600'></span> ".$rows[0]['date']."</h6>
                                        <h6 style='font-size:13px'>: <span id='s_office' style='font-weight:600'></span> ".$rows[0]['office']."</h6>
                                        </div>
                                    </div>
                                    <div style='padding:5px 10px; border-top: solid 1px black; border-top-style:dashed;'>
                                    <h5>Additional Details</h6>
                                    <div style='width:100%; display:flex'>
                                        <div style='padding:0 10px; width:110px'>
                                            <h6 style='font-size:13px'>End-user</h6>
                                            <h6 style='font-size:13px'>Widthdraw by: </h6>
                                        </div>
                                        <div style='padding:0 10px; width:110px'>
                                            <h6 style='font-size:13px'>".$rows[0]['end_user']."</h6>
                                            <h6 style='font-size:13px'>".$rows[0]['withdraw_by']." </h6>
                                        </div>
                                       
                                    </div>
                                </div>
                                </div>
                                <br>
                                <div style='width:100%; height:500px;padding-top:20px' id='table-items'>
                                <h5>List of Item Details</h5>
                                    <table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width:50px;'>#</th>
                                                <th scope='col'>Description</th>
                                                <th scope='col'>Withdrew <span style='font-weight:400; font-size:15px'>(qty)</span></th>
                                                <th scope='col'>Unit Cost<span style='font-weight:400; font-size:15px'>(per item)</span></th>
                                                <th scope='col'>Total Cost</th>
                                            

                                            </tr>
                                        </thead>
                                        <tbody id='table-datasx'>";

                                        $i=1;

                                        if(count($rows) > 0){
                                            foreach ($rows as $row){
                                                $str=$str."<tr class='s_off'>
                                                <td scope='row'>".$i."</td>
                                                <td scope='row'>".$row['description']."</td>
                                                <td scope='row'>".$row['withdrew_qty']."</td>
                                                <td scope='row'>₱".number_format($row['unitcost'], 2, '.', ',')."</td>
                                                <td scope='row'>₱".number_format($row['totalcost'], 2, '.', ',')."</td>
                                                </tr>"; 
                                                $i++;
                                            }
                                        }else{
                                            $str=$str."<h6>No Data</h6>";
                                        }
                                        

                                            
                                        $str=$str."</tbody>
                                    </table>
                                </div>
                            <div class='modal-footer'>
                            
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        </div>
                        
                        ";




         

echo $str;
?>
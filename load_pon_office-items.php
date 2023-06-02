<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$office = $_POST['office'];
//get offices on pon

$stmt =  "SELECT * FROM remaks where pon = '$pon'";
$users = $con->query($stmt) or die ($con->error);

$stmt1 =  "SELECT * FROM supply_records where purchasedOrderNumber = '$pon' and office = '$office'";
$users1 = $con->query($stmt1) or die ($con->error);

$rows1 = [];
$rows = [];
$check_no_off=false;
if($users1->num_rows > 0){
        $rows1[] =  $users1->fetch_assoc();
} 

if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row;
    } 
    $check_no_off=true;
}else{
    $check_no_off=false;
}

$str =  "
<div style='display:flex; margin-bottom:5px;'>
<div style='width:50%;'>
<h5>Office: <span style='color: rgb(28, 126, 3); font-weight:900;'>$office</h5>
</div>
<div style='width:50%; display:flex; justify-content:flex-end;'>
    <button type='button' class='btn btn-secondary ' onClick='widthdrawHistory(`$pon`)'> Back</button>  
</div>
</div>

</div>

<div id='result'>
    <table class='table'>
        <thead>
            <tr>
            <th scope='col'>Descriptio/Article</th>
            <th scope='col'>Widthdrawal Remarks</th>
            <th scope='col'>Action</th> 
            <th scope='col'>Widthdrawal Action</th>
            </tr>
        </thead>
        <tbody>";
foreach($rows as $row){
        if($row['remarks']=="complete"){
            $rem = "<span style='color:green; font-size:15px; font-weight: 900'>✓ complete</span>";
        }else{
            $rem = "<span style='color:red; font-size:15px; font-weight: 900'> incomplete </span>";
        }
        $str=$str."<tr>
          <td scope='row' style='display:none'>".$row['pon']."</td>
          <td scope='row'>".$row['office']."</td>
          <td scope='row' style='padding-left: 50px;'>".$rem."</td>
          <td> <!-- <button class='btn btn-primary' value='".$row['pon']."' onClick='edit_remarks(this)' style='margin-right:10px'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
          <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
        </svg> Edit Remarks</button> -->
          
          </button><button class='btn btn-secondary' value='".$row['pon']."' onClick='office_details(this)'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
          <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
          <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
        </svg> view items</button>
        </button></td>
        <td>
        <button class='btn btn-success' value='".$row['pon']."' onClick='widthdraw(this)'> widthdraw</button>
       
        </td>
          </tr>";
  
}
            
$str=$str."        
        </tbody>
    </table>";
    if($check_no_off==false){
        $str=$str."<h6>No Data</h6>";
    }
    $str=$str."
</div>
</div>
</div>";
echo $str;
?>
<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];

//get offices on pon

$stmt =  "SELECT * FROM supply_records where pon = '$pon'";
$users = $con->query($stmt) or die ($con->error);

$rows = [];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row;
    } 
}else{
    return false;
}


$str =  "<div>
<h5>Purchased order number: $pon</h5>
</div>
<hr>
<div>
<div><h5>List of offices that requested</h5></div>
<div>
    <table class='table'>
        <thead>
            <tr>
            <th scope='col'>Offices</th>
            <th scope='col'>Widthdrawal remarks</th>
            <th scope='col'>Action</th> 
            </tr>
        </thead>
        <tbody>";
foreach($rows as $row){
  $str=$str."<tr>
    <th scope='row'>".$row['office']."</th>
    <th scope='row'>".$row['remarks']."</th>
    <td><button class='btn btn-primary' value='".$row['pon']."' onClick='office_details(this)'>View Details</button></td>
    </tr>";
}
            
$str=$str."        
        </tbody>
    </table>
</div>
</div>";
echo $str;
?>
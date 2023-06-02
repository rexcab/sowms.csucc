<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];

//get offices on pon

$stmt =  "SELECT * FROM items where pon = '$pon'";
$users = $con->query($stmt) or die ($con->error);
$rows=[];
$str =  "

<table class='table ttable '>
<thead>
    <tr>
        <th scope='col' style='width:50px;'>#</th>
        <th scope='col'>Description</th>
        <th scope='col'>Unit</th>
        <th scope='col'>Qty</th>
        <th scope='col'>Unit cost</th>
        <th scope='col'>Total cost</th>
        <th scope='col'>Office</th>
        <th scope='col'>Action</th>
        <th scope='col' style='display:none'></th>
    </tr>
</thead>
<tbody >
";
$i=1;
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $str=$str."<tr>
        <td scope='row'>".$i."</td>
        <td scope='row'>".$row['description']."</td>
        <td scope='row'>".$row['unit']."</td>
        <td scope='row'>".$row['qty']."</td>
        <td scope='row'>".$row['unitcost']."</td>
        <td scope='row'>".$row['totalcost']."</td>
        <td scope='row'>".$row['office']."</td>
        <td scope='row'>
            <button type='button' class='btn btn-primary'>
            <i class='fa-light fa-pen-to-square fa-sm'></i>
            </button>
            <button type='button' class='btn btn-danger'>
            <i class='fa-solid fa-trash-can-slash fa-sm'></i>
            </button>
        <td scope='row' style='display:none'>".$row['id']."</td>
        </tr>"; 
        $i++;
    }
}else{
    $str=$str."<h6>No Data</h6>";
}


$str=$str."</tbody>
</table>";


         

echo $str;
?>
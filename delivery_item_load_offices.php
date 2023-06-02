<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];

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


$str =  "

<table class='table ttable '>
<thead>
    <tr>
        <th scope='col' style='width:50px;'>#</th>
        <th scope='col'>Office</th>
        <th scope='col'>Total Item</th>
    </tr>
</thead>
<tbody >
";
$i=1;

if(count($rows) > 0){
    foreach ($rows as $row){
        $str=$str."<tr onclick='s_office(this)' class='s_off'>
        <td scope='row'>".$i."</td>
        <td scope='row'>".$row."</td>
        <td scope='row'>".$row." <button type='button' class='btn btn-primary'>
        <i class='fa-light fa-pen-to-square fa-sm'></i>
        </button>
        <button type='button' class='btn btn-danger'>
        <i class='fa-solid fa-trash-can-slash fa-sm'></i>
        </button></td>
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
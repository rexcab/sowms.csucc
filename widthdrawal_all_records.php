<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();

//get offices on pon

$stmt =  "SELECT * FROM widthdraw_history";
$users = $con->query($stmt) or die ($con->error);

$rows = [];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
            $rows[] = $row;
    } 
}else{
    echo "<h4>No data</h4><br>  ";
}


$str =  "
<div>
<h4>Offices that complete widthdrawal</h4>
<br>
<div><h5>List of offices that requested</h5></div>
<div id='result'>
    <table class='table'>
        <thead>
            <tr>
            <th scope='col'>Date Widthdraw</th>
            <th scope='col'>Transaction #</th>
            <th scope='col'>Purchased order number</th>
            <th scope='col'>Offices</th>
            <th scope='col'>Action</th> 
            </tr>
        </thead>
        <tbody>";
foreach($rows as $row){

  $str=$str."<tr>
  
    <td scope='row'>".$row['date']."</td>
    <td scope='row'>".$row['trans_num']."</td>
    <td scope='row'>".$row['pon']."</td>
    <td scope='row'>".$row['office']."</td>
    <td><button class='btn btn-secondary' value='".$row['pon']."' onClick='receipt_details_all(this)'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
    <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
    <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
  </svg> details</button></td>
    </tr>";
}
            
$str=$str."        
        </tbody>
    </table>
</div>
</div>";
echo $str;
?>
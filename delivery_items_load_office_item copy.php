<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$office = $_POST['office'];

//get offices on pon


$rows=[];
$stmt = "SELECT * FROM items where pon = '$pon' and office = '$office'";
$users = $con->query($stmt) or die ($con->error);
$i=1;
$str =  "";


$str =  "
<br>
<h4 class='card-title'>Receiving Items (Arrived)</h4>
<br>
<h5>List of Items</h5>
<br>
<div style='width:100%; height:500px; overflow-y:scroll' id='table-items'>
        <table class='table '>
        <thead>
            <tr>
                <td scope='col'></th>
                <th scope='col' style='width:50px;'>#</th>
                <th scope='col'>Description</th>
                <th scope='col'>Total Qty</th>
                <th scope='col'>Total Arrived</th>
                <th scope='col'>Waiting</th>
                <th scope='col' style='width:300px'>Brand/Model</th>
                <th scope='col'>Qty (Arrived)</th>
                <th scope='col' style='display:none'></th>
                <th scope='col' style='display:none'></th>
                <th scope='col'>Status</th>
            </tr>
        </thead>
        <tbody id='table-datas'>
        ";


        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $str=$str."<tr>";
                if($row['arrived_status']=="complete")
                $str=$str."<td scope='row'></td>";
        else
                $str=$str."<td scope='row'><input class='form-check-input' type='checkbox' value='' id='flexCheckDefault' onclick='check_item(this)'></td>";
        
        
                $str=$str." 
                    <td scope='row' style='width:50px;'>".$i."</td>
                    <td scope='row'>".$row['description']."</td>
                    <td scope='row'>".$row['qty']."</td>
                    <td scope='row'>".$row['arrived']."</td>
                    <td scope='row'>".$row['waiting']."</td>
                    <td scope='row'><input type='text' placeholder='enter brand/model' style='display:none'></td>
                    <td scope='row' style='width:190px'>
                        <span class='center' style='width: 150px; margin: 40px auto; display:flex; margin:inherit; display:none'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-danger btn-number minus'  data-type='minus' onclick='minus(this)' data-field='quant[2]' >
                                    <i class='fa-solid fa-minus'></i>
                                </button>
                            </span>
                            <input type='number' name='quant[2]' class='form-control input-number' value='0' min='1' max='100' style='padding:5px'>
                            <span class='input-group-btn'>
                                <button type='button' class='btn btn-success btn-number' data-type='plus' onclick='plus(this)' data-field='quant[2]' >
                                    <i class='fa-solid fa-plus'></i>
                                </button>
                        </span>
                    </td>
                    <td scope='row' style='display:none'><input type='hidden' value='".$row['id']."'></td>
                    <td scope='row' style='display:none'><input type='hidden' value='".$row['unitcost']."'></td>";
                    if($row['arrived_status']=="complete")
                            $str=$str." <td scope='row' style='color:green; font-size:15px; font-weight:700'>".$row['arrived_status']."</td>";
                    else
                            $str=$str." <td scope='row' style='color:red; font-size:15px; font-weight:700'>".$row['arrived_status']."</td>";
                    
                    
                            $str=$str." </tr>"; 
                    $i++;
            }
        }

        $str=$str."</tbody>
        </table>
        

</div>
<hr>         
<div style='width:100%; height:100px;' >
   
   <button class='btn btn-primary' style='float:right' onclick='proceed()'>Proceed</button>
</div>";


echo $str;
?>
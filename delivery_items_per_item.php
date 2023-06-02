<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/


$str =  "
<div class='card' style='width:100%; height:500px; margin: 0'>
    <div class='card-body'>
        <div >
            <h5 class='card-title' style='float:left'>List of all items arrived</h5>
            <button type='button'  style='float:right' class='btn btn-primary '  onclick='per_item_add()'> Add</button>
        </div>
        <br>
        <br>
        <div>
            <table class='table ttable '>
                <thead>
                    <tr>
                        <th scope='col' style='width:50px;'>#</th>
                        <th scope='col'>P.O.N</th>
                        <th scope='col'>Description</th>
                        <th scope='col'>Brand/Model</th>
                        <th scope='col'>Item arrived</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody >
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tbody>
            </table>
        </div>

    </div>
</div>



";
$i=1;
/*
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
*


$str=$str."</tbody>
</table>";
*/

         

echo $str;
?>
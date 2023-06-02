<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/


$str =  "<div class='right-content' style='width:300px; '>
            <div class='card' style='width: 100%;'>
                <div class='card-body'>
                    <div style='padding:20px 0'>
                        <input type='text' class='form-control rounded ss' name='search_text' id='search_text'  placeholder='Search purchase order number' aria-label='Search'
                                    aria-describedby='search-addon' style='width:100%;'/>
                    </div>
                    <div class='tops' style='display:BLOCK' >
                            <h6 style='margin-top:5px;'>List of Purchased Number</h6>
                    </div>
                        <div id='result_pon' style='height: 600px;'>
                            <table class='table' >
                                <thead class='table'>
                                    <tr>
                                        <th >#</th>
                                        <th >Purchased Order Number</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                            </tbody>         
                        </table>   
                    </div>
                </div>
            </div>
        </div>
        <div class='in-right-content' style='width: 68%; margin: 0 0 0 10px'>
           
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
<?php

require_once('msql.php');

$vars = $userClass->getListItems();
$str='';         

if($vars==''){ 
    $str=""; 
}else{  
    $i=1;
    foreach($vars as $var){ 
        $str=$str."
    <tr class='tr_id' onclick='therow(this)'>
        <td style='font-size: 14px;'> $i</td>
        <td style='font-size: 14px;'>".$var['description']."</td>
        <td style='font-size: 14px;'>".$var['date_added']."</td>
        <td style='font-size: 14px;'><button class='btn btn-primary'>Update</td>
    </tr>";
   
    
    
    $i++;
}}

echo $str?>
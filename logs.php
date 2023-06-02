<?php 

require_once("msql.php");
$con=$userClass->connection();

//get offices on pon

$rows=[];
$stmt = "SELECT * FROM logs ";
$users = $con->query($stmt) or die ($con->error);
$vars=[];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
       $vars[] = $row;
    }
   
}


$str= "
<div>
                <ul class='nav nav-tabs'>
                <li class='nav-item'>
                    <a class='nav-link ' onclick='ch(0)' href='#'>Account</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' onclick='ch(1)' href='#'>View Logs</a>
                </li>
                <li class='nav-item'>
                <a class='nav-link' onclick='ch(2)' href='#'>Administrator Email</a>
            </li>
                </ul>
            </div>
            <!--------------->

            <div style='width:100%'>

                
                <br>
                <div style='width:100%'>
                <table class='table ttable' >
                        <thead class='table'>
                                    <tr>
                                        <th style='width:50px'>#</th>
                                        <th >Event</th>
                                        <th >Fullname</th>
                                        <th >Username</th>
                                        <th >Date </th>
                                    </tr>
                                    </thead>
                                    <tbody>";

                                   if($vars==false){ 
                                     
                                
                                    }else{                        
                                    $i=1;
                             
                                    foreach($vars as $var){
                                       
                                        
                                        $str=$str." <tr>
                                            <td style='font-size: 14px;'>".$i."</td>
                                            <td style='font-size: 14px;'>".$var['event']."</td>
                                            <td style='font-size: 14px;'>".$var['name']."</td>
                                            <td style='font-size: 14px;'>".$var['username']."</td>
                                            <td style='font-size: 14px;'>".$var['date']."</td>
                                            </tr>";
                                           
                                            $i++;
                                        }
                                    
                                   
                                    } 

                                    $str=$str."
                                    </tbody>         
                                </table>   
            </div> 
                </div>
             
                
                   
            <!--------------->
";
echo $str;
?>
<?php 

require_once("msql.php");


if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['accesstype'])){ 
  if($_SESSION['accesstype']==""){
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['isername']);
    unset($_SESSION['accesstype']);
    
    header("Location: Location: index.php");
    die();}
}else{header("Location: index.php");}

$con=$userClass->connection();
$vars= $userClass->getTransArrived();
$sessionValue = $_SESSION['name'];

?>



<!DOCTYPE html>
<html lang="en">

                  
                            <?php
                            
                            if($vars==""){ 
                                echo ""; 
                            }else{  
                                
                                
                                $i=1;
                                foreach($vars as $var){ 
                                

                                   ?>
                                   
                                <tr id='hh' class='<?php echo "s".$i; ?>' >
                                    <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['type']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['entry_no']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                                    <td style="font-size: 14px;"><button class="btn btn-secondary" onclick='details(this)'>Details</button></td>
                                    <td style="font-size: 14px;">
                                    <?php if($var['status']=="Sent"){
                                            echo "<div><div style='background-color: #28a745; font-family: Helvetica Neue, sans-serif;
                                            font-size: 15px; font-weight: bold; color: #fff;padding: 2px 7px;  border-radius: 19px; width:80px;
                                            '><i class='fa-solid fa-check fa-xs' style='padding:0 5px'></i>Sent</div><div>".$var['sent_date']."</div></div>";
                                          }else{
                                            echo "<div style='background-color: #ffc107; font-family: Helvetica Neue, sans-serif;
                                            font-size: 13px; font-weight: bold;padding: 5px 10px;  border-radius: 19px; width:100px;
                                            '><i class='fa-solid fa-timer fa-xs' style='color: #ffffff;padding:0 5px'></i>Pending</div>";
                                          }
                                    ?>
                                  
                                    </td>
                                   
                                    <td style="font-size: 14px; ">
                                        <?php if($var['status']=="Sent"){
                                               
                                            }else{
                                                echo "<button type='button' class='btn btn-primary' id='r-send' onclick='send_modal(this)' >
                                                Send
                                              </button>";
                                            }
                                        ?>
                                    </td>
                                    <td style="display:none"><?php $stmts = "SELECT * FROM offices where office_name = '".$var['office']."'";
                                              $userss = $con->query($stmts) or die ($con->error);
                                              $office_email = $userss->fetch_assoc();
                                              $office_email = $office_email['office_email'];
                                              echo $office_email;
                                    ?></td>
                                </tr>
                                <?php 
                               
                                
                                $i++;
                            }} ?>
                          
</html>


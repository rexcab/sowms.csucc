<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}
$vars = $userClass->getListItems();
$pon = $_POST['pon'];
?>



<!DOCTYPE html>
<html lang='en'>

<body>


                
                <div style='display:flex'>
                    <div class='card' style='width: 50%; margin-right:10px'>
                        <div class='card-body'>
                             
                         
                            <div>
                            <table class='table ttable' >
                                
                                    <thead>
                                        <th style="font-size:18px">Item Description</th>
                                        <th style='display:none'></th>
                                        <th style='display:none'></th>
                                    </thead>
                                    <tbody id='select-item-right'>
                                    <?php
                                        
                                        if($vars==""){ 
                                            echo ""; 
                                        }else{  
                                            
                                            
                                            $i=1;
                                            foreach($vars as $var){ 
                                            ?>
                                        <tr onclick="tr(this)" id="<?php echo "ss".$i; ?>">
                                            <td style='display:none'><?php echo $var['id'] ?></td>
                                            <td><?php echo $var['description']; ?></td>
                                            <td style='display:none'><?php echo $i ?></td>
                                        </tr>
                                        
                                      <?php $i++; }
                                      } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                    <div class='card' style='width: 50%'>
                        <div class='card-body'>
                        <div class='tops' style='display:FLEX' >
                                <h6>Purchased Order Number: <?php echo $pon; ?></h6>
                            </div>
                            <hr>
                            <h5 class='card-title'>Selected Items</h5>
                            <br>
                            <div class="s-item">
                                <ul class="list-group" id="s_i">
                                  
                                </ul>
                            </div>
                            <br>
                            
                        </div>
                        <div style="padding:0px 20px 10px 0">
                            <button class="btn btn-primary" style='float:right' onclick=" procced_to_select_office()">Proceed</button>
                        </div>
                        
                    </div>
                </div>
               
</body>
</html>
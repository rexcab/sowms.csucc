<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}

$vars = $userClass->getPON();

$select_item =  array_reverse($_POST['select_item']);
$select_item_index =array_reverse($_POST['select_item_index']);
$vars_office = $userClass->getOffices();
$pon = $_POST['pon'];
?>



<!DOCTYPE html>
<html lang='en'>

                
                <div style='display:flex'>
                    
                
                    <div class='card' style='width: 100%'>
                        <div class='card-body'>
                        <div class='tops' style='display:FLEX' >
                                <h6>Purchased Order Number: <?php echo $pon; ?></h6>
                            </div>
                            <hr>
                            <h5 class='card-title'>Select Office</h5>
                            <br>
                            <div class="s-item">
                                <table class="table table-bordered">
                                    <thead class='table '>
                                        
                                            <th>Item name & description</th>
                                            <th>Office</th>
                                           
                                    </thead>
                                    <tbody>
                                    <?php
                                        
                                        if($select_item==""){ 
                                            echo ""; 
                                        }else{  
                                            
                                            
                                            $i=1;
                                            foreach($select_item as $var){ 
                                            ?>
                                        <tr>
                                            <td style="width:300px;font-size:17px"><?php echo $var; ?></td>
                                          
                                            <td >
                                           
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="multiSelectDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Items
                                                </button>
                                               
                                                <div class="dropdown-menu" aria-labelledby="multiSelectDropdown">
                                                    <?php foreach($vars_office as $office){ ?>
                                                    <a class="dropdown-item">
                                                    <input type="checkbox"  value="<?php echo $office['office_name']; ?>">
                                                    <span for="<?php echo $office['office_name']; ?>"><?php echo $office['office_name']; ?></span>
                                                    </a>
                                                 <?php }?>
                                                </div>


                                            <!--<button class="btn btn-success btn-sm">Select Office </button>-->
                                            </td>
                                        </tr>
                                        <?php }
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            
                        </div>
                        <div style="padding:0px 20px 10px 0">
                            <button class="btn btn-primary" onclick="proceed_sort()" style='float:right'>Proceed</button>
                        </div>
                        
                    </div>
                </div>
           

</body>
</html>
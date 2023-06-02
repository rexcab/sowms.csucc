<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}


$tablecount = $_POST["tablecount"];
$office_and_item_row = $_POST["office_and_item_row"];
$input_description = $_POST["input_description"];
$unit = $_POST["unit"];
$qty = $_POST["qty"];
$u_price = $_POST["u_price"];
$t_price = $_POST["t_price"];

$temp = 0;

?>

                
        <div class='card' style='width: 100%'>

            <div class='card-body'>

                <div class='tops' style='display:FLEX' >
                    <h4>Information Details</h4>
                </div>
                <br>
                <div style="margin-left: 10px; display: flex">
                    <div style="width:210px">
                    <h6 style="font-weight: 400;">Purchased Order Number:</h6>
                    <h6 style="font-weight: 400;">Supplier:</h6>
                    <h6 style="font-weight: 400;">Date Issued:</h6>
                    </div>
                    <div>
                    <h6><?php echo $_POST["pon"]; ?></h6>
                    <h6><?php echo $_POST["supplier"]; ?></h6>
                    <h6><?php echo $_POST["date"]; ?></h6>
                    </div>
                    
                </div>
                    
                
                    <hr>
                    <div style="width:100%; margin-bottom:42px">
                        <h5 style="float:right">Total of Office : <?php echo $tablecount; ?></h5>
                    </div>
                    
                    <div id='result_pon' style=''>

                    <?php 
                    
                        for($j=0;$j<$tablecount;$j++){  ?>


                        <table class='table table-bordered' >
                            <thead class='table'>
                                <tr>
                                    <th colspan="10" style="font-size:20px"><?php echo $office_and_item_row[$j][0]; ?> </th>
                                </tr>
                                <tr>
                                    <th>Item name/Description</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Unit Price (₱)</th>
                                    <th>Total Price (₱)</th>
                                </tr>
                                </thead>
                            <tbody>
                                
                            <?php  for($w=0;$w<$office_and_item_row[$j][1];$w++){
                                $vv = $w+$temp; ?>
                                <tr>
                                    <td class="description" style="width:300px;font-size:15px"><?php echo $input_description[$vv] ; ?></td>
                                    <td><?php echo $unit[$vv]?></td>
                                    <td><?php  echo $qty[$vv]; ?></td>
                                    <td><?php echo "₱".number_format($u_price[$vv], 2, '.', ','); ?></td>
                                    <td><?php echo $t_price[$vv]; ?></td>
                                </tr>
                                
                                <?php } $temp = $vv+1;
                                ?>
                            </tbody>    
                        </table> 
                        <?php } ?>
                        
                    </div>
                    <br>
                    
            </div>
        </div>

              

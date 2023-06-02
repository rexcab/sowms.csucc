<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}


$uniq_office = $_POST["uniq_office"];
$sorted_items = $_POST["sorted_items"];
$pon = $_POST['pon'];



?>



<!DOCTYPE html>
<html lang='en'>


<img src='loading.gif' id='load-gif' style="height:100px; width:100px; position:absolute; display: none ;margin:10% 0 0 45%; "> 
                    <div class='card' style='width: 100%'>

                        <div class='card-body'>

                            <div class='tops' style='display:FLEX' >
                                <h6>Purchased Order Number: <?php echo $pon; ?></h6>
                            </div>
                                <br>
                             
                                <div id='result_pon' style=''>

                                <?php 
                             
                                 for($j=0;$j<count($uniq_office);$j++){  ?>


                                    <table class='table table-bordered' >
                                        <thead class='table'>
                                            <tr>
                                                <th colspan="10" style="font-size:20px"><?php echo $uniq_office[$j]; ?> </th>
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
                                            
                                      <?php  for($w=0;$w<count($sorted_items[$j]);$w++){  ?>
                                            <tr>
                                                <td class="description" style="width:300px;font-size:15px"><?php echo $sorted_items[$j][$w]; ?></td>
                                                <td>
                                                    <select class="form-select unit" aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qtyy(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)" required></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled required></input></td>
                                            </tr>
                                           
                                         <?php } ?>
                                        </tbody>    
                                    </table> 
                                    <?php } ?>
                                    <button type="button" class="btn btn-primary" onclick="review(this)">Review</button>
                                </div>
                                <br>
                                
                        </div>
                    </div>

              

</html>

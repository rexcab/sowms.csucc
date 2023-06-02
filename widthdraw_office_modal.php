<?php

/*** 
$connect = $mysqli_connect("localhost", "root", "", "whelis");
*/
require_once("msql.php");
$con=$userClass->connection();
$pon = $_POST['id'];
$office = $_POST['office'];
//get offices on pon

$stmt =  "SELECT * FROM supply_records where purchasedOrderNumber = '$pon' and office = '$office' ";
$users = $con->query($stmt) or die ($con->error);

$rows = [];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
        $rows[] = $row;
    } 
}else{
    return false;
}
function peso($t){
    $n = number_format($t);
    $whole = $t-floor($t); 
    $whole = substr($whole, 2, 2);
    if(!$whole){
        $whole="00";
    }
    $t = $n.".".$whole;
    return $t;
}

$str =  "
<div >
<div style='
background: #f1f1f1;
border: 1px solid black;'>
<div><h5>Item List Available</h5></div>
<div>
    <table class='table'>
        <thead>
            <tr>
            <th scope='col'>Articles</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Unit cost</th>
            <th scope='col' style='color: #3ac500'>Available Qty</th>
            <th scope='col' style=''>Qty</th>
            <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody >";
        $z=1;
foreach($rows as $row){
  $str=$str."<tr>
  <td style='display:none'><input value='$z'></td>
    <td >".$row['articles']."</td>
    <td >".$row['unit']."</td>
    <td >".$row['unitcost']."</td>
    <td scope='row'>".$row['qty_available']."</td>
    <td ><input type='number' placeholder='enter quantity' /></td>
    <td ><button type='button' class='btn btn-primary supply_items'  onClick='add_item(this)'>ADD</button></td>
        </tr>";
        $z++;
}
            
$str=$str."        
        </tbody>
    </table>
</div>
</div>
<br>
<br>
<div style='
background: #f1f1f1;
border: 1px solid black;'>
<table class='table table-dark'>
<th><h5>Widthdrawal Request</h5></th>
</table>

<br>
<div style='display:flex'>
<h5>P.O.N. : <input type='text' name='pon' readonly value='$pon' style='margin-right:20px;' /></h5>
<h5>Office: <input type='text' name='office' style='margin-right:20px;' readonly value='".$rows[0]['office']."'/></h5>
<h5>Supplier: <input type='text' name='supplier' style='margin-right:20px;' readonly value='".$rows[0]['supplier']."'/></h5>
</div>
<div style='display:flex'>
<h5>End-user : 
    <select class='form-select' aria-label='Default select example' id='enduser' onclick='thew(this)' name='enduser' required>
    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>CEIT</option>
    <option value='Cuarez, Ryan O'>Cuarez, Ryan O</option>
    <option value='Monzon, Ronald A.'>Monzon, Ronald A.</option>
    <option value='Rayno, Neil E.'>Rayno, Neil E.</option>
    <option value='Vergara, Thesa Ll.'>Vergara, Thesa Ll.</option>
    <option value='Vergara, Japeth Jay O.'>Vergara, Japeth Jay O.</option>
    <option value='Vistal, Joseph A.'>Vistal, Joseph A.</option>

    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>CITTE</option>
    <option value='Alan, Frank Aiken'>Alan, Frank Aiken</option>
    <option value='Arante, Ramil B., Ph.D.'>Arante, Ramil B., Ph.D.</option>
    <option value='Aroy, Vicardo J.'>Aroy, Vicardo J.</option>
    <option value='Beray, Marisol Jane M.'>Beray, Marisol Jane M.</option>
    <option value='Biongcog, Jona J., Ph.D.'>Biongcog, Jona J., Ph.D.</option>
    <option value='Biongcog, Ronilo P.'>Biongcog, Ronilo P.</option>
    <option value='Cabonce, Cora B.'>Cabonce, Cora B.</option>
    <option value='Cuyag, Marlon B.'>Cuyag, Marlon B.</option>
    <option value='Daminar, Nathalie'>Daminar, Nathalie</option>
    <option value='Delima, Leonilo M.'>Delima, Leonilo M.</option>
    <option value='Tadal, Cecilia H. PH.Ed.D'>Tadal, Cecilia H. PH.Ed.D</option>
    <option value='Vargas, Demie Grace'>Vargas, Demie Grace</option>
    <option value='Yatan, Joseph S.'>Yatan, Joseph S.</option>

    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>CTHM</option>
    <option value='Delima. Cecilia H. Ph. Ed.D'>Delima. Cecilia H. Ph. Ed.D</option>
    <option value='Fong, Kimberly C.'>Fong, Kimberly C.</option>
    <option value='Gregorio, Alecris V.'>Gregorio, Alecris V.</option>
    <option value='Niñofranco, Earl G.'>Niñofranco, Earl G.</option>
    <option value='Rodas, Erlin S.'>Rodas, Erlin S.</option>
    <option value='Serrano, Ma. Jovita C.'>Serrano, Ma. Jovita C.</option>

    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>CBA</option>
    <option value='Castillon, Maria Tita C.'>Castillon, Maria Tita C.</option>
    <option value='Dacanay, Sonny T.'>Dacanay, Sonny T.</option>
    <option value='Juera, Walter B.'>Juera, Walter B.</option>

    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>DGE</option>
    <option value='Alburo, Flordeliza G., Ph.D'>Alburo, Flordeliza G., Ph.D</option>
    <option value='Anunciado, Japhet D.'>Anunciado, Japhet D.</option>
    <option value='Bermudez, Alma Ligaya A.'>Bermudez, Alma Ligaya A.</option>
    <option value='Fong, Ryan Chester G.'>Fong, Ryan Chester G.</option>
    <option value='Monteclaro, Mildred L.'>Monteclaro, Mildred L.</option>
    <option value='Montola, Maria Annie B.'>Montola, Maria Annie B.</option>
    <option value='Sevilla, Alvin M.'>Sevilla, Alvin M.</option>

    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'>ADMINISTRATIVE SERVICES</option>
    <option value='Alipao, Elmer A.'>Alipao, Elmer A.</option>
    <option value='Arante, Milagros C.'>Arante, Milagros C.</option>
    <option value='Fornillos, Geneveve C.'>Fornillos, Geneveve C.</option>
    <option value='Fundalan, Rameir D.'>Fundalan, Rameir D.</option>
    <option value='Ilustrisimo, Roxan M.'>Ilustrisimo, Roxan M.</option>
    <option value='Mortola, Cyril Judah G.'>Mortola, Cyril Judah G.</option>
    <option value='Niñofranco, Ma. Eunice A.'>Niñofranco, Ma. Eunice A.</option>
    <option value='Puno, Romeo M.'>Puno, Romeo M.</option>
    <option value='Vergara, Thesa Ll.'>Vergara, Thesa Ll.</option>
    <option disabled = true style='background: #afafaf;color: white;font-weight: bold;'></option>
    <option value='other'>Other</option>
    </select>
</h5>
<h5>Widthdraw by : <input type='text' style='margin-left:20px;' class='form-control' id='withdrawby' name='withdrawby' placeholder='Enter withdraw by' required></h5>
<h5 style='margin-left:20px;'>Date Widthdraw : 
    <div class='row form-group'  >
         <input type='date'  style='margin-left:30px;'class='form-control' id='datewithdraw' name='datewithdraw' required >
    </div>
</h5>
</div>
<div >
    <table class='table'>
        <thead>
            <tr>
            <th >Qty</th>
            <th >Unit</th>
            <th >Articles</th>
            <th >Unit cost</th>
            <th >Total cost</th>
            <th >Action</th>
            </tr>
        </thead>
        <tbody class='place_widthdraw'>
        </tbody>
    </table>


</div></div></div>
</form>
";
echo $str;
?>
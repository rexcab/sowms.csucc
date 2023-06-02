<?php


require_once("msql.php");
$con=$userClass->connection();

$a = $_POST['pon'];
$b = $_POST['office'];
$c = $_POST['supplier'];
$d = [];
$e = [];
$f = [];
$g = [];
$h = [];
$i = [];
$j = []; 
$k =  [];



$a = $_POST['pon'];
$b = $_POST['office'];
$c = $_POST['supplier'];
$d = $_POST['item_id'];
$e = $_POST['arr_qty'];
$f = $_POST['arr_u_price'];
$g = $_POST['arr_t_price'];
$h = $_POST['waiting_qty'];
$i = $_POST['brand_item'];
$j = $_POST['date'];
$k = $_POST['description'];
//get offices on pon
//echo "<script>".count($d)."</script>";
$in = 0;
$check = "";
foreach($d as $row){

    $stmt =  "SELECT * FROM items WHERE id = '".$d[$in]."'";
    $users = $con->query($stmt) or die ($con->error);
    $item ="";
    if($users->num_rows > 0){
        while ($row = $users->fetch_assoc()){
            $item = $row;
        }
    }
    
    $item_a =  intval($item['arrived'])+ intval($e[$in]);
    $item_t =  intval($item['waiting']) -  intval($e[$in]); 
    $item_s =  intval($item['stock']) + intval($e[$in]); 

    $sql = "UPDATE items SET waiting = '$item_t', arrived = '$item_a', brand = '".$i[$in]."', stock = '$item_s' WHERE id = '".$d[$in]."'";
   
    if($con->query($sql) == true){
        $check =  true;
    }else{
        $check = $check+false." ".die($con->error);
    }
$in++;
}





$in = 0;

if($check==true){

   for($in=0; $in<count($d); $in++){
        $ids = date("YmdHis"); // returns the current date and time in the format "YYYYMMDDHHMMSS"
        $ids = substr($ids, -8); // takes the last 8 digits of the string
        if( intval($h[$in])==0){
            $sqlQ = "UPDATE items SET arrived_status = 'complete' WHERE id = '".$d[$in]."' ";
            $usersQ = $con->query($sqlQ) or die ($con->error);
        }
        

        $sql= "INSERT INTO `trans_arrived`(`entry_no`, `pon`,`office`,`supplier`,`date`, `description`, `unitcost`, `arrived` ,`totalcost`, `waiting`,`brand`,`status`,`type`  ) VALUES ('$ids','$a','$b','$c','$j','$k[$in]','$f[$in]','$e[$in]','$g[$in]','$h[$in]','$i[$in]','Pending','Arrived')";

        if($con->query($sql) == true){
            $check =  true;
        }else{
            $check = $check+false." ".die($con->error);
        }
    
    }
    
}

if($check== true){
    echo true;
}else{
    echo $check;
}
/*
<?php


require_once("msql.php");
$con=$userClass->connection();
$a = $_POST['pon'];
$b = $_POST['office'];
$c = $_POST['supplier'];
$d = $_POST['item_id'];
$e = $_POST['arr_qty'];
$f = $_POST['arr_u_price'];
$g = $_POST['arr_t_price'];
$h = $_POST['waiting_qty'];
$i = $_POST['brand_item'];
$j = $_POST['date'];
$k = $_POST['description'];
//get offices on pon
//echo "<script>".count($d)."</script>";
$in = 0;
$check = "";


foreach($d as $row){

    $stmt =  "SELECT * FROM items WHERE id = '".$d[$in]."'";
    $users = $con->query($stmt) or die ($con->error);
    $item ="";
    if($users->num_rows > 0){
        while ($row = $users->fetch_assoc()){
            $item = $row;
        }
    }
    
    $item_a = $item['arrived']+$e[$in];
    $item_t = $item['waiting'] - $e[$in]; 

    $sql = "UPDATE items SET waiting = '$item_t', arrived = '$item_a', brand = '".$i[$in]."' WHERE id = '".$d[$in]."'";
   
    if($con->query($sql) == true){
        $check =  true;
    }else{
        $check = $check+false." ".die($con->error);
    }
$in++;
}





$in = 0;

if($check==true){

   for($in=0; $in<count($d); $in++){
        $ids = date("YmdHis"); // returns the current date and time in the format "YYYYMMDDHHMMSS"
        $ids = substr($ids, -8); // takes the last 8 digits of the string
        
        $sqlz = "SELECT * FROM items WHERE id='".$d[$in]."'";
        $userz = $con->query($sqlz) or die ($con->error);
        $rowz = $userz->fetch_assoc();
        
        $tz = $h[$in]-$e[$in];
        if($tz==0){
            $sqltz = "UPDATE items SET arrived_status = 'complete' WHERE id='".$d[$in]."'";
            $con->query($sqlz) or die ($con->error);
        }

        $sql= "INSERT INTO `trans_arrived`(`entry_no`, `pon`,`office`,`supplier`,`date`, `description`, `unitcost`, `arrived` ,`totalcost`, `waiting`,`brand`  ) VALUES ('$ids','$a','$b','$c','$j','$k[$in]','$f[$in]','$e[$in]','$g[$in]','$h[$in]','$i[$in]')";
        if($con->query($sql) == true){
            $check =  true;
        }else{
            $check = $check+false." ".die($con->error);
        }
    
    }
    
}

if($check== true){
    echo true;
}else{
    echo $check;
}



?>
*/

?>
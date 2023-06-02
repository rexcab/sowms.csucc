<?php


require_once("msql.php");
$con=$userClass->connection();


$g = [];
$h = [];
$i = [];
$j = []; 
$k =  [];
$l =  [];
$m =  [];

///
$a = $_POST['pon'];
$b = $_POST['office'];
$c = $_POST['supplier'];
$d = $_POST['date'];
$e = $_POST['widthdraw_by'];
$f = $_POST['end_user'];

//array

$g = $_POST['item_id'];
$h = $_POST['description'];
$i = $_POST['u_price'];
$j = $_POST['w_qty'];
$k = $_POST['t_price'];
$l = $_POST['remaining'];
$m = $_POST['brand'];
$n = $_POST['unit'];
//get offices on pon
//echo "<script>".count($d)."</script>";
$in = 0;
$check = "";
foreach($g as $row){

    $stmt =  "SELECT * FROM items WHERE id = '".$g[$in]."'";
    $users = $con->query($stmt) or die ($con->error);
    $item ="";
    if($users->num_rows > 0){
        while ($row = $users->fetch_assoc()){
            $item = $row;
        }
    }
    
    $item_a =  intval($item['withdrew']) + intval($j[$in]);
    $item_t =  intval($item['remaining']) -  intval($j[$in]); 
    $item_s =  intval($item['stock']) - intval($j[$in]); 

    $sql = "UPDATE items SET remaining = '$item_t', withdrew = '$item_a',  stock = '$item_s' WHERE id = '".$g[$in]."'";
   
    if($con->query($sql) == true){
        $check =  true;
    }else{
        $check = $check+false." ".die($con->error);
    }
$in++;
}





$in = 0;

if($check==true){
   for($in=0; $in<count($g); $in++){
        $ids = date("YmdHis"); // returns the current date and time in the format "YYYYMMDDHHMMSS"
        $ids = substr($ids, -8); // takes the last 8 digits of the string
       /* if( intval($item_t[$in])==0){
            $sqlQ = "UPDATE items SET withdraw_status = 'complete' WHERE id = '".$g[$in]."' ";
            $usersQ = $con->query($sqlQ) or die ($con->error);
        }*/

        $sql= "INSERT INTO `trans_arrived`(`entry_no`, `pon`,`office`,`supplier`,`date`,`withdraw_by`,`end_user`, `description`, `unitcost`, `withdrew_qty` ,`totalcost`, `remaining`,`brand`,`status`,`type`,`unit`) 
        VALUES ('$ids','$a','$b','$c','$d','$e','$f','$h[$in]','$i[$in]','$j[$in]','$k[$in]','$l[$in]','$m[$in]','Pending','Withdrawal','$n[$in]')";

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
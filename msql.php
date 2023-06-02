<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';

class myClass{
    
    private $server = "localhost";
    private $user = "root";
    private $pass = "";
    private $database = "sowms";
    protected $con;

    public function connection()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        try{
            $this->con = new mysqli($this->server, $this->user, $this->pass, $this->database);
            return $this->con;
        }catch(Exception $e){
            $error = $e->getMessage();
            echo $error;
        }
    }

    public function closeConnection()
    {
        $this->con = null;
    }

 
/*********************************************************************************************/


public function getRecords()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM records";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }
    public function getTransArrived()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM trans_arrived";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        $n_rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['entry_no'];
            }
            $rows = array_unique($rows); 

            foreach($rows as $row){
                $stmt =  "SELECT * FROM trans_arrived where entry_no = '$row' ORDER BY date_added DESC";
                $users = $con->query($stmt) or die ($con->error);
                while($rr = $users->fetch_assoc()){
                    $n_rows[] = $rr;
                    break;
                }
            }
            return $n_rows;
        }
        else{
            return $n_rows;
        }
    }
    public function getAllEntries($type)
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM trans_arrived";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        $n_rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['entry_no'];
            }
            $rows = array_unique($rows); 

            foreach($rows as $row){
                $stmt =  "SELECT * FROM trans_arrived where entry_no = '$row' AND type = '$type' ORDER BY date_added DESC  ";
                $users = $con->query($stmt) or die ($con->error);
                while($rr = $users->fetch_assoc()){
                    $n_rows[] = $rr;
                    break;
                }
            }
            return $n_rows;
        }
        else{
            return $n_rows;
        }
    }
////////////////////////////////////////
public function getWithdrawStatus($type)
{  
        $con = $this->connection();
        $stmt =  "SELECT * FROM items";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        $n_rows = [];

        $count=0;
        if($users->num_rows > 0){

            //get pon number
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['pon'];
            }
            $rows = array_unique($rows); 


            foreach($rows as $row){
                //get items per pon
                $stmtq = "SELECT * FROM items where pon = '$row' ";
                $usersq = $con->query($stmtq) or die ($con->error);
                
                //get list offices of PON
                if($usersq->num_rows > 0){
                    while ($rowq = $usersq->fetch_assoc()){
                        $rowsq[] = $rowq['office'];
                    }
                }

                $rowsq = array_unique($rowsq); 
                
                //check items if withdrew all per office of a PON
                
                foreach($rowsq as $office){
                    $ch=false;
                    $stmtz =  "SELECT * FROM items where pon = '$row' and office = '$office'";
                    $usersz = $con->query($stmtz) or die ($con->error);

                    while($rr = $usersz->fetch_assoc()){
                        if($rr['withdraw_status']!="$type"){
                            goto x;
                        }else{
                            if($rr['withdraw_status']=="$type"){
                                $ch=true;
                                
                              
                            }
                        }
                        
                    }
                    x:
                    if($ch==true){
                       $count++;
                    }
                 
                }
                    
                    
            }
            return $count;
        }
        else{
            echo 0;
        }

}








    /////////////////////////////
    public function getAllEntries_emailStatus($x)
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM trans_arrived";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        $n_rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['entry_no'];
            }
            $rows = array_unique($rows); 

            foreach($rows as $row){
                $stmt =  "SELECT * FROM trans_arrived where entry_no = '$row' AND status = '$x' ORDER BY date_added DESC  ";
                $users = $con->query($stmt) or die ($con->error);
                while($rr = $users->fetch_assoc()){
                    $n_rows[] = $rr;
                    break;
                }
            }
            return $n_rows;
        }
        else{
            return $n_rows;
        }
    }
    public function getAllEntries_emailStatusType($x,$type)
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM trans_arrived";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        $n_rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['entry_no'];
            }
            $rows = array_unique($rows); 

            foreach($rows as $row){
                $stmt =  "SELECT * FROM trans_arrived where entry_no = '$row' AND status = '$x' AND type = '$type' ORDER BY date_added DESC  ";
                $users = $con->query($stmt) or die ($con->error);
                while($rr = $users->fetch_assoc()){
                    $n_rows[] = $rr;
                    break;
                }
            }
            return $n_rows;
        }
        else{
            return $n_rows;
        }
    }
    public function addPON(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['p_pon']);
        $b = mysqli_real_escape_string($con,$_POST['p_supplier']);
        $c = mysqli_real_escape_string($con,$_POST['p_date']);
        
        $stmt =  "SELECT * FROM pon WHERE pon = $a";
        $users = $con->query($stmt) or die ($con->error);
        if($users->num_rows > 0){
           echo 2;
        }else{
            $sql= "INSERT INTO `pon`(`pon`,`supplier`,`date`) VALUES ('$a','$b','$c')";

            if($con->query($sql) == true){
               echo 1;
            }else{
                
                echo die($con->error);
            } 
        }

    }
    public function updatePON(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['p_pon']);
        $b = mysqli_real_escape_string($con,$_POST['p_supplier']);
        $c = mysqli_real_escape_string($con,$_POST['p_date']);
        $d = mysqli_real_escape_string($con,$_POST['cur_pon']);
        
        if($a==$d){
            $sql = "UPDATE pon SET  supplier = '$b' , date = '$c' WHERE pon = '$a' ";
         
            if($con->query($sql) == true){
               echo 1;
            }else{
                echo die($con->error);
            } 
        }else if($a!=$d){
            $stmt =  "SELECT * FROM pon WHERE pon = '$a'";
            
            $users = $con->query($stmt) or die ($con->error);
            if($users->num_rows > 0){
            echo 2;
            }else{
                $sql = "UPDATE pon SET pon = '$a' , supplier = '$b' , date = '$c' WHERE pon = '$a' ";
            
                if($con->query($sql) == true){
                echo 1;
                }else{
                    
                    echo die($con->error);
                } 
            }
        }

    }
    public function updateAdminEmail($em,$app,$ename){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$em);
        $b = mysqli_real_escape_string($con,$app);
        $c = mysqli_real_escape_string($con,$ename);
        $sql = "UPDATE users SET email = '$a' , app_password = '$b', email_full_name = '$c' WHERE accesstype = 'Superadmin' ";
        
        if($con->query($sql) == true){
            echo 1;
        }else{
            echo die($con->error);
        } 
    }
  /*  public function getPON(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['pon_no']);
        $b = mysqli_real_escape_string($con,$_POST['pon_supplier']);
        $c = mysqli_real_escape_string($con,$_POST['date']);

        $sql= "INSERT INTO `supply_records`(`purchasedOrderNumber`,`supplier`,`date`) VALUES ('$a','$b','$c')";

        if($con->query($sql) == true){
          
        }else{
          
            die ($con->error);
        } 
    }*/

    public function getPON(){

        $con = $this->connection();
        $stmt =  "SELECT * FROM pon ORDER BY date_added DESC";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return $rows;
        }
    }
    public function getPONRecordStat($x){

        $con = $this->connection();
       
        $stmt =  "SELECT * FROM boolrecord WHERE pon = '$x'";
        $users = $con->query($stmt) or die ($con->error);
      
        if($users->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function addItems(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['description']);
      
        $stmt =  "SELECT * FROM item WHERE description = '$a'";
        $users = $con->query($stmt) or die ($con->error);
        if($users->num_rows > 0){
           echo 2;
        }else{
            $sql= "INSERT INTO `item`(`description`) VALUES ('$a')";
        
            if($con->query($sql) == true){
                echo 1;
            }else{
                echo false." ".die($con->error);
            } 
        }

        
    }

    public function getItems(){

        $con = $this->connection();
        $stmt =  "SELECT * FROM items";
        $users = $con->query($stmt) or die ($con->error);
        $rows = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return $rows;
        }
    }



    public function addRecords(){

        $con = $this->connection();
        $e = mysqli_real_escape_string($con,$_POST['pon']);
       

        ///////////////////////////
        $a = mysqli_real_escape_string($con,$_POST['office']);
        $b = $_POST['articles'];
        $c = $_POST['unit'];
        $d = $_POST['qty'];
        $e = mysqli_real_escape_string($con,$_POST['pon']);
        $f = $_POST['unitcost'];
        $g = $_POST['totalcost'];
        $h = mysqli_real_escape_string($con,$_POST['enduser']);
        $i = mysqli_real_escape_string($con,$_POST['supplier']);
        $j = mysqli_real_escape_string($con,$_POST['datewithdraw']);
        $k = mysqli_real_escape_string($con,$_POST['withdrawby']);  
        $trans = $today = date("Y-m-d H:i:s");
        $trans = preg_replace('/[^0-9]/', '', $trans);


            for($p=0; $p<count($b);$p++){
                $bb =  mysqli_real_escape_string($con, $b[$p]);
                $cc =  mysqli_real_escape_string($con, $c[$p]);
                $dd =   mysqli_real_escape_string($con, $d[$p]);
                $ff = mysqli_real_escape_string($con, $f[$p]);
                $gg = mysqli_real_escape_string($con, $g[$p]);   

                ////////////////////////////////////////////////////////////////////////


                $stmt =  "SELECT * FROM supply_records WHERE purchasedOrderNumber = '$e' AND office = '$a' AND articles = '$bb'";
                $users = $con->query($stmt) or die ($con->error);
                $av_qty = 0;
                $av_tot = 0;
                
                if($users->num_rows > 0){
                    while ($row = $users->fetch_assoc()){
                        $av_qty = $row['qty_available'] - $dd;
                        $av_tot = $row['totalcost_available'] -$gg;
                    }
                }
                if($av_qty==0){
                    $av_tot = 0;
                }

                $sqll = "UPDATE supply_records SET qty_available = '$av_qty', totalcost_available = '$av_tot' WHERE purchasedOrderNumber = '$e' AND office = '$a' AND articles = '$bb'";
                $con->query($sqll) or die ($con->error);

                ////////////////////////////////////////////////////////////////////////
              /*  $stmt =  "SELECT * FROM supply_records WHERE purchasedOrderNumber = '$e' AND office = '$a' AND articles = '$bb'";
                $users = $con->query($stmt) or die ($con->error);

                if($users->num_rows > 0){
                    while ($row = $users->fetch_assoc()){
                        $rows[] = $row['qty_available'];
                    }
        
                   return array_unique($rows); 
        
                }else{
                    return $rows;
                }*/
                ////////////////////////////////////////////////////////////////////////////

                $sql= "INSERT INTO `records`(`trans_num`,`office`, `articles`, `unit`, `qty` ,`purchasedOrderNumber` ,`unitcost` ,`totalcost` ,`enduser`, `supplier`, `datewithdraw`, `withdrawby` ) VALUES ('$trans','$a','$bb','$cc','$dd','$e','$ff','$gg','$h','$i','$j','$k')";

                if($con->query($sql) == true){
                    $_SESSION['add_success'] = "Created successfully ✓";
                }else{
                    $_SESSION['add_success'] = "Created failed ✘";
                    die ($con->error);
                } 
            }



            $stmt =  "SELECT * FROM supply_records WHERE purchasedOrderNumber = '$e' AND office = '$a'";
            $users = $con->query($stmt) or die ($con->error);
            $ccc = false;
            if($users->num_rows > 0){
                while ($row = $users->fetch_assoc()){
                    if($row['qty_available']!=0){
                        $ccc = true;
                        break;
                    }
                }
            }
            
            if($ccc == false){
                $sql = "UPDATE remaks SET remarks = 'complete' WHERE pon = '$e' and office = '$a' ";
                $con->query($sql) or die ($con->error);
            }

            $sql= "INSERT INTO `widthdraw_history`(`trans_num`,`pon`,`office`) VALUES ('$trans', '$e','$a')";
            $con->query($sql) or die ($con->error);
        
    }
    public function sendEmail($subject,$x,$email){

        $con = $this->connection();
        $stmt = "SELECT * FROM users WHERE accesstype = 'Superadmin' ";
        $users_email = $con->query($stmt) or die ($con->error);
        $vars=[];
        if($users_email->num_rows > 0){
            while ($row = $users_email->fetch_assoc()){
            $vars_email[] = $row;
            }
        }


        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $vars_email[0]["email"];
        $mail->Password = $vars_email[0]["app_password"];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($vars_email[0]["email"],$vars_email[0]["email_full_name"]);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $subject;

        $mail->Body =$x;
        if(!$mail->send()){
            echo "Mailer error :".$mail->ErrorInfo;
        }else{
           echo true;
        }

    }

    ///////////////////////////////////////////
    //supply 
    public function addSupplyRecords(){

        $con = $this->connection();
        $a = $_POST['office'];
        $b = $_POST['articles'];
        $c = $_POST['unit'];
        $d = $_POST['qty'];
        $e = mysqli_real_escape_string($con,$_POST['pon']);
        $f = $_POST['unitcost'];
        $g = $_POST['totalcost'];
      //  $h = mysqli_real_escape_string($con,$_POST['enduser']);
        $i = mysqli_real_escape_string($con,$_POST['supplier']);
        $j = mysqli_real_escape_string($con,$_POST['date']);
      //  $k = mysqli_real_escape_string($con,$_POST['withdrawby']);  
        
        $email_for_table="";
            for($p=0; $p<count($b);$p++){
                $nos=$p+1;
                $aa =  mysqli_real_escape_string($con, $a[$p]);
                $bb =  mysqli_real_escape_string($con, $b[$p]);
                $cc =  mysqli_real_escape_string($con, $c[$p]);
                $dd =   mysqli_real_escape_string($con, $d[$p]);
                $ff = mysqli_real_escape_string($con, $f[$p]);
                $gg = mysqli_real_escape_string($con, $g[$p]);   
                $num_formatted = number_format($gg, 2);
                $sql= "INSERT INTO `supply_records`(`office`, `articles`, `unit`, `qty` , `qty_available` ,`purchasedOrderNumber` ,`unitcost` ,`totalcost` ,`totalcost_available` , `supplier`, `date` ) VALUES ('$aa','$bb','$cc','$dd','$dd','$e','$ff','$gg','$gg','$i','$j')";
                
                if($con->query($sql) == true){
                    $email_for_table=$email_for_table."
                    <tr>
                    <td>".$nos."</td>
                    <td>".$bb."</td>
                    <td>".$cc."</td>
                    <td>".$dd."</td>
                    <td>₱".$ff."</td>
                    <td>₱".$num_formatted."</td>
                    </tr>";
                    $_SESSION['add_success'] = "Created successfully ✓";
                }else{
                    $_SESSION['add_success'] = "Created failed ✘";
                    die ($con->error);
                }
            }
            /////////////////////

            $rows=array_unique($a); 
            foreach($rows as $row){
                
                $stmt =  "SELECT * FROM remaks where pon = '$e' and office='$row' ";
                $users = $con->query($stmt) or die ($con->error);
                if($users->num_rows > 0){
                    $sql = "UPDATE remaks SET remarks = 'incomplete' WHERE pon = '$e' and office = '$row' ";
                    $con->query($sql) or die ($con->error);
                }
                else{
                    $sql= "INSERT INTO `remaks`(`pon`, `office`, `remarks`) VALUES ('$e','$row','incomplete')";
                    $con->query($sql) or die ($con->error);
                }
            }
            
            ///////////////////////////////////////////////////////////////////////////////////////////////
        



                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'rexcabutaje28@gmail.com';
                    $mail->Password = 'jbwc gbjo ukbk nbch';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('rexcabutaje28@gmail.com','Rex Cabutaje');
                    $mail->addAddress('rex.cabutaje@csucc.edu.ph');
                    $mail->isHTML(true);
                    $mail->Subject = $_POST["subject"];
                    $mail->Body = $_POST["message"];

                    $mail->Body ="
                
                    <!DOCTYPE html>
                <html lang='en'>
                <head>
                <meta charset='UTF-8'>
                <title>Bootstrap Table Example</title>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css'>
                </head>
                <body>
                <div class='container'>

                Good day!
                <br>
                <p>
                    The following items listed below are PR into your office and have already arrived in our office. You may now withdraw these items.
                </p>    
                <br>
                
                <p>Thank you.</p>
                <br>
                <hr>
                <br>
                    <img src='https://drive.google.com/uc?id=1J1c-QagZBmlgW0k4G0Dfg7cweId-zdvM' alt='Image Description' width='100%' height='100%'>
                    <div style='display:flex;'>
                        <div style='width:30%;'>
                            <h4>Purchased Order #: ".$e."</h4>
                            <h4>Supplier: ".$i."</h4>
                        </div>
                        <div>
                            <h4>Date: ".$j."</h4>
                        </div>
                    </div>
                    <br>

                    <table class='table'>
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Description/Articles</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Unit cost</th>
                        <th>Total cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        ".$email_for_table."
                    </tbody>
                    </table>

                    <br>
                </div>

                

                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js'></script>
                </body>
                </html>";

                    if(!$mail->send()){
                        echo "Mailer error :".$mail->ErrorInfo;
                    }else{
                        echo "Email message send succcesfully.";
                    }
                

            
    }
    public function getSupplyRecords()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM supply_records";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }
    public function getSupplyPON()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM supply_records";
        $users = $con->query($stmt) or die ($con->error);

        $rows = [];
        $pon = [];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row['purchasedOrderNumber'];
            }
           return array_unique($rows); 
        }else{
            return "";
        }
    }


    public function updateRemarks(){
        
        $con = $this->connection();
        $id= mysqli_real_escape_string($con,$_POST['rem_id']);
        $a = mysqli_real_escape_string($con,$_POST['rem_off']);

        if(isset($_POST['rem_check'])){
            $b = $_POST['rem_check'];
            $sql = "UPDATE remaks SET remarks = '$b' WHERE pon = '$id' and office = '$a' ";
            $con->query($sql) or die ($con->error);
            
        }
        
    }
    //////////////////////////////////////
    //users

    public function addUser(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['firstname']);
        $b = mysqli_real_escape_string($con,$_POST['lastname']);
        $c = mysqli_real_escape_string($con,$_POST['username']);
        $d = mysqli_real_escape_string($con,$_POST['password']);
        $d = md5($d);
        $sql= "INSERT INTO `users`(`firstname`, `lastname`, `username`, `password` ,`accesstype` ) VALUES ('$a','$b','$c','$d','Admin')";

        if($con->query($sql) == true){
          
        }else{
          
            die ($con->error);
        } 
    }

    public function editSupplyRecords(){
        
        $con = $this->connection();
        $id= mysqli_real_escape_string($con,$_POST['id']);
        $a = mysqli_real_escape_string($con,$_POST['office']);
        $b = mysqli_real_escape_string($con,$_POST['articles']);
        $c = mysqli_real_escape_string($con,$_POST['unit']);
        $d = mysqli_real_escape_string($con,$_POST['qty']);
        $e = mysqli_real_escape_string($con,$_POST['pon']);
        $f = mysqli_real_escape_string($con,$_POST['unitcost']);
        $g = mysqli_real_escape_string($con,$_POST['totalcost']);
        $i = mysqli_real_escape_string($con,$_POST['supplier']);
        $j = mysqli_real_escape_string($con,$_POST['datewithdraw']);
        //echo $hh_id;
        $sql = "UPDATE supply_records SET office = '$a', articles = '$b', unit = '$c' , qty = '$d' ,purchasedOrderNumber = '$e' ,unitcost = '$f',totalcost = '$g' ,supplier = '$i', date = '$j' WHERE id = '$id' ";
        if($con->query($sql) == true){
            $_SESSION['add_success'] = "Update successfully ✓";
        }else{
            $_SESSION['add_success'] = "Update failed ✘";
            die ($con->error);
        } 
    }

        public function getRemarkNotCom()
        {    
            $con = $this->connection();
            $stmt =  "SELECT * FROM remaks";
            $users = $con->query($stmt) or die ($con->error);
           $rows= [];
            if($users->num_rows > 0){
                while ($row = $users->fetch_assoc()){
                    if($row['remarks']=="incomplete"){
                        $rows[] = $row;
                    }
                }
                return $rows;
            }
            else{
                return $rows;
            }
        }
        public function getRemarkCom()
        {    
            $con = $this->connection();
            $stmt =  "SELECT * FROM remaks";
            $users = $con->query($stmt) or die ($con->error);
           $rows= [];
            if($users->num_rows > 0){
                while ($row = $users->fetch_assoc()){
                    if($row['remarks']=="complete"){
                        $rows[] = $row;
                    }
                }
                return $rows;
            }
            else{
                return $rows;
            }
        }
/////////////////////////////////////////////////////
    public function getUsers()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM users";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }



    public function deleteUser(){
        $con = $this->connection();
        $id = mysqli_real_escape_string($con,$_POST['id']);
        $sql = "DELETE FROM users WHERE id = '$id'";
        if($con->query($sql) == true){
        }else{
            die ($con->error);
        } 
    }

    public function getlogs()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM logs ORDER BY date DESC";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }

    public function widthdrawal_records()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM widthdraw_history";
        $users = $con->query($stmt) or die ($con->error);
        $rows=[];
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return $rows;
        }
    }
    

    public function addOffice(){

        $con = $this->connection();
        $a = mysqli_real_escape_string($con,$_POST['office_name']);
        $b = mysqli_real_escape_string($con,$_POST['office_email']);
        $sql= "INSERT INTO `offices`(`office_name` ,`office_email` ) VALUES ('$a','$b')";

        if($con->query($sql) == true){
          
        }else{
            die ($con->error);
        } 
    }
    public function addOffice_PON(){

        $con = $this->connection();
        $a = $_POST['pon'];
        $b = $_POST['office_name'];

        $stmt =  "SELECT * FROM remaks where pon = '$a' and office = '$b' ";
        $users = $con->query($stmt) or die ($con->error);
        if($users->num_rows > 0){
            header("Location:track_widthdraw.php?id=".$a."&add=0");
        }else{
            $sql= "INSERT INTO `remaks`(`pon` ,`office`, `remarks` ) VALUES ('$a','$b','incomplete')";
            if($con->query($sql) == true){
                header("Location:track_widthdraw.php?id=".$a."&add=1");
            }else{
                die ($con->error);
            } 
        }
    }
    
    public function getOffices()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM offices ORDER BY office_name ASC";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }

    
    public function getListItems()
    {    
        $con = $this->connection();
        $stmt =  "SELECT * FROM item ORDER BY date_added DESC";
        $users = $con->query($stmt) or die ($con->error);
       
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }

    public function updateOffice(){
        
        $con = $this->connection();
        $a= mysqli_real_escape_string($con,$_POST['office_name']);
        $b= mysqli_real_escape_string($con,$_POST['office_email']);
        $c= mysqli_real_escape_string($con,$_POST['id']);

        $sql = "UPDATE offices SET office_name = '$a', office_email = '$b' WHERE id = '$c'";
        $con->query($sql) or die ($con->error);
        
        
    }

    public function deleteOffice(){
        $con = $this->connection();
        $id = mysqli_real_escape_string($con,$_POST['id']);
        $sql = "DELETE FROM offices WHERE id = '$id'";
        if($con->query($sql) == true){
        }else{
            die ($con->error);
        } 
    }

    public function ponCountOffice($x){
     
        $con = $this->connection();
    
        $rows=[];
        $stmt = "SELECT * FROM items where pon = '$x'";
        $users = $con->query($stmt) or die ($con->error);
        
        if($users->num_rows > 0){
            while ($row = $users->fetch_assoc()){
                
                $rows[] = $row['office'];
            }
            $rows= array_unique($rows);
        }
        return count($rows);
    }
    



}





$userClass = new myClass();

if(isset($_POST['addPON'])) {
    unset($_POST['addPON']);
    return $userClass->addPON();
}
if(isset($_POST['updatePON'])) {
    unset($_POST['updatePON']);
    return $userClass->updatePON();
}
if(isset($_POST['item_add'])) {
    unset($_POST['item_add']);
    return $userClass->addItems();
}
if(isset($_POST['updateAdminEmail'])) {
    unset($_POST['updateAdminEmail']);
    return $userClass->updateAdminEmail($_POST['email_add'],$_POST['password_field'],$_POST['email_name']);
}

?>
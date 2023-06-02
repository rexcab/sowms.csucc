<?php 

require_once("msql.php");
$vars = $userClass->getRecords();

if(isset($_POST['add'])){
    $userClass->addRecords();
     header("Location:records_panel.php");
}
if(isset($_POST['delete'])){
    $userClass->deleteRecords();
     header("Location:records_panel.php");
}


$dt = new DateTime;
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');

$row=[];
do {
    $row[]=$dt->format('m/d/Y');
    $dt->modify('+1 day');
} while ($week == $dt->format('W'));

$dstart="";
$dend="";
 foreach($row as $rows){
    $dend=$rows;
 }
$dstart=$row[0];


$count=0;
if($vars!=false){
foreach($vars as $var){
    foreach($row as $rows){
    if($var['datewithdraw']==$rows){
        $count++;
    }
    }      
}                                       
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOWMS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>

<div class="modal fade" id="add_appliances" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-m" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <form action="authenticate.php" method="post">
                    <div class="modal-body">
                            <div class="">
                                <h3>Admin Login</h3>
                      
                                <input type="text" name="username" placeholder="username" required >
                                <input type="password" name="password" placeholder="password" required>
       
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button name="submit" class="btn btn-primary" type="submit">Login</button>
                    </div>
                      
                </form>
              </div>
            </div>  
</div>






<div class="content">



    <div class="containers">
    <div id="background"></div>
        <div class="head" style="margin: 0;padding-left:50px">
       
            <img src="carsucc.png" class="head-picture" alt="">
            <header class="title">
                <h2>Supply Office Widthdrawal Monitoring System CSUCC</h2>
            </header>
           
            <a href="" class="btn logout-btn" data-toggle="modal" data-target="#add_appliances" style="margin-left:30%">Login</a>

        </div>
     
  

    <div class="in-content" style="padding: 100px 50px;"> 

  <?php if(isset($_SESSION['success'])){
            if($_SESSION['success']==false){
                unset($_SESSION['success']);
                echo "<script>alert('username/password is incorrect')</script>";

            }
            
        } ?>


        <div class="tops" >
                <div class="prev-right">
                

                <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn c-green ">Latest</a> 
                <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>" class="btn c-green "><</a> <!--Previous week-->
                <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>" class="btn c-green ">></a> 
              
                </div>
                <div class="search-bar">
                <input type="text" class="form-control rounded ss" name="search_text" id="search_text"  placeholder="Search here" aria-label="Search"
                          aria-describedby="search-addon" />
            </div>
            </div>
            <div id="result">
                <div class="dates">
                    <?php echo "Week date: ".$dstart." - ".$dend; ?>
                    <h6>Total of <?php echo $count ?></h6>
                </div> 
                <div class="">
                    <table class="table">
                        <thead class="table">
                                    <tr>
                                    <th style="width:50px">#</th>
                                        <th style="width:105px;">Date Withdraw</th>
                                        <th style="width:130px;">office</th>
                                        <th style="width:50px;">Qty</th>
                                        <th style="width:60px;">Unit </th>
                                        <th style="width:120px;">Articles</th>
                                        <th style="width:80px;">Unit Cost </th>
                                        <th style="width:80px;">Total Cost </th>
                                        <th style="width:80px;">P.O.N.</th>
                                        <th style="width:120px;">End-user</th>
                                        <th style="width:120px;">Supplier</th>
                                        <th style="width:120px;">Widthdraw By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($vars==false){  
                                }else{                        
                                    $i=1;
                             
                                    foreach($vars as $var){
                                        foreach($row as $rows){
                                        if($var['datewithdraw']==$rows){
                                         ?>
                                            <tr >
                                                <td><?php echo $i; ?></td>
                                                <td style="display:none;"><?php echo $var['id'] ?></td>
                                                <td><?php echo $var['datewithdraw']; ?></td>
                                                <td><?php echo $var['office']; ?></td>
                                                <td><?php echo $var['qty']; ?></td>
                                                <td><?php echo $var['unit']; ?></td>
                                                <td><?php echo $var['articles']; ?></td>
                                                <td><?php echo $var['unitcost']; ?></td>
                                                <td><?php echo $var['totalcost']; ?></td>
                                                <td><?php echo $var['purchasedOrderNumber']; ?></td>
                                                <td><?php echo $var['enduser']; ?></td>
                                                <td><?php echo $var['supplier']; ?></td>
                                                <td><?php echo $var['withdrawby']; ?></td>
                                            
                                            </tr>
                                            <?php 
                                            $i++;
                                            }
                                        }
                                    }
                                    } ?>

                    
                                    </tbody>         
                                </table> 
                       </div>           
            </div> 
        </div>  
    </div>
    <footer>
        <center>
            <p>Copyright © 2022 <span style="color:yellow">Caraga State University - Cabadbaran Campus</span></p>
            <p>T.Curato St., Cabadbaran City, Philippines 8605</p>
            <p>All Rights Reserved.</p>
     </center>
    </footer>
    </div>  
    
    



<script type="text/javascript">

$(function() {
    $('#datepicker').datepicker();
});

$(function() {
    $('#datepickers').datepicker();
});


$(document).ready(function(){
    $('#search_text').on('keyup',function(){
    var c =$('#search_text').val();

    if(checkString(c)==true){
        alert("Invalid characters are detected!");
        e.preventDefault();
        
}
    
        $.ajax({
            type:"POST",
            url:"fetch-search.php",
            data:{
            name:$('#search_text').val(),
            },
            success:function(data){
            $("#result").html(data);
            }
        });
    });
});


function checkString(c){
        for(var i=0; i <c.length; i++){
            if(c[i]>='a' && c[i]<='z' || c[i]>='A' && c[i]<='Z' || c[i]>='0' && c[i]<='9' || c[i]=='-' || c[i]=='.' || c[i]==' ' || c[i]=='/' || c[i]==','   ){
                continue}
            else{
                return true}
        }
        return false;
}



</script>
</body>
</html>
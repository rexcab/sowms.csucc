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



$vars = $userClass->getPON();



$count=0;



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
    <script src="js/printThis.js"></script>
    <link rel="stylesheet" href="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="your-integrity-hash" crossorigin="anonymous">
<script src="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.js"></script>
    <script src="js/printThis.js"></script>
</head>
<body>




<div class="modal fade" id="add_pon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-m" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body">
                        <div>
                                <table class="table">
                                    <thead class="table-light">    
                                        <tr>  
                                        <th><h4>Create new P.O.N</h4></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <div class="form-group">
                                            <label>P.O.N</label>
                                            <input type="text" class="form-control" id="a_pon" name="p_pon" placeholder="Enter  purchased order number" required>
                                    </div>
                                
                                    <div class="form-group">
                                       <label>Supplier</label>
                                       <input type="text" class="form-control" id="a_supplier" name="p_supplier" placeholder="Enter  supplier" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Date Issued </label>
                                        <div class="row form-group" style="margin-left:0px">
                                            <div class="col-sm-17">
                                                <div class="input-group date" id="datepickers" >
                                                    <input type="text" id='a_date' class="form-control" name="p_date" required>
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white" style="font-size:1.5rem">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                                <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button"  id="save_pon" class="btn btn-primary" >Save</button>
                            </div>
                      </div>
                </form>
              </div>
            </div>  
</div>
<div class="modal fade" id="update_pon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-m" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body">
                    
                        <div>
                                <table class="table">
                                    <thead class="table-light">    
                                        <tr>  
                                        <th><h4>Update P.O.N</h4></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <div class="form-group">
                                            <label>P.O.N</label>
                                            <input type="text" class="form-control" id="u_pon" name="p_pon" placeholder="Enter  purchased order number" required>
                                    </div>
                                
                                    <div class="form-group">
                                       <label>Supplier</label>
                                       <input type="text" class="form-control" id="u_supplier" name="p_supplier" placeholder="Enter  supplier" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Date Issued </label>
                                        <div class="row form-group" style="margin-left:0px">
                                            <div class="col-sm-17">
                                                <div class="input-group date" id="datepickers" >
                                                    <input type="text" class="form-control" id='u_date' name="p_date" required>
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white" style="font-size:1.5rem">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                                <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id='up_pon'  name="up_pon" class="btn btn-primary">Save</button>
                            </div>
                      </div>
                </form>
              </div>
            </div>  
</div>
<!------------------------------------------------------------------------------------->
    
     <div class="containers">
        <div class="sidebar">

        <?php include 'sidebar.php';?>
        </div>
        <div class="block">
        <?php include 'header.php';?>
        <div class="in-content"> 
            
            <div style="margin-bottom:10px">
            
            </div>
            <div class="ins-content" style="display:block">
            <div style="padding:0 20px; margin-bottom:30px">
                <h3 style="font-weight: 700; ">PURCHASED ORDER NUMBER (P.O.N) </h3>
            </div>
                <div class="right-content" style="width:97%;  margin-left:20px">
                    <div class="card" style="width: 100%">

                   <div class="card-body">
                   <h5 class="card-title">List of Purchased Order Number </h5>
                   <BR>
                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_pon" style="margin-right:10px" > Create P.O.N</button>
                    <hr>
                    
                    
                    <div class="tops" style="display:FLEX" >
                    </div>
                    <div id="result_pon" style="height: 600px;">
                        <table class="table ttable" >
                            <thead class="table">
                                <tr>
                                    <th >#</th>
                                    <th >Purchased Order Number</th>
                                    <th >Supplier</th>
                                    <th >Date Issued</th>
                                    <th >Modified</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                            <tbody>
                            <?php
                            
                            if($vars==""){ 
                                echo ""; 
                            }else{  
                                $i=1;
                                foreach($vars as $var){ 
                                   ?>
                                <tr class="tr_id">
                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['supplier']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['date']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                    <td style="font-size: 14px;"><button class="btn btn-primary"  id='up_modal' data-toggle="modal" data-target="#update_pon" >Update</td>
                                </tr>
                                <?php 
                               
                                
                                $i++;
                            }} ?>
                            </tbody>         
                        </table>   
                        
                </div>
                </div>
                    </div>
                </div>
                <br>
             
                </div>
                <div style="position:absolute; buttom:0; width:88%">
                <?php include 'footer.php'; ?>
            </div>
            </div>
            <br>
            <br>
            
            </div>  
        </div>
    
        </div>



<script type="text/javascript">


var cur_pon = "";
$(document).ready(function(){
    $(function() {
        $("#sided").find("a:nth-child(2)").css("background","#118911")
    });
    $(function() {
        $('#datepickers').datepicker();
    });

    $('.ttable').DataTable();
    $('.ttable').css("width","100%")
   
    $('#up_modal').click(function(){
        cur_pon= $(this).parent().parent().find("td:nth-child(2)").html()
        $("#u_pon").val( $(this).parent().parent().find("td:nth-child(2)").html())
        $("#u_supplier").val( $(this).parent().parent().find("td:nth-child(3)").html())
        $("#u_date").val( $(this).parent().parent().find("td:nth-child(4)").html())
    })


            
    //add to databased
    $('#save_pon').click(function(){

        $.ajax({
            type:'POST',
            url:'msql.php',
            data:{
                p_pon:$("#a_pon").val(),
                p_supplier:$("#a_supplier").val(),
                p_date:$("#a_date").val(),
                addPON:"addPON",
            },
            success:function(response){
                
                $('#add_pon').modal('hide');
            
                if(response=="1"){
                    
                    $.sweetModal({
                        content: 'Save successfully!',
                        icon: $.sweetModal.ICON_SUCCESS,
                        onClose: closed
                    });
                
                }else if(response=="2"){
                    
                    $.sweetModal({
                        content: 'Purchased Order Number Already Exist!',
                        icon: $.sweetModal.ICON_WARNING,
                        onClose:  closed
                    });
                
                }else{
                    $.sweetModal({
                        content: response,
                        title: 'Failed!, …<br>'+response,
                        icon: $.sweetModal.ICON_ERROR,

                        buttons: [
                            {
                                label: 'Close',
                                classes: 'redB'
                            }
                        ],
                        onClose: closed
                    });
                }

            }
        }); 
    });

    //update
    $('#up_pon').click(function(){

        $.ajax({
            type:'POST',
            url:'msql.php',
            data:{
                p_pon:$("#u_pon").val(),
                p_supplier:$("#u_supplier").val(),
                p_date:$("#u_date").val(),
                cur_pon: cur_pon,
                updatePON:"updatePON",
            },
            success:function(response){
                console.log($("#u_pon").val())
                console.log(cur_pon)
                console.log(response)
                $('#update_pon').modal('hide');
            
                if(response=="1"){
                    
                    $.sweetModal({
                        content: 'Update successfully!',
                        icon: $.sweetModal.ICON_SUCCESS,
                        onClose: closed
                    });
                
                }else if(response=="2"){
                    $.sweetModal({
                        content: 'Purchased Order Number Already Exist!',
                        icon: $.sweetModal.ICON_WARNING,
                        onClose:  closed
                    });
                }else if(response=="3"){
                    $.sweetModal({
                        content: 'Update successfully!',
                        icon: $.sweetModal.ICON_WARNING,
                        onClose:  closed
                    });
                
                }else{
                    $.sweetModal({
                        content: response,
                        title: 'Failed!, …<br>'+response,
                        icon: $.sweetModal.ICON_ERROR,

                        buttons: [
                            {
                                label: 'Close',
                                classes: 'redB'
                            }
                        ],
                        onClose: closed
                    });
                }

            }
        }); 
    });

    
});
function closed(){
        location.reload()
    }
</script>

<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
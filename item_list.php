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

$vars = $userClass->getListItems();


if(isset($_POST['submit_rem'])){
    $userClass->updateRemarks();
     header("Location:track_widthdraw.php");
}
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
                                        <th><h4>Add Item</h4></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <div class="form-group">
                                            <label>Item description/article</label>
                                            <input type="text" class="form-control" id="a_description" name="description" placeholder="Enter description" required>
                                    </div>

                                </div>
                                <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button"  name="add" id="add_item" class="btn btn-primary">Save</button>
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
                <h3 style="font-weight: 700; ">Items </h3>
            </div>
                <div class="right-content" style="width:97%; height: 700px; margin-left:20px">
                    <div class="card" style="width: 100%">

                   <div class="card-body">
                   <h5 class="card-title">List of Items</h5>
                   <BR>
                    <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_pon" style="margin-right:10px" >Add Item</button>
                    <hr>
                    
                    
                    <div class="tops" style="display:FLEX" >
                    </div>
                    <div id="result_pon" style="height: 600px;">
                        <table class="table ttable" >
                            <thead class="table">
                                <tr>
                                    <th >#</th>
                                    <th >Description</th>
                                    <th >Date Added</th>
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
                                <tr class="tr_id" >
                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['description']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                    <td style="font-size: 14px;"><button class="btn btn-primary">Update</td>
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
                
            </div>
            <br>
            <br>
            <br>
            <br>  <br>
            <br>
            <br>
            <br>
            <div style="position:absolute; buttom:0; width:100%">
                <?php include 'footer.php'; ?>
            </div>
            </div>  
        </div>
    
        </div>



<script type="text/javascript">
$(function() {
    $('#datepickers').datepicker();
});
$(document).ready(function () {
    $('.ttable').DataTable();
});


$(function() {
        $("#sided").find("a:nth-child(3)").css("background","#118911")
    });

    function closed(){
        location.reload()
    }
    
$(document).ready(function(){
    $('#add_item').click(function(){
        $.ajax({
            type:"POST",
            url:"msql.php",
            data:{
                description:$('#a_description').val(),
                item_add:"item_add",
            },
            success:function(response){
                console.log($('#a_description').val())
                console.log(response)
                $('#add_pon').modal('hide');
                //console.log(response)
                            
                if(response=="1"){
                            
                            $.sweetModal({
                                content: 'Save successfully!',
                                icon: $.sweetModal.ICON_SUCCESS,
                                onClose: closed
                            });
                        
                        }else if(response=="2"){
                            $.sweetModal({
                                content: 'Items description Already Exist!',
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

function refresh(){
       
    $(document).ready(function(){
 
        $.ajax({
            type:"GET",
            url:"item_load_table.php",
            success:function(response){
                $("tbody").html(response)
            }
        });

    });
}

</script>

<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
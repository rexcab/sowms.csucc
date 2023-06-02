<?php 

require_once('msql.php');


if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['accesstype'])){ 
  if($_SESSION['accesstype']==''){
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['isername']);
    unset($_SESSION['accesstype']);
    
    header('Location: Location: index.php');
    die();}
}else{header('Location: index.php');}

$vars = $userClass->getPON();



?>



<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css'>

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'></script>
    <script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' >
    <script src='js/printThis.js'></script>
    <link rel='stylesheet' href='jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.css' />
    <link rel='stylesheet' href='https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css' integrity='your-integrity-hash' crossorigin='anonymous'>
<script src='jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.js'></script>
</head>
<body>

<style>
    .upper-group .form-group{
        font-size: 20px;
        text-align: center;
    }
    .progress{
        overflow: unset;
        margin: 30px 10% 0 10%;
       
    }
    .progress i{
        color: #198754;
        font-size: 53px;
        margin: 6px 0 0 -25px;
    }
    .card{
        border-radius: 20px;
        padding: 10px;
    }
</style>

<!------------------------------------------------------------------------------------->
    
     <div class='containers'>
        <div class='sidebar'>

        <?php include 'sidebar.php';?>
        </div>
        <div class='block'>
        <?php include 'header.php';?>
        <div class='in-content'> 
            
            <div style='margin-bottom:10px'>
            
            </div>
            <div class='ins-content' style='display:block'>
            <div style='padding:0 20px; margin-bottom:30px'>
                <h3 style='font-weight: 700; '>Items </h3>
            </div>
            <div style='margin:30px'>
                <div style='display:flex' class='upper-group'>
                    <div class='form-group'>
                        <h6>Select PON</h6>
                    </div>
                    <div class='form-group'>
                        <h6>Select Items</h6>
                    </div>
                    <div class='form-group'>
                        <h6>Select Offices</h6>
                    </div>
                    <div class='form-group'>
                        <h6>Sort</h6>
                    </div>
                    <div class='form-group'>
                        <h6>Review</h6>
                    </div>
                    
                   
                </div>
                <div>
                    
                    <div class='progress'>
                        <div class='progress-bar bg-success' role='progressbar' aria-valuenow='75' style='width: 0%;'aria-valuemin='0' aria-valuemax='100'></div>
                        <i class='fa-solid fa-circle fa-xl' style='color: #1d8129;'></i>
                    </div>
                   
                </div>
            </div>

            <!-------------------------------------------------->
                <div class='right-content' style='width:97%; height: 700px; margin-left:20px'>
                
                <div style='display:flex'>
                    <div class='card' style='width: 50%; margin-right:10px'>
                        <div class='card-body'>
                             
                         
                            <div>
                            <table class='table ttable' >
                                
                                    <thead>
                                        <th style="font-size:18px">Item Description</th>
                                    </thead>
                                    <tbody>
                                        <tr onclick="tr(this)">
                                            <td>1</td>
                                        </tr>
                                        <tr onclick="tr(this)">
                                            <td>2</td>
                                        </tr>
                                        <tr onclick="tr(this)">
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                    <div class='card' style='width: 50%'>
                        <div class='card-body'>
                            <div>
                                <h6>Purchased Order Number : 349378439</h6>
                            </div>
                            <hr>
                            <h5 class='card-title'>Selected Items</h5>
                            <br>
                            <div class="s-item">
                                <ul class="list-group" id="s_i">
                                  
                                </ul>
                            </div>
                            <br>
                            
                        </div>
                        <div style="padding:0px 20px 10px 0">
                            <button class="btn btn-primary" style='float:right'>Proceed</button>
                        </div>
                        
                    </div>
                </div>
                </div>
            <!-------------------------------------------------->
                <br>
             
                </div>
                
            </div>
       
            <br>
            <br>
            <br>
            <div style='position:absolute; buttom:0; width:100%'>
                <?php include 'footer.php'; ?>
            </div>
            </div>  
        </div>
    
        </div>



<script type='text/javascript'>
$(function() {
    $('#datepickers').datepicker();
});
$(document).ready(function () {
    $('.ttable').DataTable();

    //$('.dataTables_wrapper').find("div:nth-child(2)").html("  <div id='DataTables_Table_0_filter' class='dataTables_filter input-group' style='float: left;'><input type='search' class='form-control rounded' placeholder='Search' aria-label='Search' aria-controls='DataTables_Table_0' aria-describedby='search-addon' /> <button type='button' class='btn btn-outline-primary'>search</button> </div>")
    $('.dataTables_length').remove();
    $('.dataTables_filter').css('float', 'left');
    $('.dataTables_filter').css('width', '100%');
   $('.dataTables_wrapper').find("input").css("width","calc(100% - 62px)");
   $('.dataTables_wrapper').find("label").css("display","unset")
     
});
$(document).ready(function () {
  
});




$(function() {
        $('#sided').find('a:nth-child(4)').find('h6').css('background','#118911')
    });



$(document).ready(function(){
  $('#add_item').click(function(){
  $.ajax({
      type:'GET',
      url:'item_add.php',
      data:{
          description:$('#description').val(),
      },
      success:function(response){
          
          $('#add_pon').modal('hide');
          //console.log(response)
          if(response==1){
            
              $.sweetModal({
                  content: 'Save successfully.',
                  icon: $.sweetModal.ICON_SUCCESS
              });
            refresh()
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
                  ]
              });
          }

     

      
      }
  });
});
});

function refresh(){
       
    $(document).ready(function(){
 
        $.ajax({
            type:'GET',
            url:'item_load_table.php',
            success:function(response){
                $('tbody').html(response)
            }
        });

    });

}

function s_office(x){

   var xr = $('.progress-bar').css('width','24.5%')

   $.ajax({
    type:'post',
      url:'pon_items_select.php',
      data:{
      },
      success:function(response){
        $('.right-content').html(response)
      }
   })
   /** */
}

function tr(x){
    var x = $(x).find("td").html();
   
    var temp = $(".s-item").html();
    var str = "<li class='list-group-item'>"+x+"<button type='button' onclick='tr_remove(this)' class='btn btn-danger btn-sm' style='float:right'>remove</button></li>";
    $(".s-item").html(str+temp);
    
}
function tr_remove(x){
    var x = $(x).parent().remove();
   
}
</script>
</body>
</html>
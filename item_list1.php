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


$rem_n_complete = $userClass->getRemarkNotCom();
$rem_complete = $userClass->getRemarkCom();
$vars = $userClass->getPON();
$all_widthdraw = $userClass->widthdrawal_records();
$offices = $userClass->getOffices();


if(isset($_POST['submit_rem'])){
    $userClass->updateRemarks();
     header("Location:track_widthdraw.php");
}
$count=0;

if(isset($_POST['add'])){
    $userClass->addRecords();
     header("Location:track_widthdraw.php");
}

if(isset($_POST['add_pon'])){
    $userClass->addPON();
     header("Location:track_widthdraw.php");
}

if(isset($_POST['add_office'])){
    $userClass->addOffice_PON();
    
}
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
                                        <th><h6>Add item</h6></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <!--
-->
                                    <div class="form-group">
                                            <label>Office</label>
                                            <select class="form-select" aria-label="Default select example" name = "a_office" id="a_office" required>
                                                <?php if($offices==false){ 
                                                    echo ""; 
                                                }else{                        
                                                    $i=1;
                                                    foreach($offices as $var){ ?>
                                                    <option  value="<?php echo $var['office_name'];?>"><?php echo $var['office_name'];?></option>
                                                <?php }
                                                }?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Description/Article</label>
                                            <input type="text" class="form-control" id="a_description" name="a_description" placeholder="Enter  description/article" required>
                                    </div>
                                    <div style="display:flex">
                                        <div class="form-group">
                                                <label>Unit</label>
                                                <input type="text" class="form-control" id="a_unit" name="a_unit" placeholder="Enter  unit" required>
                                        </div>
                                        <div class="form-group">
                                                <label>Qty</label>
                                                <input type="text" class="form-control" id="a_qty" name="a_qty" placeholder="Enter  quantity" required>
                                        </div>
                                        <div class="form-group">
                                                <label>Unit cost</label>
                                                <input type="text" class="form-control" id="a_u_cost" name="a_u_cost" placeholder="Enter  unit cost" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Total cost</label>
                                            <input type="text" class="form-control" id="a_t_cost" name="a_t_cost" placeholder="Enter total cost" required>
                                    </div>

                                    
                                </div>
                                   
                                   
                                   
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button"  id="add_item"  name="add_item" class="btn btn-primary">Save</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>  
</div>



<!----------------------------------------------------------------------->
    
     <div class="containers">
        <div class="sidebar">

                <?php include 'sidebar.php';?>
        </div>
        <div class="block">
        <?php include 'header.php';?>
        <div class="in-content"> 
            
        <div style="padding:0 20px; margin-bottom:30px">
                <h3 style="font-weight: 700; ">ITEMS</h3>
            </div>                            

            <div class="ins-content" style="display:flex; margin-left:20px">
            
                <div class="right-content" style="width:400px; ">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div style="padding:20px 0">
                            <input type="text" class="form-control rounded ss" name="search_text" id="search_text"  placeholder="Search purchase order number" aria-label="Search"
                                        aria-describedby="search-addon" style="width:100%;"/>
                            </div>
                            <div class="tops" style="display:BLOCK" >
                                
                                <h6 style="margin-top:5px;">List of Purchased Number</h6>
                            </div>
                            
                            <div id="result_pon" style="height: 600px;">
                                <table class="table" >
                                    <thead class="table">
                                        <tr>
                                            <th >#</th>
                                            <th >Purchased Order Number</th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                

                                    <?php if($vars==""){ 
                                        echo "<di"; 
                                    }else{                        
                                        $i=1;
                                        foreach($vars as $var){ 
                                        ?>
                                        <tr class="tr_id" onclick="therow(this)">
                                        
                                            <td scope="row" style="font-size: 14px;"><?php echo $i; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                            <td style="display:none;"><?php echo $var['supplier']; ?></td>
                                            <td style="display:none;"><?php echo $var['date']; ?></td>
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
                <div class="left-content" style="width: 100%;">
                
                <div class="card" style="width: 100%;">
                    <div class="card-body">

                        <h6 class='card-title'>Purchased Order Number Details</h6>
                        <div style='display: flow-root; width:100%; display:flex; padding:10px; justify-content: space-between; background:white'>
                            <h6 id='pon_office' style='flex-basis: 30%;'>P.O.N: <span id="pp_pon" style='color:rgb(28, 126, 3);font-weight:900;'></span></h6>  
                            <h6 style='flex-basis: 30%;'>Supplier: <span id="pp_supplier" style='color:rgb(28, 126, 3);font-weight:900;'></span></h6>  
                            <h6 style='flex-basis: 30%;'>Date issued: <span id="pp_date" style='color:rgb(28, 126, 3);font-weight:900;'></span></h6>   
                        </div>
                    </div>
                    <!---->

                    
                </div>
                <div class="card" style="width: 100%; height:100%;">
                    <div class="card-body">
                    <div style="width:100%; display:flex;margin:10px 5px;">
                        <div style="width:50%;">
                             <h5 class='card-title'>List of All Items</h5>
                        </div>
                        <div style="width:50%; ">
                             <button style="float:right" type="button" class="btn btn-success " data-toggle="modal" data-target="#add_pon" id='btn-add' disabled> Add item</button> 
                        </div>
                        
                    </div>
                    <img id='load-gif' src='loading.gif' style='height:100px; width:100px; display:none' >       
                    <div id="result-pon">
                       <table class="table ttable " style='width:100%'>
                        <thead class='thead-dark'>
                            <tr>
                                <th scope="col" style="width:50px;">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit cost</th>
                                <th scope="col">Total cost</th>
                                <th scope="col">Office</th>
                                <th scope="col">Action</th>
                                <th scope="col" style="display:none"></th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                            <td></td>
                            <td style="font-weight:900; color: rgb(28, 126, 3);">Select P.O.N. first</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="display:none"></td>
                            </tr>
                        </tbody>
                        </table>

                    </div>
                   


                    </div>
                </div>
                </div>
                
            </div>
         
            </div>  
            <br><br><br><br>
            <div style="position:absolute; buttom:0; width:100%">
                <?php include 'footer.php'; ?>
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
        $("#sided").find("a:nth-child(3)").find("h6").css("background","#118911")
    });

function therow(x){
  
    var q = $(x);
    var data = q.children('td').map(function(){
          return $(this).text();
        }).get(); 
        var iii =data[0]-1;
 const myNodelist = document.querySelectorAll(".tr_id");

for (let i = 0; i < myNodelist.length; i++) {
  
  if(i==iii){
    myNodelist[i].style.background = "rgb(28 126 3)";
    myNodelist[i].style.color= "white";

    
          myNodelist[i].addEventListener('mouseleave', e => {
            myNodelist[i].style.background = "rgb(28 126 3)";
    myNodelist[i].style.color= "white";

          });

  }else{
    myNodelist[i].style.background = "white";
    myNodelist[i].style.color= "black";
               
              myNodelist[i].addEventListener('mouseenter', e => {
              myNodelist[i].style.background = ' rgb(30 131 4)';
              myNodelist[i].style.color = 'black';
          });

          myNodelist[i].addEventListener('mouseleave', e => {
            myNodelist[i].style.background = 'white';
            myNodelist[i].style.color = 'black';
          }); 
  }
  
}    

        $('#tot_com').css("background-color","#118911");
        $('#tot_pon').css("background-color","#115811");
        $('#tot_not_com').css("background-color","#118911");
        $('#id_office').val(data[1]);

        console.log(data)
        $("#pp_pon").html(data[1]);
        $("#pp_supplier").html(data[2]);
        $("#pp_date").html(data[3]);

    $.ajax({
        type:"POST",
        url:"item_list_load-items.php",
        data:{
        id: data[1],
        supplier: data[2],
        date: data[3],
        },
        beforeSend:function(){
           
                $('#load-gif').css("display","block");
                console.log("sds")
        },

        success:function(data){
        
        $("#result-pon").html(data);
       
        $('.ttable').css("width","100%");
        $("#btn-add").prop('disabled', false);

        },
        complete: function(){
           $('#load-gif').css("display","none");
           $(document).ready(function () {
            $('.ttable').DataTable();
        });
        },
    });

};


$(document).ready(function(){
    $('#add_item').click(function(){
    $.ajax({
        type:"GET",
        url:"item_add.php",
        data:{
            pon:$('#pp_pon').html(),
            description:$('#a_description').val(),
            unit:$('#a_unit').val(),
            qty:$('#a_qty').val(),
            u_cost:$('#a_u_cost').val(),
            t_cost:$('#a_t_cost').val(),
            office:$('#a_office').val(),
        },
        success:function(response){
            
            $('#add_pon').modal('hide');
            console.log(response)
            if(response==true){
                $.sweetModal({
                    content: 'This is a success.',
                    icon: $.sweetModal.ICON_SUCCESS
                });

                $.ajax({
                    type:"POST",
                    url:"item_list_load-items.php",
                    data:{
                    id: $("#pp_pon").html(),
                    supplier: $("#pp_supplier").html(),
                    date: $("#pp_date").html(),
                    },
                    success:function(data){
                        $("#result-pon").html(data);
                        $(document).ready(function () {
                            $('.ttable').DataTable();
                        });
                    }
                });
                
            }else{
                $.sweetModal({
                    content: response,
                    title: 'Oh noes…',
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



function remove_item(x,y){
    
    
const myNodelist = document.querySelectorAll(".supply_items");       
for (let i = 0; i < myNodelist.length; i++) {
    
    if(i==x-1){
        console.log(x);
        myNodelist[i].removeAttribute("disabled");
    }
    
}  
let tr = $(y).parent().parent().html("");
console.log(tr);

}

$(document).ready(function(){
    $('#search_text').on('keyup',function(){

        $.ajax({
            type:"POST",
            url:"fetch_search_pon.php",
            data:{
                id:$('#search_text').val(),
            },
            success:function(data){
            $("#result_pon").html(data);
            }
        });
       

    })
});


function offSide(){
    $(".fa-bars").attr("onclick","onSide()");
    document.querySelector(".head").style.marginLeft="-3px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="26px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="-200px";
    document.querySelector(".sidebar").style.transition="0.5s";

    const nodeList = document.querySelectorAll(".box");
    for (let i = 0; i < nodeList.length; i++) {
        nodeList[i].style.width="280px";
        nodeList[i].style.transition="0.5s";
    }
}
function onSide(){
    $(".fa-bars").attr("onclick","offSide()");

    document.querySelector(".head").style.marginLeft="187px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="211px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="0px";
    document.querySelector(".sidebar").style.transition="0.5s";

    const nodeList = document.querySelectorAll(".box");
    for (let i = 0; i < nodeList.length; i++) {
        nodeList[i].style.width="240px";
        nodeList[i].style.transition="0.5s";
    }
}

</script>
</body>
</html>
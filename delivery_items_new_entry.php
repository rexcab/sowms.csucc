<?php 

require_once("msql.php");


if(!isset($_SESSION)){
    session_start();
}
if(!isset($_GET['id'])){
    $_GET['id']="";
}

if(!isset($_GET['add'])){
    $_GET['add']="";
}
if($_GET['add']==0){
    echo "<script>alert('Already exist')</script>";
   // header("Location:track_widthdraw.php?id=".$a."&add=");
}
if($_GET['add']==1){
    echo "<script>alert('Successfully Added')</script>";
   
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
<style>
/* width */
#table-items::-webkit-scrollbar {
  width: 8px;
}

/* Track */
#table-items::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
#table-items::-webkit-scrollbar-thumb {
  background: grey; 
  border-radius: 10px;
}

/* Handle on hover */
#table-items::-webkit-scrollbar-thumb:hover {
  background: green; 
}

.step{
  background: red;
  border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.6em;
  margin-right: 5px;
  text-align: center;
  width: 1.6em;
      }
</style>
<body>

<div class="modal fade" id="summary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                <h5 class='card-title' >Confirmation</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                <div style="margin: 3px 27px; ">
                <div style='padding: 15px; background: #ededed;'>
                    <h6>Note* </h6>
                    <h5 style='padding-left:20px '>Please review the details of the arrived items.</h5>
                    <h6 style='padding-left:20px '>Click confirm to save.</h6>
                </div>
                <div style='padding:5px 10px; border-bottom: solid 5px black;'></div>
                <form action="" method="post">
                    <div class="modal-body">
                                <div style='padding:5px 10px; border-bottom: solid 1px black; border-bottom-style:dashed;'>
                                    <h5>Information Details</h6>
                                    <div style='width:100%; display:flex'>
                                        <div style='padding:0 10px; width:100px'>
                                            <h6 style='font-size:13px'>P.O.N </h6>
                                            <h6 style='font-size:13px'>Supplier </h6>
                                            <h6 style='font-size:13px;' >Date issued </h6>
                                            <h6 style='font-size:13px;' >Office </h6>
                                        </div>
                                        <div style='padding:0 10px; '>
                                            <h6 style='font-size:13px'>: <span id="s_pon" style="font-weight:600"></span></h6>
                                            <h6 style='font-size:13px'>: <span id="s_supplier" style="font-weight:600"></span></h6>
                                            <h6 style='font-size:13px'>: <span id="s_date" style="font-weight:600"></span> </h6>
                                            <h6 style='font-size:13px'>: <span id="s_office" style="font-weight:600"></span> </h6>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <h5>List of Arrived Items</h6>
                                <div style='width:100%; height:500px;' id='table-items'>
                                    <table class='table table-bordered'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width:50px;'>#</th>
                                                <th scope='col'>Description</th>
                                                <th scope='col'>Brand/Model</th>
                                                <th scope='col'>Unit Cost<span style='font-weight:400; font-size:15px'>(per item)</span></th>
                                                <th scope='col'>Qty <span style='font-weight:400; font-size:15px'>(arrived)</span></th>
                                                <th scope='col'>Total Cost</th>
                                                <th scope='col'>Waiting <span style='font-weight:400; font-size:15px'>(item qty)</span> </th>
                                                
                                                <th scope='col' style='display:none'></th>
                                            </tr>
                                        </thead>
                                        <tbody id='table-datasx'>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button"  onclick='confirm()' class="btn btn-primary">Confirm</button>
                        </div>
                      </div>
                </form>
                </div>
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
            <img src='loading.gif' id='load-gif' style="height:100px; width:100px; position:absolute; display: none ;margin:20% 0 0 40%; ">
            <div style='width:100%; padding:20px'>
                <div style="padding:0px; width:100%; height:30px" >
                    <h3 style="font-weight: 700; float:left ">Arrived Items <span><i class="fa-solid fa-angle-right"></i></span><span style="font-size:25px; font-weight:500"> New Entry</span></h3>
                    <button onclick="location.href='delivery_items.php'"class="btn btn-primary" style="float:right" >Back</button>
                </div>
                <hr>
                <br>
                <div id="in-arr">
                    <div style="width:100%; padding: 10px 10px 10px 0; height:45px">
                        
                        <h5 style="float:left">Select Purchased Order Number</h5>
                        
                    </div>
                    <br>
                   
                
                
             
           <div style='display:flex'>


                        <div class='right-content' style='width:400px; '>
                            <div class='card' style='width: 100%;'>
                                <div class='card-body'>
                                    <div style='padding:20px 0'>
                                        <input type='text' class='form-control rounded ss' name='search_text' id='search_text'  placeholder='Search purchase order number' aria-label='Search'
                                                    aria-describedby='search-addon' style='width:100%;'/>
                                    </div>
                                    <div class='tops' style='display:BLOCK' >
                                            <h6 style='margin-top:5px;'>List of Purchased Number</h6>
                                    </div>
                                        <div id='result_pon' style='height: 600px;'>
                                            <table class='table' >
                                                <thead class='table'>
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
                        
                        <div class='in-right-content' style='width: 100%; margin: 0 0 0 10px'>
                        
                                <div class='card' style='width: 100%;'>
                                    <div class='card-body'>

                                        <h4 class='card-title'>Purchased Order Number Details</h4>
                                    
                                        <div style='display: flex; width:100%;  padding:10px;  background:white'>

                                            <div style='display:block; width:200px'>
                                                <h6 id='pon_office' >P.O.N</h6>  
                                                <h6>Supplier</h6>  
                                                <h6>Date issued</h6>
                                                <h6 style='margin:7px 10px 0 0'>Relevant Offices </h6>
                                            </div>
                                            <div style='display:block'>
                                                <h6 id='pon_office' >: </h6>  
                                                <h6>:</h6>  
                                                <h6>: </h6>
                                                <select onclick='s_office(this)' class='form-select' aria-label='Default select example' style='width:300px' id='office' disable>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <hr style='margin:0 20px;'>
                                    </div>
                                    <div>
                                        <div class='card-body' id='office-items' style="height:533px">
                                                
                                        </div>
                                    </div>
                                    
                                </div>
                        </div>


                </div>
            </div>  
        </div>
    
        </div>
        <div style="position:absolute; buttom:0; width:100%">
                <?php include 'footer.php'; ?>
            </div>
        </div>


<script type="text/javascript">
  var g_description = [];
   var g_item_id = [];
   var g_description = [];
   var g_unit_cost = [];
   var g_arrived_qty = [];
   var g_total_cost = [];
   var g_waiting_qty = [];
   var g_brand = [];

   $(function() {
        $("#sided").find("a:nth-child(5)").css("background","#118911")
    });

function check_item(x) {
    
    // Event handler code here
// get the input field in the same row as the button
    if($(x).is(":checked")){
        //console.log("Checkbox is checked");
        $(x).closest('tr').css('background','#d9f5c4');
        $(x).closest('tr').find('td:nth-child(7)').find('input').css("display",""); // Disable the button
        $(x).closest('tr').find('td:nth-child(8)').find('span').css("display","flex"); // Disable the button
    }else{
        $(x).closest('tr').css('background','#ffff');
        $(x).closest('tr').find('td:nth-child(7)').find('input').css("display","none"); // Disable the button
        $(x).closest('tr').find('td:nth-child(8)').find('span').css("display","none"); // Disable the button
        //console.log("Checkbox is unchecked");
    };

};

function proceed(){
    
   var all = $('#table-datas').find('tr');
   var pon = $('#pp_pon').html();
   console.log(pon)
   var office = $('#office').closest('select').val()
    var supplier = $("#pp_supplier").html();
    var date = $("#pp_date").html();
    console.log(office)
    $("#s_pon").html(pon)
    $("#s_supplier").html(supplier)
    $("#s_date").html(date)
    $("#s_office").html(office)
    g_description = [];
    g_item_id = [];
    g_unit_cost = [];
    g_arrived_qty = [];
    g_total_cost = [];
    g_waiting_qty = [];
    g_brand = [];
   ////console.log(all)

   all.each(function() {
    ////console.log('dfds')
        if($(this).find('td:nth-child(1)').find('input').is(':checked')){
            g_item_id.push($(this).find('td:nth-child(9)').find('input').val());
          //  var u_cost = $(this).find('td:nth-child(8)').find('span').find('input').val();
            var ar_qty = $(this).find('td:nth-child(8)').find('span').find('input').val();
           // var brnd = $(this).find('td:nth-child(7)').find('input').val();
            var t_qty = $(this).find('td:nth-child(6)').text(); 
            var descpt = $(this).find('td:nth-child(3)').text(); 
            var u_cost = $(this).find('td:nth-child(10)').find('input').val(); 
            var br = $(this).find('td:nth-child(7)').find('input').val(); 
            
            //console.log("description: "+descpt)
            //console.log("total: "+t_qty)
            //console.log("arrived: "+ar_qty)
            //console.log("remaining: "+g_waiting_qty)
            //console.log("u cost: "+u_cost)
            //console.log("brand: "+br)
            var g_tot = ar_qty*u_cost;
            var g_wait =t_qty-ar_qty;
            console.log("re:"+g_wait)
            g_description.push(descpt);
            g_brand.push(br);
            g_unit_cost.push(u_cost);
            g_arrived_qty.push(ar_qty);
            g_total_cost.push(g_tot);
            g_waiting_qty.push(g_wait);;
            //console.log(g_unit_cost)
        }
    });
   // //console.log(item_id.length)
    $('#summary').modal('show');
    $("#table-datasx").html("z")
var str="";
var j = 1;

    for(var i=0; i<g_item_id.length; i++){
        ////console.log(g_item_id[i])
        str+="<tr><td>"+j+"</td>"+
            "<td>"+g_description[i]+"</td>"+
            "<td>"+g_brand[i]+"</td>"+
            "<td>₱ "+g_unit_cost[i]+"</td>"+
            "<td>"+g_arrived_qty[i]+"</td>"+
            "<td>₱ "+g_total_cost[i]+"</td>"+
            "<td id='i_qty'>"+g_waiting_qty[i]+"</td></tr>";
        j++;  
    }
    $("#table-datasx").html(str)
   
}

function refresh(){
    pon = $("#pp_pon").html();
    office = $("#office").val();
    //console.log("PON-OFF:"+pon+" & "+office)
     //console.log(pon)
    $.ajax({
      type:"POST",
      url:"delivery_items_load_office_item.php",
      data:{
      id: pon,
      office: office,
      },
      beforeSend:function(){
        $('#load-gif').css("display","block");
      },

      success:function(data){
        setTimeout(function() {
            $("#office-items").html(data);
            $('.ttable').css("width","100%");
            $("#btn-add").prop('disabled', false);
            $('#load-gif').css("display","none");
            $(document).ready(function () {
            $('.ttable').DataTable();
             btn_add_sub()
        });
        }, 500);
      },
      complete: function(){
         $(document).ready(function () {
          $('.ttable').DataTable();
      });
      },
  }); 
}

function confirm(){

    //console.log("wait:"+g_waiting_qty)
    //console.log("arr_qty:"+g_arrived_qty)
    console.log("id_length: "+g_item_id.length)
    console.log("ar_qty "+g_arrived_qty)


    $.ajax({
        type:"POST",
        url:"delivery_item_load_offices_save.php",
        data:{
        pon: $('#pp_pon').html(),
        office: $('#office').val(),
        supplier: $('#pp_supplier').html(),
        item_id:g_item_id,
        arr_qty:g_arrived_qty,
        arr_u_price:g_unit_cost,
        arr_t_price: g_total_cost,
        waiting_qty:g_waiting_qty,
        brand_item: g_brand,
        date: $('#pp_date').html(),
        description: g_description,
        
        },
        beforeSend:function(){
                $('#load-gif').css("display","block");
                //console.log("sds")
        },
        success:function(response){
            $('#summary').modal('hide');
            
            //console.log(response)
            if(response==true){
                $.sweetModal({
                    content: '<h3>Save successfully!</h3>. <br> <h4>Note* The available stock (withdrawable quantity) of each item has been updated successfully.</h4> ',
                    icon: $.sweetModal.ICON_SUCCESS
                });
                refresh()
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
        },
        complete: function(){
          $('#load-gif').css("display","none");
         $(document).ready(function () {
          $('.ttable').DataTable();
      });
        },
        
    });

}

function minus(x) {
    
            // Event handler code here
            //console.log("ds")
       // get the input field in the same row as the button
        var input = $(x).closest('tr').find('td:nth-child(8)').find('span').find('input');
        var tt= $(x).parent().parent().parent().parent().find("td:nth-child(6)").html()
        //console.log(input)
        // decrement the input value
        console.log(tt)
        console.log(input.val())
        
       if (parseInt(input.val()) > 0) {
            input.val(parseInt(input.val()) - 1);
            // trigger the input change event
            input.trigger('change');
        }
        var input = $(x).closest('tr').find('td:nth-child(8)').find('span').find('input');
        var tt= $(x).parent().parent().parent().parent().find("td:nth-child(6)").html()
        if(input.val()<=tt){
            console.log("gdfg")
            $(x).parent().parent().parent().parent().find("td:nth-child(8)").children().find(".plus").prop('disabled', false)
        }
};

function plus(x) {
    
    // Event handler code here
    //console.log("ds")
// get the input field in the same row as the button
var input = $(x).closest('tr').find('td:nth-child(8)').find('span').find('input');
var tt= $(x).parent().parent().parent().parent().find("td:nth-child(6)").html()


//console.log(input)
// decrement the input value
    input.val(parseInt(input.val()) + 1);
    // trigger the input change event
    input.trigger('change');

    var input = $(x).closest('tr').find('td:nth-child(8)').find('span').find('input');
var tt= $(x).parent().parent().parent().parent().find("td:nth-child(6)").html()
    if(input.val()>=tt){
        $(x).prop('disabled', true);
    }

};

// input change handler
$('input[type="number"]').change(function() {
    // get the total value for the table
    var total = 0;
    $('input[type="number"]').each(function() {
        total += parseInt($(this).val());
    });
    $('#total').text(total);
});


function btn_adds(x){
    var uc = $(x).parent().parent('input').html();
  /*  var data = uc.children('input').map(function(){
            return $(this).text();
        }).get();*/
    //console.log(uc)

}
function btn_minus(x){
    var uc = $(x).parent().children('input:nth-child(1)').val();

}
function btn_add_sub(){

    /*
    $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    */
}

    


$(function() {
    $('#datepickers').datepicker();
});

$(document).ready(function () {
    $('.ttable').DataTable();
});

function per_item(){

    $.ajax({
        type:"POST",
        url:"delivery_items_per_item.php",
        beforeSend:function(){
           
                $('#load-gif').css("display","block");
                //console.log("sds")
        },
        success:function(data){
            $(".ins-content").html(data);
        },
        complete: function(){
          $('#load-gif').css("display","none");
         $(document).ready(function () {
          $('.ttable').DataTable();
      });
        },
    });

};

function per_item_add(){

$.ajax({
    type:"POST",
    url:"delivery_items_per_item_add.php",
    beforeSend:function(){
       
            $('#load-gif').css("display","block");
            //console.log("sds")
    },
    success:function(data){
        $(".ins-content").html(data);
    },
    complete: function(){
      $('#load-gif').css("display","none");
     $(document).ready(function () {
      $('.ttable').DataTable();
  });
    },
});

};




function s_office(x){

  var q = $(x).val();
      //console.log(q)
/*
      $(".s_off").hover(function() {
        
        $('.s_off').css("background","white");
        $('.s_off').css("color","black");
        $(this).css("background-color", "rgb(28, 126, 3)");
        $(this).css("color","#fff");

        $(q).css("background","rgb(28, 126, 3)");
        $(q).css("color","#fff");
        }, function() {
            
        $('.s_off').css("background","white");
        $('.s_off').css("color","black");
        $(this).css("background-color", "white");
        $(this).css("color","black");
        $(q).css("background","rgb(28, 126, 3)");
        $(q).css("color","#fff");
     });
    */

    
     pon = $("#pp_pon").html();
     //console.log(pon)
    $.ajax({
      type:"POST",
      url:"delivery_items_load_office_item.php",
      data:{
      id: pon,
      office: q,
      },
      beforeSend:function(){

        $('#load-gif').css("display","block");
      },

      success:function(data){
        setTimeout(function() {
            $("#office-items").html(data);
            $('.ttable').css("width","100%");
            $("#btn-add").prop('disabled', false);
            $('#load-gif').css("display","none");
            $(document).ready(function () {
            $('.ttable').DataTable();
             btn_add_sub()
        });
        }, 500);
      },
      complete: function(){
         $(document).ready(function () {
          $('.ttable').DataTable();
      });
      },
  }); 

};



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

     $('#id_office').val(data[1]);

      //console.log(data)
      $("#pp_pon").html(data[1]);
      $("#pp_supplier").html(data[2]);
      $("#pp_date").html(data[3]);

  $.ajax({
      type:"POST",
      url:"delivery_items_add_entry.php",
      data:{
      id: data[1],
      supplier: data[2],
      date: data[3],
      },
      beforeSend:function(){
         
              $('#load-gif').css("display","block");
              //console.log("sds")
      },

      success:function(data){
      
      $(".in-right-content").html(data);
     
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
          //console.log(response)
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
            //console.log(response)
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
        //console.log(x);
        myNodelist[i].removeAttribute("disabled");
    }
    
}  
let tr = $(y).parent().parent().html("");
//console.log(tr);

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


$(document).ready(function () {
    
    $('.ttable').DataTable();
    $('.ttable').css("width","100%")
});

</script>
<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
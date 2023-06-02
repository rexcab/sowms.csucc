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


$vars= $userClass->getAllEntries('Withdrawal');

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
</style>
<body>

<div class="modal fade" id="summary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
              
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body" id="modal-details" style="margin:0 10px">
                               
                    </div>
                </form>
              </div>
            </div>  
</div>

<div class="modal fade" id="summary1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
              
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body" id="modal-details1" style="margin:0 40px;  height: 297mm; ">
                               
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
        <?php include 'header.php'; ?>

        <div class="in-content"> 
            <img src='loading.gif' id='load-gif' style="height:100px; width:100px; position:absolute; display: none ;margin:20% 0 0 40%; ">
            <div style='width:100%; '>
                <div style="padding:0 30px">
                    <h3 style="font-weight: 700; ">WITHDRAWS</h3>
                </div>
                <br>
                <div class="dash">
                
                <a href="#" id="com_total_display" style="color:unset; text-decoration:none"> 
                    <div class="box" id="tot_com">
                        <div >
                        <h4><?php echo $userClass->getWithdrawStatus("complete"); ?></h4>
                        </div>
                        <div>
                            <h6>Total of Complete</h6>
                            <span>(Number of offices per P.O.N)</span>
                        </div>
                    </div>
                </a>
                <a href="#" id="not_com_total_display" style="color:unset; text-decoration:none">
                <div class="box" id="tot_not_com">
                
                    <div>
                    <h4><?php echo $userClass->getWithdrawStatus("incomplete"); ?></h4>
                    </div>
                    <div>
                        <h6>Total of Incomplete</h6>
                        <span>(Number of offices per P.O.N)</span>
                    </div>
                    
                </div>
                </a>
                <a href="#" id="all_widthdraw_records" style="color:unset; text-decoration:none">
                <div class="box" id="tot_all_widthdraw">
                
                    <div >
                    <h4><?php if($vars!=""){ echo count($vars); }else{ echo "0";}?></h4>
                    </div>
                    <div>
                        <h6>Total of Widthdrawal</h6>
                        <span>(All entries )</span>
                    </div>
                    
                </div>
                </a>
            </div>
                <hr>
                <br>
                 <div class="e-cards" style="margin:20px;  ">
                 <div id="in-arr">
                        <div style="width:100%; padding: 10px 10px -2px 0; height:45px">
                            
                            <h5 style="float:left"> Recently Widthdraw</h4>
                            <button onclick="location.href='widthdraw_items_new_entry.php'"class="btn btn-primary" style="float:right; margin-right:35px" >New Widthdraw</button>
                            
                        </div>
                        <div class="card" style="width: 98%; padding:10px 0; margin-left: 0 ">
                            
                            <div class="card-body" >    
                                <table class="table ttable" >
                                            <thead class="table">
                                                <tr>
                                                    <th style='width:120px'>Latest</th>
                                                    <th >Entry Number</th>
                                                    <th >P.O.N</th>
                                                    <th >Office</th>
                                                    <th >Detais</th>
                                                    <th style='display:none' ></th>
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
                                                
                                                <tr id='hh'>
                                                    <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $var['entry_no']; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                                    <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                                                    <td style="font-size: 14px;"><button class="btn btn-secondary" onclick='details(this)'>Details</button></td>
                                                    <td style="display:none"><?php echo $var['type']; ?></td>
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
        </div>
    
        </div>
        <br>
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
        $("#sided").find("a:nth-child(6)").css("background","#118911")
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
                    content: 'This is a success.',
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
        //console.log(input)
        // decrement the input value
       if (parseInt(input.val()) > 0) {
            input.val(parseInt(input.val()) - 1);
            // trigger the input change event
            input.trigger('change');
        }
};

function plus(x) {
    
    // Event handler code here
    //console.log("ds")
// get the input field in the same row as the button
var input = $(x).closest('tr').find('td:nth-child(8)').find('span').find('input');
//console.log(input)
// decrement the input value
    input.val(parseInt(input.val()) + 1);
    // trigger the input change event
    input.trigger('change');

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
function imgAfter(){
    document.querySelector("#pic1").src="/sowms/img/csucc-header.png";
    $("#foot").css("visibility","inherit")
}

   function print(){

    document.querySelector("#pic1").src="/sowms/img/csucc-header.png";
    $("#foot").css("visibility","hidden")
        $('#modal-details1').printThis({
            
            debug: false,
            importCSS: true,
            importStyle: true,
            printContainer: true,
            loadCSS: "./sowms/style.css",
            pagetitle: "Print",
            removeInline: false,
            printDelay: 333,
            header: "",
            footer: null,
            formValues:true,
            canvas: false,
            base: false,
            doctypeString: '<!DOCTYPE html>',
            removeScripts: false,
            copyTagClasses: false,
            removeScripts: false,
            afterPrint: imgAfter,
        })
       
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
      url:"widthdraw_items_load_office_item.php",
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
      url:"widthdraw_items_add_entry.php",
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
var a1 = "";
var a2 = "";
var a3 = "";

function details(x){
        $("#modal-details").html("");
          //console.log(pon)
        var type = $(x).parent().parent().find("td:nth-child(6)").html();
        
        var entry_no = $(x).parent().parent().find("td:nth-child(2)").html();
        var date_m = $(x).parent().parent().find("td:nth-child(1)").html();
        a2 = entry_no;
        a3 = date_m;
        console.log(type)
        if(type=="Withdrawal"){
            $.ajax({
                type:"POST",
                url:"email_items_details_withdrawal.php",
                data:{
                    entry_no:entry_no,
                    date_m: date_m,
                },
                beforeSend:function(){
                    $('#load-gif').css("display","block");
                },

                success:function(data){
                    $("#modal-details").html(data);
                },
                complete: function(){
                    $(document).ready(function () {
                    $('.ttable').DataTable();
                    $('#load-gif').css("display","none");
                });
                },
            }); 
            $('#summary').modal('show'); 
        }else{
            $.ajax({
                type:"POST",
                url:"email_items_details.php",
                data:{
                    entry_no:entry_no,
                    date_m: date_m,
                },
                beforeSend:function(){
                    $('#load-gif').css("display","none");
                },

                success:function(data){
                   $("#modal-details").html(data);
                },
                complete: function(){
                    $(document).ready(function () {
                    $('.ttable').DataTable();
                });
                },
            }); 
            $('#summary').modal('show'); 
        }
    }

    
function makePrint(){
    $('#summary').modal('hide'); 
        $("#modal-details1").html("");

        var entry_no = a2;
        var date_m = a3;
 
            $.ajax({
                type:"POST",
                url:"email_items_details_withdrawal_modal.php",
                data:{
                    entry_no:entry_no,
                    date_m: date_m,
                },
                beforeSend:function(){
                    $('#load-gif').css("display","block");
                },

                success:function(data){
                    $("#modal-details1").html(data);
                },
                complete: function(){
                    $(document).ready(function () {
                    $('.ttable').DataTable();
                    $('#load-gif').css("display","none");
                });
                },
            }); 
            $('#summary1').modal('show'); 

    }


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
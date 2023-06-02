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
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<script src='jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.js'></script>
</head>
<body>

<style>
    .upper-group .form-group{
        
        text-align: center;
        font-weight: 700;
    }
    .upper-group .form-group h6{
        font-weight: 700;
        font-family: inherit;
        font-size: 20px;
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
</style>






<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body">
                    
                        <div>
                            <div id="rev">
                               
                            </div>    
                        




                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button"  name="add_pon" class="btn btn-primary" onclick="save()">Save</button>
                            </div>
                      </div>
</div>
                </form>
              </div>
            </div>  
</div>




<!------------------------------------------------------------------------------------->
    
     <div class='containers'>
        <div class='sidebar'>

        <?php include 'sidebar.php';?>
        </div>
        <div class='block'>
        <?php include 'header.php';?>
        <div class='in-content'> 
            
      
            <div class='ins-content' style='display:block'>
            <br>
           <div style='width:95%; padding-left:30px ;height:50px'>
                <h3 style="font-weight: 700; float:left ; ">PURCHASED REQUEST RECORD</h3>
                    <button onclick="location.href='pon_items.php'"class="btn btn-primary" style="float:right" >Create Record </button>
            </div>
           <br>
          

         
            <!-------------------------------------------------->
            <div  id='load-gif' style = "position: fixed; z-index:1; display:none; margin-left: 38%">
            <span style="font-size: 20px; padding-top: 20px;">Sorting...</span><img src='loading.gif'  style="height:100px; width:100px; position:absolute;margin:-48% 0 0 10%; ">
            </div>
                <div class='right-content' style='width:97%; height: 700px; margin-left:20px; display: flex'>

                    <div class='card' style='width:400px; margin-right:20px'>
                    
                        <div class='card-body'>
                        <h5>List of P.O.N that has Records</h5>
                        <br>
                            <div id='result_pon' style='height: 600px;'>
                                <table class='table ttable' >
                                    <thead class='table'>
                                        <tr>
                                            <th>#</th>
                                            <th>P.O.N.</th>
                                            <th >Total of Offices</th>
                                            <th  style='display:none'>Total of Items</th>
                                            <th style='display:none'></th>
                                            <th style='display:none'></th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                                    
                                    if($vars==''){ 
                                        echo ''; 
                                    }else{  
                                        
                                        
                                        $i=1;
                                        foreach($vars as $var){ 
                                            if($userClass->ponCountOffice($var['pon'])!=0){

                                        ?>
                                        <tr  id ='rr'  onclick='s_item(this)'>
                                            <td style='font-size: 14px;'><?php echo $i; ?></td>
                                            <td style='font-size: 14px;' ><?php echo $var['pon']; ?></td>
                                            <td style='font-size: 14px; font-weight:700'><?php echo $userClass->ponCountOffice($var['pon']); ?></td>
                                            <td style='font-size: 14px; font-weight:700; display:none'><?php echo $userClass->ponCountOffice($var['pon']); ?></td>
                                            <td style='font-size: 14px; display:none'><?php echo $var['supplier']; ?></td>
                                            <td style='font-size: 14px; display:none'> <?php echo $var['date']; ?></td>
                                        </tr>
                                        <?php 
                                    
                                        
                                        $i++;
                                    }} }?>
                                    </tbody>         
                                </table>   
                            </div>
                        </div>
                    </div>
                    <div class='card right-content2' style=' width:calc(100% - 420px)' >
                    </div>
                </div>
                <br>
             
                </div>
                
            </div>
       
            <br>
            <br>
            <div id="ff"></div>
            <br>
            <div style='position:absolute; bottom:0; '>
         <?php //include // 'footer.php'; ?>
            </div>
            </div>  
        </div>
    
        </div>



<script type='text/javascript'>

var select_item = [];
var select_item_index = [];
var sorted_items1 = [];
var uniq_office1 = [];
var tablecount=0;
var office_and_item_row=[]
var input_description=[]
var unit=[]
var qty=[]
var xu_price=[]
var xt_price=[]
var g_id = 0;
var g_supplier = 0;
var g_date = 0;
$(function() {
    $('#datepickers').datepicker();
});
$(document).ready(function () {
    $('.ttable').DataTable();
});
$(document).ready(function () {
    $('.dataTables_length').remove();
    $('.dataTables_filter').css('float', 'left');
   
});


$(function() {
        $("#sided").find("a:nth-child(4)").css("background","#118911")
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

function s_item(x){
    $("#rr").css("background","white")
    $("#rr").css("color","black")

    $('#rr').hover(
    function() {
      $(this).css("background","rgb(17, 137, 17)")
    },
    function() {
        $(this).css("background","white")
        $(this).css("color","black")
        }
    );

    console.log($(x).parent().html())
    $(x).closest('tr').css("background","rgb(17, 137, 17)")
    $(x).closest('tr').css("color","white")


   var xr = $(".progress-bar").css("width","34%")
    g_id = $(x).find("td:nth-child(2)").html();
    g_supplier = $(x).find("td:nth-child(3)").html();
    g_date = $(x).find("td:nth-child(4)").html();
    
  
   $.ajax({
    type:'post',
      url:'record_load_pon.php',
      data:{
        id:$(x).find("td:nth-child(2)").html(),
        supplier:$(x).find("td:nth-child(5)").html(),
        date: $(x).find("td:nth-child(6)").html(),
      },
      success:function(response){
        $(".right-content2").html(response)
        $('.ttable').DataTable();
      }
   })
  
}

function tr(x){
    var v = $(x).find("td:nth-child(2)").html();
   var t = $(x);
   var i =  $(x).attr('id');
    var temp = $(".s-item").html();
    var str = "<li class='list-group-item'><span>"+v+"</span><span style='display:none'>"+i+"</span><button type='button' onclick='tr_remove(this)' class='btn btn-danger btn-sm' style='float:right'>remove</button></li>";
    $(".s-item").html(str+temp);

    var row = $(x);
   
    $(document).ready(function() {
        row.removeAttr('onclick');
        row.attr("disabled", "disabled");
        row.css("opacity","0.5")
    });
  
}


function tr_remove(x){
    var i = $(x).parent().find("span:nth-child(2").html();
    var x = $(x).parent().remove();
    var a = $("#select-item-right").find("#"+i);
    a.css("opacity","1.0")
    a.attr('onclick', 'tr(this)');
}

function procced_to_select_office(){

   var s_item= $(".s-item").find("li")
   select_item = [];
   select_item_index = [];
   s_item.each(function(index, element) {
    // Perform actions on each <li> element
  //  console.log($(element).find("span:nth-child(1").html());
  select_item.push($(element).find("span:nth-child(1").html());
  select_item_index.push($(element).find("span:nth-child(2").html());
  });

 console.log(select_item);
 console.log(select_item_index);



 //////////////////////////////
 var xr = $(".progress-bar").css("width","65.5%")
 
 $.ajax({
 type:'post',
   url:'pon_items_select_office.php',
   data:{
    pon:g_id,
    select_item:select_item,
    select_item_index,select_item_index,
   },
   success:function(response){
     $(".right-content").html(response)
     dropdown_office()
   }

})

 
}



function proceed_sort(){

var array = [];
var array_t = [];
var u_office = [];
var itemm = [];
var sorted_items = [];
$(document).ready(function () {
$(".right-content").html("")
    $('#load-gif').css("display","block");
})

var t = document.querySelectorAll(".dropdown-menu");
var i =0; //index



t.forEach((s) => {
   
    array_t[i] = [];
    //console.log('index '+i)
      itemm.push($(s).parent().parent().find('td').html());
        var temp = ($(s).parent().find('.dropdown-item'))

        temp.find('input[type="checkbox"]:checked').each(function() {
              array_t[i].push($(this).parent().find('input').val())
              u_office.push($(this).parent().find('input').val())
        });
       
    i++;
});
// console.log(array_t);
const uniq_office = [...new Set(u_office)];

//sort


i=0;
var j=0;
uniq_office.forEach((x)=>{
    sorted_items[i] =[];
  // console.log(x)
  j=0;
    array_t.forEach((p)=>{
        l=0;
        p.forEach((q)=>{
            if(x==q){
               sorted_items[i].push(itemm[j])
            //   console.log(  itemm[j])
            
            }
            l++;
        })
        j++;
    })
    i++;
  
})


var xr = $(".progress-bar").css("width","97%")
$.ajax({
    type:'post',
      url:'pon_items_sort.php',
      data:{
        pon:g_id,
        uniq_office:uniq_office,
        sorted_items,sorted_items,
      },
      beforeSend:function(){
      
      },
      success:function(response){
        $(".right-content").html("")
       
        setTimeout(function() {
           
            $(document).ready(function () {
                $('#load-gif').css("display","none");
                    $(".right-content").html(response)
                });
            }, 1000);
       
      }
})
console.log(uniq_office)
console.log(sorted_items)
uniq_office1 =uniq_office;
sorted_items1 =sorted_items;

}


const options = {
  style: 'currency',
  currency: 'PHP',
};
function qtyy(x){
  //  console.log($(x).val())
  $(document).ready(function() {
    var u_price = $(x).parent().parent().find("td:nth-child(4)").find("input").val()
    if(u_price!=""){
        var t_price = u_price*$(x).val()
        $(x).parent().parent().find("td:nth-child(4)").find("input").val(+u_price)
        t_price = t_price.toLocaleString('en-PH', options);
        $(x).parent().parent().find("td:nth-child(5)").find("input").val(t_price)
    }

    });
   
}

function u_price(x){
    $(document).ready(function() {
       $(x).on('input', function() {
           $(x).val($(x).val())
           $(x).attr('value', $(x).val());

           var qty = $(x).parent().parent().find("td:nth-child(3)").find("select").val()

           var t_price = qty*$(x).val();
           t_price = t_price.toLocaleString('en-PH', options);
           
            $(x).parent().parent().find("td:nth-child(5)").find("input").val(t_price)
        })
    })
} 


function review(x){
    $("#rev").empty()
// get quanty of office and its name
  var rowCount = $('table').length;
  var check_u_price = document.querySelectorAll(".u_price");
  var check = false;
  for (var i = 0; i < check_u_price.length; i++) {
            var value = check_u_price[i].value;
            if (value==""){
                check = true;
            }
    }
    if(check==true){
       alert('Please complete all inputs!'); 
    }else{
        
            for(var i =1; i<=rowCount; i++){
                office_and_item_row[i-1]=[];
                office_and_item_row[i-1].push($("table:nth-child("+i+")").find("thead tr th").html())
                office_and_item_row[i-1].push($("table:nth-child("+i+")").find("tbody tr").length)
            }

            //getting of all data inout/selected

            tablecount = rowCount;

            input_description = getAlldata(".description")
            unit = getAlldata(".unit")
            qty = getAlldata(".qty")
            xu_price = getAlldata(".u_price")
            xt_price = getAlldata(".t_price")

            


            /** function that collect data and put in array then return */
            function getAlldata(inputs){
                var str = document.querySelectorAll(inputs)
                var temp=[];

                for (var i = 0; i < str.length; i++) {
                    if(".description"==inputs){
                        temp.push((str[i].innerHTML));
                    }else{
                        temp.push((str[i].value));
                    }
                }
                return temp;
            }
            console.log(office_and_item_row)

            //modal
            
            $.ajax({
                type:'post',
                url:'pon_items_sort_modal.php',
                data:{
                    pon:g_id,
                    supplier:g_supplier,
                    date:g_date,
                    tablecount:tablecount,
                    office_and_item_row:office_and_item_row,
                    input_description:input_description,
                    unit:unit,
                    qty:qty,
                    u_price:xu_price,
                    t_price:xt_price,
                },
                success:function(response){
                
                $("#rev").html(response)
                $('#review').modal('show');
                
                }
                
            })

    }
}

function save(){

    $.ajax({
    type:'post',
      url:'pon_items_save.php',
      data:{
        pon:g_id,
        supplier:g_supplier,
        date:g_date,
        tablecount:tablecount,
        office_and_item_row:office_and_item_row,
        input_description:input_description,
        unit:unit,
        qty:qty,
        u_price:xu_price,
        t_price:xt_price,
      },
      success:function(response){
       
        $('#review').modal('hide');
            if(response==true){
                $.sweetModal({
                    content: 'Save successfully.',
                    icon: $.sweetModal.ICON_SUCCESS,
                    buttons: [{
                        label: 'Close',
                        classes: 'redB',
                        action: function() {
                            location.reload();
                        }
                    }],
                    afterClose: function() {
                        location.reload();
                    }
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
                    ]
                }
            );
        }
      }
      
})
}
$(document).ready(function () {
    
    $('.ttable').DataTable();
    $('.ttable').css("width","100%")
});


</script>

<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
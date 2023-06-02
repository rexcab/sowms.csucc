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
                        <div class='progress-bar bg-success' role='progressbar' aria-valuenow='75' style="width: 0%;"aria-valuemin='0' aria-valuemax='100'></div>
                        <i class='fa-solid fa-circle fa-xl' style='color: #1d8129;'></i>
                    </div>
                   
                </div>
            </div>

            <!-------------------------------------------------->
                <div class='right-content' style='width:97%; height: 700px; margin-left:20px'>

                
                    <div class='card' style='width: 100%'>

                        <div class='card-body'>

                            <div class='tops' style='display:FLEX' >
                                <h4>Purchased Order Number: 248292</h4>
                            </div>
                                <br>
                                <h5>Office 1</h5>
                                <div id='result_pon' style=''>
                                    <table class='table table-bordered' >
                                        <thead class='table'>
                                            <tr>
                                                <th colspan="10" style="font-size:20px">CEIT</th>
                                            </tr>
                                            <tr>
                                                <th>Item name/Description</th>
                                                <th>Unit</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>Total Price</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            

                                            <tr>
                                                <td class="description" style="width:300px;font-size:15px">TVs</td>
                                                <td>
                                                    <select class="form-select unit" aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qty(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)"></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled></input></td>
                                            </tr>
                                            <tr>
                                                <td class="description" style="width:300px;font-size:15px">TVs</td>
                                                <td>
                                                    <select class="form-select unit" aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qty(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)"></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled></input></td>
                                            </tr>
                                            <tr>
                                                <td class="description" style="width:300px;font-size:15px">TVs</td>
                                                <td>
                                                    <select class="form-select unit" aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qty(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)"></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled></input></td>
                                            </tr>
                                         
                                        </tbody>    
                                    </table> 
                                    <table class='table table-bordered' >
                                        <thead class='table'>
                                            <tr>
                                                <th colspan="10" style="font-size:20px">CEIT</th>
                                            </tr>
                                            <tr>
                                                <th>Item name/Description</th>
                                                <th>Unit</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>Total Price</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                        <tr>
                                                <td class="description" style="width:300px;font-size:15px">TVs</td>
                                                <td>
                                                    <select class="form-select unit"  aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qty(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)"></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled></input></td>
                                            </tr>
                                            <tr>
                                                <td class="description" style="width:300px;font-size:15px">TVs</td>
                                                <td>
                                                    <select class="form-select unit" aria-label="Default select example" id="unit[]" name="unit"  required>
                                                    <option value="Unit">Unit</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pieces">Pieces</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Boxes">Boxes</option>
                                                        <option value="Rim">Rim</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Catridges">Catridges</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Can">Can</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Foot">Foot</option>
                                                        <option value="Feet">Feet</option>
                                                        <option value="Copies">Copies</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-select qty" aria-label="Default select example" id="qty[]" name="unit"  onclick="qty(this)" required>
                                                    <?php for($i=1;$i<=1000;$i++){
                                                        echo "<option value=$i>$i</option>";
                                                    } ?>
                                                        
                                                    </select></td>
                                                <td> <input type="text" class="form-control u_price" id='u_price[]' value="" onclick="u_price(this)"></input></td>
                                                <td><input type="text" class="form-control t_price" id='t_price[]' disabled></input></td>
                                            </tr>

                                         
                                         
                                        </tbody>    
                                    </table> 
                                    <button type="button" class="btn btn-primary" onclick="sort_and_input(this)">Sort</button>
                                </div>
                                <br>
                                
                        </div>
                    </div>

                   
                </div>
                <br>
             
                </div>
                
            </div>
       
            <br>
            <br>
            <br>
           <!-- <div style='position:absolute; buttom:0; width:100%'>
               /* <?php //include 'footer.php'; ?>*/
            </div>-->
            </div>  
        </div>
    
        </div>



<script type='text/javascript'>

var select_item = [];
var select_item_index = [];

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

function s_item(x){

   var xr = $(".progress-bar").css("width","24.5%")

   $.ajax({
    type:'post',
      url:'pon_items_select.php',
      data:{
      },
      success:function(response){
        $(".right-content").html(response)
      }
   })
   /** */
}

function tr(x){
    var v = $(x).find("td:nth-child(2)").html();
   var t = $(x);
   var i = t.find("td:nth-child(3)").html()
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
    var a = $("#select-item-right").find("tr:nth-child("+i+")");
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
 var xr = $(".progress-bar").css("width","50%")
 
 $.ajax({
 type:'post',
   url:'pon_items_select_office.php',
   data:{
    select_item:select_item,
    select_item_index,select_item_index,
   },
   success:function(response){
     $(".right-content").html(response)
     dropdown_office()
   }

})

 
}

function dropdown_office(){

$(".dropdown-menu").on('click', function(e) {
    e.stopPropagation();
  });

 //  console.log($(".dropdown-menu").html())
  $('.dropdown-item').find('input[type="checkbox"]').on('click', function() {
    var selectedItems = [];
   // console.log($(this).parent().parent().html())
 //   console.log("Dfd")
    $(this).parent().parent().find('.dropdown-item input[type="checkbox"]:checked').each(function() {
      selectedItems.push($(this).val());
    });
    
    var buttonText = "Select Items";
    if (selectedItems.length > 0) {
      buttonText = selectedItems.join(", ");
    }
  
    $(this).parent().parent().parent().find('.dropdown-toggle').html(buttonText); 
    

  });



  //////////////////////////////////




}



function proceed_sort(){

var array = [];
var array_t = [];
var u_office = [];
var itemm = [];
var sorted_items = [];
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
console.log(uniq_office)
console.log(uniq_office)
console.log(sorted_items)

}
const options = {
  style: 'currency',
  currency: 'PHP',
};
function qty(x){
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


function sort_and_input(x){

// get quanty of office and its name
  var rowCount = $('table').length;
  var office_and_item_row = []
  for(var i =1; i<=rowCount; i++){
    console.log($("table:nth-child("+i+")").find("thead tr th").html())
    console.log($("table:nth-child("+i+")").find("tbody tr").length)

  }

  //getting of all data inout/selected

    
  var input_description = getAlldata(".description")
  var unit = getAlldata(".unit")
  var qty = getAlldata(".unit")
  var u_price = getAlldata(".u_price")
  var t_price = getAlldata(".t_price")

  


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
 
  
}
</script>
</body>
</html>
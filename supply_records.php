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



$vars = $userClass->getSupplyRecords();

if(isset($_POST['add'])){
    $userClass->addSupplyRecords();
  header("Location:supply_records.php");
}
if(isset($_POST['delete'])){
    $userClass->deleteSupplyRecords();
     header("Location:supply_records.php");
}

if(isset($_POST['edit'])){
    $userClass->editSupplyRecords();
     header("Location:supply_records.php");
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>

<div class="modal fade" id="add_hh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body">
                    
                        <div>
                                <table class="table">
                                    <thead class="table-dark">    
                                        <tr>  
                                        <th><h5>Add New Data</h5></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div class="dis">
                                    <!--
-->
                                    <div class="form-group">
                                            <label>Purchased Order Number</label>
                                            <input type="text" class="form-control" id="citys" name="pon" placeholder="Enter purchased order number" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Supplier</label>
                                       <input type="text" class="form-control" id="citys" name="supplier" placeholder="Enter supplier" required>
                                   </div>
                                    <div class="form-group">
                                       <label>Date </label>
                                               <div class="row form-group" style="margin-left:0px">
                                                   <div class="col-sm-17">
                                                       <div class="input-group date" id="datepickers" >
                                                           <input type="text" class="form-control" name="date" required>
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
                                <div class="dis">
                                   
                                   
                                   
                               </div>
                               <div class="dis">
                                   
                                 
                                   <!--
                                   <div class="form-group">
                                       <label>Withdraw by</label>
                                       <input type="text" class="form-control" id="citys" name="withdrawby" placeholder="Enter withdraw by" required>
                                   </div> -->
                               </div>
                               <br>
                               
                               <div>
                                <table class="table">
                                    <thead class="table-secondary">    
                                        <tr>  
                                        <th><h6>Add Article/Description</h6></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div id="articles">
                               
                                </div>
                                <hr>
                                <div class=btn>
                                    <button type="button" class="btn btn-primary" id="add_more">Add</button>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="add" class="btn btn-primary">Save</button>
                    </div>
                </form>
              </div>
            </div>  
</div>


<!-------------------------------->
<div class="modal fade" id="edit_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
      
                  </button>
                </div>
                
                
                <form action="" method="post">
                    <div class="modal-body">
                        <div>
                                <table class="table">
                                    <thead class="table-dark">    
                                        <tr>  
                                        <th><h5>Update Data</h5></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                
                                <div class="form-group">
                                <input type="hidden"  id="id" name="id">
                                    <label>Office</label>
                                       <select class="form-select" aria-label="Default select example" name = "office" onclick="office_add(this)" id="office" required>
                                            <option value="Chancellor">Chancellor</option>
                                            <option value="Finance Management System">Finance Management System</option>
                                            <option value="Human Resource">Human Resource</option>
                                            <option value="Registrar">Registrar</option>
                                            <option value="General Education">General Education</option>
                                            <option value="BAC">BAC</option>
                                            <option value="Guidance and Counselling">Guidance and Counselling</option>
                                            <option value="Supply">Supply</option>
                                            <option value="CITTE Faculty">CITTE Faculty</option>
                                            <option value="CEIT Faculty">CEIT Faculty</option>
                                            <option value="OSWD">OSWD</option>
                                            <option value="OSAS">OSAS</option>
                                            <option value="RGMS">RGMS</option>
                                            <option value="Campus Publication">Campus Publication</option>
                                            <option value="QUAMS">QUAMS</option>
                                            <option value="RDE">RDE</option>
                                            <option value="Clinic">Clinic</option>
                                            <option value="Library">Library</option>
                                            <option value="CTHM office">CTHM office</option>
                                            <option value="Computer Laboratory">Computer Laboratory</option>
                                            <option value="MAED">MAED</option>
                                            <option value="Records">Records</option>
                                            <option value="General Services">General Services</option>
                                            <option value="DLHS">DLHS</option>
                                            <option value="MIS">MIS</option>
                                            <option value="Planning">Planning</option>
                                            <option value="other">Other</option>
                                        </select>
                                </div>
                                <div class="dis">
                                <div class="form-group">
                                        <label>Purchased Order Number</label>
                                        <input type="text" class="form-control" id="pon" name="pon" placeholder="Enter purchased order number" required>
                                    
                                    </div>
                                    <div class="form-group" style="width:182%;">
                                        <label>Article/Description</label>
                                        <input type="text" class="form-control" id="articless" name="articles" placeholder="Enter articles/description" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Unit</label>
                                        <select class="form-select" aria-label="Default select example" id="unit" name="unit" onclick="unit_add(this)" required>
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
                                    </div>
                                    
                                </div>
                                <div class="dis">
                                    <div class="form-group">
                                    <label>Quantity</label>
                                        
                                        <select class="form-select" aria-label="Default select example" id="qtyx" name="qty" required>
                                        <?php  
                                        for($t=1;$t<=1000;$t++){ ?>    
                                            <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                        <?php } ?>
                                        <option value="other">other</option>
                                        </select>
                                        </div>
                                    <div class="form-group">
                                        <label>Unit Cost</label>
                                        <input type="number" class="form-control" id="unitcostx" name="unitcost" placeholder="Enter unit cost" onKeyUp="unitCostx()" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Cost</label>
                                        <input type="text" class="form-control" id="totalcostx" name="totalcost" placeholder="Enter total cost" readonly required>
                                    </div>
                                </div>
                                <div class="dis">
                                   
                                <div class="form-group">
                                        <label>Date</label>
                                                <div class="row form-group" style="margin-left:0px">
                                                    <div class="col-sm-17">
                                                        <div class="input-group date" id="datepicker" >
                                                            <input type="text" class="form-control" id="datewithdraw" name="datewithdraw" required >
                                                            <span class="input-group-append">
                                                                <span class="input-group-text bg-white" style="font-size:1.5rem">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

 
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <input type="text" class="form-control" id="suppliers" name="supplier" placeholder="Enter supplier" required>
                                    </div>
                                </div>
                               

                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="edit" class="btn btn-primary">Save</button>
                    </div>
                </form>
              </div>
            </div>  
</div>


<!----------------------------------------------------------------------->
<div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm delete</h4>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <span>Are you sure you want to delete this data?</span>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <form action="" method="post">
                        <input type="hidden" name="idd" id="ids">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>  
</div>

<!----------------------------------------------------------------------->

    <div class="containers">
    <div class="sidebar">

        <div class="logo">
            <img src="img/user_logo.png" class="head-picture" alt="">
        </div>
        <div class="name">
        <span><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']." | </span><span style='margin-left:0; margin-right: 10px;
    color: #00e900;
    font-size: 16px;
    padding-top: 15px;'>".$_SESSION['accesstype']; } ?></span><a href="logout.php" class="btn logout-btn" >Logout</a>
        </div>
        <div class="tags">
            <h4>MANAGE</h4>
        </div>
            <a href="supply_records.php" >
                <h6 style="background-color:#118911;">Supply Records</h6>
            </a>
            <a href="track_widthdraw.php">
                <h6>Track Widthdraw</h6>
            </a>
            
            <a href="offices_informations.php">
                <h6>Offices</h6>
            </a>
            <!--
            <a href="records_panel.php">
                <h6>Widthdrawal Records</h6>
            </a> -->
        </div>
        <div class="head">
        <i class="fas fa-bars" onclick="offSide()"></i>
            <img src="carsucc.png" class="head-picture" alt="">
            <header class="title">
                <h2>Supply Office Widthdrawal Monitoring System CSUCC</h2>
            </header>
        </div>
     
  

    <div class="in-content"> 

        <div class="tops" >
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_hh" > Add data</button>  
        </div>
           <br>
            <div>
            <table class="display ttable">
                <thead >
                    <tr>
                        <th >#</th>
                        <th style="width:105px;">Date</th>
                        <th style="width:90px;">P.O.N.</th>
                        <th style="width:130px;">office</th>
                        <th style="width:50px;">Qty</th>
                        <th style="width:60px;">Unit </th>
                        <th style="width:120px;">Articles</th>
                        <th style="width:80px;">Unit Cost </th>
                        <th style="width:80px;">Total Cost </th>
                        <th style="width:120px;">Supplier</th>
                        <th style="display:none">hh</th>
                        <th >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($vars==false){ 
                        echo ""; 
                
                    }else{                        
                    $i=1;
                
                    foreach($vars as $var){

                    ?><tr>
                        <td style="font-size: 14px;"><?php echo $i; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['date']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['purchasedOrderNumber']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['qty']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['unit']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['articles']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['unitcost']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['totalcost']; ?></td>
                        <td style="font-size: 14px;"><?php echo $var['supplier']; ?></td>
                      
                    <td ><span style="display:flex;"><button type="button" class="btn btn-primary btn-sm " onclick="edit(this)" style="height:29px; margin-right:3px;">update</button>
                        
                    </td>  <td style="display:none"><?php echo $var['id']; ?></td>
                                    </tr>
                                    <?php 
                                    $i++;
                                    }
                            } ?>

            
                            </tbody>         
                        </table>   
                        <br>
            </div> 
        </div>  

    </div>

 

    



<script type="text/javascript">
$(document).ready(function () {
    $('.ttable').DataTable();
});

$(function() {
    $('#datepicker').datepicker();
});

$(function() {
    $('#datepickers').datepicker();
});
function dropz(x){
  $(x).parent().parent().parent().remove();
}

var add_app = document.getElementById('articles');
  $(document).ready(function(){
    $('#add_more').on('click',function(){ 
      
      const myNodelist = document.querySelectorAll(".cont").length;
      var tbl = "";
      tbl =
      "<div class='cont' style='border-top:2px solid black; padding-top:10px'>"+
      
      "<div class='dis'>"+
      
                "<div class='form-group' style=''>"+
                    "<label>Article/Description</label>"+
                    "<input type='text' class='form-control' id='firstnames' name='articles[]' placeholder='Enter articles/description' required>"+
                "</div>"+

                "<div class='form-group'>"+
                "<label>Office</label>"+
                "<select class='form-select' aria-label='Default select example' onclick='office_add(this)' name = 'office[]' required>"+
                "<option value='Chancellor'>Chancellor</option>"+
                "<option value='Finance Management System'>Finance Management System</option>"+
                "<option value='Human Resource'>Human Resource</option>"+
                "<option value='Registrar'>Registrar</option>"+
                "<option value='General Education'>General Education</option>"+
                "<option value='BAC'>BAC</option>"+
                "<option value='Guidance and Counselling'>Guidance and Counselling</option>"+
                "<option value='Supply'>Supply</option>"+
                "<option value='CITTE Faculty'>CITTE Faculty</option>"+
                "<option value='CEIT Faculty'>CEIT Faculty</option>"+
                "<option value='OSWD'>OSWD</option>"+
                "<option value='OSAS'>OSAS</option>"+
                 "<option value='RGMS'>RGMS</option>"+
                 "<option value='Campus Publication'>Campus Publication</option>"+
                 "<option value='QUAMS'>QUAMS</option>"+
                 "<option value='RDE'>RDE</option>"+
                 "<option value='Clinic'>Clinic</option>"+
                 "<option value='Library'>Library</option>"+
                 "<option value='CTHM office'>CTHM office</option>"+
                 "<option value='Computer Laboratory'>Computer Laboratory</option>"+
                 "<option value='MAED'>MAED</option>"+
                 " <option value='Records'>Records</option>"+
                 "<option value='General Services'>General Services</option>"+
                 "<option value='DLHS'>DLHS</option>"+
                 "<option value='MIS'>MIS</option>"+
                 "<option value='Planning'>Planning</option>"+
                 "<option value='other'>Other</option>"+          
                 "</select>"+
                 "</div>"+



                 "<div class='form-group'>"+
                "<label>Unit</label>"+
                    "<select class='form-select' aria-label='Default select example' name='unit[]' onclick='unit_add(this)'>"+
                        "<option value='Unit'>Unit</option>"+
                        "<option value='Piece'>Piece</option>"+
                        "<option value='Pieces'>Pieces</option>"+
                        "<option value='Box'>Box</option>"+
                        "<option value='Boxes'>Boxes</option>"+
                        "<option value='Rim'>Rim</option>"+
                        "<option value='Set'>Set</option>"+
                        "<option value='Catridges'>Catridges</option>"+
                        "<option value='Gallon'>Gallon</option>"+
                        "<option value='Can'>Can</option>"+
                        "<option value='Meter'>Meter</option>"+
                        "<option value='Foot'>Foot</option>"+
                        "<option value='Feet'>Feet</option>"+
                        "<option value='Copies'>Copies</option>"+
                        "<option value='Pack'>Pack</option>"+
                        "<option value='other'>Other</option>"+
                    "</select>"+
                "</div>"+
                
            "</div>"+
            "<div class='dis'>"+
                "<div class='form-group'><input type='hidden' value='";
                tbl+=myNodelist;
                tbl+="'><label>Quantity</label>"+
                    "<select class='form-select' aria-label='Default select example' onclick='qtyz(this)' name='qty[]' required  >";
                   
                   for(var p=1;p<=1000;p++){
                    tbl+="<option value=";
                    tbl+=p;
                    tbl+=">";
                    tbl+=p;
                    tbl+="</option>"; 
                   }
                   tbl+="<option value='other'>other</option>";
                   
                   tbl+="</select>"+
                    "</div>"+
                "<div class='form-group'><input type='hidden' value='";
                tbl+=myNodelist;
                tbl+="'><label>Unit Cost</label>"+
                    "<input type='text' class='form-control' id='unnit_cost' name='unitcost[]' placeholder='Enter unit cost' onKeyUp='unitCost(this)' required>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<label>Total Cost</label>"+
                    "<input type='text' class='form-control' id='total_cost[]' name='totalcost[]' readonly required>"+
                    "</div>"+  
                    "<div class='form-group' style=' width: 100px; margin: 26px 10px;'>"+
                    "<button class='btn btn-danger btn-sm rounded-0'  onclick='dropz(this)' type='button' data-toggle='tooltip' data-placement='top' title='Delete'>"+
                    "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>"+
                    "<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>"+
                    "<path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg>"+
                    "</button></td>"+  
               "</div>"+   
                "</div>";                                                   
            
      $(add_app).append(tbl);
    })
})



$(document).ready(function(){
    $('#search_text').on('keyup',function(){
    console.log($('#search_text').val());
    document.getElementById('cc').style.display= 'none';
        $.ajax({
            type:"POST",
            url:"fetch_search_supply_records.php",
            data:{
            name:$('#search_text').val(),
            },
            success:function(data){
            $("#result").html(data);
            }
        });
    });
});

function qtyz(x){
    var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text'  class='form-control' name='qty' placeholder='Enter qty' required>"));
    }

    var uc = $(x).parent().children('input:nth-child(1)').val();

const myNodelist = document.querySelectorAll(".cont");       
for (let i = 0; i < myNodelist.length; i++) {
    if(i==uc){
        var qty = myNodelist[i].children[1].children[0].children[2].value;
        console.log(qty);
        
        var unc = myNodelist[i].children[1].children[1].children[2].value;
        if(unc==""){
            unc=0;
        }
        var tc = myNodelist[i].children[1].children[2].children[1].value=qty*unc;
     
    }
    
}  

}





function unitCost(x){
    var uc = $(x).parent().children('input:nth-child(1)').val();

        const myNodelist = document.querySelectorAll(".cont");       
        for (let i = 0; i < myNodelist.length; i++) {
            if(i==uc){
                var qty = myNodelist[i].children[1].children[0].children[2].value;
      
                var unc = myNodelist[i].children[1].children[1].children[2].value;
          
                var tc = myNodelist[i].children[1].children[2].children[1].value=qty*unc;
             
            }
            
        }

}

function unitCostx(){
    var uc = document.querySelector('#unitcostx').value;
    var qty = document.querySelector('#qtyx').value;
    document.querySelector('#totalcostx').value = uc*qty;   
    
}

$(document).ready(function(){
    $('#qtyx').on('click',function(){
    /**     var q = $(this);
  console.log(this.value);
    if(this.value == "other"){
    q.replaceWith($("<input type='text'  class='form-control' name='qtyx' placeholder='Enter qty' required>"));
    }*/
    var uc = document.querySelector('#unitcostx').value;
    var qty = document.querySelector('#qtyx').value;
    document.querySelector('#totalcostx').value = uc*qty;
    });
});

function thew(x){
  var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text' class='form-control' name='enduser' placeholder='Enter end-user'  required>"));
    }
}

function office_add(x){
  var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text'  class='form-control' name='office' placeholder='Enter office' required>"));
    }
}

function qty_add(x){
  var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text'  class='form-control' name='qty' placeholder='Enter qty' required>"));
    }
}

function unit_add(x){
  var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text'  class='form-control' name='unit' placeholder='Enter office' required>"));
    }
}


function edit(x){
        $('#edit_data').modal('show');
        $tr = $(x).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();
        var x = document.getElementById("unit");
        let option = document.createElement("option");
        option.value = data[5];
        option.text = data[5];
        x.add(option);
        console.log(data);
        $('').val(data[0]);
        $('#id').val(data[11]);
        $('#office').val(data[3]);
        $('#qtyx').val(data[4]);
        $('#unit').val(data[5]);
        $('#unit').innerHTML = data[5];
        $('#articless').val(data[6]);
        $('#unitcostx').val(data[7]);
        $('#totalcostx').val(data[8]);
        $('#pon').val(data[2]);
        $('#suppliers').val(data[9]);
        $('#datewithdraw').val(data[1]);

}

  function deleteb(x){
    var q = $(x).parent().parent().parent();
    var data = q.children('td').map(function(){
          return $(this).text();
        }).get(); 
        console.log(data);
        $('#ids').val(data[2]);
        $('#delete_user').modal('show');
  }

  function offSide(){
    $(".fa-bars").attr("onclick","onSide()");
    document.querySelector(".head").style.marginLeft="-3px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="26px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="-200px";
    document.querySelector(".sidebar").style.transition="0.5s";


}
function onSide(){
    $(".fa-bars").attr("onclick","offSide()");
    document.querySelector(".head").style.marginLeft="187px";
    document.querySelector(".head").style.transition="0.5s";
    document.querySelector(".in-content").style.paddingLeft="211px";
    document.querySelector(".in-content").style.transition="0.5s";
    document.querySelector(".sidebar").style.marginLeft="0px";
    document.querySelector(".sidebar").style.transition="0.5s";
}
</script>
</body>
</html>
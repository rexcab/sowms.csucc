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


$rem_n_complete = $userClass->getRemarkNotCom();
$rem_complete = $userClass->getRemarkCom();
$vars = $userClass->getSupplyPON();
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
    <script src="js/printThis.js"></script>
</head>
<body>

<div class="modal fade" id="add_pon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" >
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
                                        <th><h6>Create new P.O.N</h6></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <!--
-->
                                    <div class="form-group">
                                            <label>P.O.N</label>
                                            <input type="text" class="form-control" id="" name="pon_no" placeholder="Enter  purchased order number" required>
                                    </div>
                                
                                    <div class="form-group">
                                       <label>Supplier</label>
                                       <input type="text" class="form-control" id="" name="pon_supplier" placeholder="Enter  supplier" required>
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
                                   
                                   
                                   
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="add_pon" class="btn btn-primary">Save</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>  
</div>
<!------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------->
<div class="modal fade" id="add_office" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" >
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
                                    <th><h6>Add Office</h6></th>
                                </tr>
                                </thead> 
                            </table>
                        </div>
                        <div>
                            <div class="form-group">
                                <input type="hidden"  id="id_office" name="pon">
                                    <label>Office</label>
                                        <select class="form-select" aria-label="Default select example" name = "office_name" id="office_name" required>
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
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="add_office" class="btn btn-primary">Add</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>  
</div>
<!------------------------------------------------------------------------------------->

<div class="modal fade" id="add_hh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
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
                                <div class="form-group">
                                    <label>Office</label>
                                       <select class="form-select" aria-label="Default select example" onclick="office_add(this)" name = "office" required>
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
                                
                                    <div class="form-group">
                                            <label>Purchased Order Number</label>
                                            <input type="text" class="form-control" id="citys" name="pon" placeholder="Enter purchased order number" required>
                                    </div>
                                </div>
                                <div class="dis">
                                   
                                   <div class="form-group">
                                       <label>End-User</label>
                                       <select class="form-select" aria-label="Default select example" onclick="thew(this)" name="enduser" required>
                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CEIT</option>
                                       <option value="Cuarez, Ryan O">Cuarez, Ryan O</option>
                                       <option value="Monzon, Ronald A.">Monzon, Ronald A.</option>
                                       <option value="Rayno, Neil E.">Rayno, Neil E.</option>
                                       <option value="Vergara, Thesa Ll.">Vergara, Thesa Ll.</option>
                                       <option value="Vergara, Japeth Jay O.">Vergara, Japeth Jay O.</option>
                                       <option value="Vistal, Joseph A.">Vistal, Joseph A.</option>

                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CITTE</option>
                                       <option value="Alan, Frank Aiken">Alan, Frank Aiken</option>
                                       <option value="Arante, Ramil B., Ph.D.">Arante, Ramil B., Ph.D.</option>
                                       <option value="Aroy, Vicardo J.">Aroy, Vicardo J.</option>
                                       <option value="Beray, Marisol Jane M.">Beray, Marisol Jane M.</option>
                                       <option value="Biongcog, Jona J., Ph.D.">Biongcog, Jona J., Ph.D.</option>
                                       <option value="Biongcog, Ronilo P.">Biongcog, Ronilo P.</option>
                                       <option value="Cabonce, Cora B.">Cabonce, Cora B.</option>
                                       <option value="Cuyag, Marlon B.">Cuyag, Marlon B.</option>
                                       <option value="Daminar, Nathalie">Daminar, Nathalie</option>
                                       <option value="Delima, Leonilo M.">Delima, Leonilo M.</option>
                                       <option value="Tadal, Cecilia H. PH.Ed.D">Tadal, Cecilia H. PH.Ed.D</option>
                                       <option value="Vargas, Demie Grace">Vargas, Demie Grace</option>
                                       <option value="Yatan, Joseph S.">Yatan, Joseph S.</option>

                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CTHM</option>
                                       <option value="Delima. Cecilia H. Ph. Ed.D">Delima. Cecilia H. Ph. Ed.D</option>
                                       <option value="Fong, Kimberly C.">Fong, Kimberly C.</option>
                                       <option value="Gregorio, Alecris V.">Gregorio, Alecris V.</option>
                                       <option value="Niñofranco, Earl G.">Niñofranco, Earl G.</option>
                                       <option value="Rodas, Erlin S.">Rodas, Erlin S.</option>
                                       <option value="Serrano, Ma. Jovita C.">Serrano, Ma. Jovita C.</option>

                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CBA</option>
                                       <option value="Castillon, Maria Tita C.">Castillon, Maria Tita C.</option>
                                       <option value="Dacanay, Sonny T.">Dacanay, Sonny T.</option>
                                       <option value="Juera, Walter B.">Juera, Walter B.</option>

                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">DGE</option>
                                       <option value="Alburo, Flordeliza G., Ph.D">Alburo, Flordeliza G., Ph.D</option>
                                       <option value="Anunciado, Japhet D.">Anunciado, Japhet D.</option>
                                       <option value="Bermudez, Alma Ligaya A.">Bermudez, Alma Ligaya A.</option>
                                       <option value="Fong, Ryan Chester G.">Fong, Ryan Chester G.</option>
                                       <option value="Monteclaro, Mildred L.">Monteclaro, Mildred L.</option>
                                       <option value="Montola, Maria Annie B.">Montola, Maria Annie B.</option>
                                       <option value="Sevilla, Alvin M.">Sevilla, Alvin M.</option>

                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">ADMINISTRATIVE SERVICES</option>
                                       <option value="Alipao, Elmer A.">Alipao, Elmer A.</option>
                                       <option value="Arante, Milagros C.">Arante, Milagros C.</option>
                                       <option value="Fornillos, Geneveve C.">Fornillos, Geneveve C.</option>
                                       <option value="Fundalan, Rameir D.">Fundalan, Rameir D.</option>
                                       <option value="Ilustrisimo, Roxan M.">Ilustrisimo, Roxan M.</option>
                                       <option value="Mortola, Cyril Judah G.">Mortola, Cyril Judah G.</option>
                                       <option value="Niñofranco, Ma. Eunice A.">Niñofranco, Ma. Eunice A.</option>
                                       <option value="Puno, Romeo M.">Puno, Romeo M.</option>
                                       <option value="Vergara, Thesa Ll.">Vergara, Thesa Ll.</option>
                                       <option disabled = true style="background: #afafaf;color: white;font-weight: bold;"></option>
                                       <option value="other">Other</option>

                                       </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Supplier</label>
                                       <input type="text" class="form-control" id="citys" name="supplier" placeholder="Enter supplier" required>
                                   </div>
                               </div>
                               <div class="dis">
                                   
                                   <div class="form-group">
                                       <label>Date Withdraw</label>
                                               <div class="row form-group" style="margin-left:0px">
                                                   <div class="col-sm-17">
                                                       <div class="input-group date" id="datepickers" >
                                                           <input type="text" class="form-control" name="datewithdraw" required>
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
                                       <label>Withdraw by</label>
                                       <input type="text" class="form-control" id="citys" name="withdrawby" placeholder="Enter withdraw by" required>
                                   </div>
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
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
      
                  </button>
                </div>
                
                
                <form action="" method="post">
                    <div class="modal-body" id="office_details_mod">
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
                                        <input type="text" class="form-control" id="articles" name="articles" placeholder="Enter articles/description" required>
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
                                        <label>End-User</label>
                                       <select class="form-select" aria-label="Default select example" id="enduser" onclick="thew(this)" name="enduser" required>
                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CEIT</option>
                                        <option value="Cuarez, Ryan O">Cuarez, Ryan O</option>
                                        <option value="Monzon, Ronald A.">Monzon, Ronald A.</option>
                                        <option value="Rayno, Neil E.">Rayno, Neil E.</option>
                                        <option value="Vergara, Thesa Ll.">Vergara, Thesa Ll.</option>
                                        <option value="Vergara, Japeth Jay O.">Vergara, Japeth Jay O.</option>
                                        <option value="Vistal, Joseph A.">Vistal, Joseph A.</option>

                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CITTE</option>
                                        <option value="Alan, Frank Aiken">Alan, Frank Aiken</option>
                                        <option value="Arante, Ramil B., Ph.D.">Arante, Ramil B., Ph.D.</option>
                                        <option value="Aroy, Vicardo J.">Aroy, Vicardo J.</option>
                                        <option value="Beray, Marisol Jane M.">Beray, Marisol Jane M.</option>
                                        <option value="Biongcog, Jona J., Ph.D.">Biongcog, Jona J., Ph.D.</option>
                                        <option value="Biongcog, Ronilo P.">Biongcog, Ronilo P.</option>
                                        <option value="Cabonce, Cora B.">Cabonce, Cora B.</option>
                                        <option value="Cuyag, Marlon B.">Cuyag, Marlon B.</option>
                                        <option value="Daminar, Nathalie">Daminar, Nathalie</option>
                                        <option value="Delima, Leonilo M.">Delima, Leonilo M.</option>
                                        <option value="Tadal, Cecilia H. PH.Ed.D">Tadal, Cecilia H. PH.Ed.D</option>
                                        <option value="Vargas, Demie Grace">Vargas, Demie Grace</option>
                                        <option value="Yatan, Joseph S.">Yatan, Joseph S.</option>

                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CTHM</option>
                                        <option value="Delima. Cecilia H. Ph. Ed.D">Delima. Cecilia H. Ph. Ed.D</option>
                                        <option value="Fong, Kimberly C.">Fong, Kimberly C.</option>
                                        <option value="Gregorio, Alecris V.">Gregorio, Alecris V.</option>
                                        <option value="Niñofranco, Earl G.">Niñofranco, Earl G.</option>
                                        <option value="Rodas, Erlin S.">Rodas, Erlin S.</option>
                                        <option value="Serrano, Ma. Jovita C.">Serrano, Ma. Jovita C.</option>

                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">CBA</option>
                                        <option value="Castillon, Maria Tita C.">Castillon, Maria Tita C.</option>
                                        <option value="Dacanay, Sonny T.">Dacanay, Sonny T.</option>
                                        <option value="Juera, Walter B.">Juera, Walter B.</option>

                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">DGE</option>
                                        <option value="Alburo, Flordeliza G., Ph.D">Alburo, Flordeliza G., Ph.D</option>
                                        <option value="Anunciado, Japhet D.">Anunciado, Japhet D.</option>
                                        <option value="Bermudez, Alma Ligaya A.">Bermudez, Alma Ligaya A.</option>
                                        <option value="Fong, Ryan Chester G.">Fong, Ryan Chester G.</option>
                                        <option value="Monteclaro, Mildred L.">Monteclaro, Mildred L.</option>
                                        <option value="Montola, Maria Annie B.">Montola, Maria Annie B.</option>
                                        <option value="Sevilla, Alvin M.">Sevilla, Alvin M.</option>

                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;">ADMINISTRATIVE SERVICES</option>
                                        <option value="Alipao, Elmer A.">Alipao, Elmer A.</option>
                                        <option value="Arante, Milagros C.">Arante, Milagros C.</option>
                                        <option value="Fornillos, Geneveve C.">Fornillos, Geneveve C.</option>
                                        <option value="Fundalan, Rameir D.">Fundalan, Rameir D.</option>
                                        <option value="Ilustrisimo, Roxan M.">Ilustrisimo, Roxan M.</option>
                                        <option value="Mortola, Cyril Judah G.">Mortola, Cyril Judah G.</option>
                                        <option value="Niñofranco, Ma. Eunice A.">Niñofranco, Ma. Eunice A.</option>
                                        <option value="Puno, Romeo M.">Puno, Romeo M.</option>
                                        <option value="Vergara, Thesa Ll.">Vergara, Thesa Ll.</option>
                                        <option disabled = true style="background: #afafaf;color: white;font-weight: bold;"></option>
                                        <option value="other">Other</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Enter supplier" required>
                                    </div>
                                </div>
                                <div class="dis">
                                    
                                    <div class="form-group">
                                        <label>Date Withdraw</label>
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
                                        <label>Withdraw by</label>
                                        <input type="text" class="form-control" id="withdrawby" name="withdrawby" placeholder="Enter withdraw by" required>
                                    </div>
                                </div>

                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
              </div>
            </div>  
</div>

<!--------- widthdraw -->
<div class="modal fade" id="widthdraw_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
      
                  </button>
                </div>
                
                
                <form action="" method="post">
                    <div class="modal-body" id="office_widthdwal">
                      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type='submit'  name='add' class='btn btn-primary'>Withdraw</button>
                    </div>
                </form>
              </div>
            </div>  
</div>

<!----------------------------------------------------------------------->

<div class="modal fade" id="edit_rem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                <h5>Update Remarks</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="office_details_mod">
                    <form action="" method="post">
                        <div class="modal-body" id="office_details_mod">           
                    
                                <input type="hidden" id="id_rem" name="rem_id">
                                <input type="hidden" id="id_rem_off" name="rem_off">
                                <h5>Office: <span id='office_rem' name="rem_office"></span></h5>
                                <br>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" value="complete" name="rem_check" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Widthdraw complete
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="incomplete" name="rem_check" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Not yet widthraw
                                    </label>
                                </div>      

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="submit_rem">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>  
</div>

<!----------------------------------------------------------------------->

<div class="modal fade" id="receipt_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                <h5>Widthdrawal SLIP FORM<h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >  
                        <div class="slip-details">
                            
                        </div>
                        

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary print" >Print</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                </div>
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
            <a href="home.php">
                <h6 style="">Home</h6>
            </a>
            <a href="pon.php">
                <h6 style="font-size:15px; ">Purchased Order Number</h6>
            </a>
            <a href="item_list.php">
                <h6 style="">Items</h6>
            </a>
            <a href="delivery_items.php">
                <h6 style="">Item Availability</h6>
            </a>
            
            <a href="track_widthdraw.php">
                <h6 style="background-color:#118911;">Widthdraw Items</h6>
            </a>
            <a href="email_items.php">
                <h6 style="">Email Items</h6>
            </a>
            <a href="offices_informations.php">
                <h6> Offices</h6>
            </a>
            

        </div>
        <div class="block">
        <div class="head">
            <i class="fas fa-bars" onclick="offSide()"></i>
            <img src="carsucc.png" class="head-picture" alt="">
            <header class="title">
                <h2>Supply Office Widthdrawal Monitoring System CSUCC</h2>
            </header>
        </div>

        <div class="in-content"> 
            
          

            <div class="dash">
                <a href="track_widthdraw.php" style="color:unset; text-decoration:none">
                <div class="box" id="tot_pon" style="background:#115811">
                    <div >
                        <h4><?php if($vars!=""){ echo count($vars); }else{ echo "0";}?></h4>
                    </div>
                    <div>
                        <h6 style="margin-top:10px">Total of Purchased Order Number</h6>
                    </div>
                </div>
                </a>
                <a href="#" id="com_total_display" style="color:unset; text-decoration:none"> 
                    <div class="box" id="tot_com">
                        <div >
                        <h4><?php echo count($rem_complete); ?></h4>
                        </div>
                        <div>
                            <h6>Total of Offices</h6>
                            <span>(Complete Widthdraw)</span>
                        </div>
                    </div>
                </a>
                <a href="#" id="not_com_total_display" style="color:unset; text-decoration:none">
                <div class="box" id="tot_not_com">
                
                    <div >
                    <h4><?php echo count($rem_n_complete); ?></h4>
                    </div>
                    <div>
                        <h6>Total of Offices</h6>
                        <span>(Incomplete Widthdraw )</span>
                    </div>
                    
                </div>
                </a>
                <a href="#" id="all_widthdraw_records" style="color:unset; text-decoration:none">
                <div class="box" id="tot_all_widthdraw">
                
                    <div >
                    <h4><?php echo count($all_widthdraw); ?></h4>
                    </div>
                    <div>
                        <h6>Total of Widthdrawal</h6>
                        <span>(All records )</span>
                    </div>
                    
                </div>
                </a>
            </div>

            <hr>
            <div class="ins-content" style="display:flex">

                <div class="right-content" style="width:30%; height: 700px;">
                <div style="padding:20px 0">
                    <input type="text" class="form-control rounded ss" name="search_text" id="search_text"  placeholder="Search purchase order number" aria-label="Search"
                                aria-describedby="search-addon" style="width:330px;"/>
                    </div>
                    <div class="tops" style="display:BLOCK" >
                        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_pon"  > Add P.O.N.</button> 
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
                                echo ""; 
                            }else{                        
                                $i=1;
                                foreach($vars as $var){ 
                                    if($var==$_GET['id']){
                                      ?>
                                     <tr style="background: rgb(28, 126, 3); color: white;" class="tr_id" onclick="therow(this)">
                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var; ?></td>
                                    </tr>
                               <?php }else{  ?>
                                <tr class="tr_id" onclick="therow(this)">
                                
                                    <td style="font-size: 14px;"><?php echo $i; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var; ?></td>
                                </tr>
                                <?php 
                               
                                }
                                $i++;
                            }} ?>
                            </tbody>         
                        </table>   
                    </div>
                </div>
                <div class="left-content" style="">
                    <div id="result-pon" >
                        <?php 
                            if($_GET['id']==""){
                                echo "<h6>Select Purchased Order Number (P.O.N) first.";
                            }else{
                            require_once("msql.php");
                            $con=$userClass->connection();
                            $pon = $_GET['id'];
                            
                            //get offices on pon
                            
                            $stmt =  "SELECT * FROM remaks where pon = '$pon'";
                            $users = $con->query($stmt) or die ($con->error);
                            
                            $stmt1 =  "SELECT * FROM supply_records where purchasedOrderNumber = '$pon'";
                            $users1 = $con->query($stmt1) or die ($con->error);
                            
                            $rows1 = [];
                            $rows = [];
                            $check_no_off=false;
                            $fs="";
                            if($users1->num_rows > 0){
                                    $rows1[] =  $users1->fetch_assoc();
                                    $fs=true;
                            } 
                            
                            if($users->num_rows > 0){
                                while ($row = $users->fetch_assoc()){
                                    $rows[] = $row;
                                } 
                                $check_no_off=true;
                            }else{
                                $check_no_off=false;
                            }
                            $fs1="";
                            if($rows1==true){
                                $fs=$rows1[0]['supplier'];
                                $fs1=$rows1[0]['date'];
                            }
                            $str =  "<div style='display: flow-root; width:100%; display:flex; padding:10px; justify-content: space-between; background:white'>
                            <h6 style='flex-basis: 30%;'>P.O.N: <span style='color:rgb(28, 126, 3);'>$pon</span></h6>  
                            <h6 style='flex-basis: 30%;'>Supplier: <span style='color:rgb(28, 126, 3);'>".$fs."</span></h6>  
                            <h6 style='flex-basis: 30%;'>Date: <span style='color:rgb(28, 126, 3);'>".$fs1."</span></h6>   
                            </div>
                            <hr>
                            <div>
                            <div style='display:flex; margin-bottom:5px;'>
                            <div style='width:50%;'><h5>List of Offices</h5></div>
                            <div style='width:50%; display:flex; justify-content:flex-end;'>
                                <button type='button' class='btn btn-success ' data-toggle='modal' data-target='#add_office' style='margin-right:5px'  > Add Offices</button> 
                                <button type='button' class='btn btn-secondary ' onClick='widthdrawHistory(`$pon`)'> Widthdrawal history</button>  
                            </div>
                            </div>

                            </div>

                            <div id='result'>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                        <th scope='col'>Offices</th>
                                        <th scope='col'>Widthdrawal Remarks</th>
                                        <th scope='col'>Action</th> 
                                        <th scope='col'>Widthdrawal Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            foreach($rows as $row){
                            if($row['remarks']=="complete"){
                                $rem = "<span style='color:green; font-size:15px; font-weight: 900'>✓ complete</span>";
                            }else{
                                $rem = "<span style='color:red; font-size:15px; font-weight: 900'> incomplete </span>";
                            }
                            $str=$str."<tr>
                                <td scope='row' style='display:none'>".$row['pon']."</td>
                                <td scope='row'>".$row['office']."</td>
                                <td scope='row' style='padding-left: 50px;'>".$rem."</td>
                                <td> <!-- <button class='btn btn-primary' value='".$row['pon']."' onClick='edit_remarks(this)' style='margin-right:10px'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                                <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                            </svg> Edit Remarks</button> -->
                                
                                </button><button class='btn btn-secondary' value='".$row['pon']."' onClick='office_details(this)'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                                <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                                <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                            </svg> Requested items</button>
                            </button></td>
                            <td>
                            <button class='btn btn-success' value='".$row['pon']."' onClick='widthdraw(this)'> widthdraw</button>
                            
                            </td>
                                </tr>";
                            }
                                        
                            $str=$str."        
                                    </tbody>
                                </table>
                            </div>
                            </div>";
                            echo $str;
                            }
                        ?>
                        
                    </div>
                </div>
            </div>

            </div>  
        </div>
    
        </div>



<script type="text/javascript">
$(function() {
    $('#datepickers').datepicker();
});



var trow= document.querySelector('.tr_id');
function thew(x){
  var q = $(x);
  console.log(x.value);
    if(x.value == "other"){
    q.replaceWith($("<input type='text' class='form-control' name='enduser' placeholder='Enter end-user'  required>"));
    }
}

function therow_office_items(x){
  
  var q =  $(x).closest('tr');
 
  var data = q.children('td').map(function(){
        return $(this).text();
      }).get(); 
     console.log(data)
      $.ajax({
        type:"POST",
        url:"load_pon_office-items.php",
        data:{
        id: data[0],
        office: data[1],
        },
        success:function(data){
        $("#in_data_office").html(data);
        }
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

        $('#tot_com').css("background-color","#118911");
        $('#tot_pon').css("background-color","#115811");
        $('#tot_not_com').css("background-color","#118911");
        $('#id_office').val(data[1]);
    $.ajax({
        type:"POST",
        url:"load_pon_details.php",
        data:{
        id: data[1],
        },
        success:function(data){
        $(".left-content").html(data);
        }
    });

};


function widthdrawHistory(x){
  
  $.ajax({
      type:"POST",
      url:"widthdrawal_history.php",
      data:{
      id: x,
      },
      success:function(data){
      $(".left-content").html(data);
      }
  });

};


function widthdraw(x){
    $tr = $(x).closest('tr');
    
    var data = $tr.children('td').map(function(){
    return $(this).text();
    }).get();
    console.log(data)
    $.ajax({
        type:"POST",
        url:"widthdraw_office_modal.php",
        data:{
        id: data[0],
        office: data[1],
        },
        success:function(data){
        $("#office_widthdwal").html(data);
        $('#widthdraw_modal').modal('show');
        }
    });
    
}
    
function receipt_details(x){
    $tr = $(x).closest('tr');
    
    var data = $tr.children('td').map(function(){
    return $(this).text();
    }).get();
    console.log(data)

        $.ajax({
        type:"POST",
        url:"widthdrawal_receipt_modal.php",
        data:{
        id: data[0],
        date: data[1],
        transaction: data[2],
        office: data[3],
        },
        success:function(data){
        $('#receipt_modal').modal('show');
        $(".slip-details").html(data);
        }
    });

}
    
function receipt_details_all(x){
    $tr = $(x).closest('tr');
    
    var data = $tr.children('td').map(function(){
    return $(this).text();
    }).get();
    console.log(data)

        $.ajax({
        type:"POST",
        url:"widthdrawal_receipt_modal.php",
        data:{
        id: data[2],
        date: data[0],
        transaction: data[1],
        office: data[3],
        },
        success:function(data){
        $('#receipt_modal').modal('show');
        $(".slip-details").html(data);
        }
    });

}
    
function office_details(x){
        
    $tr = $(x).closest('tr');

var data = $tr.children('td').map(function(){
  return $(this).text();
}).get();

console.log(data);

        $.ajax({
            type:"POST",
            url:"office_details_modal.php",
            data:{
            id: data[0],
            office: data[1],
            },
            success:function(data){
            $("#office_details_mod").html(data);
            $('#edit_data').modal('show');
            }
        });
    
}



        
function add_item(x){

    var uc = $(x).parent().parent().children('td:nth-child(6)').children().val();
    var index = $(x).parent().parent().children('td:nth-child(1)').children().val();
    $tr = $(x).closest('tr');
    
    var data = $tr.children('td').map(function(){
      return $(this).text();
    }).get();

   
    console.log(data)

    if(uc==""){ 
        alert("Input missing!");
    }else if(parseInt(uc)>parseInt(data[4])){
        alert("Inputed quantity must not be greater than the available quantity!");
    }else{
        $(x).attr('disabled','disabled');
        $(".place_widthdraw").append("<tr><td>"+uc+"</td>"+
    "<td>"+data[2]+"</td>"+
    "<td>"+data[1]+"</td>"+
    "<td>"+data[3]+"</td>"+
    "<td>"+uc*data[3]+"</td>"+
    "<td style='display:none'><input name='qty[]' value ='"+uc+"' style='display:none'>"+
    "<input name='unit[]' value ='"+data[2]+"' style='display:none'>"+
    "<input name='articles[]' value ='"+data[1]+"' style='display:none'>"+
    "<input name='unitcost[]' value ='"+data[3]+"' style='display:none'>"+
    "<input name='totalcost[]' value ='"+uc*data[3]+"' style='display:none'></td>"+
    "<td><button class='btn btn-danger' type='button' onClick='remove_item("+index+",this)'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>"+
    "</svg></button></td></tr>"

    );
    }
    
}
    

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


function edit_remarks(x){
        
    
    $tr = $(x).closest('tr');
    var data = $tr.children('td').map(function(){
    return $(this).text();
    }).get();
    console.log(data);

    $('#id_rem').val(data[0]); 
    $('#id_rem_off').val(data[1]); 
    $('#office_rem').html(data[1]); 
    if(data[2]=='X '){
        $('#crem').val('');
        $('#crem').prop("checked", false);
        $('#xrem').prop("checked", true); 
        $('#xrem').val('incomplete');
    }else{
        $('#xrem').val('');
        $('#xrem').prop("checked", false);
        $('#crem').prop("checked", true);
        $('#crem').val('complete'); 
    }

    $('#edit_rem').modal('show');
    
}


$(document).ready(function(){
    $('#com_total_display').on('click',function(){
        $('#tot_pon').css("background-color","#118911");
        $('#tot_com').css("background-color","#115811");
        $('#tot_not_com').css("background-color","#118911");
        $('#tot_all_widthdraw').css("background-color","#118911");
        document.querySelector(".ins-content").style.display="";
        $.ajax({
            type:"POST",
            url:"total_widthdraw_display.php",
            success:function(data){
            $(".ins-content").html(data);
            }
        });


    })
});

$(document).ready(function(){
    $('#all_widthdraw_records').on('click',function(){

        $('#tot_pon').css("background-color","#118911");
        $('#tot_com').css("background-color","#118911");
        $('#tot_not_com').css("background-color","#118911");
        $('#tot_all_widthdraw').css("background-color","#115811");
        document.querySelector(".ins-content").style.display="";
        $.ajax({
            type:"POST",
            url:"widthdrawal_all_records.php",
            success:function(data){
            $(".ins-content").html(data);
            }
        });
    });

});


$(document).ready(function(){
    $('#not_com_total_display').on('click',function(){
        document.querySelector(".ins-content").style.display="";
        $('#tot_pon').css("background-color","#118911");
        $('#tot_com').css("background-color","#118911");
        $('#tot_not_com').css("background-color","#115811");
        $('#tot_all_widthdraw').css("background-color","#118911");
        $.ajax({
            type:"POST",
            url:"total_not_widthdraw_display.php",
            success:function(data){
            $(".ins-content").html(data);
            }
        });
    })
});

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


var add_app = document.getElementById('articles');
  $(document).ready(function(){
    
    $('#add_more').on('click',function(){ 
      
      const myNodelist = document.querySelectorAll(".cont").length;
      var tbl = "";
      tbl = "<hr style='height:5px; color:black'>"+
      "<div class='cont'>"+
      "<div class='dis'>"+
                "<div class='form-group' style=''>"+
                    "<label>Article/Description</label>"+
                    "<input type='text' class='form-control' id='firstnames' name='articles[]' placeholder='Enter articles/description' required>"+
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
                   tbl+="</select>"+
                    "</div>"+
                "<div class='form-group'><input type='hidden' value='";
                tbl+=myNodelist;
                tbl+="'><label>Unit Cost</label>"+
                    "<input type='number' class='form-control' id='unnit_cost' name='unitcost[]' placeholder='Enter unit cost' onKeyUp='unitCost(this)' required>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<label>Total Cost</label>"+
                    "<input type='text' class='form-control' id='total_cost[]' name='totalcost[]' readonly required>"+
                    "</div>"+  
                "</div>";                                                
            
      $(add_app).append(tbl);
    })
})
function imgAfter(){
    document.querySelector("#pic1").src="img/csucc-header.png";
    document.querySelector("#pic2").src="img/csucc-header.png";
}

$('.print').click(function(){
    document.querySelector("#pic1").src="sowms/img/csucc-header.png";
    document.querySelector("#pic2").src="sowms/img/csucc-header.png";
    $('.slip-details').printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        printContainer: true,
        loadCSS: "./SOWMS/style.css",
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
        afterPrint: imgAfter,
        removeScripts: false
    })
    
})

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
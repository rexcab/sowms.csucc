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











$vars = $userClass->getRecords();

if(isset($_POST['add'])){
    $userClass->addRecords();
     header("Location:records_panel.php");
}
if(isset($_POST['delete'])){
    $userClass->deleteRecords();
     header("Location:records_panel.php");
}

if(isset($_POST['edit'])){
    $userClass->editRecords();
     header("Location:records_panel.php");
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
                                    <div class="cont">
                                    <div class="dis">
                                    <div class="form-group" style="">
                                        <label>Article/Description</label>
                                        <input type="text" class="form-control" id="firstnames" name="articles" placeholder="Enter articles/description" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Unit</label>
                                        <select class="form-select" aria-label="Default select example" name="unit" onclick="unit_add(this)">
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
                                        <select class="form-select" aria-label="Default select example" name="qty" required id="qty" >
                                        <?php  
                                        for($t=1;$t<=1000;$t++){ ?>    
                                            <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                        <?php } ?>
                                        </select>
                                       </div>
                                    <div class="form-group">
                                        <label>Unit Cost</label>
                                        <input type="number" class="form-control" id="unnit_cost" name="unitcost" placeholder="Enter unit cost" onKeyUp="unitCost(this)" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Cost</label>
                                        <input type="text" class="form-control" id="total_cost" name="totalcost" readonly required>
                                        
                                    </div>
                                    </div>   
                                    </div>
                                </div>
                                <hr>
                                <div class=btn>
                                    <button type="button" class="btn btn-primary" id="add_more">Add more</button>
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
        <div class="head">
            <img src="carsucc.png" class="head-picture" alt="">
            <header class="title">
                <h2>Supply Office Widthdrawal Monitoring System CSUCC</h2>
            </header>
           
            <span><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']." | </span><span style='margin-left:0; margin-right: 10px;
    color: #00e900;
    font-size: 16px;
    padding-top: 15px;'>".$_SESSION['accesstype']; } ?></span><a href="logout.php" class="btn logout-btn" >Logout</a>

        </div>
     
  

    <div class="in-content"> 

  <?php if(isset($_SESSION['success'])){
            if($_SESSION['success']==false){
                unset($_SESSION['success']);
                echo "<script>alert('username/password is incorrect')</script>";

            }
            
        } ?>


        <div class="tops" >
                <div class="prev-right">
                
                
                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_hh"  > Add data</button>  
                <input type="text" class="form-control rounded ss" name="search_text" id="search_text"  placeholder="Search" aria-label="Search"
                          aria-describedby="search-addon"  style="margin-left:10px"/>
                </div>
                <div class="search-bar">
                <h5 style="float:right; margin-top:3px;" id="cc">Total of <?php if($vars!=false){ echo count($vars); }?></h5> 
        
               
            </div>
            </div>
            <div class="dates" id="check_add" style="background: white;  color:green">
            <?php if(isset($_SESSION['add_success'])){ ?>
                 <h5 style="font-family:revert; margin:0; padding:9px 10px;">
                  <?php echo $_SESSION['add_success'];
                   unset($_SESSION['add_success']); ?>
                   </h5>
             <?php  } ?>
            </div>
            <div id="result">
             
                
                    <table class="table">
                        <thead class="table">
                                    <tr>
                                        <th >#</th>
                                        <th style="width:105px;">Date Withdraw</th>
                                        <th style="width:130px;">office</th>
                                        <th style="width:50px;">Qty</th>
                                        <th style="width:60px;">Unit </th>
                                        <th style="width:120px;">Articles</th>
                                        <th style="width:80px;">Unit Cost </th>
                                        <th style="width:80px;">Total Cost </th>
                                        <th style="width:90px;">P.O.N.</th>
                                        <th style="width:120px;">End-user</th>
                                        <th style="width:120px;">Supplier</th>
                                        <th style="width:120px;">Widthdraw By</th>
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
                                              <td style="font-size: 14px;"><?php echo $var['datewithdraw']; ?></td>
                            <td style="display:none;"><?php echo $var['id'] ?></td>
                            <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['qty']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['unit']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['articles']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['unitcost']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['totalcost']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['purchasedOrderNumber']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['enduser']; ?></td>
                            <td style="font-size: 14px;"><?php echo $var['supplier']; ?></td>
                            <td ><?php echo $var['withdrawby']; ?></td>

                            <td ><span style="display:flex;"><button type="button" class="btn btn-primary btn-sm " onclick="edit(this)" style="height:29px; margin-right:3px;">update</button>
                              
                            </td>
                                            </tr>
                                            <?php 
                                            $i++;
                                            }
                                   
                                    } ?>

                    
                                    </tbody>         
                                </table>   
            </div> 
        </div>  
    </div>

 

    



<script type="text/javascript">

$(function() {
    $('#datepicker').datepicker();
});

$(function() {
    $('#datepickers').datepicker();
});

const element = document.getElementById("check_add");
setInterval(function() {element.innerHTML = ""}, 7000);



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
                    "<input type='text' class='form-control' id='firstnames' name='articles' placeholder='Enter articles/description' required>"+
                "</div>"+
                "<div class='form-group'>"+
                "<label>Unit</label>"+
                    "<select class='form-select' aria-label='Default select example' name='unit' onclick='unit_add(this)'>"+
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
                    "<select class='form-select' aria-label='Default select example' onclick='qtyz(this)' name='qty' required  >";
                   
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
                    "<input type='number' class='form-control' id='unnit_cost' name='unitcost' placeholder='Enter unit cost' onKeyUp='unitCost(this)' required>"+
                "</div>"+
                "<div class='form-group'>"+
                    "<label>Total Cost</label>"+
                    "<input type='text' class='form-control' id='total_cost' name='totalcost' readonly required>"+
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
            url:"fetch-search2.php",
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
        $('#id').val(data[2]);
        $('#office').val(data[3]);
        $('#qtyx').val(data[4]);
        $('#unit').val(data[5]);
        $('#unit').innerHTML = data[5];
        $('#articles').val(data[6]);
        $('#unitcostx').val(data[7]);
        $('#totalcostx').val(data[8]);
        $('#pon').val(data[9]);
        $('#enduser').val(data[10]);
        $('#supplier').val(data[11]);
        $('#datewithdraw').val(data[1]);
        $('#withdrawby').val(data[12]);

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


</script>
</body>
</html>
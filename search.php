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



$vars = $userClass->getItems();


if(isset($_POST['add'])){
    $userClass->addOffice();
     header("Location:offices_informations.php");
}

if(isset($_POST['edit'])){
    $userClass->updateOffice();
     header("Location:offices_informations.php");
}

if(isset($_POST['delete'])){
    $userClass->deleteOffice();
     header("Location:offices_informations.php");
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
<style>
   
.highlight {
    background-color: yellow;
}
</style>
<!----------------------------------------------------------------------->
<div class="modal fade" id="add_hh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <th><h6>Add New Data</h6></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <!--
-->
                                    <div class="form-group">
                                            <label>Office Name</label>
                                            <input type="text" class="form-control" id="office_name" name="office_name" placeholder="Enter office name" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                       <label>Office Email</label>
                                       <input type="text" class="form-control" id="office_email" name="office_email" placeholder="Enter office email" required>
                                   </div>
                                   
                                </div>
                                   
                                   
                                   
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="add" class="btn btn-primary">Save</button>
                      </div>
                      </div>
                </form>
              </div>
            </div>  
</div>

<!----------------------------------------------------------------------->
<div class="modal fade" id="edit_hh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <th><h6>Update Data</h6></th>
                                    </tr>
                                    </thead> 
                                </table>
                                </div>
                                <div>
                                    <!--
-->
                                    <div class="form-group">
                                            <label>Office Name</label>
                                            <input type="text" class="form-control" id="u_office_name" name="office_name" placeholder="Enter office name" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                       <label>Office Email</label>
                                       <input type="text" class="form-control" id="u_office_email" name="office_email" placeholder="Enter office email" required>
                                       <input type="hidden" id="u_office_id" name="id">
                                   </div>
                                   
                                </div>
                                   
                                   
                                   
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  name="edit" class="btn btn-primary">update</button>
                      </div>
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
                        <input type="hidden" name="id" id="ids">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>  
</div>
<!------------------------>


     <div class="containers">
        <div class="sidebar">

        <?php include 'sidebar.php';?>
        </div>
        <div class="block">
        <?php include 'header.php';?>
        <div class="in-content"> 

          
            <div class="ins-content" >

            <div style="padding:0 30px 30px 30px">
                <h3 style="font-weight: 700; ">SEARCH DATA</h3>
            </div>

            <div class="card" style="width: 97%; margin-left:22px">
                <div class="card-body">
                    <div style="">
                        
                        <br>
                        <div id="result_pon" style="height:600px">
                            <table class="table ttable" >
                                <thead class="table">
                                    <tr>
                                        <th>P.O.N Code</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Unit Cost</th>
                                        <th>Total Cost</th>
                                        <th>Office</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($vars==false){ 
                                    echo ""; 
                                }else{                        
                                    $i=1;
                                    foreach($vars as $var){ ?>
                                    <tr class="tr_id">
                                        <td ><?php echo  $var['pon']; ?></td>
                                        <td ><?php echo $var['description']; ?></td>
                                        <td ><?php echo $var['unit'];  ?></td>                                    
                                        <td ><?php echo $var['qty'];  ?></td>
                                        <td ><?php echo $var['unitcost'];  ?></td>
                                        <td ><?php echo $var['totalcost'];  ?></td>
                                        <td ><?php echo $var['office'];  ?></td>
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

            </div>
                <!------------>
            </div>

            </div>  
            <div style="position:absolute; buttom:0; width:100%">
                <?php include 'footer.php'; ?>
            </div>
        </div>
    
        </div>

<script type="text/javascript">
       $(function() {
        $("#top-sided").find("a:nth-child(3)").css("background","#118911")
    });
    $(document).ready(function () {
    $('.ttable').DataTable();
});
$('.ttable').css("width","100%");

function edit(x){
        $('#edit_hh').modal('show');
        $tr = $(x).closest('tr');
        var data = $tr.children('td').map(function(){
            return $(this).text();
        }).get();
      //  console.log(data);

        $('#u_office_name').val(data[1]);
        $('#u_office_email').val(data[2]);
        $('#u_office_id').val(data[3]);
        
}

function deleteo(x){
    $('#delete_user').modal('show');
    $tr = $(x).closest('tr');
    var data = $tr.children('td').map(function(){
        return $(this).text();
    }).get();
   console.log(data);
    $('#ids').val(data[3]);
  }




  // Initialize the DataTable
var table = $('.ttable').DataTable();

// Add the highlight plugin
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        if ( settings.nTable.id !== 'myTable' ) {
            return true;
        }
 
        // Perform the highlighting
        var searchTerm = $('input').val().toLowerCase();
        var cellText = $(table.cell(dataIndex, 0).node()).text().toLowerCase();
        var matchIndex = cellText.indexOf(searchTerm);
 
        if ( matchIndex !== -1 ) {
            // Highlight the search term
            $(table.cell(dataIndex, 0).node()).html(
                cellText.substring(0, matchIndex) +
                '<span class="highlight">' +
                cellText.substring(matchIndex, matchIndex + searchTerm.length) +
                '</span>' +
                cellText.substring(matchIndex + searchTerm.length)
            );
 
            return true;
        }
 
        return false;
    }
);

// Apply the search
$('#mySearchInput').on('keyup', function() {
    table.search(this.value).draw();
});



</script>
<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
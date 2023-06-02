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


$vars = $userClass->getUsers();
$logs = $userClass->getLogs();
if(isset($_POST['add'])){
    $userClass->addUser();
     header("Location:administrator.php");
}
if(isset($_POST['delete'])){
    $userClass->deleteUser();
     header("Location:administrator.php");
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" >
    <script src="js/printThis.js"></script>

    <link rel="stylesheet" href="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="your-integrity-hash" crossorigin="anonymous">
<script src="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.js"></script>
</head>
<body>

<div class="modal fade" id="add_hh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-m" role="document" >
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
             
                  </button>
                </div>
                
                <form action="" method="post">
                    <div class="modal-body">
                    
                        <div class="add_user">
                                <table class="table">
                                    <thead class="table-dark">    
                                        <tr>  
                                        <th><h5>Create new account</h5></th>
                                    </tr>
                                    </thead> 

                                </table>
                                <div class="form-group">
                                    <label>Firstname </label><input name ="firstname" placeholder="Enter First name"/>
                                </div>
                                <div class="form-group">
                                <label>Lastname  </label><input name="lastname" placeholder="Enter Last name"/>
                                </div>
                                <div class="form-group">
                                <label>Username  </label><input name="username" placeholder="Enter Username"/>
                                </div>
                                <div class="form-group">
                                    <label>Password  </label><input name="password" placeholder="Enter Password"/>
                                </div>
                               
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


<!----------------------------------------------------------------------->
<div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm delete</h4>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <span>Are you sure you want to delete this account?</span>
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

<!----------------------------------------------------------------------->

    <div class="containers" >
    <div class="head" style="margin: 0;padding-left:50px; background:rgb(68 68 68); color:#fff">
            <img src="carsucc.png" class="head-picture" alt="">
            <header class="title">
                <h2>Supply Office Widthdrawal Monitoring System CSUCC</h2>
            </header>
           
            <span><?php if(isset($_SESSION['name'])){ echo $_SESSION['name']." | </span><span style='margin-left:0; margin-right: 10px;
    color: #00e900;
    font-size: 16px;
    padding-top: 15px;'>".$_SESSION['accesstype']; } ?></span><a href="logout.php" class="btn logout-btn" >Logout</a>

        </div>
     
  

    <div class="in-content" style="padding: 100px 50px;"> 

  <?php if(isset($_SESSION['success'])){
            if($_SESSION['success']==false){
                unset($_SESSION['success']);
                echo "<script>alert('username/password is incorrect')</script>";

            }
            
        } ?>

    <h2 style="font-weight:800">ADMINISTRATOR Access</h2>

    <div id="error"></div>
    <br>
    
         <div class="card" style=" width: 100%; height: auto; margin-right:10px">

        <div class="card-body"  id="ch" >
            <div>
                <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" onclick="ch(0)" href="#">Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="ch(1)" href="#">View Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="ch(2)" href="#">Administrator Email</a>
                </li>
                </ul>
            </div>
            <!--------------->

            <div style="width:100%">
                <br>
                <div>
                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#add_hh" style="width: 120px;"  > Add account</button>  
                </div>
                
                <br>
                <div style="width:100%">
                <table class="table ttable" >
                        <thead class="table">
                                    <tr>
                                        <th style="width:50px">#</th>
                                        <th >Firstname</th>
                                        <th >Lastname</th>
                                        <th >Username</th>
                                        <th >Password </th>
                                        <th >Accesstype</th>
                                        <th style="display:none;"><?php echo $var['id'] ?></th>
                                        <th >status</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($vars==false){ 
                                        echo ""; 
                                
                                    }else{                        
                                    $i=1;
                             
                                    foreach($vars as $var){
                                        if($var['accesstype']=="Superadmin"){
                                            continue;
                                        }else{
                                         ?><tr>
                                            <td style="display:none;"><?php echo $var['id'] ?></td>
                                            <td style="font-size: 14px;"><?php echo $i; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['firstname']; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['lastname']; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['username']; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['password']; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['accesstype']; ?></td>
                                            <td style="font-size: 14px;"><?php echo $var['status']; ?></td>
                                            <?php if ($var['status']=="Active"){ ?>
                                                <td ><span style="display:flex;"><button type="button" class="btn btn-danger btn-sm " onclick="status(this)" style="height:29px; margin-right:3px;">Deactivate</button>
                                                <?php }else{ ?>
                                                    <td ><span style="display:flex;"><button type="button" class="btn btn-primary btn-sm " onclick="status(this)" style="height:29px; margin-right:3px;">Activate</button>
                                                <?php } ?>
                                            
                                            </td>
                                            </tr>
                                            <?php 
                                            $i++;
                                        }
                                            }
                                   
                                    } ?>

                    
                                    </tbody>         
                                </table>   
            </div> 
                </div>
             
                
                   
            <!--------------->
        </div>


        </div>
    </div>

 

    



<script type="text/javascript">


$(document).ready(function() {
        $('.ttable').DataTable({
            order: [[0, 'desc']] // Sort by first column in ascending order
        });
    });

function status(type){
    var x = $(type);
    var id= x.closest("tr").find("td:nth-child(1)").html();
    var st= x.closest("tr").find("td:nth-child(8)").html();
    $.ajax({
        type:"POST",
        url:"account_change_status.php",
        data:{
            id: id,
            status:st,
        },  
        success:function(data){
            if(data==1){
                location.reload();
            }else{
                $("#error").html(data)
           
            }
                
        },
    });

};
function e_update(){
    $(".buttons").html("<button class='btn btn-primary' onclick='e_save()'>Save</button><button class='btn btn-secondary' style='margin-left:5px' onclick='e_cancel()'>Cancel</button>")
    $("#email_add").prop("disabled",false)
    $("#email_name").prop("disabled",false)
    $("#password-field").prop("disabled",false)
    $(".password-toggle").css("display","flex")

}

function e_cancel(){
    $(".buttons").html("<button class='btn btn-primary' onclick='e_update()'>Update</button>")
    $("#email_add").prop("disabled",true)
    $("#email_name").prop("disabled",true)
    $("#password-field").prop("disabled",true)
    $(".password-toggle").css("display","none")
}
function togglePasswordVisibility() {
      var passwordField = document.getElementById("password-field");
      var passwordToggle = document.querySelector(".password-toggle");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordToggle.innerHTML = "&#128064;";
      } else {
        passwordField.type = "password";
        passwordToggle.innerHTML = "&#128065;";
      }
    }

function e_save(){
    console.log($("#password-field").val())
    
    $.ajax({
            type:"POST",
            url:"msql.php",
            data:{
                email_name:$("#email_name").val(),
                email_add:$("#email_add").val(),
                password_field:$("#password-field").val(),
                updateAdminEmail:"updateAdminEmail",
            },
            success:function(data){
              location.reload()
            },
        });
}
function ch(type){
    var x = type;
   if(x==0){
    location.reload();
   }else if(x==1){
        $.ajax({
            type:"POST",
            url:"logs.php",
            success:function(data){
                if(data==1){
                   $("#ch").html(data) 
                }else{
                    $("#ch").html(data)
                    
                }
                $(document).ready(function() {
                    $('.ttable').DataTable({
                        order: [[0, 'desc']] // Sort by first column in ascending order
                    });
                });
            },
        });
   }else{
    $.ajax({
            type:"POST",
            url:"administrator_info.php",
            success:function(data){
                if(data==1){
                   $("#ch").html(data) 
                }else{
                    $("#ch").html(data)
                    
                }
                $(document).ready(function() {
                    $('.ttable').DataTable({
                        order: [[0, 'desc']] // Sort by first column in ascending order
                    });
                });
            },
        });
   }
   

};


</script>
</body>
</html>
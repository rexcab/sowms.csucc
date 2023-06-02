<?php 

require_once("msql.php");
$con=$userClass->connection();

//get offices on pon

$rows=[];
$stmt = "SELECT * FROM logs ";
$users = $con->query($stmt) or die ($con->error);
$vars=[];
if($users->num_rows > 0){
    while ($row = $users->fetch_assoc()){
       $vars[] = $row;
    }
   
}

$stmt = "SELECT * FROM users WHERE accesstype = 'Superadmin' ";
$users_email = $con->query($stmt) or die ($con->error);
$vars=[];
if($users_email->num_rows > 0){
    while ($row = $users_email->fetch_assoc()){
       $vars_email[] = $row;
    }
}

$str= "
<div>

    <ul class='nav nav-tabs'>
        <li class='nav-item'>
            <a class='nav-link ' onclick='ch(0)' href='#'>Account</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link ' onclick='ch(1)' href='#'>View Logs</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link active' onclick='ch(2)' href='#'>Administrator Email</a>
        </li>
    </ul>
</div>
<!--------------->
<br>
<div style='width:100%; padding:20px'>
    <h3>Email Information</h3>
    <hr>
    <h6>* The email information provided below will serve as the sender for all email transactions.</h6>
    <h6><span style='padding-left:20px; font-weight:400'>Last Update: 09/02/21 </span> </h6>
    <div style='padding:20px'>
        <div class='form-group'>
            <h5>Name <span style='font-weight:300'>(sender)</span></h5>
            <input class='' id='email_name' value='".$vars_email[0]['email_full_name']."' disabled />
        </dv>
        <div class='form-group'  style='margin-top:20px'>
            <h5>Email address</h5>
            <input class='' id='email_add' value='".$vars_email[0]['email']."' disabled />
        </dv>
        <div class='form-group' style='margin-top:20px'>
            <h5>Apps password</h5>
        </dv>
        <div class='password-container' style=' display:flex'>
            <input type='password' id='password-field' placeholder='Enter password'  value='".$vars_email[0]['app_password']."' disabled/>
            <span class='password-toggle' style='display:none; margin-left:5px; position:unset;right:unset' onclick='togglePasswordVisibility()' >&#128065;</span>
      </div>
    </div>
    <br>
    <div class='buttons'>
    <button class='btn btn-primary' onclick='e_update()'>Update</button>
    </div>
 
    
</div>
                  
                   
            <!--------------->
";
echo $str;
?>
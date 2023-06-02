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

$con=$userClass->connection();
$vars= $userClass->getTransArrived();
$sessionValue = $_SESSION['name'];

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

    <script src="js/LoadingSpinner/loading-spinner.js"></script>
</head>
<body>
    
<style>
    #loading {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 30px;
  height: 30px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#hh:hover{
    background-color: white;
    color: black;
}
.card-top:hover{
    background: #f5f5f5;
    cursor:pointer;
}
</style>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Email Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-email" class="col-form-label">Recipient name:</label>
              <input type="email" class="form-control" id="recipient-name"  value='' disabled>
            </div>
            <div class="form-group">
              <label for="recipient-email" class="col-form-label">Recipient email:</label>
              <input type="email" class="form-control" id="recipient-email"  value='' disabled>
            </div>
            <div class="form-group">
              <label for="subject" class="col-form-label">Subject:</label>
              <input type="text" class="form-control" id="subject">
            </div>
            <div class="form-group">
              <label for="message" class="col-form-label">Additional Message:</label>
              <textarea class="form-control" id="message" rows="8" value=""></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick='send_btn()'>Send Email</button>
        </div>
      </div>
    </div>
  </div>
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

<!------------------------------------------------------------------------------------->
    
     <div class="containers">
        <div class="sidebar">

        <?php include 'sidebar.php';?>
        </div>
        <div class="block">
        <?php include 'header.php';?>

        <div class="in-content"> 
            
            <div style="padding:0 30px">
                <h3 style="font-weight: 700; ">EMAILS</h3>
            </div>
            <div class="e-cards" style="margin:20px 0; display:flex; ">
                <div class="card card-top card-1" style="width: 100%;  margin: 0 20px;  border-radius: 19px; background: #202020; color:#fff">
                    <div class="card-body" >
                        <div style="margin:0px 20px 0 20px; display:flex">
                            <div style="width:100%">
                                <h4 style="float:left; margin-top: 10px;">Total Entries</h4>
                                <i style="float:right; margin:30px 20px; font-size:40px" class="fa-solid fa-ballot-check fa-xl"></i>
                            </div>
                        </div>
                        <div style="margin:0 20px; display:flex">
                            <div style="display:block;width:60%">
                                <div>
                                    <h2 style='font-size:40px'><?php echo count($userClass->getAllEntries_emailStatus('Pending'))+count($userClass->getAllEntries_emailStatus('Sent'));?></h2>
                                </div>
                                <div>
                                </div>
                            </div>
                            <div style="display:block; width:40%; margin-top:10px">
                                <div>
                                    <h6><i class="fa-solid fa-paper-plane fa-xl"></i> Send:  <?php echo count($userClass->getAllEntries_emailStatus('Sent'));?></h6>
                                </div>
                                <div>
                                    <h6><i class="fa-solid fa-stopwatch fa-xl"></i> Pending: <?php echo count($userClass->getAllEntries_emailStatus('Pending'));?></h6>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="card card-top card-2" style="width: 100%;  margin: 0 20px;  border-radius: 19px;" >
                    <div class="card-body" >
                        <div style="margin:0px 20px 0 20px; display:flex">
                            <div style="width:100%">
                                <h5 style="float:left; margin-top: 10px;">Arrived Items </h4>
                                <i style="float:right; margin:30px 20px; font-size:40px" class="fa-solid fa-ballot-check fa-xl"></i>
                            </div>
                        </div>
                        <div style="margin:0 20px; display:flex">
                            <div style="display:block;width:60%">
                                <div>
                                    <h3 style="margin:0"><?php echo count($userClass->getAllEntries_emailStatusType('Pending','Arrived'))+count($userClass->getAllEntries_emailStatusType('Sent','Arrived')); ?></h3>
                                    <span style="font-weight:600"> Total Entries </span> 
                                </div>
                            </div>
                            <div style="display:block; width:40%; margin-top:10px">
                                <div>
                                    <h6><i class="fa-solid fa-paper-plane fa-xl"></i> Sent: <?php echo count($userClass->getAllEntries_emailStatusType('Sent','Arrived'));?></h6>
                                </div>
                                <div>
                                    <h6><i class="fa-solid fa-stopwatch fa-xl"></i> Pending: <?php echo count($userClass->getAllEntries_emailStatusType('Pending','Arrived'));?></h6>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="card card-top card-3" style="width: 100%;  margin: 0 20px;  border-radius: 19px;">
                    <div class="card-body" >
                        <div style="margin:0px 20px 0 20px; display:flex">
                            <div style="width:100%">
                                <h5 style="float:left; margin-top: 10px;">Withdrew Items </h4>
                                <i style="float:right; margin:30px 20px; font-size:40px" class="fa-solid fa-ballot-check fa-xl"></i>
                            </div>
                        </div>
                        <div style="margin:0 20px; display:flex">
                            <div style="display:block;width:60%">
                                <div>
                                    <h3 style="margin:0"><?php echo count($userClass->getAllEntries_emailStatusType('Pending','Withdrawal'))+count($userClass->getAllEntries_emailStatusType('Sent','Withdrawal')); ?></h3>
                                    <span style="font-weight:600"> Total Entries </span> 
                                </div>
                            </div>
                            <div style="display:block; width:40%; margin-top:10px">
                                <div>
                                    <h6><i class="fa-solid fa-paper-plane fa-xl"></i> Sent: <?php echo count($userClass->getAllEntries_emailStatusType('Sent','Withdrawal'));?></h6>
                                </div>
                                <div>
                                    <h6><i class="fa-solid fa-stopwatch fa-xl"></i> Pending: <?php echo count($userClass->getAllEntries_emailStatusType('Pending','Withdrawal'));?></h6>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%;  margin: 0 20px;  visibility: hidden; border-radius: 19px;">
                    
                </div>
            </div>
            <div class="ins-content" style="display:flex; ">

                <div class="right-content" style="width:100%; height: 700px; padding:0 20px">
                    <div class="card" style="width: 100%">

                   <div class="card-body">
                        <h5 class="card-title">List of entries</h5>
                    <br>
                    
                    
                    <div class="tops" style="display:FLEX" >
                    </div>
                    <div id="result_pon" style="height: 600px;">
                    <img src='loading.gif' id='load-gif' style="height:100px; width:100px; position:absolute; display: none ;margin:10% 0 0 45%; ">
                        <table class="table ttable " >
                            <thead class="table">
                                <tr>
                                    <th style='width:120px'>Last Modified</th>
                                    <th >Type</th>
                                    <th >Entry Number</th>
                                    <th >P.O.N</th>
                                    <th >Office</th>
                                    <th >Detais</th>
                                    <th >Status</th>
                                    <th >Action</th>
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
                                   
                                <tr id='hh' class='<?php echo "s".$i; ?>' >
                                    <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                    <td style="font-size: 14px; font-weight:700"><?php echo $var['type']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['entry_no']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                    <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                                    <td style="font-size: 14px;"><button class="btn btn-secondary" onclick='details(this)'>Details</button></td>
                                    <td style="font-size: 14px;">
                                    <?php if($var['status']=="Sent"){
                                            echo "<div><div style='background-color: #28a745; font-family: Helvetica Neue, sans-serif;
                                            font-size: 15px; font-weight: bold; color: #fff;padding: 2px 7px;  border-radius: 19px; width:80px;
                                            '><i class='fa-solid fa-check fa-xs' style='padding:0 5px'></i>Sent</div><div>".$var['sent_date']."</div></div>";
                                          }else{
                                            echo "<div style='background-color: #ffc107; font-family: Helvetica Neue, sans-serif;
                                            font-size: 13px; font-weight: bold;padding: 5px 10px;  border-radius: 19px; width:100px;
                                            '><i class='fa-solid fa-timer fa-xs' style='color: #ffffff;padding:0 5px'></i>Pending</div>";
                                          }
                                    ?>
                                  
                                    </td>
                                   
                                    <td style="font-size: 14px; ">
                                        <?php if($var['status']=="Sent"){
                                               
                                            }else{
                                                echo "<button type='button' class='btn btn-primary' id='r-send' onclick='send_modal(this)' >
                                                Send
                                              </button>";
                                            }
                                        ?>
                                    </td>
                                    <td style="display:none"><?php $stmts = "SELECT * FROM offices where office_name = '".$var['office']."'";
                                              $userss = $con->query($stmts) or die ($con->error);
                                              $office_email = $userss->fetch_assoc();
                                              $office_email = $office_email['office_email'];
                                              echo $office_email;
                                    ?></td>
                                </tr>
                                <?php 
                               
                                
                                $i++;
                            }} ?>
                            </tbody>         
                        </table>   
                        
                </div>
                </div>
                <br>
                <div style=" buttom:0; width:100%">
                <?php include 'footer.php'; ?>
            </div>
        </div>
                    </div>
                </div>
                
                </div>
               
            </div>  
            
        </div>
    
       
       
    
        </div>



<script type="text/javascript">
    $(function() {
        $("#sided").find("a:nth-child(7)").css("background","#118911")
    });
    $(function() {
        $('#datepickers').datepicker();
    });

   function load_table_desc() {
        $(document).ready(function() {
            $('.ttable').DataTable({
                order: [[0, 'desc']],
        
            });
        });
    }

    $(document).ready(function() {
        $('.card-top').click(function() {
            //set background and text color of current card
            $('.card-top').css("color","")
            $('.card-top').css("background","")
            $(this).css("color","#fff")
            $(this).css("background","#202020")
            
            //identify the card
            tcname = $(this).attr("class").split(' ')[2];
            if(tcname=='card-1'){
                url = 'email_items_load_all_type.php';
            }else if(tcname=='card-2'){
                url = 'email_items_load_arrived.php';
            }else if(tcname=='card-3'){
                url = 'email_items_load_withdraw.php';
            }
          
            //destroy current table
            $('.ttable').DataTable().destroy(); 

            //call new table
            $.ajax({
                type:"POST",
                url:url,
                beforeSend:function(){
                    $('#load-gif').css("display","block");
                },
                success:function(data){
                    $("tbody").html('');
                    $("tbody").html(data);
                      load_table_desc()
                      $('#load-gif').css("display","none");
                      $('.ttable').css("width","100%")
                },
                complete: function(){
                    $(document).ready(function () {
                    $('.ttable').DataTable();
                  
                });
                },
            }); 
            
      });

     
      $('.table').css("width","100%")
      load_table_desc()

    });

    
var textarea_footer="";
var pt = "";
    var cname ="";
    function details(x){
        $("#modal-details").html("");
          //console.log(pon)
        var type = $(x).parent().parent().find("td:nth-child(2)").html();
        
        var entry_no = $(x).parent().parent().find("td:nth-child(3)").html();
        var date_m = $(x).parent().parent().find("td:nth-child(1)").html();
        console.log(type)
        if(type=="Withdrawal"){
            $.ajax({
                type:"POST",
                url:"email_items_details_withdrawal2.php",
                data:{
                    entry_no:entry_no,
                    date_m:date_m,
                },
                beforeSend:function(){
                    $('#load-gif').css("display","block");
                },

                success:function(data){
                    $("#modal-details").html(data);
                    $('#load-gif').css("display","none");
                },
                complete: function(){
                    $(document).ready(function () {
                    $('.ttable').DataTable();
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
                    date_m:date_m,
                },
                beforeSend:function(){
                    $('#load-gif').css("display","block");
                },

                success:function(data){
                   $("#modal-details").html(data);
                   $('#load-gif').css("display","none");
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
    
    function send_modal(x){
        cname = $(x).parent().parent().attr("class").split(' ')[0];;
        
        var t = $(x).parent().parent().find("td:nth-child(5)").html();
        var o = $(x).parent().parent().find("td:nth-child(9)").html();
            pt = $(x).parent().parent().find("td:nth-child(2)").html();
        var pon = $(x).parent().parent().find("td:nth-child(4)").html();
        $('#exampleModal').modal('show'); 
        $("#recipient-name").val(t)
        $("#recipient-email").val(o)
        var textarea = document.getElementById("message");
        var subject = document.getElementById("subject");
// Set the value of the textarea
        if(pt=="Arrived"){
            var javascriptValue = '<?php echo $sessionValue; ?>';
            subject.value = "P.O.N. #"+pon+" (Arrived Items)";
            textarea.value = "Greeting! [Office of "+t+"],\n\n"+
            "We are pleased to inform you that the items you requested for Purchased Order Number ("+pon+") are now available for withdrawal at our office. You may proceed to collect them at your earliest convenience during our working hours."+
            "\n\nPleased see the Items below, Thank you.";

      }else{
        var javascriptValue = '<?php echo $sessionValue; ?>';
        subject.value = "P.O.N. #"+pon+" (Recent Withdrawal)";
            textarea.value = "Greeting! [Office of "+t+"],\n\n"+
            "This email serves as a receipt to confirm that your office recently withdrew the following items:";
        }
        textarea_footer = "\n\nBest regards,\n"+javascriptValue+"\n\n\n<span><strong>PROPERTY AND SUPPY MANAGEMENT OFFICE (PSMO)</strong></span>\n<span><strong>Caraga State University Cabadbaran City</strong></span>\nT. Curato Street, Cabadbaran City 8605, Agusan del Norte\n";


    }


    function send_btn(x){
        var temp = $("tbody").find("."+cname).find("td:nth-child(8)");
        console.log(temp)
        var textarea = document.getElementById("message").value;
        
        var subject = document.getElementById("subject").value;
        temp.html("<div style='display:flex'><i id='loading'></i><span style='font-size:18px'>  Sending</span></div>");

        $('#loading').css("display","block");
     
        $('#exampleModal').modal('hide'); 
        var entry_no = $("tbody").find("."+cname).find("td:nth-child(3)").html();

       // textarea = encodeURIComponent(textarea);
        console.log(entry_no);
      
        $.ajax({
            type:"POST",
            url:"email_items_send_details.php",
            data:{

                entry_no:entry_no,
                subject:subject,
                textarea:textarea,
                textarea_footer:textarea_footer,
                type:pt,
            },
            success:function(data){
                if(data==true){
                    /*
                    // Get the current date and time
                    let now = new Date();

                    // Format the date and time in a readable format
                    let formattedDate = `${now.getMonth()+1}/${now.getDate()}/${now.getFullYear()}`;
                    let formattedTime = `${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;
                    let amOrPm = now.getHours() >= 12 ? 'PM' : 'AM';
                    formattedTime += ` ${amOrPm}`;

                    // Output the formatted date and time */
                    const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true
                    };

                    const formatter = new Intl.DateTimeFormat('en-US', options);
                    const formattedTime = formatter.format(new Date());
                  //  console.log(`Current date is: ${formattedDate}`);

                    console.log("Sent successfully");
                    $('#loading').css("display","none");
                    temp.html("<div style='background-color: #28a745; font-family: Helvetica Neue, sans-serif; font-size: 15px; font-weight: bold; color: #fff;padding: 2px 7px;  border-radius: 19px; width:80px;'><i class='fa-solid fa-check fa-xs' style='padding:0 5px'></i>Sent</div>");
                    
                    //btn.closest('td').html("<div style='background-color: #fff; display:flex font-family: Helvetica Neue, sans-serif; font-size: 15px; font-weight: bold; color: #28a745;padding: 2px 7px; '><i class='fa-solid fa-check fa-xs' style='padding:0 5px'></i>Success</div>")
                    //button.closest('td').html(formattedTime);


                    //updating status
                    console.log("en_no:"+entry_no)
                    $.ajax({
                        type:"POST",
                        url:"email_items_updating_details.php",
                        data:{
                            entry_no:entry_no,
                            status: "Sent",
                            date_added: formattedTime,
                        },
                        success:function(datax){
                            if(datax==true){
                                console.log("Successfully Updated")
                            }else{
                                console.log(datax)
                            }
                        }
                    })

                    location.reload()
                }else{
                    console.log(data)
                    alert("Connection error! Check the office email address or your email address")
                    $('#r-send').html(" <i class='fa-light fa-paper-plane fa-xs' style='color: #ffffff; padding:0 5px 0 0'></i>Resend");
                }
            },
            complete: function(){
                $(document).ready(function () {
                $('.ttable').DataTable();
            });
            },
        }); 

    }
   
</script>
<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
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
$varsx= $userClass->getTransArrived();


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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="your-integrity-hash" crossorigin="anonymous">
<script src="jquery.sweet-modal-1.3.3/min/jquery.sweet-modal.min.js"></script>

</head>
<style>
    #myChart .chartjs-render-monitor .chartjs-doughnut-legend li span {
    font-size: 50px; /* change the font size to your desired size */
}

</style>
<body>

<!----------------------------------------------------------------------->
    
<div class="containers">
    <div class="sidebar">
       <?php include 'sidebar.php';?>
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
            <div class="ins-content" style="display:flex">
                <div style='width:100%; padding:10px 20px'>
                    <div>

                    
                                <div style="padding:0px">
                                    <h3 style="font-weight: 700; ">DASHBOARD </h3>
                                </div>

                                <div class="e-cards" style="margin: 20px 0; height:170px; display:flex; ">
                                    <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px; background:#444; color:white">
                                        <div class="card-body" style="padding:10px 25px ;">
                                            <div style=" display:flex">
                                                <h5 style="float:left; margin-top: 10px; font-size:20px">Purchased Order Number <span style="font-size:17px; font-weight:400">(P.O.N)</span></h5>
                                            </div>
                                            <div style="display:flex; padding:20px 0px 10px 0px">
                                                <h3 style="margin-bottom:0" ><?php echo count($vars); ?></h3>
                                            </div>
                                            <span style="font-weight:600;"> Total of P.O.N</span> 
                                        </div>
                                    </div>
                                    <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px;">
                                        <div class="card-body" style="padding:10px 25px ;">
                                            <div style=" display:flex">
                                                <h5 style="float:left; margin-top: 10px;">Arrived <span style="font-size:17px; color:grey; font-weight:400"> (per entries)</span></h5>
                                            </div>
                                            <div style="display:flex; padding:20px 0px 10px 0px">
                                                <h3 style="margin-bottom:0" ><?php echo count($userClass->getAllEntries('Arrived'));?></h3>
                                            </div>
                                            <span style="font-weight:600;"> Total of entries</span> 
                                        </div>
                                    </div>
                                    <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px;">
                                        <div class="card-body" style="padding:10px 25px ;">
                                            <div style=" display:flex">
                                                <h5 style="float:left; margin-top: 10px;">Items<span style="font-size:17px; color:grey; font-weight:400"> (per entries)</span></h5>
                                            </div>
                                            <div style="display:flex; padding:20px 0px 10px 0px">
                                                <h3 style="margin-bottom:0" ><?php echo count($userClass->getItems());?></h3>
                                            </div>
                                            <span style="font-weight:600;"> Total of Items</span> 
                                        </div>
                                    </div>
                                    <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px;">
                                        <div class="card-body" style="padding:10px 25px ;">
                                            <div style=" display:flex">
                                            <h5 style="float:left; margin-top: 10px;">Email<span style="font-size:17px; color:grey; font-weight:400"> (per entries)</span></h5>
                                            </div>
                                            <div style="width:100%; display:flex">
                                                <div style="width:50%;">
                                                    <div style="display:flex; padding:20px 0px 10px 0px">
                                                        <h3 style="margin-bottom:0" ><?php echo count($userClass->getTransArrived()); ?></h3>
                                                    </div>
                                                    <span style="font-weight:600;"> Total of entries</span> 
                                                </div>
                                                <div style="padding-top:20px">
                                                    <h6><i class="fa-solid fa-paper-plane fa-l"></i> Sent: <span style="font-size:19px"><?php echo count($userClass->getAllEntries_emailStatus('Sent'));?></span> </h6>
                                                    <h6><i class="fa-solid fa-stopwatch fa-l"></i> Pending: <span style="font-size:19px"><?php echo count($userClass->getAllEntries_emailStatus('Pending'));?></span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div> 
                    <!---------------------------------------------------------------------------------------------------->
                    <div>
                        <div style="margin:70px 0 0 0">
                            <h4 style="font-weight: 700; ">OFFICE WITHDRAW STATUS</h4>
                        </div>
                        <div style="width:100%; display:flex">
                            <div style="width:50%; margin-right:10px;display:block">
                                <div style="display:flex; margin:10px 0">
                                    <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px;">
                                            <div class="card-body" style="padding:10px 25px ;">
                                                <div style=" display:flex">
                                                    <h5 style="float:left; margin-top: 10px;" >Office </h5>
                                                </div>
                                                <div style="display:flex; padding:00px 0px 10px 0px">
                                                    <h3 style="margin-bottom:0" ><?php echo count($userClass->getOffices()); ?> </h3>
                                                </div>
                                                <span style="font-weight:600;"> Total of Offices</span> 
                                            </div>
                                        </div>
                                        <div class="card" style="width: 100%;  margin: 0  0 0;  border-radius: 12px;">
                                            <div class="card-body" style="padding:10px 25px ;">
                                                <div style=" display:flex">
                                                <h5 style="float:left; margin-top: 10px;">Withdrawal Records<span style="font-size:17px; color:grey; font-weight:400"> (per entries)</span></h5>
                                                </div>
                                                <div style="display:flex; padding:0px 0px 10px 0px">
                                                    <h3 style="margin-bottom:0" ><?php echo count($userClass->getAllEntries('Withdrawal'));?></h3>
                                                </div>
                                                <span style="font-weight:600;"> Total of entries</span> 
                                            </div>
                                        </div>
                                    </div>
                                <div class="card" style="width: 100%;  margin: 0 10px 0 0;  border-radius: 12px;">
                                    <div>
                                        <h5 class="card-title" style="margin:20px 30px">Previous Transaction </h5>
                                    </div>
                                    <div class="card-body" style="padding:10px 25px ;" >
                                    <table class="table ttable" >
                                <thead class="table">
                                    <tr>
                                        <th style='width:120px'>Latest</th>
                                        <th >Type</th>
                                        <th >Entry Code</th>
                                        <th >P.O.N</th>
                                        <th >Office</th>
                                        <th style='display:none' >Detais</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php
                                
                                if($vars==""){ 
                                    echo ""; 
                                }else{  
                                    
                                    
                                    $i=1;
                                    foreach($varsx as $var){ 
                                    if($i==7){
                                        break;
                                    }
                                    ?>
                                    
                                    <tr id='hh'>
                                        <td style="font-size: 14px;"><?php echo $var['date_added']; ?></td>
                                        <td style="font-size: 14px;"><?php echo $var['type']; ?></td>
                                        <td style="font-size: 14px;"><?php echo $var['entry_no']; ?></td>
                                        <td style="font-size: 14px;"><?php echo $var['pon']; ?></td>
                                        <td style="font-size: 14px;"><?php echo $var['office']; ?></td>
                                        <td style="font-size: 14px; display:none"><button class="btn btn-secondary" onclick='details(this)'>Details</button></td>
                                        
                                    </tr>
                                    <?php 
                                
                                    
                                    $i++;
                                }} ?>
                                </tbody>       
                    </table>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; margin-right:10px;">

                                <div class="card" style="width: 100%;  height: 630px; margin: 10px 10px 0 0; padding:20px 0px; border-radius: 12px;">
                                    
                                    <div class="card-body" style="padding:10px 25px ;">
                                        <div class="container">
                                            <h3>Withdraw Status</h3>
                                            <hr>
                                            <div style="margin-top:20px">
                                                <h5 style="font-weight:500;">Total of offices <span style="color:grey; font-size:20px">(Per P.O.N)</span> </h5> 
                                                <h6 style="font-weight:400">Complete : <span style=" font-weight:700;color:#6495ed; font-size:25px" id="com"><?php echo $userClass->getWithdrawStatus("complete"); ?></span></h6>
                                                <h6 style="font-weight:400">Incomplete : <span style="font-weight:700; color:#ffa500; font-size:25px" id="incom"><?php echo $userClass->getWithdrawStatus("incomplete"); ?></span></h6>
                                            </div>
                                            <div style="margin-top:20px">
                                                <canvas id="myChart"></canvas>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <br>
           
        </div>  
        <div style="position:absolute; buttom:0; width:100%">
                <?php include 'footer.php'; ?>
            </div>
    </div>

</div>



<script type="text/javascript">
    $(document).ready(function() {
    
        var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Complete', 'Incomplete'],
        datasets: [{
            label: '# of Votes',
            data: [$("#com").html(), $("#incom").html()],
            backgroundColor: [
                '#6495ed',
            '#ffa500'
            ],
            
        }]
    },
    options: {
        legend: {
            labels: {
                fontSize: 25,
                
            }
        }
    }
});


    });
$(function() {
        $("#top-sided").find("a:nth-child(2)").css("background","#118911")
    });


$(function() {
    $('#datepickers').datepicker();
});

$(document).ready(function () {
    $('.ttable').DataTable();
});


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

        console.log(data)
        $("#pp_pon").html(data[1]);
        $("#pp_supplier").html(data[2]);
        $("#pp_date").html(data[3]);

    $.ajax({
        type:"POST",
        url:"item_list_load-items.php",
        data:{
        id: data[1],
        supplier: data[2],
        date: data[3],
        },
        beforeSend:function(){
           
                $('#load-gif').css("display","block");
                console.log("sds")
        },

        success:function(data){
        
        $("#result-pon").html(data);
       
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
            console.log(response)
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




</script>

<script type="text/javascript" src="js/sidebar-toggle.js"></script>
</body>
</html>
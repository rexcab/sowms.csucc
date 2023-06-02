<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="your-integrity-hash" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<Style>
    * {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}

body {
	background-color: #f1f1f1;
	font-family: Arial, sans-serif;
}

.container {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
	height: 100vh;
}

.left-column {
	flex-basis: 60%;
	height: 100%;
	display: block;
	align-items: center;
	background-color: #fff;
}
.row-1{
    width: 100%;
    margin:110px 20px;
    color:#4CAF50;

}
.left-column img {
	max-width: 100%;
	max-height: 100%;
	margin: auto;
	display: block;
}

.right-column {
	flex-basis: 40%;
	height: 100%;
	display: flex;
	align-items: center;
	background-color: #4CAF50;
}

form {
	width: 100%;
	max-width: 400px;
	margin: auto;
	padding: 20px;
	background-color: #fff;
	border-radius: 5px;
}

h2 {
	text-align: center;
	margin-bottom: 20px;
	color: #4CAF50;
}

input[type="text"],
input[type="password"] {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	border-radius: 4px;
	box-sizing: border-box;
}

button[type="button"] {
	background-color: #4CAF50;
	color: #fff;
	padding: 12px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	width: 100%;
}

button[type="submit"]:hover {
	background-color: #45a049;
}
.log-details{
    float: right;
    height: 50px;
    margin: 10px 50px 10px 0;
    background: white;
    padding: 17px;
    width: 273px;
    box-shadow: 0 0 10px gray;
}

</Style>

<body>
    <div style="width:100%; height:140px; position:fixed;" >
        <div class="log-details" id="alert-msg" style="display:none; height:70px">
            
        </div>
    </div>

  
	<div class="container">
		<div class="left-column">
            <div class="row-1">
                <center>
                <h1>Supply Office Withdrawal Monitoring System CSUCC </h1>
                </center>
            </div>
            <div class="row-2">
			    <img src="img/login.jpg" alt="Login Image" style="height:50%; width:50%">
            </div>
		</div>
		<div class="right-column">
          
			<form>
            
          
				<h2>Login</h2>
				<input type="text" placeholder="Username" id="username" required>
				<input type="password" placeholder="Password" id="password" required>
				<button type="button" id="btn" onclick="login()">Login</button>
			</form>
		</div>
	</div>
    <script>
        
        function login(){
            $("#alert-msg").html("")
            let username = $("#username").val()
            let password = $("#password").val()
            $.ajax({
                type:"POST",
                url:"authentication/authenticate.php",
                data:{
                    username:username,
                    password:password,
                },
                beforeSend:function(){
                    $('#btn').prop("disabled", true);
                    $('#btn').html('Login... <i class="fa-solid fa-circle-notch fa-spin"></i>');
                },
                success:function(data){
                   
                     setTimeout(function() {
                        $(document).ready(function () {
                            $('#btn').html('Login');

                            if(data==1){
                                $("#alert-msg").html("<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'><i class='bi-check-circle-fill'></i><strong class='mx-2'> Login success!</strong> </div>")
                                $("#alert-msg").css("display","block")
                                $('#btn').html('Loading.....');
                                setTimeout(function() {
                                    $(document).ready(function () {
                                        $("#alert-msg").html("")
                                        $("#alert-msg").css("display","none")
                                        window.location.href = "dashboard.php";
                                    });
                                }, 1000);
                            }else if(data==2){
                                $("#alert-msg").html("<div class='alert alert-success alert-dismissible d-flex align-items-center fade show'><i class='bi-check-circle-fill'></i><strong class='mx-2'> Administrator Login!</strong> </div>")
                                $("#alert-msg").css("display","block")
                                $('#btn').html('Loading.....');
                                setTimeout(function() {
                                    $(document).ready(function () {
                                        $("#alert-msg").html("")
                                        $("#alert-msg").css("display","none")
                                        window.location.href = "administrator.php";
                                    });
                                }, 2000);
                            }else if(data==3){
                                $('#btn').prop("disabled", false);
                                $("#alert-msg").html("<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'><i class='bi-exclamation-octagon-fill'></i><strong class='mx-2'> Your account has been deactivate!</strong></div>")
                                $("#alert-msg").css("display","block")

                                setTimeout(function() {
                                    $(document).ready(function () {
                                        $("#alert-msg").html("")
                                        $("#alert-msg").css("display","none")
                                    });
                                }, 3000);
    
                            }else{
                                $('#btn').prop("disabled", false);
                                $("#alert-msg").html("<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'><i class='bi-exclamation-octagon-fill'></i><strong class='mx-2'> Invalid username/password!</strong></div>")
                                $("#alert-msg").css("display","block")

                                setTimeout(function() {
                                    $(document).ready(function () {
                                        $("#alert-msg").html("")
                                        $("#alert-msg").css("display","none")
                                    });
                                }, 3000);
    
                            }
                        });
                    },1000);
                },
            }); 
           
        }
    </script>
</body>
</html>

<?php include('server.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Login</title>
</head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<style type="text/css">
	
.form-control{
		width: 75%;
		border:1px solid black;
		background: #ffffffaa;
		text-align: center;
		color: white;
		font-size: 1vw;
		display: inline-block;

	}
	.form-group{
		color: white;
		font-size: 2vw;


	}
	.btn-success{
		background-color: green;
		color:white;
		font-size: 1vw;

	}
	.login-form{
		background-color: #000000aa;
		color: white;
		padding-top: 2.5%;
		padding-bottom: 2.5%;
		position: fixed;
		top: 15%;
		left: 30%;
		right: 30%;
	}

	img{
		height: 230px;
		width: auto;
		border-radius: 100%;
	}
	body{
		background-color: #ffaa;
	}
	.lefttttt{
		height: 100%;
		width: 50%;
		background-image: url("images/logoLogin.png");
		background-repeat: no-repeat;
		background-size: 400px 400px;

	}
</style>
<body>
	<div class="lefttttt" style="height: 400px; width: 400px; margin-top: 5%;">
		
	</div>

	<div class="login-form" >
		<div class="login-container">
		<center>
			<img src="images/myLogo.png">
			<form  class="form-group" method="post" action="main_login.php">

				<?php include('errors.php');
				?>

            <input type = "text" class = "form-control" name = "username" placeholder="Username" required autofocus></br>
            <input type = "password" class = "form-control" name = "password" placeholder="Password" required>
			<center>
				<input type="submit" name="login_user" class="btn btn-success" value="Login" style="width: 50%;">
			</center>
		</form></center>
		</div>
	</div>


</body>
</html>
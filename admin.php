<?php 
include('add_user_function.php');
	session_start(); 
	if (!isset($_SESSION['username'])) {
		echo '<script> alert("You must login first!"); </script>';
		header('location: main_login.php');
		exit;
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: main_login.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
</head>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<style type="text/css">
	body{
		background-color: gray;

	}

    .Container {
	    width: 100%;
	    min-width: 500px;
	    margin: auto;
	}
	.main_content {

	    width: 35%;
	    height: 100%;
	}
	.btn-success{
		background-color: #121212;
		font-size: 14pt;
		width: 60%;
		height: 50px;
		margin-bottom: 20px;
		border: none;
	}
	.content {
	    width: 100%;
	    height: 500px;
	    margin-top: 5%;
	}
	.input-group {
	margin: 10px 0px 10px 0px;
}

.input-group label {
	display: block;
	text-align: left;
	margin: 3px;
}
.input-group input {
	height: 30px;
	width: 100%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
	
</style>
<body>
	<div class="Container">

		<div class="content" align="center">

			<aside class="main_content" >

			<div style="width: 100%; height: 100%;background-color: #1f1b24; padding-top: 5%;" align="center">
				<img src="images/prof.png" style="height: 75px; width: 75px; margin-bottom: 25px;">
				<br>
				<?php 
					if ($_SESSION['user_type'] == "admin") {
						?>
						<a href="" style="margin-bottom: 25px; color: white; font-size: 18pt; font-weight: bold; text-transform: uppercase;"><?php echo "SUPER ADMIN"?></a>
						<?php
					}
					else{
						?>
						<a href="" style="margin-bottom: 25px; color: white; font-size: 18pt; font-weight: bold; text-transform: uppercase;"><?php echo "ADMIN"?></a>
						<?php
					}
					 ?>
				
				<br>
				<br>

				<a href="sales_report.php"><button class="btn btn-success" name="coffee">Sales Report</button></a>
				<a href="stocks.php"><button class="btn btn-success" name="coffee">Stocks</button></a>
				<?php 
					if ($_SESSION['user_type'] == "admin") {
						?>
						<a href="users.php"><button class="btn btn-success">View/Add Users</button></a>
						<?php
					}
					else{
						?>
						<button class="btn btn-success" style="color: gray;">View/Add Users</button>
						<?php
					}
					 ?>
				


				<a href="admin.php?logout='1'"><button class="btn btn-success" name="coffee">Logout</button></a>
			</div>

		</aside>


	
	</div>
</div>





</body>
</html>


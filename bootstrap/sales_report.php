<?php 
include('add_products_function.php');
	session_start(); 


	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
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
	<title>Sales Report</title>
</head>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style type="text/css">
	body{
		background-color: gray;

	}
	header {
	    width: 100%;
	    height: 75px;
	    line-height: 70px;
	    background-color: #313131;
	}

    header span {
        color: #fff;
        font-size: 20px;
        padding-left: 20px;
    }

    .Container {
	    width: 100%;
	    min-width: 500px;
	    margin: auto;
	}
	.report_side {
	    width: 25%;
	    float: left;
	    height: 100%;
	}
	.stocks {
	    width: 15%;
	    float: right;
	    height: 100%;
	}
	.btn-success{
		background-color: #121212;
		font-size: 14pt;
		width: 50%;
		height: 50px;
		margin-top: 40px;
		margin-bottom: 40px;
		border: none;
	}
	table {
	  border-collapse: collapse;
	}

	table, th, td {
	  border: 1px solid black;
	}
	.reports {
	    width: 75%;
	    float: left;
	    height: 100%;
	    background-color: pink;
	}

	.reportsDescription {
	    display: -moz-box; /* Firefox*/
	    display: -webkit-box; /* Chrome */
	    display: -ms-flexbox; /* IE 10 */
	    display: flexbox;
	    flex-direction: row;
	    flex-align:start;
	    width: 100%;
	    height: 150px;
	}
	.content {
	    width: 100%;
	    height: 700px;
	}
	footer {
	    width: 100%;
	    height: 50px;
	    background-color: black;
	}
	.column {
	  float: left;
	  width: 15%;
	  padding: 10px;
	  margin-left: 4.5%;
	  margin-bottom: 3%;
	}

	.row {
		width: 100%;
	}
</style>
<body>
	<div class="Container">

		
		<header style="height: 5%; background-color: black; color: white;">
			<span> Admnistration Panel 
				<img src="images/prof.png" style="height: 50px; width: 50px;  position: relative; left: 55%;">
				

					<button class="btn" style="width: 15%;color: white;text-transform: uppercase;position: relative; left: 55%;"><?php echo "SUPER ",$_SESSION['username']; ?></button>

				<a href="admin.php" style="text-decoration: none; position: relative; left: 55%; font-size: 12pt">Back</a>
			</span>
		</header>

	</div>
	<div>
		<a href="delivered.php"><button style="margin-left: 5%; margin-top: 2%;" class=" btn btn-primary">See Delivered</button></a>
	</div>

  <div class="row" style="color: white;">

  		<?php 
  		$stats = "PENDING";
	 $sql = "SELECT * FROM process WHERE status = '$stats' ";

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) {
	        	?>
	        	<table style="margin-left: 6%; margin-top: 2%;">
	        		<tr>
	        			<td>
	        	<div class="receipt" style="height: 500px; width: 325px; background-color: #1f1b24;">
	        		<center><div style="width: 300px; height: 50px; line-height: 50px; text-transform: uppercase; font-family: bold; font-size: 14pt; background-color:  #313131; float: left; margin-top: 2%; margin-left: 12.5px;">
	        			<?php echo $row['guest_name']; ?>
	        		</div></center>
	        		<div style="height: 60%; width: 150px; float: left; margin-top: 5%;" align="center">
	        			<label style="font-weight: bold; font-size: 12pt;">Orders</label><br>
	        			<p style="font-size: 10pt;">	
			        	<?php
			        	echo $row['orders'];
			        	?></p>
	        		</div>
	        		<div style="height: 60%; width: 50px; float: left; margin-left: 3.5%; margin-top: 5%;" align="center">
	        			<label style="font-weight: bold; font-size: 12pt;">Qty</label><br>
	        			<p style="font-size: 10pt;">
				        	<?php
				        	echo $row['quantity'];
				        	?></p>
	        		</div>
	        		<div style="height: 60%; width: 100px; float: right; margin-top: 5%;" align="center">
	        			<label style="font-weight: bold; font-size: 12pt;">Prices</label><br>
	        			<p style="font-size: 10pt;">
				        	<?php
				        	echo $row['price_tag'];
				        	?></p>
	        		</div>
	        		<div style="height: 40px; width: 50%;float: left; margin-top: 5%; line-height: 40px;" align="center">
	        			<p style="font-weight: bold;">
	        				Total Amount:
	        			</p>
	        		</div>
	        		<div style="height: 40px; width: 30%; float: right; margin-top: 5%; line-height: 40px" align="center">
	        			<?php echo "₱", $row['total']; ?>
	        		</div>
	        		<div style="height: 40px; width: 200px; float: left; margin-top: 5%; line-height: 40px; font-weight: bold;" align="center">
	        			<label>STATUS: <?php echo $row['status']; ?></label>
	        		</div>
	        		<div style="height: 40px; width: 100px; float: right; margin-top: 5%; margin-right: 10px;">
	        			<form action="add_products_function.php" method="post">
	        				<input type="hidden" name="hidden_id" value="<?php echo $row['id'];?>">

	        				<button type="button" class="btn btn-info editbtn" style="width: 100%;"  data-toggle="modal" data-target="#confirm">Deliver</button>
	        			
	        		</div>
	        	</div>
	        	</td>
	        	</tr>
	        	</table>
	        	<br>
	        	<?php
	        }
	    }
	}
 ?>
  </div>
</div>

<div class="modal fade" role = "dialog" id="confirm">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h5>Confirm Delivery</h5>
					</div>
					<div class="modal-footer">
						<input type="submit" name="processBTN" class="btn btn-primary" value="Confirm">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
					</form>

				</div>
			</div>
		</div>
	
</body>
</html>
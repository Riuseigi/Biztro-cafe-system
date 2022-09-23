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
	<title>Delivered Sales</title>
</head>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=1200,height=600');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>
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
	  border: 2px solid #ffffff99;
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
	  width: 50%;
	  padding: 10px;
	  margin-left: 5%;
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

	<div id="divToPrint" style="display: none;">
  <div style="width:1000px;height:500px;background-color:teal;">
  	<center><h1>SALES REPORT</h1></center>
  	<table style="margin-left: 10%; width: 80%;background-color:  #1f1b24;">
	        		
	        		<th width="5%" style="font-size: 14pt; text-align: center;">ID</th>
	        		<th width="15%" style="font-size: 14pt; text-align: center;">Name</th>
	        		<th width="7%" style="font-size: 14pt; text-align: center;">No. Items</th>
	        		<th width="8%" style="font-size: 14pt; text-align: center;">Total Amount</th>	
	        		<th width="10%" style="font-size: 14pt; text-align: center;">Time</th>
  		<?php 
  		$stats = "SERVED!";
	 $sql = "SELECT * FROM process WHERE status = '$stats' ";
		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) {
	        	?>
	        	
	        	
	        		<tr>
		        			<td style="text-align: center;">
		        				<?php echo $row['id']; ?>
		        			</td>
		        			<td style="text-align: center;">
		        				<?php echo $row['guest_name']; ?>
		        			</td>
		        			<td style="text-align: center;">
		        				<?php echo $row['items']; ?>
		        			</td>
				        	<td style="text-align: right;">
				        		<?php echo "₱", $row['total']; ?>
				        	</td>
		        			<td>
		        				<center>
		        				<?php echo $row['currentTime']; ?>
		        				</center>
		        			</td>
	        			
	        		</tr>
	        		
	        	
	        	
	        	<br>
	        	<?php
	        }
	    }
	}
 ?>
 </table> 
  </div>
</div>
	<div>
		<a href="sales_report.php"><button style="margin-left: 5%; margin-top: 2%;" class=" btn btn-primary">See Pending</button></a>
	</div>
	<input style="margin-left: 10%; margin-top: 2%" class="btn btn-primary" type="button" value="print" onclick="PrintDiv();" />
  <div class="row" style="color: white;">

  	<table style="margin-left: 10%; margin-top: 2%; width: 80%;background-color:  #1f1b24;">
	        		
	        		<th width="5%" style="font-size: 14pt; text-align: center;">ID</th>
	        		<th width="15%" style="font-size: 14pt; text-align: center;">Name</th>
	        		<th width="7%" style="font-size: 14pt; text-align: center;">No. Items</th>
	        		<th width="8%" style="font-size: 14pt; text-align: center;">Total Amount</th>
	        		<th width="10%" style="font-size: 14pt; text-align: center;">Status</th>
	        		<th width="10%" style="font-size: 14pt; text-align: center;">Time</th>
  		<?php 
  		$stats = "SERVED!";
	 $sql = "SELECT * FROM process WHERE status = '$stats' ";
		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) {
	        	?>
	        	
	        	
	        		<tr>
		        			<td style="text-align: center;">
		        				<?php echo $row['id']; ?>
		        			</td>
		        			<td style="text-align: center;">
		        				<?php echo $row['guest_name']; ?>
		        			</td>
		        			<td style="text-align: center;">
		        				<?php echo $row['items']; ?>
		        			</td>
				        	<td style="text-align: right;">
				        		<?php echo "₱", $row['total']; ?>
				        	</td>
					        <td style="text-align: center;">
		        			<?php echo $row['status']; ?>
		        			</td>
		        			<td>
		        				<center>
		        				<?php echo $row['currentTime']; ?>
		        				</center>
		        			</td>
	        			
	        		</tr>
	        		
	        	
	        	
	        	<br>
	        	<?php
	        }
	    }
	}
 ?>
 </table>
  </div>
</div>

	
</body>
</html>
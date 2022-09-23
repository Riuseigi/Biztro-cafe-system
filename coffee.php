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
	<title>Stocks</title>
	<script type="text/javascript">
function delete_id(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='stocks.php?delete_id='+id;
     }
}
</script>
</head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<style type="text/css">
	body{
		background-color: white;

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
		margin-top: 10px;
		margin-bottom: 10px;
		border: none;
	}
	.btn-active{
		background-color: green;
		font-size: 14pt;
		width: 50%;
		height: 50px;
		margin-top: 40px;
		margin-bottom: 40px;
		border: none;
	}
	table {
	  border-collapse: collapse;
	  width: 75%;
	  text-align: center;
	  background-color: white;
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
	    height: auto;
	    background-color: #1f1b24;
	}
	footer {
	    width: 100%;
	    height: 50px;
	    background-color: black;
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

		
		<header style="height: 5%; background-color: black; color: white;">
			<span> Admnistration Panel 
				<img src="images/prof.png" style="height: 50px; width: 50px;  position: relative; left: 55%;">
				

					<button class="btn" style="width: 15%;color: white;text-transform: uppercase;position: relative; left: 55%;"><?php echo "SUPER ",$_SESSION['username']; ?></button>

				<a href="admin.php" style="text-decoration: none; position: relative; left: 55%; font-size: 12pt">Back</a>
			</span>
		</header>

		<div class="content">

			<aside class="report_side">

			<div style="width: 100%; height: 100%;background-color: #1f1b24; padding-top: 3%;" align="center">
				<button class="btn btn-success" type="button" name="age" id="age" data-toggle="modal" data-target="#add_product" class="btn btn-warning">ADD PRODUCT </button>
				<a href="stocks.php"><button class="btn btn-success" name="coffee">FOODS</button></a>
				<a href="rice_bowls.php"><button class="btn btn-success" name="coffee">RICE BOWLS</button></a>
				<a href="snacks.php"><button class="btn btn-success" name="coffee">SNACKS</button></a>
				<a href="beverages.php"><button class="btn btn-success" name="coffee">BEVERAGES</button></a>
				<a href="milktea.php"><button class="btn btn-success" name="coffee">MILKTEA</button></a>
				<a href="toppings.php"><button class="btn btn-success" name="coffee">TOPPINGS</button></a>
				<a href="coffee.php"><button class="btn btn-success active" name="coffee">COFFEE</button></a>
				<a href="liqour.php"><button class="btn btn-success" name="coffee">LIQOUR</button></a>
			</div>
		</aside>
		<div align="right">
			<button class="btn btn-primary" style="width: 10%; margin-top: 1%; margin-right: 5%; margin-bottom: 1%;">Print</button>
		</div>

		<table>
			<tr>
				<th style="display: none;">ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Size</th>
				<th>Category</th>
				<th>Images</th>
				<th colspan="2"> ACTION</th>
			</tr>
		<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Coffee' ORDER BY id ASC"; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 
	        while ($row = mysqli_fetch_array($res)) { 
	            echo "<tr>";
	            echo "<td style = ".'display:none;'.">".$row['id']."</td>";
	            echo "<td>".$row['productname']."</td>"; 
	            echo "<td>".$row['price']."</td>"; 
	            echo "<td>".$row['size']."</td>"; 
	            echo "<td>".$row['category']."</td>";
	            echo "<td>";
	            echo "<div id = 'img_div'>";
			echo "<img src = 'images/".$row['image']."' style = ".'width:75px;height:75px;'." > ";
			echo "</div>";
			echo"</td>";
 
	        ?>
	        
	        <td>
	        	<button type="button" class="btn btn-info editbtn" style="width: 100%;">EDIT</button>
	        	
	        </td>
	        <td>
	        	<a href="javascript:delete_id(<?php echo $row['id']; ?>) " class = "btn btn-danger" style = "width: 100%;">DELETE</a>
	        </td>

	    <?php 
	echo "</tr>"; 
} ?>
	        <?php 
	        echo "</table>"; 
	    } 
	    else { 
	        echo "<h3> No records found. </h3>"; 
	    } 
	} 
	else { 
	    echo "ERROR: Could not able to execute $sql. "
	                                .mysqli_error($db); 
	} 
	mysqli_close($db); 
		 ?>
		


		<footer></footer>

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
	<!--THIS IS MY MODAL-->
	<div class="modal fade" role = "dialog" id="add_product">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h5>ADD PRODUCT</h5>
					</div>
					<form action="add_products_function.php" method="POST" enctype="multipart/form-data" id="personID" onsubmit="return ValidateForm();">
					<div class="modal-body">

						<div class="input-group">
							<label>Product name</label>
							<input type="text" name="prod_name" value="<?php echo $productname; ?>">
						</div>
						<div class="input-group">
							<label>Product Price</label>
							<input type="text" name="prod_price" value="<?php echo $productprice; ?>">
						</div>
						<div class="input-group">
							<label>Product Size</label>
							<input type="text" name="prod_size" value="<?php echo $productsize; ?>">
						</div>
						<div class="asd">
							<input type="hidden" name="size" value="1000000">
							<label>IMAGE/PHOTO</label>
							<br>
							<input type="file" name="image" required="required">
						</div>
						<br>
						<label>Category</label>
						<select name="category" id="category" class="form-control">
							<option value="Beverages">Beverages</option>  
							<option value="Coffee">Coffee</option>
							<option value="Foods">Food</option>
							<option value="Liqours">Liqour</option>  
							<option value="Milktea">Milktea</option>
							<option value="Rice Bowls">Rice Bowl</option>  
							<option value="Snacks">Snacks</option>
							<option value="Toppings">Toppings</option>
						</select>
						<br>
					</div>
					<div class="modal-footer">
						<input type="submit" name="insertdata" class="btn btn-primary" id="insert" value="Add" onclick="ValidateForm">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
					</form>

				</div>
			</div>
		</div>

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<!--THIS IS EDIT PRODUCTS MODAL-->
	<div class="modal fade" role = "dialog" id="editprod">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h5>EDIT PRODUCT</h5>
					</div>
					<form action="add_products_function.php" method="POST" id="personID" enctype="multipart/form-data">
					<div class="modal-body">

						<input type="hidden" name="myid" id="myid">

						<div class="input-group">
							<label>Product name</label>
							<input type="text" id="prod_name" name="prod_name">
						</div>
						<div class="input-group">
							<label>Product Price</label>
							<input type="text" id="prod_price" name="prod_price">
						</div>
						<div class="input-group">
							<label>Product Size</label>
							<input type="text" id="prod_size" name="prod_size">
						</div>
						<div>
							<input type="hidden" name="size" value="1000000">
							<label>IMAGE/PHOTO</label><br>
							<input type="file" name="myImage" required="required" value="<?php echo $row['image'] ?>">
						</div>
						<label>Category</label>
						<select name="category" id="category" class="form-control">
							<option value="Beverages">Beverages</option>  
							<option value="Coffee" selected="">Coffee</option>
							<option value="Foods" >Food</option>
							<option value="Liqours">Liqour</option>  
							<option value="Milktea">Milktea</option>
							<option value="Rice Bowls">Rice Bowl</option>  
							<option value="Snacks">Snacks</option>
							<option value="Toppings">Toppings</option>
						</select>
						<br>
					</div>
					<div class="modal-footer">
						<input type="submit" name="update" class="btn btn-primary" value="Modify">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</div>
					</form>

				</div>
			</div>
		</div>

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

</body>
</html>

<!--THIS IS MY SCRIPT-->
<!-- <script type="text/javascript">
function ValidateForm()
{
	var a = 0;
   var success = true;
    $("input").each(function()
        {
            if($(this).val()=="")
            {
            a++;   
                success = false;
            }

    });

    if (a != 0) {
    	alert("Please fill out the form");
    }
    return success;
}
</script> -->

<script>
	
	$(document).ready(function () {

		$('.editbtn').on('click' , function() {
			$('#editprod').modal('show');

			$tr = $(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();

			console.log(data);
			$('#myid').val(data[0]);
			$('#prod_name').val(data[1]);
			$('#prod_price').val(data[2]);
			$('#prod_size').val(data[3]);
			$('#category').val(data[4]);
		});

	})
</script>
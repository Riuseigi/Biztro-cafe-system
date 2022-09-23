<?php

session_start();
	$db = mysqli_connect('localhost', 'root', 'bartine2x', 'db_userview');
 if(isset($_POST["add_to_cart"]))  
 {  
    $id = $_GET['id'];
    $item_name = $_POST['hidden_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['hidden_price'];
    
     
    $query = mysqli_query($db, "SELECT * FROM orders WHERE id='$id' ");

    if (!$query)
    {
        die('Error: ' . mysqli_error($db));
    }
	if(mysqli_num_rows($query) > 0){  
		$quant = "SELECT quantity FROM orders WHERE id = '$id' ";
		$totalQuantity = 0;
		if ($resss = mysqli_query($db,$quant)) {
			if (mysqli_num_rows($resss) > 0) {
				while ($row = mysqli_fetch_array($resss)) {
					$totalQuantity = $row['quantity'] + $quantity;
				}
				# code...
			}
			# code...
		}
	    $query = "UPDATE orders SET item_name = '$item_name' , quantity = '$totalQuantity' , price = '$price' WHERE id = '$id' ";
	    $query_run = mysqli_query($db,$query);
	    header('location:menu.php');
	    exit;
	}else{

	    $query = "INSERT INTO orders (id, item_name, quantity, price) VALUES ('$id' , '$item_name', '$quantity' , '$price') ";
	    $query_run = mysqli_query($db,$query);
	    header('location:menu.php');
	    exit;

	}
 }  
 if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$query = "DELETE from orders WHERE id = $id";
		$query_run = mysqli_query($db, $query);
		header("location:menu.php");
		exit;
	}

 if (isset($_POST['order'])) {
	 	$arrayItem = [];
	 	$arrayPrice = [];
	 	$arrayQuantity = [];
	 	$status = "PENDING";
	 	$guest_name = $_POST['guest'];
	 	$hidden_total = $_POST['hidden_total'];
	 	$dateFormat = $_POST['time'];
        $query1 = "SELECT * FROM orders";
		// set array
		$array = array();
		$items = 0;
		$result = mysqli_query($db,$query1);
		// look through query
		while($row = mysqli_fetch_array($result)){

		  // add each row returned into an array
		  $arrayItem[] = $row['item_name'];
		  $arrayPrice[] = $row['price'];
		  $arrayQuantity[] = strval($row['quantity']);
		  // OR just echo the data:
		  $items += 1;
		}

		$allOrders = implode("<br>", $arrayItem);
		$allPrice = implode("<br>", $arrayPrice);
		$allQuantity = implode("<br>", $arrayQuantity);
        $query = "INSERT INTO process (guest_name, orders , price_tag, status, total, items, quantity, currentTime ) VALUES ('$guest_name','$allOrders' , '$allPrice' , '$status', '$hidden_total', '$items' , '$allQuantity' , $dateFormat )";
        $query_run = mysqli_query($db, $query);

        $queryDelete = "DELETE FROM orders";
        $query_running = mysqli_query($db, $queryDelete);
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Menu</title>
</head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style type="text/css">

	.logo{
		height: 75px;
		margin-left: 5%;
	}
	body, html {
    margin: 0px;
    padding: 0px;
    font-family: 'Trebuchet MS';
	}

	.Container {
	    width: 100%;
	    min-width: 500px;
	    margin: auto;
	}

	header {
	    width: 100%;
	    height: 100;
	    line-height: 95px;
	    background-color: #313131;
	}

    header span {
        color: #fff;
        font-size: 30px;
        padding-left: 20px;
    }

	.content {
	    width: 100%;
	    min-height: 500px;
	    height: 100%;
	    background-image: url("images/vinzoBG.jpg");
	    background-repeat: repeat;
	    background-size: 100% 600px;
	}
	.menuBG{
		width: 95%;
	    min-height: 500px;
	    height: 95%;
	    background-color: #ffffff22;
	    color: white;
	}

	footer {
	    width: 100%;
	    height: 50px;
	    background-color: black;
	}

	.btn-success{
		background-color: green;
		font-size: 14pt;
		width: 50%;
		height: 50px;
		margin-top: 20px;
		margin-bottom: 10px;
		border: none;
	}
	textarea{
		width: 75%;
		height: 5%;
		margin-top: 25px;
	}

	.column {
	  float: left;
	  width: 15%;
	  padding: 10px;
	  margin-left: 4.5%;
	  margin-bottom: 3%;
	  border-radius: 15%;
	  background-color: #aaaaaaa2;
	  color: black;

	}

	.row {
		width: 100%;
	}
	.modal-lg{
		width: 1200px;
	}

</style>
<body >
	

	<div class="Container" >	
		<header>
			<span>
				<a href="menu.php"><img src="images/myLogo.png" class="logo" style="border-radius: 100%; width: auto; height: 95px;"></a>
	<select id="viewSelector" style="border-radius: 25px; height: 30px; margin-left: 20%; width: 25%; font-size: 14pt;">
   <option value="0"> Select a Category </option>
   <option value="Food">Food</option>
   <option value="Rice">Rice Bowls</option>
   <option value="Snacks">Snacks</option>
   <option value="Beverages">Beverages</option>
   <option value="Milktea">Milktea</option>
   <option value="Toppings">Toppings</option>
   <option value="Coffee">Coffee</option>
   <option value="Liqour">Liqour</option>

</select>
				<button class="btn btn-primary" style="width: 20%; position: relative; left: 15%;" data-toggle="modal" data-target="#view_order">Check my Orders</button>
			</span>
		</header>

		<div class="content" align="center">
			<br>
			<div class="menuBG" >


<div id="Food">
  <h2> FOODS </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Foods' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	           
	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";
				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Rice">
  <h2> Rice Bowls </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Rice Bowls' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>

	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";
				?>

				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Snacks">
	<h2> Snacks </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Snacks' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" /> 
                <div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Beverages">
	<h2> Beverages </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Beverages' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'." ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>
<div id="Milktea">

	<h2> Milktea </h2>

  	<div class="row">
			<?php


		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Milktea' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'." ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Toppings">
	<h2> Toppings </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Toppings' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Coffee">
	<h2> Coffee </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Coffee' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
		else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>
</div>


<div id="Liqour">
	<h2> Liqour </h2>
  <div class="row">
				  

				<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM products WHERE category = 'Liqours' ORDER BY price ASC "; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <div class="column">
	            <?php 

	            echo "<div id = 'img_div'>";
				echo "<center><img src = 'images/".$row['image']."' style = ".'width:125px;height:100px;'."  ></center>";
				echo "<center>".$row['productname']."</center>";
				echo "<center>₱".$row['price']."</center>";
				echo "</div>";


				?>
				<form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">
				<input type="hidden" name="hidden_name" value="<?php echo $row["productname"]; ?>" />  
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               

				<div> 
                <center><label style="">Quantity</label>
				<input type="text" name = "quantity" style="width: 40px; text-align: center; margin-left:10px;" value="1"></center>
				</div>
				<center> <input type="submit" name="add_to_cart"style="font-size: 10pt; height: 30px; margin-top: 5px;width: 100px;" class="btn btn-success" value="Add to Cart" /> </center>
				</form>
			</div>
				<?php 

			}
		}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	    } 
	}
	        ?>
	        </div>	        
	</div>

			</div>
			<br>
		</div>



<div class="modal fade" role = "dialog" id="view_order">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">

					<div class="modal-header">
						<h5>Order Details</h5>
					</div>

					<div class="modal-body">
						<div style="clear:both"></div>  
                <br />
                <div class="table-responsive">  
                	<form action="menu.php" method="post">
                		<label>Name:</label>
                		<input type="text" name="guest" required="required" placeholder="Your Name">
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM orders"; 
		$total = 0;
		$dat = date("d/m/Y");
		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 

	        while ($row = mysqli_fetch_array($res)) { 
	            ?>
	            <tr>  
                          	
                               <td><?php echo $row["item_name"]; ?></td>  
                               <td><?php echo $row["quantity"]; ?></td>  
                               <td>₱ <?php echo $row["price"]; ?></td>
                               
                               <td>₱ <?php echo number_format($row["quantity"] * $row["price"], 2); ?></td>  
                               <td><a href="menu.php?delete=<?php echo $row["id"]; ?>"><span class="text-danger">Remove</span></a></td>
                          </tr>  
                          <?php  
                                    $total = $total + ($row["quantity"] * $row["price"]);
                               }

                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>
                               <td align="right">₱ <?php echo number_format($total, 2); ?></td>
                               <input type="hidden" name="time" value="<?php echo $dat; ?>">
                               <input type="hidden" name="hidden_total" value="<?php echo number_format($total, 2); ?>">
                               <td><button class="btn btn-primary" name="order">Order</button></td>
                               </form> 
                          </tr>  
                          <?php  
                          }
                          ?> 
	            <?php 
			}
	else { 
	        echo "<p style = ".'margin-left:2%;'."> No Foods Yet. </p>"; 
	}
	        ?>
                           
                     </table>  
                </div>  
					</div>

					<div class="modal-footer">
						
					</div>

				</div>
			</div>
		</div>
				



        </div>
                <footer>
                	
                </footer>
            </div>
        </div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
  $.viewMap = {
    '0' : $([]),
    'All' : $('#Food'),
    'Food' : $('#Food'),
    'Rice' : $('#Rice'),
    'Snacks' : $('#Snacks'),
    'Beverages' : $('#Beverages'),
    'Milktea' : $('#Milktea'),
    'Toppings' : $('#Toppings'),
    'Coffee' : $('#Coffee'),
    'Liqour' : $('#Liqour'),
  };

  $('#viewSelector').change(function() {
    // hide all
    $.each($.viewMap, function() { this.hide(); });
    // show current
    $.viewMap[$(this).val()].show();
  });
});
</script>

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
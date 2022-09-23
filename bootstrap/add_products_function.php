<?php

	// variable declaration
	$productname = "";
	$productprice = "";
	$productsize = "";
	$category = "";
	$errors = array();
	$msg = "";
	// connect to database
	$db = mysqli_connect('localhost', 'root', 'bartine2x', 'db_userview');
	// REGISTER USER
	if (isset($_POST['insertdata'])) {
		// receive all input values from the form
		
		$target = "images/".basename($_FILES['image']['name']);
		$image = $_FILES['image']['name'];

		$productname = mysqli_real_escape_string($db, $_POST['prod_name']);
		$productprice = mysqli_real_escape_string($db, $_POST['prod_price']);
		$productsize = mysqli_real_escape_string($db, $_POST['prod_size']);
		$category = mysqli_real_escape_string($db, $_POST['category']);


			$query = "INSERT INTO products (productname,price,size,category, image) 
					  VALUES('$productname','$productprice','$productsize','$category' , '$image')";
			$query_run = mysqli_query($db, $query);

			if (move_uploaded_file($_FILES['image']['tmp_name'], $target )) {
				$msg = "Image Uploaded";
				# code...
			}
			else{
				$msg = "Upload Failed";
			}
			if ($query_run) {
				echo '<script> alert ("Data Saved"); </script>';
				header('location: stocks.php');
				exit;

			}
			else{
				echo '<script> alert("Data not Saved"); </script>';
			}
		
	}

	if (isset($_GET['delete_id'])) {
		$id = $_GET['delete_id'];
		$query = "DELETE from products WHERE id = $id";
		$query_run = mysqli_query($db, $query);

		header('location: stocks.php');

	}
	// if(isset($_POST['update']))
	// 	{
	// 		//get user input
	// 		$book_id=$_POST['myID'];
	// 		$text=$_POST['text'];
	// 		$storedFile="images/".basename($_FILES["myImage"]["name"]);
	// 		$myStyle = basename($_FILES["myImage"]["name"]);
	// 		move_uploaded_file($_FILES["myImage"]["tmp_name"],$storedFile);
	// 		$query = "UPDATE images SET image='$myStyle', texts ='$text' WHERE id='$book_id'";
	// 		$query_run = mysqli_query($db, $query);
	// 	}

	
	if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="menu.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      } 
      header('location: menu.php');
      exit;
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="menu.php"</script>';  
                }  
           }  
      }  
      header('location: menu.php');
      exit;
 }
 		 if (isset($_POST['order'])) {

	 	$array = [];
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                                    $array[] = $values["item_name"];

                                    unset($_SESSION["shopping_cart"][$keys]);
                               }
                          }
                          
                          $dim = implode("<br>",$array);
                          echo $dim;
                          $query = "INSERT INTO process (orders) VALUES ('$dim')";
                          $query_run = mysqli_query($db, $query);
                          header('location: menu.php');
                          exit;
 }

 if (isset($_POST['processBTN'])) {
		$id = $_POST['hidden_id'];
		$date = date('Y-m-d H:i:s');
		$status = "SERVED!";
		$query = "UPDATE process SET status = '$status', currentTime = '$date' WHERE id = '$id' ";
		$query_run = mysqli_query($db, $query);
		header('location: sales_report.php');
		exit;
	}
	if (isset($_POST['update'])) {

		$myid = $_POST['myid'];

		$productname = $_POST['prod_name'];
		$productprice =$_POST['prod_price'];
		$productsize = $_POST['prod_size'];
		$category = $_POST['category'];
		$storedFile="images/".basename($_FILES["myImage"]["name"]);
		$myStyle = basename($_FILES["myImage"]["name"]);
		move_uploaded_file($_FILES["myImage"]["tmp_name"],$storedFile);
		$query = "UPDATE products SET productname = '$productname', price = '$productprice', size = '$productsize', category = '$category', image = '$myStyle' WHERE id ='$myid'  ";

		$query_run = mysqli_query($db, $query);

		if ($query_run) {
				echo '<script> alert ("Data Saved"); </script>';
				header('location: stocks.php');
				exit;
			}
			else{
				echo '<script> alert("Data not Saved"); </script>';
			}

	}


?>


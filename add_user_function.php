<?php

	// variable declaration
	$lastname = "";
	$firstname = "";
	$username = "";
	$contact = "";
	$email    = "";
	$user_type = "";
	$errors = array();
	// connect to database
	$db = mysqli_connect('localhost', 'root', 'bartine2x', 'db_userview');
	// REGISTER USER
	if (isset($_POST['insertdata'])) {
		// receive all input values from the form
		$contact = mysqli_real_escape_string($db, $_POST['contact']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$user_type = mysqli_real_escape_string($db, $_POST['type']);
		$password = md5($username);

			$query = "INSERT INTO users (firstname,lastname,username,contact,email, password, user_type) 
					  VALUES('$firstname','$lastname','$username','$contact', '$email', '$password' , '$user_type')";
			$query_run = mysqli_query($db, $query);

			if ($query_run) {
				echo '<script> alert ("Data Saved"); </script>';
				header('location: users.php');
				exit;
			}
			else{
				echo '<script> alert("Data not Saved"); </script>';
			}

	}

	if (isset($_GET['delete_id'])) {
		$id = $_GET['delete_id'];
		$query = "DELETE from users WHERE id = $id";
		$query_run = mysqli_query($db, $query);

		header('location: users.php');
		exit;

	}

	if (isset($_POST['updatedata'])) {

		$id = $_POST['updateid'];
		
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$contact = mysqli_real_escape_string($db, $_POST['contact']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$user_type = mysqli_real_escape_string($db, $_POST['type']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password = md5($password);
		$query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', contact = '$contact', email = '$email', username = '$username', user_type = '$user_type' , password = '$password' WHERE id ='$id'  ";
		$query_run = mysqli_query($db, $query);

		if ($query_run) {
				echo '<script> alert ("Data Saved"); </script>';
				header('location: users.php');
				exit;
			}
			else{
				echo '<script> alert("Data not Saved"); </script>';
			}

	}

	?>
<?php 
	session_start();

	// variable declaration
	$lastname = "";
	$firstname = "";
	$username = "";
	$contact = "";
	$email    = "";
	$errors = array(); 
	$msg = "";
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', 'bartine2x', 'db_userview');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$contact = mysqli_real_escape_string($db, $_POST['contact']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (firstname,lastname,username,contact,email, password, user_type) 
					  VALUES('$firstname','$lastname','$username','$contact', '$email', '$password' , 'user')";
			mysqli_query($db, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: menu.php');
			exit;
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
		
		$password = md5($password);
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
		
		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type']) {
				$_SESSION['username'] = $username;
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['user_type'] = $logged_in_user['user_type'];
				$_SESSION['success']  = "You are now logged in";
				header('location: admin.php');
				exit; 
			}
			// else{
			// 	$_SESSION['username'] = $username;
			// 	$_SESSION['user'] = $logged_in_user;
			// 	$_SESSION['success']  = "You are now logged in";

			// 	header('location: user.php');
			// }
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
	


}
	
?>
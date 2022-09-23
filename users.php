<?php 
include('add_user_function.php');
	session_start(); 
	if ($_SESSION['user_type'] == 'user') {
		echo '<script> confirm("You must login first!"); </script>';
		header('location: admin.php');
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
	<title>Add or View Users</title>
	<script type="text/javascript">
	function delete_id(id)
	{
	     if(confirm('Sure To Remove This Record ?'))
	     {
	        window.location.href='users.php?delete_id='+id;
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
	.report_side {
	    width: 25%;
	    float: left;
	    height: 100%;
	}
	.btn-success{
		background-color: #121212;
		font-size: 14pt;
		width: 70%;
		height: 50px;
		margin-top: 70px;
		margin-bottom: 40px;
		border: none;
	}
	table {
	  border-collapse: collapse;
	  width: 75%;
	  text-align: center;
	}

	table, th, td {
	  border: 1px solid black;
	}
	.reports {
	    width: 75%;
	    float: left;
	    height: 100%;
	    background-color: white;
	}
	.content {
	    width: 100%;
	    min-height: 500px;
	    height: 550px;
	    max-height: 550px;
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
				
				<a href="profile.php" style=" position: relative; left: 55%;">
					<button class="btn" style="width: 15%;color: white;">Administrator name</button></a>

				<a href="users.php?logout='1'" style="text-decoration: none; position: relative; left: 55%; font-size: 12pt">LOGOUT</a>
			</span>
		</header>

		<div class="content">
			<aside class="report_side">

				<div style="width: 100%; height: 100%;background-color: #1f1b24; padding-top: 3%;" align="center">
					<a href="users.php"><button class="btn btn-success active">List Of Users</button></a>
					<button class="btn btn-success" type="button" name="age" id="age" data-toggle="modal" data-target="#create_users" class="btn btn-warning">Add Users</button>
					<a href="admin.php"><button class="btn btn-success">Back</button></a>
				</div>

			</aside>



		<?php

		if ($db == false) {
			die("ERROR: Could not connect. ".mysqli_connect_error());
		}

		$sql = "SELECT * FROM users"; 

		if ($res = mysqli_query($db, $sql)) { 
	    if (mysqli_num_rows($res) > 0) { 
	        echo "<table>"; 
	        echo "<tr>"; 
	        echo "<th>ID</th>"; 
	        echo "<th>Firstname</th>"; 
	        echo "<th>Lastname</th>"; 
	        echo "<th>Contact</th>"; 
	        echo "<th>Email</th>"; 
	        echo "<th>Username</th>"; 
	        echo "<th>User Type</th>";
	        echo "<th>EDIT</th>";
	        echo "<th>DELETE</th>"; 
	        echo "</tr>";
	        while ($row = mysqli_fetch_array($res)) { 
	            echo "<tr>"; 
	            echo "<td>".$row['id']."</td>"; 
	            echo "<td>".$row['firstname']."</td>"; 
	            echo "<td>".$row['lastname']."</td>"; 
	            echo "<td>".$row['contact']."</td>"; 
	            echo "<td>".$row['email']."</td>"; 
	            echo "<td>".$row['username']."</td>"; 
	            echo "<td>".$row['user_type']."</td>";
	            
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
	        echo "No records are found."; 
	    } 
	} 
	else { 
	    echo "ERROR: Could not able to execute $sql. "
	                                .mysqli_error($db); 
	} 
	mysqli_close($db); 
		 ?>


		</div>
	</div>
<!-- ##################################################################################################################-->
	<!--THIS IS MY MODAL-->
	<div class="modal fade" role = "dialog" id="create_users">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h5>Create User</h5>
					</div>
					<form action="add_user_function.php" method="POST" id="personID" onsubmit="return ValidateForm();">
					<div class="modal-body">

						<div class="input-group">
							<label>Last name</label>
							<input type="text" required="required" name="lastname" value="<?php echo $lastname; ?>">
						</div>
						<div class="input-group">
							<label>First name</label>
							<input type="text" required="required" name="firstname" value="<?php echo $firstname; ?>">
						</div>
						<div class="input-group">
							<label>Username</label>
							<input type="text" required="required" name="username" value="<?php echo $username; ?>">
						</div>
						<div class="input-group">
							<label>Contact number</label>
							<input type="text" required="required" name="contact" value="<?php echo $contact; ?>">
						</div>
						<div class="input-group">
							<label>Email</label>
							<input type="email" required="required" name="email" value="<?php echo $email; ?>">
						</div>
						<label>Select Type</label>
						<select name="type" id="type" class="form-control">
							<option value="user">User</option>  
							<option value="admin">Administrator</option>
						</select>
						<br>
					</div>
					<div class="modal-footer">
						<input type="submit" name="insertdata" class="btn btn-primary" id="insert" value="Save" onclick="ValidateForm">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</form>

				</div>
			</div>
		</div>


<!-- ##################################################################################################################-->

<!--THIS IS MY EDIT MODAL-->
<div class="modal fade" role = "dialog" id="editmodal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Edit User</h5>
					</div>
					<form action="add_user_function.php" method="POST" id="personID">
					<div class="modal-body">

						<input type="hidden" name="updateid" id="updateid">

						<div class="input-group">
							<label>Last name</label>
							<input type="text" id="lastname" name="lastname" >
						</div>
						<div class="input-group">
							<label>First name</label>
							<input type="text" id="firstname" name="firstname" >
						</div>
						<div class="input-group">
							<label>Username</label>
							<input type="text" id="username"name="username">
						</div>
						<div class="input-group">
							<label>Contact number</label>
							<input type="text" id="contact" name="contact">
						</div>
						<div class="input-group">
							<label>Email</label>
							<input type="email" id="email" name="email" >
						</div>
						<label>Select Type</label>
						<select name="type" id="type" class="form-control">
							<option value="user">User</option>  
							<option value="admin">Administrator</option>
						</select>
						<div class="input-group">
							<label>Password</label>
							<input type="password" name="password">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" name="updatedata" class="btn btn-primary" value="UPDATE">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</form>

				</div>
			</div>
		</div>

<!-- ##################################################################################################################-->

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
			$('#editmodal').modal('show');

			$tr = $(this).closest('tr');

			var data = $tr.children("td").map(function(){
				return $(this).text();
			}).get();

			console.log(data);
			$('#updateid').val(data[0]);
			$('#lastname').val(data[1]);
			$('#firstname').val(data[2]);
			$('#contact').val(data[3]);
			$('#email').val(data[4]);
			$('#username').val(data[5]);
			$('#type').val(data[6]);

		});

	})
</script>
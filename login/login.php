<?php
	require "../config/config.php";

	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		// User is logged in.
		header('Location: ../electro_db/index.php');
	} else {
		if ( isset($_POST['username']) && isset($_POST['password']) ) {
			// The form was submitted.
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
			if ( $mysqli->connect_errno ) {
					echo $mysqli->connect_error;
					exit();
			}

			$username = $_POST['username'];
			$password = hash('sha256', $_POST['password']);

			$sql = "SELECT *
					FROM users
					WHERE username = '$username'
					AND password = '$password';";

			$results = $mysqli->query($sql);
			

			if ( !$results ) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
			
			$mysqli->close();

			if ( $results->num_rows == 1 ) {
				// Valid credentials.
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $_POST['username'];

				$row = $results->fetch_assoc();
				if($row['admin_num'] != 0){
					$_SESSION['admin'] = true;
					header('Location: ../electro_db/admin_listing.php');
				}else{
					header('Location: ../electro_db/index.php');
				}


			} else {
				// Invalid credentials.
				$error = "Invalid credentials.";

			}

		}

	}


	//3 admin users (pre setted)
	// 1. username: admin1; password: admin1
	// 2. username: admin2; password: admin2
	// 3. username: admin3; password: admin3
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Electronics Products Listing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>

		body{
			margin-top: 10%;
			margin-left: 5%;
			margin-right: 5%;
			background-color: #242582; 
			font-family: "KanitLight";
		}
		img{
			width: 98%;
		}

		label, button, p{
			font-family: "KanitLight";
		}

  </style>
</head>
<body>
	<?php include 'navigation_login_version.php'; ?>
	<div class="card mb-3 text-center text-lg-start bg-dark">
		<div class="row g-0 d-flex align-items-center">
			<div class="col-4">
				<img src="../electro_db/img/laptop.png" alt="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.photographytalk.com%2Fbest-laptop-for-photo-editing&psig=AOvVaw06oNkgi_OuxjxjPxpap4ra&ust=1670314070802000&source=images&cd=vfe&ved=0CA8QjRxqFwoTCMCN1fiC4vsCFQAAAAAdAAAAABAE">
		    </div>
		    <div class="col-8">
		    	<div class="card-body py-5 px-md-5">
		    		<form action="login.php" method="POST">
		    			<div class="form-outline mb-4">
		    				<label for="username-id" class="form-label float-left text-white">Username</label>
		    				<input type="text" class="form-control" id="username-id" name="username">
		    			</div>

		    			<div class="form-outline mb-4">
		    				<label for="password-id" class="form-label float-left text-white">Password</label>
							<input type="password" class="form-control" id="password-id" name="password">
		    			</div>

		    			<p class="mb-5 pb-lg-2 float-left text-white">New user? <a class="text-white-50" href="signup.php">Signup Here!</a></p>

              			<button class="btn btn-secondary btn-block mb-4" type="submit">Login</button>
		    		</form>
		    	</div>
		    </div>
		</div>
	</div> 
	<footer>
		<div class="footer-copyright text-center py-3 mb-5 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>



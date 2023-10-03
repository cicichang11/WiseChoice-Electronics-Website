<?php

require '../config/config.php';

if ( !isset($_POST['email']) || trim($_POST['email'] == '')
	|| !isset($_POST['username']) || trim($_POST['username'] == '')
	|| !isset($_POST['password']) || trim($_POST['password'] == '') ) {
	$error = "Please fill out all required fields.";
} else {
	// All required fields present.
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
	}

	$email = $mysqli->escape_string($_POST['email']);
	$username = $mysqli->escape_string($_POST['username']);
	$password = $mysqli->escape_string($_POST['password']);

	$password = hash('sha256', $password);

	$sql_registered = "SELECT * 
						FROM users
						WHERE username = '$username'
						OR email = '$email';";

	$results_registered = $mysqli->query($sql_registered);

	if ( !$results_registered ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	if ($results_registered->num_rows > 0) {
		$error = "Username or email already registered.";
	} else {
		$sql = "INSERT INTO users (username, email, password)
			VALUES ('$username','$email','$password');";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}
	}

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup Confirmation | Electronics Products Listing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			margin-top: 10%;
			margin-left: 5%;
			margin-right: 5%;
			background-color: #242582; 
		}
		img{
			width: 95%;
		}

		label, button, p, a, span{
			font-family: "KanitLight";
		}
	</style>
</head>
<body>
	<?php include 'navigation_login_version.php'; ?>
	<div class="card mb-3 text-center text-lg-start bg-dark">
		<div class="row g-0 d-flex align-items-center">
			<div class="col-lg-4 d-none d-lg-flex">
				<img src="../electro_db/img/laptop.png" alt="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.photographytalk.com%2Fbest-laptop-for-photo-editing&psig=AOvVaw06oNkgi_OuxjxjPxpap4ra&ust=1670314070802000&source=images&cd=vfe&ved=0CA8QjRxqFwoTCMCN1fiC4vsCFQAAAAAdAAAAABAE">
		    </div>
		    <div class="col-lg-8">
		    	<div class="card-body py-5 px-md-5">
		    		
					<div class="row">
						<h1 class="col-12 mt-4 text-white">User Signed Up</h1>
					</div> <!-- .row -->


					<div class="row mt-4">
						<div class="col-12">
							<?php if ( isset($error) && trim($error) != '' ) : ?>
								<div class="text-primary"><?php echo $error; ?></div>
							<?php else : ?>
								<div class="text-white-50"><?php echo $username; ?> was successfully signed up.</div>
							<?php endif; ?>
						</div> <!-- .col -->
					</div> <!-- .row -->


					<div class="row mt-4 mb-4">
						<div class="col-12">
							<a href="login.php" role="button" class="btn btn-light">Login</a>
							<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-secondary">Back</a>
						</div> <!-- .col -->
					</div> <!-- .row -->
		    	</div>
		    </div>
		</div>
	</div>

	<footer>
		<div class="footer-copyright text-center py-3 mb-5 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
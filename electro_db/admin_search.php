<?php
	require '../config/config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// connection errors
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Search | WiseChoice Electronics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			background-color: #242582;
		}
		
		form{
			font-size: 1.1em;
		}

	</style>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-5 text-white text-center">Admin Search</h1>
		</div> <!-- .row -->
		<form action="admin_listing.php" method="GET">
			<div class="form-group row">
				<label for="keyword-id" class="col-sm-12 col-form-label text-center text-white">Product name:</label>
				<div class="col-sm-7 mx-auto mb-1">
					<input type="text" class="form-control" id="keyword-id" name="name_keyword">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-12 mt-2 mt-4 mb-5 text-center">
					<button type="submit" class="btn btn-primary">Find</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div>

	<footer>
		<div class="footer-copyright text-center my-3 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
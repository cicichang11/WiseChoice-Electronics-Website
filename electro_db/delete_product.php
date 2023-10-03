<?php
	require '../config/config.php';

	if ( !isset($_GET['product_id']) || trim($_GET['product_id']) == ''
		|| !isset($_GET['product_name']) || trim($_GET['product_name']) == ''
	) {
		$error = "Couldn't find the product.";
	}else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$product_id = $_GET['product_id'];

		$sql = "DELETE
				FROM electronics_prodcuts
				WHERE id = $product_id;";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete Product | WiseChoice Electronic</title>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
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
		<div class="card mx-auto mt-5" style="width: 18rem;">
		  	<div class="card-body">
		    	<h5 class="card-title">Product Deletion Confirmation</h5>
		    	<div class="card-text">
		    		<?php if ( isset($error) && trim($error) != '' ) :  ?>
		    			<div class="text-danger">
		    				<?php echo $error; ?>
		    			</div>
		    		<?php else : ?>
		    			<div class="text-primary">
		    				<span class="font-italic"><?php echo $_GET['product_name']; ?></span> was successfully deleted.
		    			</div>
		    		<?php endif; ?>
		    	</div>
		    	<a href="admin_listing.php" role="button" class="btn btn-warning mt-5">Go Back to Product Listing</a>
		  	</div>
		</div> <!-- .card -->
	</div>

	<footer>
		<div class="footer-copyright text-center mt-5 mb-2 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>


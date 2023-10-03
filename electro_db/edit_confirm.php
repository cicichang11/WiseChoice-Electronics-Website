<?php
	require '../config/config.php';
	// Check for required data.
	if (!isset($_POST['product_name']) || trim($_POST['product_name']) == ''
		||!isset($_POST['price']) || trim($_POST['price']) == ''
		|| !isset($_POST['condition']) || trim($_POST['condition']) == ''
		|| !isset($_POST['sale']) || trim($_POST['sale']) == ''
		|| !isset($_POST['shipping']) || trim($_POST['shipping']) == ''
	) {
		$error = "Please fill out all the fields.";
	} else {
		// DB Connection.
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$product_name = $_POST['product_name'];
		$product_id = $_POST['product_id'];
		$price = $_POST['price'];
		$condition = $_POST['condition'];
		$sale = $_POST['sale'];
		$shipping = $_POST['shipping'];


		$sql = "UPDATE electronics_prodcuts
				SET name = '$product_name',
					price = '$price',
					condition_id = $condition,
					sale_id = $sale,
					shipping_id = $shipping
				WHERE id = $product_id;";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		// Close MySQL Connection
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confrim | WiseChoice Electronic</title>
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
		    	<h5 class="card-title">Product Editing Confirmation</h5>
		    	<div class="card-text">
		    		<?php if ( isset($error) && trim($error) != '' ) :  ?>
		    			<div class="text-danger">
		    				<?php echo $error; ?>
		    			</div>
		    		<?php else : ?>
		    			<div class="text-primary"><span class="font-italic"><?php echo $product_name; ?></span> was successfully edited.</div>
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
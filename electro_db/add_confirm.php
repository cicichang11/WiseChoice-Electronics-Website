<?php
	require '../config/config.php';

	if ( !isset($_POST['product_name']) || trim($_POST['product_name']) == ''
		|| !isset($_POST['price']) || trim($_POST['price']) == ''
		|| !isset($_POST['condition_id']) || trim($_POST['condition_id']) == ''
		|| !isset($_POST['brand_id']) || trim($_POST['brand_id']) == ''
		|| !isset($_POST['sale_id']) || trim($_POST['sale_id']) == ''
		|| !isset($_POST['weight']) || trim($_POST['weight']) == ''
		|| !isset($_POST['shipping_id']) || trim($_POST['shipping_id']) == ''
		|| empty($_FILES["file_name"])
		|| !isset($_POST['image_urls']) || trim($_POST['image_urls']) == ''
	) {
		$error = "Please fill out all required fields and upload the image.";
	} else if ($_FILES['file_name']['error'] > 0) {
		$error = "File upload error # " . $_FILES['file_name']['error'];
	} else{
		// DB Connection.
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$name = $_POST['product_name'];
		$price = $_POST['price'];
		$condition_id = $_POST['condition_id'];
		$brand_id = $_POST['brand_id'];
		$sale_id = $_POST['sale_id'];
		$weight = $_POST['weight'];
		$weight .= " pounds";
		$shipping_id = $_POST['shipping_id'];

		$source = $_FILES['file_name']['tmp_name'];
		$destination = "uploads/" . uniqid() . $_FILES['file_name']["name"];
		$destination = preg_replace('/\s/', '_', $destination);
		move_uploaded_file($source, $destination);

		$image_urls = $_POST['image_urls'];
		

		$sql = "INSERT INTO electronics_prodcuts (name, price, condition_id, brand_id, sale_id, weight, shipping_id, imageURLs)
				VALUES ('$name', $price, $condition_id, $brand_id, $sale_id, '$weight', $shipping_id, '$image_urls');";

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
	<title>Product Posting Confirm | WiseChoice Electronic</title>
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
		    	<h5 class="card-title">Post Product Confirmation</h5>
		    	<div class="card-text">
		    		<?php if ( isset($error) && trim($error) != '' ) :  ?>
		    			<div class="text-danger">
		    				<?php echo $error; ?>
		    			</div>
		    		<?php else : ?>
		    			<div class="text-primary">
		    				<span class="font-italic"><?php echo $_POST['product_name']; ?></span> was successfully added.
		    			</div>
		    		<?php endif; ?>
		    	</div>
		    	<a href="admin_listing.php" role="button" class="btn btn-warning mt-5">Go Back to Product Database</a>
		    	<a href="admin_listing.php" role="button" class="btn btn-warning mt-1">Go Back to Add a Procut Page</a>
		  	</div>
		</div> <!-- .card -->
	</div>

	<footer>
		<div class="footer-copyright text-center py-3 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
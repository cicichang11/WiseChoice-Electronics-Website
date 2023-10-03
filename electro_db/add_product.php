<?php
	require "../config/config.php";
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// sales
	$sql_sales = "SELECT * FROM sales;";
	$results_sales = $mysqli->query($sql_sales);
	if ( $results_sales == false ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// shipping
	$sql_shipping = "SELECT * FROM shipping;";
	$results_shipping = $mysqli->query($sql_shipping);
	if ( $results_shipping == false ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// conditions
	$sql_conditions = "SELECT * FROM conditions;";
	$results_conditions = $mysqli->query($sql_conditions);
	if ( $results_conditions == false ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// brands
	$sql_brands = "SELECT * FROM brands;";
	$results_brands = $mysqli->query($sql_brands);
	if ( $results_brands == false ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}


	// Close DB Connection
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post New Product | WiseChoice Electronic</title>
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
			<h1 class="col-12 mt-5 text-white text-center">Post A New Product</h1>
		</div> <!-- .row -->

		<div class="row">
			<h5 class="col-12 mt-1 mb-5 text-warning text-center">New Products Coming... Excited!!</h5>
		</div> <!-- .row -->

		<form action="add_confirm.php" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-6">
					<!-- product name -->
					<div class="form-group row">
						<label for="name-id" class="col-sm-12 col-form-label text-center text-white">
							Product Name <span class="text-warning">*</span>
						</label>
						<div class="col-sm-12 mx-auto mb-1">
							<input type="text" class="form-control" id="name-id" name="product_name">
						</div>
					</div> <!-- .form-group -->
				</div>
				<div class="col-6">
					<!-- price -->
					<div class="form-group row">
						<label for="price" class="col-sm-12 col-form-label text-center text-white">
							Price <span class="text-warning">*</span>
						</label>
						<div class="col-sm-12 mx-auto mb-1">
							<input type="number" step=0.01 name="price" min="0" max="10000000" id="price" class="form-control">
						</div>
					</div> <!-- .form-group -->
				</div>
			</div>


			<div class="row">
				<div class="col-6">
					<!-- condition -->
					<div class="form-group row">
						<label for="condition-id" class="col-sm-12 col-form-label text-center text-white">
							Condition <span class="text-warning">*</span>
						</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="condition_id" id="condition-id" multiple class="form-control">
								<option value="" selected disabled>Please Pick One</option>
								<?php while( $row = $results_conditions->fetch_assoc() ): ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['con']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
					</div> <!-- .form-group -->
				</div>
				<div class="col-6">
					<!-- brand -->
					<div class="form-group row">
						<label for="brand-id" class="col-sm-12 col-form-label text-center text-white">
							Brand <span class="text-warning">*</span>
						</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="brand_id" id="brand-id" class="form-control">
								<option value="" selected disabled>Please Pick One </option>
								<?php while( $row = $results_brands->fetch_assoc() ): ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['brand']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
					</div> <!-- .form-group -->
				</div>
			</div>


			<div class="row">
				<div class="col-6">
					<!-- in stock -->
					<div class="form-group row">
						<label for="sale_id" class="col-sm-12 col-form-label text-center text-white">In Stock:</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="sale_id" id="sale_id" class="form-control">
								<option value="" selected disabled>Unknown </option>
								<?php while( $row = $results_sales->fetch_assoc() ): ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['sale']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
					</div> <!-- .form-group -->
				</div>
				<div class="col-6">
					<!-- weight -->
					<div class="form-group row">
						<label for="weight" class="col-sm-12 col-form-label text-center text-white">
							Weight <span class="text-warning">*</span>
						</label>
						<div class="col-sm-10 ml-auto mb-1">
							<input type="text" class="form-control" id="weight" name="weight">
						</div>
						<div class="col-sm-2 mr-auto mb-1 text-white"><label>pounds</label></div>
					</div> <!-- .form-group -->
				</div>
			</div>

			<div class="form-group row">
				<label for="shipping-id" class="col-sm-12 col-form-label text-center text-white">
					Shipping Method <span class="text-warning">*</span>
				</label>
				<div class="col-sm-7 mx-auto mb-1">
					<select name="shipping_id" id="shipping-id" multiple class="form-control">
						<option value="" selected disabled>Please Pick One</option>
						<?php while( $row = $results_shipping->fetch_assoc() ): ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['shipping_method']; ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->


			<div class="form-group row">
				<label for="file-id" class="col-sm-12 col-form-label text-center text-white">
					Product Image <span class="text-warning">*</span></label>
				<div class="col-sm-7 mx-auto mb-1">
					<input type="file" class="form-control" id="file-id" name="file_name">
				</div>
			</div> <!-- .form-group -->

			<!-- image url -->
			<div class="form-group row">
				<label for="url-id" class="col-sm-12 col-form-label text-center text-white">
					Image URLs (just in case we need to fetch it online) <span class="text-warning">*</span>
				</label>
				<div class="col-sm-7 mx-auto mb-1">
					<input type="text" class="form-control" id="url-id" name="image_urls" placeholder="https://">
				</div>
			</div> <!-- .form-group -->


			
			<div class="form-group row mt-1">
				<div class="csol-sm-9 mx-auto">
					<span class="text-warning font-italic">* Required</span>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-12 mt-2 mt-4 mb-5 text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->

		</form>

	</div><!-- .container -->

	<footer>
		<div class="footer-copyright text-center my-3 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
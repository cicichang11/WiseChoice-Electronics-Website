<?php
	require "../config/config.php";
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// product info:
	$product_id = $_GET['product_id'];
	$sql_product = "SELECT * 
	     			FROM electronics_prodcuts
	                WHERE id = $product_id;";
	$results_product = $mysqli->query($sql_product);
	if ( $results_product == false ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

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

	$row_product = $results_product->fetch_assoc();

	// Close DB Connection
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit a Product | WiseChoice Electronic</title>
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
			<h1 class="col-12 mt-5 mb-5 text-white text-center">Update the Product</h1>
		</div> <!-- .row -->

		<form action="edit_confirm.php" method="POST">

			<input type="hidden" name="product_id" value="<?php echo $row_product['id']; ?>">

			<div class="row">
				<div class="col-6">
					<!-- product name -->
					<div class="form-group row">
						<label for="name_id" class="col-sm-12 col-form-label text-center text-white">Product name:</label>
						<div class="col-sm-12 mx-auto mb-1">
							<input type="text" class="form-control" id="name_id" name="product_name" value="<?php echo $row_product['name']; ?>">
						</div>
					</div> <!-- .form-group -->
				</div>
				<div class="col-6">
					<!-- price -->
					<div class="form-group row">
						<label for="price-id" class="col-sm-12 col-form-label text-center text-white">Price: </label>
						<div class="col-sm-12 mx-auto mb-1">
							<input type="number" name="price" min="0" max="10000000" id="price-id" class="form-control" value="<?php echo $row_product['price']; ?>">
						</div>
					</div> <!-- .form-group -->
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<!-- condition -->
					<div class="form-group row">
						<label for="condition-id" class="col-sm-12 col-form-label text-center text-white">Condition:</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="condition" id="condition-id" multiple class="form-control">
								<?php while( $row = $results_conditions->fetch_assoc() ): ?>
									<?php if ( $row['id'] == $row_product['condition_id'] ) : ?>
										<option value="<?php echo $row['id']; ?>" selected>
											<?php echo $row['con']; ?>
										</option>
									<?php else : ?>
										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['con']; ?>
										</option>
									<?php endif; ?>
								<?php endwhile; ?>
							</select>
						</div>
					</div> <!-- .form-group -->
				</div>
				<div class="col-6">
					<!-- in stock -->
					<div class="form-group row">
						<label for="sale-id" class="col-sm-12 col-form-label text-center text-white">In Stock:</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="sale" id="sale-id" multiple class="form-control">
								<?php while( $row = $results_sales->fetch_assoc() ): ?>
									<?php if ( $row['id'] == $row_product['sale_id'] ) : ?>
										<option value="<?php echo $row['id']; ?>" selected>
											<?php echo $row['sale']; ?>
										</option>
									<?php else : ?>
										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['sale']; ?>
										</option>
									<?php endif; ?>
								<?php endwhile; ?>
							</select>
						</div>
					</div> <!-- .form-group -->
				</div>
			</div>

		

			<!-- shipping -->
			<div class="form-group row">
				<label for="shipping-id" class="col-sm-12 col-form-label text-center text-white">Shipping:</label>
				<div class="col-sm-7 mx-auto mb-1">
					<select name="shipping" id="shipping-id" multiple class="form-control">
						<?php while( $row = $results_shipping->fetch_assoc() ): ?>
							<?php if ( $row['id'] == $row_product['shipping_id'] ) : ?>
								<option value="<?php echo $row['id']; ?>" selected>
									<?php echo $row['shipping_method']; ?>
								</option>
							<?php else : ?>
								<option value="<?php echo $row['id']; ?>">
									<?php echo $row['shipping_method']; ?>
								</option>
							<?php endif; ?>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-12 mt-2 my-5 text-center">
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
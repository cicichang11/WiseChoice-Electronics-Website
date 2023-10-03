<?php
	require '../config/config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// connection errors
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql_brand = "SELECT * FROM brands;";
	$results_brand = $mysqli->query( $sql_brand );
	// SQL errors
	if ( !$results_brand ) {
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

	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Preference Filter | WiseChoice Electronics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			background-color: #242582;
		}
		
		form{
			font-size: 1.2em;
		}

	</style>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 text-center text-white"><strong>Preference Filter</strong></h1>
		</div> <!-- .row -->

		<div class="row">
			<div class="col-3">
				<div class="card mt-5 text-dark bg-warning mb-3">
				  	<div class="card-header">
				    	WiseChoice Electronics
				  	</div>
				  	<div class="card-body">
				   		<blockquote class="blockquote mb-0">
				      		<p>Please take advantage of this filter to personalize your search.</p>
				      		<small>We are dedicated to provide you a great experience.</small>
				    	</blockquote>
				  	</div>
				</div>
			</div> <!-- .col-4 -->

			<div class="col-9">
				<form action="listing.php" method="GET">

					<div class="form-group row mt-5">
						<label for="name_id" class="col-sm-12 col-form-label text-center text-white">Product name</label>
						<div class="col-sm-12 mx-auto mb-1">
							<input type="text" class="form-control" id="name_id" name="product_name">
						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="brand_id" class="col-sm-12 col-form-label text-center text-white">Any Specific Brand?</label>
						<div class="col-sm-12 mx-auto mb-1">
							<select name="brand_id" id="brand_id" class="form-control">
								<option value="" selected> No Prefrence </option>
								<?php while ( $row = $results_brand->fetch_assoc() ) : ?>
									<option value="<?php echo $row['id']; ?>">
										<?php echo $row['brand']; ?>
									</option>
								<?php endwhile; ?>

							</select>
						</div>
					</div> <!-- .form-group -->

					<div class="row">
						<div class="col-6">
							<div class="form-group row">
								<label for="conditions_id" class="col-sm-12 col-form-label text-center text-white">Products' conditions:</label>
								<div class="col-sm-12 mx-auto mb-1">
									<select name="conditions_id" id="conditions_id" multiple class="form-control">
										<?php while( $row = $results_conditions->fetch_assoc() ): ?>
											<option value="<?php echo $row['id']; ?>">
												<?php echo $row['con']; ?>
											</option>
										<?php endwhile; ?>
									</select>
								</div>
							</div><!-- .form-group -->
						</div><!-- .col-6 -->
						<div class="col-6">
							<div class="row mb-5">
					           	<label for="price" class="col-12 col-form-label mt-3 text-center text-white"><strong>Maximum acceptable price:</strong></label>
						        <div class="col-12 text-center text-white">
						        	<?php if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) : ?>
						        		<input type="number" name="price" id="price" min="0" max="100000000">
						        	<?php else : ?>
						        		Please <a href="../login/login.php" class="text-warning">login</a> to set preferences for prices.
						        	<?php endif; ?>
						        </div>
							</div>
						</div><!-- .col-6 -->
					</div>


					<div class="form-group row">
						<div class="col-12 mt-4 mb-5 text-center">
							<button type="submit" class="btn btn-primary">Search</button>
							<button type="reset" class="btn btn-light">Reset</button>
						</div>
					</div> <!-- .form-group -->
				</form>
			</div><!-- .col-8 -->
		</div><!-- .row -->


		
		
	</div> <!-- .container -->

	<footer>
		<div class="footer-copyright text-center mt-5 mb-2 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>

</body>
</html>

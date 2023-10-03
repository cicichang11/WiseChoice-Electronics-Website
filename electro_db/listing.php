<?php
	require '../config/config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// Retrieve results from the DB.
	$sql = "SELECT electronics_prodcuts.id AS product_id, electronics_prodcuts.imageURLs, electronics_prodcuts.name AS product, electronics_prodcuts.price AS price, conditions.con AS conditions, brands.brand AS brand, sales.sale AS sale, electronics_prodcuts.weight AS weight, shipping.shipping_method AS shipping
	        FROM electronics_prodcuts
            LEFT JOIN conditions
	            ON electronics_prodcuts.condition_id = conditions.id
            LEFT JOIN brands
	            ON electronics_prodcuts.brand_id = brands.id
            LEFT JOIN sales
	            ON electronics_prodcuts.sale_id = sales.id
            LEFT JOIN shipping
	            ON electronics_prodcuts.shipping_id = shipping.id
			WHERE 1 = 1";

	if ( isset($_GET['product_name']) && trim($_GET['product_name']) != '' ) {
		$product_name = $mysqli->escape_string( $_GET['product_name'] );
		$sql = $sql . " AND electronics_prodcuts.name LIKE '%$product_name%'";
	}

	if ( isset( $_GET['brand_id'] ) && trim( $_GET['brand_id'] ) != '' ) {
		$brand_id = $_GET['brand_id'];
		$sql = $sql . " AND electronics_prodcuts.brand_id = $brand_id";
	}

	if ( isset( $_GET['conditions_id'] ) && trim( $_GET['conditions_id'] ) != '' ) {
		$conditions_id = $_GET['conditions_id'];
		$sql = $sql . " AND electronics_prodcuts.condition_id = $conditions_id";
	}

	if ( isset( $_GET['price'] ) && trim( $_GET['price'] ) != '' ) {
		$price = $_GET['price'];
		$sql = $sql . " AND electronics_prodcuts.price <= $price";
	}

	$sql = $sql . ";";

	// echo "<hr>$sql<hr>";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// pagination
	$total_results = $results->num_rows;
	$results_per_page = 20;
	$last_page = ceil($total_results / $results_per_page);

	if ( isset($_GET['page']) && trim($_GET['page']) != '' ) {
		$current_page = $_GET['page'];
	} else {
		$current_page = 1;
	}

	if ($current_page < 1 || $current_page > $last_page) {
		$current_page = 1;
	}

	$start_index = ($current_page - 1) * $results_per_page;

	$sql = rtrim($sql, ';');

	$sql = $sql . " LIMIT $start_index, $results_per_page";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products Listing | WiseChoice Electronic</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			background-color: #242582;
		}
	</style>
</head>
<body>
	<?php include 'navigation.php'; ?>
	<div class="container mb-5">
		<div class="row">
			<h1 class="col-12 mt-5 text-white text-center">Products Meet Your Preferences</h1>
		</div> <!-- .row -->
		<div class="row">
			<!-- counting results -->
			<div class="col-12 mt-5 text-white">
				<?php if ( $total_results == 0 ) : ?>
					There a total of 0 results.
				<?php else : ?>
					There are a total of 
					<?php echo $total_results; ?> 
					result(s),     
					<?php echo $start_index + 1; ?>
					-
					<?php echo $start_index + $results->num_rows; ?>
					of them are showing on this page.
				<?php endif; ?>
			</div> <!-- counting results-->

			<div class="col-12">
				<div class="row">
					<?php while ( $row = $results->fetch_assoc() ) : ?>
						<div class="card col-3 mt-3 bg-light">
							<img class="card-img-top w-50 mx-auto mt-3" src="<?php echo $row['imageURLs']; ?>" alt="img/laptop.png">
							<div class="card-body">
								<h5 class="card-title">
									<a href="detail_image.php?product_id=<?php echo urlencode($row['product_id']); ?>" class="card-link text-dark">
										<?php echo $row['product']; ?>
									</a>
								</h5>
								<?php if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) : ?>
									<p class="card-text text-primary">$<?php echo $row['price']; ?></p>
								<?php else : ?>
									<p><a class="text-primary" href="../login/login.php">Login</a> to view price</p>
								<?php endif; ?>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Shipping: <?php echo $row['shipping']; ?></li>
								<li class="list-group-item">Brand: <?php echo $row['brand']; ?></li>
								<li class="list-group-item">Condition: <?php echo $row['conditions']; ?></li>
								<li class="list-group-item">Weight: <?php echo $row['weight']; ?></li>
								<li class="list-group-item">Available: <?php echo $row['sale']; ?></li>
							</ul>
							<div class="card-body">
								<a href="detail_image.php?product_id=<?php echo $row['product_id']; ?>" class="card-link">View Details</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>


			<div class="col-12 mt-5">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end">
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = 1;
								echo urlencode($_SERVER['PHP_SELF']) . '?' . http_build_query($_GET);
							?>">First</a>
						</li>
						<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page - 1;
								echo urlencode($_SERVER['PHP_SELF']) . '?' . http_build_query($_GET);
							?>"><?php echo $current_page-1; ?></a>
						</li>
						<li class="page-item active">
							<a class="page-link" href=""><?php echo $current_page; ?></a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $current_page + 1;
								echo urlencode($_SERVER['PHP_SELF']) . '?' . http_build_query($_GET);
							?>"><?php echo $current_page+1; ?></a>
						</li>
						<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
							<a class="page-link" href="<?php
								$_GET['page'] = $last_page;
								echo urlencode($_SERVER['PHP_SELF']) . '?' . http_build_query($_GET);
							?>">Last</a>
						</li>
					</ul>
				</nav>
			</div> <!-- .col -->
		</div><!-- .row -->
	</div> <!-- .container -->

	<footer>
		<div class="footer-copyright text-center py-3 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>

</body>
</html>



<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electronics Products In-Stock Listing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
</head>
<body>

	<?php include 'navigation.php'; ?>

	<div id="header" class="text-center">
		<h1>WiseChoice Electronics</h1>
	</div> <!-- #header -->

	<div id="wrapper" class="container mb-5">
		<div class="row">
			<div id="intro" class="col-9 pt-5 mx-auto">
				<p>
					This product listing website enables the eCommerce retail company WiseChoice to display its products online according to different specifications of products such as brand, condition, size & price. The product listing makes the process of online shopping easy and convenient for every customer. Moreover, it helps the owner to increase their sale online.
				</p> <!-- #intro -->
			</div> <!-- #content -->
		</div> <!-- .row-->

		<div class="row">
			<div class="col-8 mx-auto">
				<h4 class="text-primary font-weight-bold mt-5 text-center">you will be able to search for details of products from following brands and more:</h4>
			</div> 
		</div><!-- .row-->

		<div class="row pt-5">
			<img src="img/apple_logo.png" class="col-3" alt="https://www.freepnglogos.com/uploads/apple-logo-png/apple-logo-png-dallas-shootings-don-add-are-speech-zones-used-4.png">
			<img src="img/micro_logo.png" class="col-3" alt="https://logos-world.net/wp-content/uploads/2020/09/Microsoft-Logo.png">
			<img src="img/lenovo_logo.png" class="col-3" alt="https://logodownload.org/wp-content/uploads/2014/09/lenovo-logo-1-1.png">
			<img src="img/bose_logo.png" class="col-3" alt="https://www.freepnglogos.com/uploads/bose-png-logo/bose-new-png-logo-4.png">
		</div>

		<div class="row">
			<div class="col-8 mx-auto mt-5">
				<h4 class="text-primary font-weight-bold mt-5 text-center">Check out the products we have in stock...</h4>
			</div> 

			<table class="table mt-3">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Product Name</th>
						<th scope="col">Brand</th>
						<th scope="col">Condion</th>
						<!-- <th scope="col"></th> -->
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Sanus VLF410B1 10-Inch Super Slim Full-Motion Mount for 37 - 84 Inches TV''s</td>
						<td>Sanus</td>
						<td>New</td>
						<!-- <td>
							<button class="btn btn-outline-primary" onclick="showAlert()">Details</button>
						</td> -->
					</tr>
				</tbody>
			</table>
		</div><!-- .row-->

		<?php if ( isset($_SESSION['admin']) ) : ?>
			<a class="row" href="admin_listing.php">
				<button class="btn btn-primary col-6 mx-auto mt-3 mb-1 text-decoration-none">Products Database Management - Admin Access</button>
			</a>
		<?php else : ?>
			<a href="filter.php" class="row btn btn-primary col-6 mt-3 mb-1 text-decoration-none">Search for More Products</a>
		<?php endif; ?>
 
		<div class="row">
			<p class="text-warning mb-5">(ADMINS: please log in to manage the product database)</p>
		</div>
	</div><!-- #wrapper -->

	<footer>
		<div class="footer-copyright text-center py-3">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
	
</body>
</html>

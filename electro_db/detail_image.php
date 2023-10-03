<?php

	require '../config/config.php';

	if ( !isset($_GET['product_id']) || trim($_GET['product_id']) == '') {
		$error = "No Produts Found";
	}	else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$product_id = $_GET['product_id'];

		$sql = "SELECT imageURLs, name AS product
				FROM electronics_prodcuts
				WHERE id = $product_id;";

		$results = $mysqli->query($sql);

		if ( !$results ) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$row = $results->fetch_assoc();

		$mysqli->close();
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products Details | WiseChoice Electronic</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			background-color: #242582;
		}

		#detail_image{
			margin-top: 25px;
		}

		.zoom_lens {
			position: absolute;

		  	width: 52px;
		  	height: 52px;

		  	border: 2px solid #FFF;
		}

		.zoom_in {
			position: relative;

		  	width: 350px;
		  	height: 350px;

		  	border: 1px solid #FFF;
		}
	</style>
	
	<!-- reference source: https://www.w3schools.com/howto/howto_js_image_zoom.asp -->
	<script>
		function zoomIn(rawImg, zoomInImg) {
			var img, lens, move_x, move_y, zoom;
			img = document.getElementById(rawImg);
		  	zoom = document.getElementById(zoomInImg);
			
			lens = document.createElement("div");
			lens.setAttribute("class", "zoom_lens");
			
			img.parentElement.insertBefore(lens, img);
		
			move_x = zoom.offsetWidth / lens.offsetWidth;
			move_y = zoom.offsetHeight / lens.offsetHeight;
		
			zoom.style.backgroundImage = "url('" + img.src + "')";
			zoom.style.backgroundSize = (img.width * move_x) + "px " + (img.height * move_y) + "px";
		
			lens.addEventListener("mousemove", lens_movement);
			img.addEventListener("mousemove", lens_movement);
			
			lens.addEventListener("touchmove", lens_movement);
			img.addEventListener("touchmove", lens_movement);

			function lens_movement(i) {
				var pos, x, y;
			   
			    i.preventDefault();
			    
			    pos = cursorP(i);
			    
			    x = pos.x - (lens.offsetWidth / 2);
			    y = pos.y - (lens.offsetHeight / 2);
			    
			    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
			    if (x < 0) {x = 0;}
			    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
			    if (y < 0) {y = 0;}
			   
			    lens.style.left = x + "px";
			    lens.style.top = y + "px";
			    
			    zoom.style.backgroundPosition = "-" + (x * move_x) + "px -" + (y * move_y) + "px";
	  		}
		    
		    function cursorP(i) {
			    var a, x = 0, y = 0;
			    i = i || window.event;
			   
			    a = img.getBoundingClientRect();
			   
			    x = i.pageX - a.left;
			    y = i.pageY - a.top;
			    
			    x = x - window.pageXOffset;
			    y = y - window.pageYOffset;
			    return {x : x, y : y};
			}
		}
	</script>
</head>
<body>
	<?php include 'navigation.php'; ?>
	
	<div class="container my-5">
		<?php if ( isset($error) && trim($error) != '' ) : ?>

			<div class="text-warning text-center mt-5">
				<?php echo $error; ?>
			</div>

		<?php else : ?>
			<div id="details" class="row mt-5">
				<h2 class="col-6 mt-5 text-white text-center"><?php echo $row['product']; ?></h2>
				<div class="col-6 max-auto">
					<img id="detail_image" class="w-75 ml-5" src="<?php echo $row['imageURLs']; ?>" alt="img/laptop.png">
				</div>
			</div> <!-- .row -->
			<div class="row">
				<div id="zoom_image" class="zoom_in col-6 mt-3 mx-auto"></div>
			</div>
		<?php endif; ?>
	</div>


	<footer>
		<div class="footer-copyright text-center py-3 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>

	<script>
		zoomIn("detail_image", "zoom_image");
	</script>
</body>
</html>
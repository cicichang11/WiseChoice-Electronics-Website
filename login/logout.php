<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout | WiseChoice Electronics</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		@font-face{
			font-family: "KanitLight";
			src:url("fonts/Kanit-Light.ttf");
		}
		
		body{
			margin-top: 10%;
			margin-left: 5%;
			margin-right: 5%;
			background-color: #242582; 
			font-family: "KanitLight";
		}
		img{
			width: 99%;
		}

		label, button, p, a, span, small{
			font-family: "KanitLight";
		}
	</style>
</head>
<body>
	<?php include 'navigation_login_version.php'; ?>
	<div class="card mb-3 text-center text-lg-start bg-dark">
		<div class="row g-0 d-flex align-items-center">
			<div class="col-4">
				<img src="../electro_db/img/laptop.png" alt="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.photographytalk.com%2Fbest-laptop-for-photo-editing&psig=AOvVaw06oNkgi_OuxjxjPxpap4ra&ust=1670314070802000&source=images&cd=vfe&ved=0CA8QjRxqFwoTCMCN1fiC4vsCFQAAAAAdAAAAABAE">
		    </div>
		    <div class="col-8">
		    	<div class="card-body py-5">
		    		<h1 class="col-12 mt-2 mb-4 text-white">Logout</h1>
		    		<div class="col-12 text-white">You are now logged out.</div>
		    		<div class="col-12 mt-3 text-white">You can go to <a class="text-warning" href="../electro_db"><u>home</u></a> or <a class="text-warning" href="login.php"><u>log in</u></a> again.</div>
		    	</div>
		    </div>
		</div>
	</div> 

	<footer>
		<div class="footer-copyright text-center py-3 mb-5 text-white">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
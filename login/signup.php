<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup | Electronics Products Listing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<style>
		body{
			margin-top: 10%;
			margin-left: 5%;
			margin-right: 5%;
			background-color: #242582; 
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
		    	<div class="card-body py-5 px-md-5">
		    		<form action="signup_confirmation.php" method="POST">
		    			<div class="form-outline mb-4">
		    				<label for="username_id" class="form-label float-left text-white">Username: <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="username_id" name="username">
							<small id="username-error" class="invalid-feedback text-danger float-left">Username is required.</small>
		    			</div>

		    			<div class="form-outline mb-4">
		    				<label for="email_id" class="form-label float-left text-white">Email: <span class="text-danger">*</span></label>
							<input type="email" class="form-control" id="email_id" name="email">
							<small id="email-error" class="invalid-feedback text-danger float-left">Email is required.</small>
		    			</div>

		    			<div class="form-outline mb-4">
		    				<label for="password_id" class="form-label float-left text-white">Password: <span class="text-danger">*</span></label>
							<input type="password" class="form-control" id="password_id" name="password">
							<small id="password-error" class="invalid-feedback text-danger float-left">Password is required.</small>
		    			</div>

		    			<div class="row">
							<span class="text-danger font-italic">* Required</span>
						</div> <!-- .form-group -->

						<div class="row">
							<a id="existAccount" href="login.php" class="text-white-50 font-italic"><u>Already have an account, let me login!</u></a>
						</div> <!-- .form-group -->

						<div class="d-flex justify-content-end pt-3">
							<a href="../electro_db" role="button" class="btn btn-secondary">Cancel</a>
							<button type="submit" class="btn btn-light ms-2">Sign Up</button>
		                </div>

		    		</form>
		    	</div>
		    </div>
		</div>
	</div> 
	<script>
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username_id').value.trim().length == 0 ) {
				document.querySelector('#username_id').classList.add('is-invalid');
			} else {
				document.querySelector('#username_id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email_id').value.trim().length == 0 ) {
				document.querySelector('#email_id').classList.add('is-invalid');
			} else {
				document.querySelector('#email_id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password_id').value.trim().length == 0 ) {
				document.querySelector('#password_id').classList.add('is-invalid');
			} else {
				document.querySelector('#password_id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>

	<footer>
		<div class="footer-copyright text-center py-3 mb-5 text-white ">© ITP303 Final Proejct 2022 Copyright: Cici Chang</div>
	</footer>
</body>
</html>
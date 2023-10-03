<nav class="navbar navbar-expand navbar-expand-lg navbar-light bg-light">
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="index.php">Home</a>
			</li>
			<li class="nav-item active">
				<?php if ( isset($_SESSION['admin']) ) : ?>
					<a class="nav-link" href="admin_search.php">Search</a>
				<?php else : ?>
					<a class="nav-link" href="filter.php">Filter</a>
				<?php endif; ?>
			</li>
			<li class="nav-item active">
				<?php if ( isset($_SESSION['admin']) ) : ?>
					<a class="nav-link" href="admin_listing.php">Database</a>
				<?php else : ?>
					<a class="nav-link" href="listing.php">Listing</a>
				<?php endif; ?>
			</li>
			<li class="nav-item">
				<?php if ( !isset($_SESSION['logged_in']) ) : ?>
					<a class="nav-link" href="../login/login.php">Login</a>
				<?php else : ?>
					<?php if ( !isset($_SESSION['admin']) ) : ?>
						<a class="nav-link" href="#"><?php echo $_SESSION['username']; ?> (user)</a>
					<?php else : ?>
						<a class="nav-link" href="#"><?php echo $_SESSION['username']; ?> (admin)</a>
					<?php endif; ?>
				<?php endif; ?>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="../login/signup.php">Signup</a>
			</li>
			<li class="nav-item">
				<?php if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) : ?>
					<a class="nav-link" href="../login/logout.php">Logout</a>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</nav>
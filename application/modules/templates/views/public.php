<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>Carousel Template · Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url(); ?>assets/frontend/css/bootstrap.css" rel="stylesheet">
	<!-- Custom styles -->
	<link href="<?php echo base_url(); ?>assets/frontend/css/main.css" rel="stylesheet">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand" href="#">Logo</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>
			</ul>
		</nav>
	</header>

	<main role="main">
		<div class="container marketing">
			<?php 
			if(isset($view_file)) {
				$this->load->view($view_module."/".$view_file);
			}

			?>
		</div>

		<!-- FOOTER -->
		<footer class="container">
			<p class="float-right"><a href="#">Back to top</a></p>
			<p>&copy; 2017-2019 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
		</footer>
	</main>
	<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap.bundle.js"></script>
</body>
</html>

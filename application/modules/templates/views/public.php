<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>Bulma</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url(); ?>assets/frontend/css/bulma.css" rel="stylesheet">
	<!-- Font awesome -->
	<link href="<?php echo base_url(); ?>assets/frontend/css/all.css" rel="stylesheet">
</head>
<body>
	<header>

		<nav class="navbar is-danger" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item" href="https://bulma.io">
					<img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
				</a>

				<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
					<span aria-hidden="true"></span>
				</a>
			</div>

			<div id="navbarBasicExample" class="navbar-menu">
				<div class="navbar-start">
					<a class="navbar-item">
						Home
					</a>

					<?php echo Modules::run("store_categories/_draw_top_nav"); ?>
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
							More
						</a>

						<div class="navbar-dropdown">
							<a class="navbar-item">
								About
							</a>
							<a class="navbar-item">
								Jobs
							</a>
							<a class="navbar-item">
								Contact
							</a>
							<hr class="navbar-divider">
							<a class="navbar-item">
								Report an issue
							</a>
						</div>
					</div>
				</div>

				<div class="navbar-end">
					<div class="navbar-item">
						<div class="buttons">
							<a class="button is-primary">
								<strong>Sign up</strong>
							</a>
							<a class="button is-light">
								Log in
							</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<main role="main">
		<div class="container">
			<?php 
			if(isset($webpage)) {
				echo  nl2br($webpage->page_content);
			} elseif(isset($view_file)) {
				$this->load->view($view_module."/".$view_file);
			}
			?>
		</div>

		<footer class="footer">
			<div class="content has-text-centered">
				<p>
					<strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
					<a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
					is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
				</p>
			</div>
		</footer>
	</main>
	<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

			if ($navbarBurgers.length > 0) {

				$navbarBurgers.forEach( el => {
					el.addEventListener('click', () => {

						const target = el.dataset.target;
						const $target = document.getElementById(target);

						el.classList.toggle('is-active');
						$target.classList.toggle('is-active');

					});
				});
			}

		});
	</script>
</body>
</html>

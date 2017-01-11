<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-xs-4">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<a class="navbar-brand" href="#page-top"><img src="img/logo.png" alt="<?= $texts['Header.logo.text']; ?>" id="logo-img" /></a>
				</div>
			</div>
			
			<div class="col-lg-9 col-md-9 col-xs-8">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					<?php include('navbar.php'); ?>
				</div>
				<!-- /.navbar-collapse -->
			</div>
				<!-- /.container-fluid -->
		</div>
	</div>
</nav>
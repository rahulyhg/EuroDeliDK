<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-xs-3">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header page-scroll">
					<a class="navbar-brand" href="http://eurodeli.dk"><?= $texts['Header.logo.text']; ?></a>
				</div>
			</div>
			
			<div class="col-lg-9 col-md-9 col-xs-9">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">	
						<li class="languages-select">
							<a href="order.php?sprog=dk&email=<?php echo $_GET['email']; ?>" class="pull-right">
								<img class="img-responsive img-circle country-flag" src="img/flags/dk.png" alt="">
							</a>
							<a href="order.php?sprog=ru&email=<?php echo $_GET['email']; ?>" class="pull-right">
								<img class="img-responsive img-circle country-flag" src="img/flags/ru.png" alt="">
							</a>
							<a href="order.php?sprog=en&email=<?php echo $_GET['email']; ?>" class="pull-right">
								<img class="img-responsive img-circle country-flag" src="img/flags/en.png" alt="">
							</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
				<!-- /.container-fluid -->
		</div>
	</div>
</nav>
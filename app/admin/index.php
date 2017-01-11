<?php 
include('Database.php');
logIt('In loging screen');
if (isSet($_SESSION['logged'])) {
	header("Location: " . $web_root . "/cms.php");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('includes/head.php'); 
	?>
	<link rel="stylesheet" href="css/sign-in.css">
  </head>

  <body>
  	<?php include('includes/header.php'); 
  	?>
  	<div class="site-wrapper login-screen">
		<div class="container">
			<div class="raw">
				<div class="raw">
				<form class="form-signin" id="loginForm" action="#" metgod="POST">
					<h2 class="form-signin-heading">Login To Admin Panel</h2>
					<p class="response"></p>
					<label for="r5g2" class="sr-only">Username</label>
					<input type="text" id="r5g2" class="form-control" placeholder="Username" required autofocus>
					<label for="g11a5" class="sr-only">Password</label>
					<input type="password" id="g11a5" class="form-control" placeholder="Password" required>
					<div class="checkbox">
					</div>
					<button id="loginBtn" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
			  	</form>
			 </div>
		</div> <!-- /container -->
	 </div>
  </body>
</html>

<style type="text/css">
	.account-bar {

	}
</style>
<div class="account-bar">

	<?php
	if ($selectedPanel) {
		echo '
		<div class="col-md-2">
			<form action="cms.php">
				<button type="submit" class="btn-lg btn-default"><< Go Back</button>
				
			</form>
		</div>
			';
	} 
	if (isSet($_SESSION['user'])) {

		echo '<h4 class="account-username" style="margin-top:13px;margin-left:16px;width:200px;float:left">' . $_SESSION['user']['name'] . '</h4>';
		echo '<button id="logoutBtn" class="btn btn-lg pull-right" style="margin-right:16px;" type="button">Logout</button>';
	}
	?>
</div>

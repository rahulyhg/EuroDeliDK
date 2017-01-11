<?php
/*
if (!isSet($_GET['email']) || empty($_GET['email'])) {
	header('location: ' . 'index.php');
}*/
// prerequisites
include('core/Language.php');
include('core/Database.php');


function logIt(&$db, $action = null, $what = null) {
	$stmt = $db->prepare("INSERT INTO `log` (`server`, `what`, `user`, `action`) VALUES (:server, :what, :user, :action)");

	$server = json_encode($_SERVER);
	if (isSet($_SESSION['logged'])) {

		$user = json_encode($_SESSION['user']);
	} else {
		$user = 'uknown';
	}

	$what = $what ? $what : "";
	
	$stmt->bindParam(':server', $server);
	$stmt->bindParam(':what', $what);
	$stmt->bindParam(':user', $user);
	$stmt->bindParam(':action', $action);
	$stmt->execute();
}




// if the user is logged in
if (isSet($_SESSION['user'])) {
	// if wants to sign out
	
	logIt($db, 'User in edit-order.');

// if wants to log in
} else {

	if (!isSet($_POST["logIn"])) {

		$html = '<form action="#" method="POST">

		<input type="hidden" name="logIn" />
		<input type="text" placeholder="username" name="username" />
		<input type="password" placeholder="pass" name="pass" />
		<input type="submit" value="LOGIN" />
		</form
		';
		echo $html;
		die();
	} else {

		$username = $_POST['username'];
		$pass = $_POST['pass'];
		// var_dump($username,$pass);

		logIt($db,'Try to login to edit order', json_encode(array(
			"username" => $username,
			"pass" => $pass
		)));
		
		$statement = $db->prepare("select name, email, type from users where username = :username and password = :pass");
		$statement->execute(array(':username' => $username, ':pass' => $pass));
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);


		// if user exists with this credentials			
		if (count($results) > 0) {
			// store the user in the session
			$_SESSION['logged'] = true;
			$_SESSION['user'] = $results[0];
			logIt($db, 'User logged in edit-order.');

			$response = array(
				'success' => true,
				'message' => 'Logged In Edit Order!',
				'body' => array(
					'user' => $results[0]
				),
				'redirect' => $web_root . "/cms.php"
			);
		} else {
		  header('WWW-Authenticate: Basic realm="My Realm"');
		  header('HTTP/1.0 401 Unauthorized');
		  die ("Not authorized");
		}
	}
}








/*$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
*/	


include('core/content.php');

// include all head tags
include('includes/theme/head.php');

// include navbar html
include('includes/theme/order_header.php');

// include order tools
include('includes/sections/admin_order.php');


// include('includes/sections/order_online2.php');
include('includes/theme/footer.php');
// Theme end
include('includes/theme/order_end.php');
?>
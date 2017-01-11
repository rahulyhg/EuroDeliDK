<?php
header('Content-Type: application/json');
include("Database.php");
$response['success'] = false;

// if the user is logged in
if (isSet($_SESSION['logged'])) {
	// if wants to sign out
	if (isSet($_POST['logout'])) {
		logIt('Try to logout');

		unset($_SESSION['logged']);
		unset($_SESSION['user']);

		$response = array(
			'success' => true,
			'message' => 'You are no longer in the system!',
			'body' => '',
			'redirect' => $web_root
		);
	} else {
		$response = array(
			'success' => true,
			'message' => 'You are already in the system!',
			'body' => ''
		);
	}

// if wants to log in
} else if (isSet($_POST['r5g2']) && !empty($_POST['r5g2']) && isSet($_POST['g11a5']) && !empty($_POST['g11a5'])) {
	$pass = $_POST['g11a5'];
	$username = $_POST['r5g2'];
	logIt('Try to login', json_encode(array(
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
		logIt('User logged in.');

		$response = array(
			'success' => true,
			'message' => 'Logged In!',
			'body' => array(
				'user' => $results[0]
			),
			'redirect' => $web_root . "/cms.php"
		);
	}
} else {
	$response = array(
		'success' => true,
		'message' => 'Unknow command',
		'body' => ''
	);
}

echo json_encode($response);
?>
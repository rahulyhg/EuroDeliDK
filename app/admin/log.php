<?php
function logIt($action = null, $what = null) {
	$stmt = $GLOBALS['db']->prepare("INSERT INTO `log` (`server`, `what`, `user`, `action`) VALUES (:server, :what, :user, :action)");

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

function vd($v) {
	echo "<pre>";
	var_dump($v);
	echo "</pre>";
}

function vdd($v) {
	echo "<pre>";
	var_dump($v);
	echo "</pre>";
	die('hard');
}


?>
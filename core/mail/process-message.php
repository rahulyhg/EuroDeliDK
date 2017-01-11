<?php
$response = array(
	'success' => false,
	'message' => 'Try again',
	'body' => ''
);
if (isSet($_POST['message_id']) && $_POST['message_id'] > 0) {
	include('../Language.php');
	include('../Database.php');
	include('../content.php');

	$message = getMeOrder($db, $_POST['message_id']);
	$message['user'] = json_encode($_SESSION['user']);

	if (isSet($_POST['update']) && $_POST['update'] == true) {
		$status = 10;
		$message['status'] = $status;
		$message['finished_at'] = date("Y-m-d H:i:s");
		$success = saveMessage($db, $message);

		if ($success)   {
			logIt($db,'updated message', json_encode($message));
			$message['response'] = $_POST['notes'];
			// (:table, :item_id, :user, :username, :email_sent, :data)
			$data = [
				'table' => 'messages',
				'item_id' => $message['id'],
				'email_sent' => 0,
				'data' => $message 
			];
			historyIt($db, $data);
			
			$response = array(
				'success' => true,
				'message' => 'updated message',
				'body' => ''
			);
		} else {
			
		}

	} else {
	}

} else if (isSet($_POST['get_history']) && isSet($_POST['id'])) {
	include('../Language.php');
	include('../Database.php');
	include('../content.php');

	$history = getHistory($db, ['item_id' => intval($_POST['id']), 'table' => 'messages']);
	var_dump($history);
	die();
}

function getMeOrder(&$db, $id) {
	$query = $db->prepare("SELECT * FROM `messages` WHERE `id` = ? ");
	$query->execute(array(intval($id)));
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result[0];
}

function saveMessage(&$db, $message) {
	$id = array_shift($message);
	$keys = array_keys($message);
	$fields = '`'.implode('`=?, `',$keys).'`=?';
	
	$query = $db->prepare("UPDATE messages SET $fields WHERE id=$id");
	if ($query->execute(array_values($message))) {
		return true;
	} else {
		return false;
	}
}
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

function getHistory(&$db, $item) {
	$query = $db->prepare("SELECT * FROM `history` WHERE `table` = :table AND `item_id` = :item_id ORDER BY created DESC");
	$query->bindParam(':table', $item['table']);
	$query->bindParam(':item_id', $item['item_id']);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function historyIt(&$db, $data) {
	$stmt = $db->prepare("INSERT INTO `history` (`table`, `item_id`, `user`, `username`, `email_sent`, `data`) VALUES (:table, :item_id, :user, :username, :email_sent, :data)");

	if (isSet($_SESSION['logged'])) {
		$user = json_encode($_SESSION['user']);
		$username = json_encode($_SESSION['user']['name']);
	} else {
		$user = 'uknown';
		$username = 'uknown';
	}
	$theData = json_encode($data['data']);
	$stmt->bindParam(':table', $data['table']);
	$stmt->bindParam(':item_id', $data['item_id']);
	$stmt->bindParam(':user', $user);
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':email_sent', $data['email_sent']);
	$stmt->bindParam(':data', $theData);
	$stmt->execute();
}

echo json_encode($response);
exit;
?>
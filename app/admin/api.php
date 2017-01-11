<?php
include("Database.php");
$response = array(
	'success' => false,
	'message' => 'Oops',
	'body' => ''
);
$get = $_GET;
if (isset($get['promotions'])) {
	$products = [
		'top' => [],
		'new' => [],
		'promotions' => []
	];
	$promotions = getMeFromPromotions($db);
	header('Content-Type: application/json');
	echo json_encode($promotions);
	exit;
	if (count($result)>0) {
	}
} else {

}
header('Content-Type: application/json');
echo json_encode($response);
exit;

function getMeFromPromotions(&$db, $id = null) {
	if (!$id) {
		$query = $db->prepare("SELECT * FROM `promotions` ORDER BY `created` DESC");
		$query->execute();
	} else {
		$query = $db->prepare("SELECT * FROM `promotions` WHERE `id` = ? ");
		$query->execute(array(intval($id)));
	}
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}
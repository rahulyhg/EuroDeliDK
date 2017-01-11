<?php

if ( isSet($_POST['update']) ||  isSet($_POST['add']) ||  isSet($_GET['remove'])) {
	if (isSet($_POST['update'])) {
		$response['success'] = false;
		
		if (isSet($_POST['id'])) {
			if (isSet($_POST['what'])) {
				$what = $_POST['what']; 
				if ('text' == $what) {
					if (!empty($_POST['id']) && $_POST['id']) {
						$id = $_POST['id'];
						$dk = $_POST['dk'] ? $_POST['dk'] : '';
						$en = $_POST['en'] ? $_POST['en'] : '';
						$ru = $_POST['ru'] ? $_POST['ru'] : '';

						$query = $db->prepare("UPDATE texts SET `dk`=?, `en`=?, `ru`=? WHERE id=?");
						if ($query->execute(array($dk, $en, $ru, $id))) {
							logIt('Updated text', json_encode(
								array(
									'id' => $id,
									'dk' => $dk,
									'en' => $en,
									'ru' => $ru,
								)
							));
							
							$response = array(
								'success' => true,
								'message' => 'You successfully updated the text field!',
								'body' => '',
								'redirect' => $web_root
							);
						}
					}
				}
			}
		}
		echo json_encode($response);
	} else if (isSet($_GET['remove'])) {

		if (isSet($_GET['id'])) {
			$id = intval($_GET['id']);

			if ($id > 0) {
				if (in_array($_GET['what'], ['text', 'promotion', 'order'])) {
					$table = $_GET['what'] . 's';
					$stmt    = $db->prepare("SELECT * FROM $table WHERE id=?");
					$results = $stmt->execute(array($id));
					if ($results) {
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$stmt = $db->prepare("DELETE FROM $table WHERE id=?");
						if ($stmt->execute(array($id))) {
							logIt('Deleted field in ' . $table, json_encode($row));
							header('location: ' . $_SERVER["HTTP_REFERER"]);
						}
					}
					
				}
			}
		}

	} else if (isSet($_POST['add'])) {
		if (isSet($_POST['name']) && isSet($_POST['dk']) && isSet($_POST['en']) && isSet($_POST['ru'])) {
			if (!empty($_POST['name']) && $_POST['name']) {
				$data['name'] = $_POST['name'];
				$data['dk'] = $_POST['dk'] ? $_POST['dk'] : '';
				$data['en'] = $_POST['en'] ? $_POST['en'] : '';
				$data['ru'] = $_POST['ru'] ? $_POST['ru'] : '';

				$query = $db->prepare("INSERT INTO texts(`name`, `dk`, `en`, `ru`) VALUES(?, ?, ?, ?)");
				
				$query->execute(array($data['name'], $data['dk'], $data['en'], $data['ru']));

				if ($query->errorCode() == 0) {
					logIt('Added new text', json_encode($data));
					//header('location: ' . $web_root);
				} else {

				}
			}
		}
	} else {

	}
}

if ( isSet($_POST['promotion']) ) {
	$user = $_SESSION['user'];
	if ($user['type'] > 1) {
		$userName = $user['name'];
	} else {
		$userName = 'admin';
	}

	$response = array(
		'success' => false,
		'message' => '',
		'body' => ''
	);

	$promotion = $_POST['promotion'];
	// $userName = 'admin';
	if ($userName == 'Aaboulevard') {
		unset($promotion['shop_2']);
		unset($promotion['shop_2_quantity']);
		unset($promotion['shop_3']);
		unset($promotion['shop_3_quantity']);
		unset($promotion['shop_4']);
		unset($promotion['shop_4_quantity']);
	}
	
	if ($userName == 'Taastrup') {
		unset($promotion['shop_1']);
		unset($promotion['shop_1_quantity']);
		unset($promotion['shop_3']);
		unset($promotion['shop_3_quantity']);
		unset($promotion['shop_4']);
		unset($promotion['shop_4_quantity']);
	}

	if ($userName == 'Odense') {
		unset($promotion['shop_1']);
		unset($promotion['shop_1_quantity']);
		unset($promotion['shop_2']);
		unset($promotion['shop_2_quantity']);
		unset($promotion['shop_4']);
		unset($promotion['shop_4_quantity']);
	}

	if ($userName == 'Ikast') {
		unset($promotion['shop_1']);
		unset($promotion['shop_1_quantity']);
		unset($promotion['shop_2']);
		unset($promotion['shop_2_quantity']);
		unset($promotion['shop_3']);
		unset($promotion['shop_3_quantity']);
	}

	if (isSet($promotion['id']) && $promotion['id'] > 0) {
		$copy = $promotion;
		$id = array_shift($promotion);
		$keys = array_keys($promotion);

		$fields = '`'.implode('`=?, `',$keys).'`=?';
		// $query = $db->prepare("INSERT INTO promotions($fields) VALUES($placeholder)");
		$query = $db->prepare("UPDATE promotions SET $fields WHERE id=$id");
		if ($query->execute(array_values($promotion))) {
			logIt('updated promotion', json_encode($copy));
			
			$response = array(
				'success' => true,
				'message' => 'You successfully updated the promotion!',
				'body' => ''
			);
		} else {

		}
	} else {
		$keys = array_keys($promotion);
		$fields = '`'.implode('`, `',$keys).'`';
		$placeholder = substr(str_repeat('?,',count($keys)),0,-1);
		
		$query = $db->prepare("INSERT INTO promotions($fields) VALUES($placeholder)");
		// $query = $db->prepare("UPDATE promotions SET `name_ru`=? WHERE id=?");
		if ($query->execute(array_values($promotion))) {
			logIt('new promotion', json_encode($promotion));
			
			$response = array(
				'success' => true,
				'message' => 'You successfully saved the promotion!',
				'body' => ''
			);
		} else {

		}

	}
	echo json_encode($response);
	exit;
}
?>
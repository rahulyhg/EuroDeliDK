<?php
$response = array(
	'success' => false,
	'message' => '',
	'body' => ''
);
$statuses = array(
    0 => 'New',
    10 => 'Open',
    50 => 'Done',
    60 => 'Delivered',
    90 => 'Canceled',
);
if (isSet($_POST['order_id']) && $_POST['order_id'] > 0) {
	include('../Language.php');
	include('../Database.php');
	include('../content.php');
	$status = 0;

	$order = getMeOrder($db, $_POST['order_id']);
	// logIt($db, "order_update", $order)
	$order['user'] = json_encode($_SESSION['user']);
	$email_sent = 0;
	if (isSet($_POST['start']) && $_POST['start'] == true) {
		$status = 10;
		$order['status'] = $status;
	} else if ($_POST['update'] == true) {
		$price = $_POST['price'];
		$notes = $_POST['notes'];
		$order['price'] = $price;
		$order['notes'] = $notes;
		// sendSendgridEmail(["to"=>"aleksandar.aleksandrov@ymail.com"]);
		/*die('kurva');
		try {
			$email_sent = mailClient("aleksandar.aleksandrov@ymail.com", $notes);
		} catch (Exception $e) {
			die();
		}
*/
		// $email_sent = mailClient($order['email'], "Order is DONE!");
		
	} else if ($_POST['finish'] == true) {
		$status = 50;
		$order['status'] = $status;
	} else if ($_POST['deliver'] == true) {
		$status = 60;
		$order['status'] = $status;
		$order['finished_at'] = date("Y-m-d H:i:s");
	} else if ($_POST['cancel'] == true) {
		$status = 90;
		$order['status'] = $status;
		$order['finished_at'] = date("Y-m-d H:i:s");
	} else if (isSet($_POST['shop']) && in_array($_POST['shop'],['Ikast','Odense','Taastrup','Aaboulevard'])) {
		$order['shop'] = $_POST['shop'];
	}

	$success = saveOrder($db, $order);

	if ($success)   {
		logIt($db,'updated order', json_encode($order));
		// (:table, :item_id, :user, :username, :email_sent, :data)
		$data = [
			'table' => 'orders',
			'item_id' => $order['id'],
			'email_sent' => $email_sent,
			'data' => $order 
		];

		historyIt($db, $data);
		
		$response = array(
			'success' => true,
			'message' => '',
			'body' => ''
		);
	} else {
		$response = array(
			'success' => false,
			'message' => 'Try again',
			'body' => ''
		);
	}
}

function getMeOrder(&$db, $id) {
	$query = $db->prepare("SELECT * FROM `orders` WHERE `id` = ? ");
	$query->execute(array(intval($id)));
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result[0];
}

function saveOrder(&$db, $order) {
	$id = array_shift($order);
	$keys = array_keys($order);
	$fields = '`'.implode('`=?, `',$keys).'`=?';
	
	$query = $db->prepare("UPDATE orders SET $fields WHERE id=$id");
	if ($query->execute(array_values($order))) {
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


function  mailClient($email, $text) {
	$to = $email;
	$subject = "Your order in Eurodeli";
	$message = $text;
  	$headers  = "From: Eurodeli < admin@eurodeli.dk >\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
    $headers .= "X-Priority: 1\n"; // Urgent message!
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\n";
	
	var_dump(mail($to,$subject,$message,$headers));
	die();
	

}

echo json_encode($response);
exit;


function sendSendgridEmail($options = array()) {

   include("sendgrid-client.php");

   $message = '<html>
               <body>
               <table rules="all" style="border-color: none;" cellpadding="10">
               <tbody>
                  <tr>
                     <td>
                     </td>
                     <td>
                        <img src="http://eurodeli.dk/img/logo.jpg" alt="EuroDeli" />
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        EuroDeli received new order from:
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">Subscriber:<br/>
                        ' . $options['to'] . '
                     </td>
                  </tr>
                  </tbody>
               </table>
               </body>
               </html>';

   $from = new SendGrid\Email("EuroDeliTest", "admin@eurodeli.dk");
   $subject = "First Test";
   $to = new SendGrid\Email("Aleksandar", "aleksandar.aleksandrov@ymail.com");
   $content = new SendGrid\Content("text/html", "and easy to do anywhere, even with PHP");
   $mail = new SendGrid\Mail($from, $subject, $to, $content);
   $apiKey = "api_here";
   $sg = new \SendGrid($apiKey);
   $response = $sg->client->mail()->send()->post($mail);
   /*echo $response->statusCode();
   echo $response->headers();
   echo $response->body();
*/
   die(var_dump($response));
}


function sendEmail($to, $text) {

$curl = curl_init();

$data = [
"from" => "admin@eurodeli.dk",
"to" => $to,
"subject" => "New Email",
"text" => $text
];

$data2 = "from=admin%40eurodeli.dk&to=todor.bojanov%40gmail.com&subject=test&text=I%20am%20a%20";


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.mailgun.net/v3/sandboxdac28cb0fc314e639edd4cd3804fd616.mailgun.org/messages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => serialize($data2),
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic YXBpOmtleS04M2JkMTEwYzNiOGMyODM2Yzc1NmViMjZmNGMxODNhZQ==",
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
  ),
));

$response = curl_exec($curl);
var_dump($response);
$err = curl_error($curl);

curl_close($curl);
return (!$err) ? true : false;
/*
    try {
      $response = $request->send();

      // echo $response->getBody();
      return true;
    } catch (HttpException $ex) {
      echo $ex;
      return false;
    }*/
}
?>

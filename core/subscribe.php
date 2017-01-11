<?php
if (isSet($_POST['subscribe']) && $_POST['subscribe']) {
include('Language.php');
include('Database.php');
$languageSelected = $_POST['lang'];

include('content.php');


function createEmailMessage($to = null, &$texts, &$languageSelected) {
   if (!$to) {
      return false;
   }

   $message = '<html>
               <head>
               </head>
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
                        ' . $texts['z.Email.TopText'] . '
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <a target="_blank" href="http://eurodeli.dk/order.php?email=' .$to. '&sprog=' . $languageSelected . '">
                           ' . $texts['z.Email.LinkText'] . '
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                     ' . $texts['z.Email.BottomText'] . '
                     </td>
                     <td>
                     </td>
                  </tr>
                  </tbody>
               </table>
               </body>
               </html>';
   
   return $message;
}

function getMeSubscriber(&$db, $id) {
   $query = $db->prepare("SELECT id, email_sent, email FROM `pricelist_subscribers` WHERE `id` = ? ");
   $query->execute(array(intval($id)));
   $result = $query->fetchAll(PDO::FETCH_ASSOC);
   return $result[0];
}

function saveSubscriber(&$db, $subscriber) {
   $id = array_shift($subscriber);
   $keys = array_keys($subscriber);
   $fields = '`'.implode('`=?, `',$keys).'`=?';
   
   $query = $db->prepare("UPDATE pricelist_subscribers SET $fields WHERE id=$id");
   if ($query->execute(array_values($subscriber))) {
      return true;
   } else {
      return false;
   }
}

$response = array(
	'success' => false,
	'message' => $texts['Subscribe.fail'],
	'body' => '',
);
	if (isSet($_POST['email']) && isSet($_POST['country']) && isSet($_POST['shop'])) {
		if (!empty($_POST['email']) && $_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$subscriber = array(
				'email' => $_POST['email'],
				'country' => $_POST['country'],
				'shop' => $_POST['shop'],
				'send_newsletter' => ($_POST['newsletter'] == "true") ? "Yes" : "No",
			);
			$query = $db->prepare("INSERT INTO pricelist_subscribers (`email`, `country`, `shop`, `send_newsletter`) VALUES(?, ?, ?, ?)");
			$query->execute(array($subscriber['email'], $subscriber['country'], $subscriber['shop'], $subscriber['send_newsletter']));

			if ($query->errorCode() == 0) {
            $subscriberId = $db->lastInsertId();




            $emailSent = sendPricelistEmail($subscriber['email'], $texts, $languageSelected);
            if ($emailSent) {
               
   				$response = array(
                  'success' => true,
                  'message' => $texts['Subscribe.message.ok'],
                  'body' => ''
               );       
            } else {
               $response = array(
   					'success' => false,
   					'message' =>  $texts['Subscribe.email.not_send'],
   					'body' => ''
   				);			
               
               
            }
			}
		} else {
			$response = array(
				'success' => false,
				'message' => $texts['Subscribe.email.invalid'],
				'body' => '',
			);
		}
	}
}
echo json_encode($response);
exit;
?>
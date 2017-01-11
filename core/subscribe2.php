<?php


if (isSet($_POST['subscribe']) && $_POST['subscribe']) {
include('Language.php');
include('Database.php');
$languageSelected = $_POST['lang'];

include('content.php');

function sendPricelistEmail($to = null, &$texts, &$languageSelected) {
   if (!$to) {
      return false;
   }

   // Create the email and send the message
   $subject = $texts['z.Email.SubjectTitle'];
   $headers = "From: " . $texts['z.Email.SenderEmail']. "\r\n";
   $headers .= "Reply-To: admin@eurodeli.dk"."\r\n".
   "X-Mailer: PHP/" . phpversion();
   $headers .= "MIME-Version: 1.0"."\r\n";
   $headers .= "Content-Type: text/html; charset=utf-8"."\r\n";

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
   $result = mail($to, $subject, $message, $headers);
   
   if ($result) {
      return true;         
   }
   return false;
}

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





// include('mail/contact_me.php');
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


         require 'class.phpmailer.php';
         require 'class.smtp.php';

         // Create the email and send the message
         $email['message'] = createEmailMessage($subscriber['email'], $texts, $languageSelected);
         $email['subject'] = $texts['z.Email.SubjectTitle'];
         $email['headers'] = "From: " . $texts['z.Email.SenderEmail']. "\r\n";
         $email['headers'] .= "Reply-To: admin@eurodeli.dk"."\r\n".
         "X-Mailer: PHP/" . phpversion();
         $email['headers'] .= "MIME-Version: 1.0"."\r\n";
         $email['headers'] .= "Content-Type: text/html; charset=utf-8"."\r\n";

         $email['headers2']  = "From: Admin < " . $texts['z.Email.SenderEmail'] . " >\n";
         $email['headers2'] .= "X-Sender: Admin < " . $texts['z.Email.SenderEmail'] . " >\n";
         $email['headers2'] .= 'X-Mailer: PHP/' . phpversion() . "\n";
         $email['headers2'] .= "X-Priority: 1\n"; // Urgent message!
         $email['headers2'] .= "Return-Path: " . $texts['z.Email.SenderEmail'] . "\n"; // Return path for errors
         $email['headers2'] .= "MIME-Version: 1.0\r\n";
         $email['headers2'] .= "Content-Type: text/html; charset=utf-8\n";



         $result = mail($subscriber['email'], $email['subject'], $email['message'], $email['headers2']);

         var_dump($result);






         die('tri');


















			/*
         $query = $db->prepare("INSERT INTO pricelist_subscribers (`email`, `country`, `shop`, `send_newsletter`, `email_sent`) VALUES(?, ?, ?, ?, 1)");
			$query->execute(array($subscriber['email'], $subscriber['country'], $subscriber['shop'], $subscriber['send_newsletter']));

			if ($query->errorCode() == 0) {
            $subscriberId = $db->lastInsertId();
            $subscriber = getMeSubscriber($db, $subscriberId);

            // $message = createEmailMessage($subscriber['email'], &$texts, &$languageSelected)






            $emailSent = sendPricelistEmail($subscriber['email'], $texts, $languageSelected);



            if ($emailSent) {
   				$response = array(
                  'success' => true,
                  'message' => $texts['Subscribe.message.ok'],
                  'body' => ''
               );       
            } else {
               $response = array(
   					'success' => true,
   					'message' =>  $texts['Subscribe.email.not_send'],
   					'body' => ''
   				);
               $subscriber['email_sent'] = 0;
               saveSubscriber($db, $subscriber);
            }
			}
         */
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
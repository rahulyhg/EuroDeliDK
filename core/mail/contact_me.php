<?php

include('../Language.php');
include('../Database.php');
include('../content.php');


if (isSet($_POST['sendContactForm']) || isSet($_POST['sendWishlistForm'])) {
   if (isSet($_POST['email']) && isSet($_POST['name'])) {
      if (!empty($_POST['email']) && $_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {               
        
         if (isSet($_POST['sendContactForm'])) {
            $contactForm = array(
               'to' => '',
               'email' => $_POST['email'],
               'phone' => $_POST['phone'],
               'name' => $_POST['name'],
               'message' => $_POST['message'],
               'shop' => $_POST['shop'],
               'country' => $_POST['country'],
               'newsletter' => ($_POST['newsletter'] == "1") ? "Yes" : "No",
            );

            $query = $db->prepare("INSERT INTO messages (`email`, `name`, `phone`, `message`, `to`, `shop`, `country`, `newsletter`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute(array(
               $contactForm['email'],
               $contactForm['name'],
               $contactForm['phone'],
               $contactForm['message'],
               $contactForm['to'],
               $contactForm['shop'],
               $contactForm['country'],
               $contactForm['newsletter']
            ));
            if ($query->errorCode() == 0) {
               $emailSent = sendMessageEmailToAdmin($contactForm['email'], $texts, $languageSelected);

               $response = array(
                  'success' => true,
                  'message' => $texts['Contact.message.ok'],
                  'body' => '',
               );
            } else {
               $response = array(
                  'success' => false,
                  'message' => $text['Contact.message.fail'],
                  'body' => '',
               );
            }
         } else {
            $wishlistForm = array(
               'to' => '',
               'email' => $_POST['email'],
               'phone' => $_POST['phone'],
               'name' => $_POST['name'],
               'message' => $_POST['message'],
               'country' => $_POST['country'],
               'newsletter' => ($_POST['newsletter'] = 1) ? "Yes" : "No",
               'image_link' => $_POST['image_link']
            );

            $query = $db->prepare("INSERT INTO messages (`email`, `name`, `phone`, `message`, `to`, `shop`, `country`, `newsletter`, `image_link`) VALUES(?, ?, ?, ?, ?, ?, ?, ?,?)");
            $query->execute(array(
               $wishlistForm['email'],
               $wishlistForm['name'],
               $wishlistForm['phone'],
               $wishlistForm['message'],
               $wishlistForm['to'],
               "wishlist",
               $wishlistForm['country'],
               $wishlistForm['newsletter'],
               $wishlistForm['image_link']
            ));

            if ($query->errorCode() == 0) {
               $emailSent = sendMessageEmailToAdmin($wishlistForm['email'], $texts, $languageSelected);

               $response = array(
                  'success' => true,
                  'message' => $texts['Wishlist.message.ok'],
                  'body' => '',
               );
            } else {
               $response = array(
                  'success' => false,
                  'message' => $text['Wishlist.message.fail'],
                  'body' => '',
               );
            }
         }

         echo json_encode($response);
         exit;
      }
   
      $response = array(
         'success' => false,
         'message' => $texts['Contact.email.message'],
         'body' => '',
      );
      echo json_encode($response);
      exit;
   }
   $response = array(
      'success' => false,
      'message' => $texts['Wishlist.message.fail'],
      'body' => '',
   );
   echo json_encode($response);
   exit;
}

if (isSet($_POST['sendOrderForm'])) {
   $orderForm = array(
      'email' => $_POST['email'],
      'name' => $_POST['name'],
      'details' => $_POST['products'],
      'address' => $_POST['address'],
      'phone' => $_POST['phone'],
      'message' => $_POST['message'],
      'price' => $_POST['price'],
   );
   
   $query = $db->prepare("INSERT INTO orders (`email`, `name`, `details`, `address`, `phone`, `message`, `price`) VALUES(?, ?, ?, ?, ?, ?, ?)");
   $query->execute(array(
      $orderForm['email'],
      $orderForm['name'],
      $orderForm['details'],
      $orderForm['address'],
      $orderForm['phone'],
      $orderForm['message'],
      $orderForm['price']
   ));
  
   if ($query->errorCode() == 0) {
      $emailSent = sendOrderEmailToAdmin($orderForm['email'], $texts, $languageSelected);

      if ($orderForm['price'] >= 200) {
         $response = array(
            'success' => true,
            'message' => $texts['OrderPage.success'],
            'body' => '',
         );
      } else {
         $response = array(
            'success' => false,
            'message' => $texts['OrderPage.Min_price'],
            'body' => '',
         );
         
      }
   } else {
      $response = array(
         'success' => true,
         'message' => $texts['OrderPage.fail'],
         'body' => '',
      );
   }
   echo json_encode($response);
   exit;
}


function sendOrderEmailToAdmin($to = null, &$texts, &$languageSelected) {
   if (!$to) {
      return false;
   }

   // Create the email and send the message
   $subject = "New Website Message";
   $headers = "From: " . $texts['z.Email.SenderEmail']. "\r\n";
   $headers .= "Reply-To: admin@eurodeli.dk" . "\r\n".
   "X-Mailer: PHP/" . phpversion();
   $headers .= "MIME-Version: 1.0"."\r\n";
   $headers .= "Content-Type: text/html; charset=utf-8"."\r\n";

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
                        ' . $to . '
                     </td>
                  </tr>
                  </tbody>
               </table>
               </body>
               </html>';
   

   $result = mail($texts['z.Email.AdminEmail'], $subject, $message, $headers);
   
   if ($result) {
      $result = mail($texts['z.Email.AdminEmail2'], $subject, $message, $headers);
      if ($result) {
         $result = mail($texts['z.Email.AdminEmail3'], $subject, $message, $headers);
         if ($result) {
            return true;
         }
      }
   }
   return false;
}

function sendMessageEmailToAdmin($to = null, &$texts, &$languageSelected) {
   if (!$to) {
      return false;
   }

   // Create the email and send the message
   $subject = "New Order";
   $headers = "From: " . $texts['z.Email.SenderEmail']. "\r\n";
   $headers .= "Reply-To: admin@eurodeli.dk" . "\r\n".
   "X-Mailer: PHP/" . phpversion();
   $headers .= "MIME-Version: 1.0"."\r\n";
   $headers .= "Content-Type: text/html; charset=utf-8"."\r\n";

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
                        EuroDeli received message from:
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">Client:<br/>
                        ' . $to . '
                     </td>
                  </tr>
                  </tbody>
               </table>
               </body>
               </html>';
   

   $result = mail($texts['z.Email.AdminEmail'], $subject, $message, $headers);
   
   if ($result) {
      $result = mail($texts['z.Email.AdminEmail2'], $subject, $message, $headers);
      if ($result) {
         $result = mail($texts['z.Email.AdminEmail3'], $subject, $message, $headers);
         if ($result) {
            return true;
         }
      }
   }
   return false;
}


?>
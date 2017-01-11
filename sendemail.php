<?php
$result = "";
if (isSet($_POST['to'])) {
	/*var_dump($_POST);
	die();*/

	require('Response.php');
	require('Client.php');
	require('SendGrid.php');

	$api_key = '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';
	$api_key = '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'; // 111111

// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

$request_body = json_decode('{
  "personalizations": [
    {
      "to": [
        {
          "email": "'.$_POST['to'].'"
        }
      ],
      "subject": "'.$_POST['subject'].'"
    }
  ],
  "from": {
    "email": "admin@eurodeli.dk"
  },
  "content": [
    {
      "type": "text/html",
      "value": "'.$_POST['body'].'"
    }
  ]
}');

$apiKey = getenv($api_key);
$sg = new \SendGrid($api_key);

try {
    $response = $sg->client->mail()->send()->post($request_body);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo $response->statusCode();
echo $response->body();
echo $response->headers();



}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title></title>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style type="text/css">
		
	</style>
	<script type="text/javascript">
		
	</script>
</head>
<body>

<?php 
if (isSet($_POST['to'])) {
	echo '<p>'.$result.'</p>';
}
?>

<form action="#" method="POST">
  To:<br>
  <input type="email" name="to" placeholder="To:"><br>
  Subject:<br>
  <input type="text" name="subject" placeholder="Subject:"><br>
  Text:<br>
  <input type="text" name="body" placeholder="Text:"><br>
  


  <input type="submit" value="Submit">
</form>
 
</body>
</html>
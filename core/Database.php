<?php
header('Content-type: text/html; charset=utf-8');
$dev = (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) ? true : false;

// webroot url
$protocol = isSet($_SERVER['HTTPS']) == '' ? 'http://' : 'https://';
$url = substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], '/'));
$web_root = $protocol . $_SERVER['HTTP_HOST'] . $url; 
$web_self = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

if ($dev) {
	$db_host = "localhost";
	$db_name = "eurodeli_dk";
	$db_username = "root";
	$db_pass = "";
	$db_charset = "utf8";
} else {
    $db_host = "eurodeli.dk.mysql";
    $db_name = "eurodeli_dk";
    $db_username = "eurodeli_dk";
    $db_pass = "asas123";
    $db_charset = "utf8";
}


// create PDO connection to DB
$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_username, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
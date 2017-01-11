<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: text/html; charset=utf-8');
session_start();
$dev = (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) ? true : false;

class pdoDbException extends PDOException {
    public function __construct(PDOException $e) { 
        if(strstr($e->getMessage(), 'SQLSTATE[')) {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches); 
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]); 
            $this->message = $matches[3]; 
        }
    }
}

// webroot url
$protocol = isSet($_SERVER['HTTPS']) == '' ? 'http://' : 'https://';
$url = substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], '/'));
$web_root = $protocol . $_SERVER['HTTP_HOST'] . $url; 
$web_self = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

// Database settings

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

/*try {
	$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=' . $db_charset . ';',$db_username, $db_pass);
	// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) { 
    throw new pdoDbException($e); 
}*/

$stmt = $db->prepare('SELECT * FROM countries');
$stmt->execute();

$countries = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $countries[$row['id']] = $row;
}

$stmt = $db->prepare('SELECT * FROM shops');
$stmt->execute();

$shops = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $shops[$row['id']] = $row;
}
$languageSelected = 'en';
$stmt = $db->query('SELECT name, ' . $languageSelected . ' FROM texts ORDER BY `name` ASC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$texts = array();
foreach ($results as $id => $text) {
    $texts[$text['name']] = $text[$languageSelected];
}

include('log.php');
?>
<?php
$languageSelected = 'dk';
session_start();

if (isset($_SESSION['sprog']) && in_array($_SESSION['sprog'], array('en','dk','ru'))) {
	$languageSelected = $_SESSION['sprog'];
}

if (isset($_GET['sprog']) && in_array($_GET['sprog'], array('en','dk','ru'))) {
	$_SESSION['sprog'] = $_GET['sprog'];
	$languageSelected = $_SESSION['sprog'];
}

?>
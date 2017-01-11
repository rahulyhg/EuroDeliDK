<?php
if (!isSet($_GET['email']) || empty($_GET['email'])) {
	header('location: ' . 'index.php');
}
// prerequisites
include('core/Language.php');
include('core/Database.php');
include('core/content.php');

// include all head tags
include('includes/theme/head.php');

// include navbar html
include('includes/theme/order_header.php');

// include('includes/sections/order_page.php');
include('includes/sections/order_online2.php');

// footer
include('includes/theme/footer.php');
// Theme end
include('includes/theme/order_end.php');
?>
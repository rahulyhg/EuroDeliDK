<?php
// prerequisites
include('core/Language.php');
include('core/Database.php');
include('core/content.php');



// include all head tags
include('includes/theme/head.php');

// include navbar html
include('includes/theme/header.php');

// sections

// home section
include('includes/sections/home.php');
// order section
include('includes/sections/order.php');
if ($_GET['test'] == true) {
	// events section
	include('includes/sections/events.php');
}
// shops section
include('includes/sections/shops.php');

// All shops section
include('includes/sections/shops/all.php');

/*
// Aaboulevard section
include('includes/sections/shops/aaboulevard.php');
// Taastrup section
include('includes/sections/shops/taastrup.php');
// Odense section
include('includes/sections/shops/odense.php');
// Ikast section
include('includes/sections/shops/ikast.php');*/

// About section
include('includes/sections/about.php');

// Wishlist section
include('includes/sections/wishlist.php');

// Contact section
include('includes/sections/contact.php');

// footer
include('includes/theme/footer.php');
// Theme end
include('includes/theme/end.php');
?>
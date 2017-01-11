<?php 
/*
if ($_GET['test'] == true) {
	// events section
	include('includes/sections/subscribe_panel2.php');
} else {
	// All shops section
	include('includes/sections/subscribe_panel.php');
}
*/
// Create the function, so you can use it
/*function isMobile() {
    return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackbe‌​rry|iemobile|bolt|bo‌​ost|cricket|docomo|f‌​one|hiptop|mini|oper‌​a mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|‌​webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
// If the user is on a mobile device
if(isMobile()){
	include('includes/sections/subscribe_panel.php');
} else {
	include('includes/sections/subscribe_panel2.php');
}
*/



?>
<?php include('products_panel.php');?>
<!-- Header -->
<header id="page-top" >
	<div class="container container-header">
		&nbsp;
	</div>
	<div class="container container-overlay">
		<div class="row">
			<div class="col-lg-12">
				<div class="home-title">
					<?= $texts['Home.slogan']; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 bottom-home-text">
				<div class="home-shops">
						<a href="#shop_1"><?= $texts['Home.Magazin1']; ?></a> > <a href="#shop_2"><?= $texts['Home.Magazin2']; ?></a> > <a href="#shop_3"><?= $texts['Home.Magazin3']; ?></a> > <a href="#shop_4"><?= $texts['Home.Magazin4']; ?></a>
				</div>
			</div>
		</div>
	</div>
</header>

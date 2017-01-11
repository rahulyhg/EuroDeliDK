<script type="text/javascript">
var map;
var marker;

var aaboulevard_latLang = {lat: 55.684581, lng: 12.555188};
var taastrup_latLang = {lat: 55.653138, lng: 12.302519};
var odense_latLang = {lat: 55.393968, lng: 10.333878};
var ikast_latLang = {lat: 56.126391, lng: 9.158068};
var mobile_draggable = false;

function initMap() {
	AabMap = new google.maps.Map(document.getElementById('aaboulevard-map'), {
		center: aaboulevard_latLang,
    	scrollwheel: false,
    	draggable: mobile_draggable,
		zoom: 18
	});

	TaaMap = new google.maps.Map(document.getElementById('taastrup-map'), {
		center: taastrup_latLang,
    	scrollwheel: false,
    	draggable: mobile_draggable,
		zoom: 18
	});

	OdMap = new google.maps.Map(document.getElementById('odense-map'), {
		center: odense_latLang,
    	scrollwheel: false,
    	draggable: mobile_draggable,
		zoom: 18
	});

	IkMap = new google.maps.Map(document.getElementById('ikast-map'), {
		center: ikast_latLang,
    	scrollwheel: false,
    	draggable: mobile_draggable,
		zoom: 18
	});

	AabMarker = new google.maps.Marker({
		position: aaboulevard_latLang,
		map: AabMap,
		draggable: true,
		animation: google.maps.Animation.DROP,
		title: 'Aaboulevard'
	});

	TaaMarker = new google.maps.Marker({
		position: taastrup_latLang,
		map: TaaMap,
		draggable: true,
		animation: google.maps.Animation.DROP,
		title: 'Eurodeli Taastrup'
	});

	OdMarker = new google.maps.Marker({
		position: odense_latLang,
		map: OdMap,
		draggable: true,
		animation: google.maps.Animation.DROP,
		title: 'Eurodeli Odense'
	});

	IkMarker = new google.maps.Marker({
		position: ikast_latLang,
		map: IkMap,
		draggable: true,
		animation: google.maps.Animation.DROP,
		title: 'Eurodeli Ikast'
	});
}
</script>

<style type="text/css">
	
@media (max-width: 992px) {
    .shop-content-details {
	    height: auto;
	    padding-top: 10px;
	    background-size: 100% 100%;
	}
}
</style>

<?php
$shopsHtml = '';

foreach($shops as $shop) {
$shopsHtml .= '
			<div class="col-lg-3 col-md-6 col-xs-12 shop-section">
				<a href="#' .$shop['id']. '" class="shop-link shop-link-circle">
					<img class="img-responsive img-circle shop-image" src="' .$shop['image']. '" alt="">
				</a>
				<div class="shop-description">
					<h1>' . $texts[$shop['dataname'].'.title'] . '</h1>
					<div class="col-lg-12 col-xs-12">
						<a href="#' .$shop['id']. '" class="shop-link">' . $texts['Shops.more_details'] . '</a>
					</div>
				</div>
			</div>

';
}
?>

<!-- Shops Section -->
<section id="shops">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 shop-content-header">
				<span class="shop-content-header-text">
					<h1><?= $texts['Shops.title']; ?></h1>
				</span>
			</div>
		</div>
		<div class="row shops-section">
			<?php echo $shopsHtml; ?>
		</div>
	</div>
</section>
		
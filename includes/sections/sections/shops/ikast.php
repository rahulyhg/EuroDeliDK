<section id="ikast">
	<div class="container">
		<div class="row shop-content">
			<div class="col-lg-12 shop-content-header">
				<span class="shop-content-header-text">
					<h1><?= $texts['Magazin4.title']; ?></h1>
				</span>
			</div>
			<div class="col-lg-12 shop-content-content">
				<div class="col-lg-6 col-xs-6 shop-content-image-slider">
					<div class="list-group shop-slider">
						<div class="item">
							<img data-u="image" src="img/aaboulevard_1.jpg" alt="" />
						</div>
						<div class="item">
							<img data-u="image" src="img/aaboulevard_2.jpg" alt="" />
						</div>
						<div class="item">
							<img data-u="image" src="img/aaboulevard_1.jpg" alt="" />
						</div>
						<div class="item">
							<img data-u="image" src="img/aaboulevard_2.jpg" alt="" />
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xs-6 shop-content-details">
					<div class="col-lg-12 col-xs-12">
						<h3> Shop Details: </h3>
					</div>

					<div class="col-lg-12 col-xs-12">
						<div class="col-lg-3 col-xs-3">
							<p>Address:</p>
						</div>
						<div class="col-lg-9 col-xs-9">
							<!-- <p><?= $texts['Magazin4.address1']; ?> - <a href="#">Open in Maps</a></p> -->
							<p><?= $texts['Magazin4.address1']; ?> - <?= $texts['Magazin4.address2']; ?> </p>
						</div>
						<div class="col-lg-3 col-xs-3">
							<p>Telephone:</p>
						</div>
						<div class="col-lg-9 col-xs-9">
							<p><?= $texts['Magazin4.telephone']; ?></p>
						</div>
						<div class="col-lg-3 col-xs-3">
							<p>email:</p>
						</div>
						<div class="col-lg-9 col-xs-9">
							<p><?= $texts['Magazin4.email']; ?></p>
						</div>
						<div class="col-lg-3 col-xs-3">
							<p>Variety:</p>
						</div>
						<div class="col-lg-9 col-xs-9">
							<p class="shop-details-variety-flags">
								<img class="img-responsive img-circle country-flag" src="img/flags/dk.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/bg.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/ru.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/lt.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/en.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/lv.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/pl.png" alt="">
								<img class="img-responsive img-circle country-flag" src="img/flags/ro.png" alt="">
							</p>
						</div>
						<p>
							<?= $texts['Magazin1.details']; ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-12 shop-content-promotions">
				<h3>
					Promotions
				</h3>
				<div id="ikast-products" class="row list-group">
					<?php
						echo showPromotions($promotions['shop_4'], 'shop_4');
					?>
				</div>
			</div>
			<div class="col-lg-12 col-xs-12 variety-flags">
				<p class="description">
					<?= $texts['Magazin4.description']; ?>
				</p>
				<div id="ikast-map" class="map"></div>
			</div>
		</div>
	</div>
</section>
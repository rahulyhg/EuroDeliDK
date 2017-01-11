<section id="aaboulevard">
	<div class="container">
		<div class="row shop-content">
			<div class="col-lg-12 shop-content-header">
				<span class="shop-content-header-text">
					<h1><?= $texts['Magazin1.title']; ?></h1>
				</span>
			</div>
			<div class="col-lg-12 shop-content-content">
				<div class="col-lg-6 col-xs-6 shop-content-image-slider">
					<div class="slider">
						<img src="img/aaboulevard_1.jpg" alt="" />
						<div class="just_text">
							<p>Open 367 days a year!
							</p>
						</div>
					
					</div>
				</div>
				<div class="col-lg-6 col-xs-6 shop-content-details">
					<div class="row">
						<div class="col-lg-12 col-xs-12">
							<h3> Shop Details: </h3>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-xs-12">
							<div class="row">
								<div class="col-lg-3 col-xs-3">
									<img class="detail-icon" src="img/shop/address.png" alt="" />
								</div>
								<div class="col-lg-9 col-xs-9">
									<!-- <p><?= $texts['Magazin1.address1']; ?> - <a href="#">Open in Maps</a></p> -->
									<p><?= $texts['Magazin1.address1']; ?> - <?= $texts['Magazin1.address2']; ?> </p>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-3 col-xs-3">
									<img class="detail-icon" src="img/shop/phone.png" alt="" />
								</div>
								<div class="col-lg-9 col-xs-9">
									<p><?= $texts['Magazin1.telephone']; ?></p>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-3 col-xs-3">
									<img class="detail-icon" src="img/shop/email.png" alt="" />
								</div>
								<div class="col-lg-9 col-xs-9">
									<p><?= $texts['Magazin1.email']; ?></p>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-3 col-xs-3">
									<img class="detail-icon" src="img/shop/language.png" alt="" />
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
							</div>
							<p>
								<?= $texts['Magazin1.details']; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 shop-content-promotions">
				<h3>
					Promotions
				</h3>
				<div id="aaboulevard-products" class="row list-group">
					<?php
						echo showPromotions($promotions['shop_1'], 'shop_1', $languageSelected, $texts);
					?>	
				</div>
			</div>
			<div class="col-lg-12 col-xs-12 variety-flags">
				<p class="description">
					<?= $texts['Magazin1.description']; ?>
				</p>
				<div id="aaboulevard-map" class="map"></div>
			</div>
		</div>
	</div>
</section>
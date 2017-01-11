<!-- Order Section -->
	<section id="order">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 shop-content-header" style="height:auto;">
					<span class="shop-content-header-text">
						<h1><?= $texts['Order.title']; ?></h1>
					</span>
				</div>
				<div id="order-img" class="col-lg-12">
					<a href="order.php" target="_blank"><img src='img/order/order.png' id="orderStepsImage" style="cursor: pointer" class="img-responsive" alt="<?= $texts['Order.linkText']; ?>"/></a>
				</div>
				<div id="order-details" class="col-lg-12">
					<span>
						<?= $texts['Order.Step1']; ?>
					</span>
					<span>
						<?= $texts['Order.Step2']; ?>
					</span>
					<span>
						<?= $texts['Order.Step3']; ?>
					</span>
					<span>
						<?= $texts['Order.Step4']; ?>
					</span>
					<span>
						<?= $texts['Order.Step5']; ?>
					</span>
				</div>
				<div class="col-lg-12">
					<div class="col-md-5">
						<p>
							<?= $texts['OrderPage.deliveryText']; ?>
						</p>
					</div>
					<div class="col-md-3 col-md-offset-2">
						<a href="<?= $texts['OrderPage.deliveryLink']; ?>" target="_blank" title="<?= $texts['OrderPage.deliveryLinkText']; ?>">
							<p style="color:black; text-align: center;"><?= $texts['OrderPage.clickMap']; ?></p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
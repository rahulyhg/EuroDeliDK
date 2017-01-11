<!-- Wishlist Section -->
	<section id="wishlist">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 shop-content-header" style="height:auto;">
					<span class="shop-content-header-text">
						<h1><?= $texts['Wishlist.title']; ?></h1>
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<p>
						<?= $texts['Wishlist.description']; ?>
					</p>
					<div class="row">
						<form class="col-lg-12 col-xs-12" name="sentMessage" id="wishlistForm" enctype="multipart/form-data" method="post" novalidate>
							<div class="row control-group">
								<div class="form-group col-xs-12 floating-label-form-group controls">
									<label><?= $texts['Contact.name']; ?></label>
									<input type="text" class="form-control" placeholder="<?= $texts['Contact.name']; ?>" id="name" required data-validation-required-message="<?= $texts['Contact.name.message']; ?>">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="row control-group">
								<div class="form-group col-xs-12 floating-label-form-group controls">
									<label><?= $texts['Contact.email']; ?></label>
									<input type="email" class="form-control" placeholder="<?= $texts['Contact.email']; ?>" id="email" required data-validation-required-message="<?= $texts['Contact.email.message']; ?>">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="row control-group">
								<div class="form-group col-xs-12 floating-label-form-group controls">
									<label><?= $texts['Contact.phone']; ?></label>
									<input type="tel" class="form-control" placeholder="<?= $texts['Contact.phone']; ?>" id="phone" required data-validation-required-message="<?= $texts['Contact.phone.message']; ?>">
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<div class="row control-group">
								<div class="form-group col-xs-12 floating-label-form-group controls">
									<label><?= $texts['Contact.message']; ?></label>
									<textarea rows="5" class="form-control" placeholder="<?= $texts['Contact.message']; ?>" id="message" required data-validation-required-message="<?= $texts['Contact.message.message']; ?>"></textarea>
									<p class="help-block text-danger"></p>
								</div>
							</div>
							<br>
							<div id="success"></div>
							<div class="row">
								<div class="form-group col-lg-3 col-md-3 col-xs-6">
									<div class="row control-group">
										<div class="input-group dropdowns">
											<?php include('includes/helper/countries_select.php'); ?>
										</div>
									</div>
								</div>
								<div class="form-group col-lg-3 col-md-3 col-xs-6">
									<div class="row control-group">
										<div class="input-group" style="margin:auto">
											<img class="image-preview" id="image-preview" style="width: 60px;margin-right: 20px; float:left;" src="img/photo.png" alt="" />
											<input id="image-input" style="display:none" type="file" name="image" data-id=0 class="image-input" data-name="image" onchange="imageUpload(this)"/>
										</div>
									</div>
								</div>
								<div class="form-group col-lg-4 col-md-4 col-xs-7">
									<div class="row control-group">
										<div class="input-group dropdowns">
											<span class="input-group-addon">
										       <label class="checkbox-inline"><input type="checkbox" id="subscribeNewsletterWishlistForm" value=0><?= $texts['Home.newsletter.text']; ?></label>
										    </span>
										</div>
									</div>
								</div>
								<div class="form-group col-lg-2 col-md-2 col-xs-4" style="text-align:center">
									<button type="submit" class="btn btn-success btn-lg" id="sendWishlistForm"><?= $texts['Contact.send']; ?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
	$('#image-preview').click(function() {
		$('#image-input').click()
	})
</script>
<!-- Contact Section -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 shop-content-header">
				<span class="shop-content-header-text">
					<h1><?= $texts['Contact.title']; ?></h1>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
				<!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
				<form name="sentMessage" id="contactForm" novalidate>
					<div class="row control-group">
						<div class="form-group col-xs-12 floating-label-form-group controls">
							<label><?= $texts['Contact.name']; ?></label>
							<input type="text" class="form-control" placeholder="<?= $texts['Contact.name']; ?>" id="contactname" required data-validation-required-message="<?= $texts['Contact.name.message']; ?>">
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12 floating-label-form-group controls">
							<label><?= $texts['Contact.email']; ?></label>
							<input type="email" class="form-control" placeholder="<?= $texts['Contact.email']; ?>" id="contactemail" required data-validation-required-message="<?= $texts['Contact.email.message']; ?>">
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12 floating-label-form-group controls">
							<label><?= $texts['Contact.phone']; ?></label>
							<input type="tel" class="form-control" placeholder="<?= $texts['Contact.phone']; ?>" id="contactphone" required data-validation-required-message="<?= $texts['Contact.phone.message']; ?>">
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12 floating-label-form-group controls">
							<label><?= $texts['Contact.message']; ?></label>
							<textarea rows="5" class="form-control" placeholder="<?= $texts['Contact.message']; ?>" id="contactmessage" required data-validation-required-message="<?= $texts['Contact.message.message']; ?>"></textarea>
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<br>
					<div id="contactsuccess"></div>
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
								<div class="input-group dropdowns">
									<?php include('includes/helper/shops_select.php'); ?>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-xs-6">
							<div class="row control-group">
								<div class="input-group dropdowns">
									<span class="input-group-addon">
								       <label class="checkbox-inline"><input type="checkbox" id="subscribeNewsletterContactForm" value=0><?= $texts['Home.newsletter.text']; ?></label>
								    </span>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-3 col-xs-6" style="text-align:center">
							<input type="hidden" name="language" id="language" value="<?php echo $languageSelected; ?>">
							<button type="submit" class="btn btn-success btn-lg" id="sendContactForm"><?= $texts['Contact.send']; ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
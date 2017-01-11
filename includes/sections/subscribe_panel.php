<script type="text/javascript">

$(document).ready(function() {

	$(window).on('scroll', function() {
	    var scrollTop = $(this).scrollTop();

	    $('.background1, .background2').each(function() {
	        var topDistance = $(this).offset().top;

	        if ( (topDistance+100) < scrollTop ) {
	            alert( $(this).text() + ' was scrolled to the top' );
	        }
	    });
	});
	
	$(".selectpicker-countries").selectpicker({
		showIcon:false
	});
	$(".selectpicker-shops").selectpicker({
		showIcon:false
	});

	$('#subscribeForm').jqBootstrapValidation({
		preventSubmit: true
	});
	$('#subscribeForm').submit(function(event) {

		$('#subscribeResult').show();
		// $("#subscribeSubmit").attr("disabled", true);
		event.preventDefault();

		// get values from FORM
		var subscribeData = {
			email     : $("input#subscribeEmail").val(),
			country   : $("select#subscribeCountry").val(),
			shop      : $("select#subscribeShop").val(),
			newsletter: $("input#subscribeNewsletter").prop('checked'),
			lang      :  $("input#subscribeLanguage").val(),
			subscribe : true,
		};


		if (subscribeData.email === "") {
			$('#subscribeResult').html("<?= $texts['Subscribe.email.empty'] ?>");
			$('#subscribeEmail').focus();
			return false;
		}

		if (subscribeData.country === "") {
			$('#subscribeResult').html("<?= $texts['Subscribe.country.empty'] ?>");
			$('#subscribeForm button[data-id="subscribeCountry"]').parent().css({'border':'2px solid #3a4287'})
			return false;
		} else {
			$('#subscribeForm button[data-id="subscribeCountry"]').parent().css({'border':'none'})
		}

		if (subscribeData.shop === "") {
			$('#subscribeResult').html("<?= $texts['Subscribe.area.empty'] ?>");
			$('#subscribeForm button[data-id="subscribeShop"]').parent().css({'border':'2px solid #3a4287'})
			return false;
		} else {
			$('#subscribeForm button[data-id="subscribeShop"]').parent().css({'border':'none'})
		}
		$('#subscribeLoader').show();
		$('#subscribeSubmit').prop('disabled', true);


		$.ajax({
			url: "core/subscribe.php",
			type: "POST",
			data: subscribeData,
			cache: false,
			success: function(response) {
				$('#subscribeLoader').hide();
				$('#subscribeSubmit').prop('disabled', false);
				response = $.parseJSON(response);
				console.log(response);

				$('#subscribeResult').html(response.message);

				// Enable button & show success message

				//clear all fields
				if (response.success) {
					$('#subscribeForm').trigger("reset");	
				}
			},
			error: function(response) {
				$('#subscribeSubmit').prop('disabled', false);
				$('#subscribeLoader').hide();
				console.log(response);
				// $('#contactForm').trigger("reset");
			},
		})
		$('#subscribeEmail').focus();
	});
});
</script>
<style>
.price-list-bar {
    border-radius: 10px;
    border: 1px solid #F47B2D;
    background: #F47B2D;
    padding: 0;
}

.price-list-bar .input-group:first-of-type {
	width: 100%;
}

.subscribe-top {
	right:30%;
	width:35%;
}

#subscribePanel {
	position: fixed;
	top: 32%;
	width: 200px;
	right: 20px;
	z-index: 12;
	padding: 0 1.5vw 1.5vw 1.5vw;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
#subscribeEmail {
	width: 94%;
	margin-left: 3%;
	margin-right: 3%;
    border-radius: 10px;
    border: none;
    border-bottom:none;
}

.hide-panel {
	right: -220px !important;
	opacity: 0.6 !important;
}

.hidden-subscribe {
	/*right: -200px !important;*/
}

#subscribePanelButton {
	position: absolute;
	cursor: pointer;
	background-image: url('images/arrow_right.png');
    background-size: 100% 100%;
	top: 50px;
	height: 50px;
	width: 50px;
	left: -25px;
	z-index: 12;
	opacity:0.2;
}
#subscribePanel:hover #subscribePanelButton {
	opacity: 1;
}

#subscribePanel .input-group-addon {
    border-radius: 0px;
}

#subscribeLoader {
	display:none;
	width: 32px;
}

.price-list-bar .btn {
    padding: 10px;
}

@media (max-width: 992px) {
	#subscribePanel {
		top: 20%;
	}
}

</style>
<div id="subscribePanel" class="hidden-subscribe subscribe-top">
<img src="images/arrow_right.png" alt="" id="arrow-right" style="display:none"/>
<img src="images/arrow_left.png" alt="" id="arrow-left" style="display:none"/>
	<div class="row">
		<form id="subscribeForm" novalidate>
			<div class="col-lg-12 col-xs-12 price-list-bar">
				<p style="
				    font-size: 18px;
				    margin: 3%;
				    color: white;"
    			><?= $texts['Home.email.text']; ?>
				</p>
				<div class="input-group">
					<input 
						id="subscribeEmail" 
						class="form-control" 
						placeholder="<?= $texts['Contact.email']; ?>"
						type="email" 
						required 
						data-validation-matches-match="email" 
						data-validation-required-message="Please enter your email address." 
					/>
				 	<input type="hidden" id="subscribeLanguage" name="subscribeLanguage" value="<?= $languageSelected; ?>">
				</div>
				<div class="input-group-addon">
				   <label class="checkbox-inline"><input type="checkbox" id="subscribeNewsletter" value=""><?= $texts['Home.newsletter.text']; ?></label>
				</div>
				<div class="input-group">
					
					<?php include('includes/helper/countries_select.php'); ?>
				</div>
				<div class="input-group">
					<?php include('includes/helper/area_select.php'); ?>
				</div>
				<div class="input-group-addon">
					<button class="btn btn-success" id="subscribeSubmit" type="submit">
					<?= $texts['Home.email.button.text']; ?>
					</button>
					<br/>
				</div>
				<div class="col-lg-12" style="height:32px; text-align: center;">
					<img id="subscribeLoader" src="http://www.voki.com/images/ajax-loader.gif" alt="Loading">
				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<p id="subscribeResult">
		</p>
	</div>
			
	<div id="subscribePanelButton">
		&nbsp;
	</div>

</div>

<script type="text/javascript">
	
$(document).ready(function() {
	$('#subscribePanelButton').click(function(ev) {
		if ($('#subscribePanel').hasClass('hidden-subscribe')) {
			$('#subscribePanel').removeClass('hidden-subscribe');
			$('#subscribePanel').addClass('hide-panel');
			$('#subscribePanelButton').css({'background-image': 'url('+$('#arrow-left').prop('src')+')'});
		} else {
			$('#subscribePanelButton').css({'background-image': 'url('+$('#arrow-right').prop('src')+')'});
			$('#subscribePanel').addClass('hidden-subscribe');
			$('#subscribePanel').removeClass('hide-panel');
			
		}
	})

	$('#subscribePa').click(function(ev) {
		console.log($('#subscribePanelButton').css('background-image'));
		if ($('#subscribePanel').hasClass('hidden-subscribe')) {
			$('#subscribePanel').animate({
			    opacity: 0.6,
			    right: "-240px"
			  }, 1000, function() {

				$('#subscribePanelButton').css({'background-image': 'url('+$('#arrow-left').prop('src')+')'});
				$('#subscribePanel').removeClass('hidden-subscribe');
				$('#subscribePanel').animate({
				    right: "-240px"
				  }, 100, function() {
				});
			  });
		} else {
			$('#subscribePanel').animate({
			    opacity: 1,
			    right: "50px"
			  }, 1000, function() {
				$('#subscribePanelButton').css({'background-image': 'url('+$('#arrow-right').prop('src')+')'});
				$('#subscribePanel').addClass('hidden-subscribe');
				$('#subscribePanel').animate({
				    right: "50px"
				  }, 100, function() {
				});
		  	});
		}
	})
});
</script>
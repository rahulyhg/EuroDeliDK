/*!
 * Start Bootstrap - Freelancer Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
	$('body').on('click', '.page-scroll a, .home-shops a, a.shop-link', function(event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top
		}, 1500);
		event.preventDefault();
	});

	


	$('#orderStepsImage').click(function(ev) {
		if ($('#subscribePanel').hasClass('hidden-subscribe')) {
			$('#subscribePanel').css({'right': "30px"});
			setTimeout( function() {
				$('#subscribePanel').css({'right': "20px"})	
			}, 300 );
		} else {
			$('#subscribePanelButton').css({'background-image': 'url('+$('#arrow-right').prop('src')+')'});
			$('#subscribePanel').addClass('hidden-subscribe');
			$('#subscribePanel').removeClass('hide-panel');		
		}
	})






});

// Floating label headings for the contact form
$(function() {
	$("body").on("input propertychange", ".floating-label-form-group", function(e) {
		$(this).toggleClass("floating-label-form-group-with-value", !! $(e.target).val());
	}).on("focus", ".floating-label-form-group", function() {
		$(this).addClass("floating-label-form-group-with-focus");
	}).on("blur", ".floating-label-form-group", function() {
		$(this).removeClass("floating-label-form-group-with-focus");
	});








});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
	target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
	$('.navbar-toggle:visible').click();
});


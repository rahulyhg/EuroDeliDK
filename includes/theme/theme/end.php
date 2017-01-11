	<div class="scroll-top page-scroll visible-lg visible-md visible-xs visible-sm to-top">
		<a class="btn btn-primary button-to-top" href="#page-top">
            <img src="images/arrow_up.png" alt="" id="arrow-up" />
		</a>
	</div>

	<?php
		// include('includes/side_shops.php');
	?>

    <script src="js/sss.min.js"></script>
    <link rel="stylesheet" href="css/sss.css" type="text/css" media="all">

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script> -->
    <script type="text/javascript" src="js/bootstrap-table.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.session.js"></script>
    <script src="js/jqBootstrapValidation.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
    <script src="js/app.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/contact_me.js"></script>
    <script src="js/fileinput.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script>
    /*jQuery(function($) {
    $('.slider').sss();
    });*/
    $(document).ready(function(){
    
    if ($(window).width() < 700) {
      $('.promoslider').slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          arrows : false,
          dots: true
      });  
      $('.productsSlider').slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          arrows : false,
          dots: true
      });  

    } else {
     $('.promoslider').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true
      });
     $('.productsSlider').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true
      }); 
    }
    });


    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASZZ3t1UDI3WcNjWWzAQod5VLLYrzFGbM&callback=initMap">
    </script>
</body>

</html>
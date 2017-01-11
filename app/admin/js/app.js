$(document).ready(function() {
	$("#loginBtn").click(function(event) {
		var data = {
			r5g2 : $('#r5g2').val(),
			g11a5 : $('#g11a5').val()
		};
		$.post("login.php", data, function(response) {
			response = $.parseJSON(response);
			if (response.success) {
				if (response.redirect) {
					window.location.replace(response.redirect);
				} else {
				}
			}
			$('.response').html(response.message);
		});
	});

	$("#loginForm").submit(function(event) {
		event.preventDefault();
		var data = {
			r5g2 : $('#r5g2').val(),
			g11a5 : $('#g11a5').val()
		};
		$.post("login.php", data, function(response) {
			response = $.parseJSON(response);
			if (response.success) {
				if (response.redirect) {
					window.location.replace(response.redirect);
				} else {
				}
			}
			$('.response').html(response.message);
		});
	});


	$("#logoutBtn").click(function(event) {
		var data = {
			logout : true
		};

		$.post("login.php", data, function(response) {
			response = jQuery.parseJSON(response);
			if (response.success) {
				if (response.redirect) {
					window.location.replace(response.redirect);
				} else {
				}
			}
			$('.response').html(response.message);
		});

	});

	$(".btn-update-text").click(function(event) {
		var id = $(this).data('id');
		var data = {
			update : true,
			what : "text",
			id : id,
			dk : $('.text-box[data-id=' + id + ']').find('textarea[data-name="dk"]').val(),
			en : $('.text-box[data-id=' + id + ']').find('textarea[data-name="en"]').val(),
			ru : $('.text-box[data-id=' + id + ']').find('textarea[data-name="ru"]').val()
		};

		$.post("cms.php", data, function(response) {
			console.log(response);
			/*if (response.success) {
				if (response.redirect) {
					window.location.replace(response.redirect);
				} else {
				}
			}
			$('.response').html(response.message);*/
		});

	});

	$(".btn-update-promotion").click(function(event) {
		var id   = $(this).data('id');
		var form = $('.promotion-box[data-id=' + id + ']');
		
		var data = {
			promotion: {
				id : id,
				// active : $(form).find('input[data-name="active"]').prop('checked'),
				image_link : $(form).find('.image-preview').attr('src'),
				old_price : $(form).find('input[data-name="old_price"]').val(),
				new_price : $(form).find('input[data-name="new_price"]').val(),
				name_dk : $(form).find('textarea[data-name="name_dk"]').val(),
				name_en : $(form).find('textarea[data-name="name_en"]').val(),
				name_ru : $(form).find('textarea[data-name="name_ru"]').val(),
				description_dk : $(form).find('textarea[data-name="description_dk"]').val(),
				description_en : $(form).find('textarea[data-name="description_en"]').val(),
				description_ru : $(form).find('textarea[data-name="description_ru"]').val(),
				shop_1 : ($(form).find('input[data-name="shop_1"]').prop('checked')) ? 1 : 0,
				shop_2 : ($(form).find('input[data-name="shop_2"]').prop('checked')) ? 1 : 0,
				shop_3 : ($(form).find('input[data-name="shop_3"]').prop('checked')) ? 1 : 0,
				shop_4 : ($(form).find('input[data-name="shop_4"]').prop('checked')) ? 1 : 0,
				shop_1_quantity : $(form).find('input[data-name="shop_1_quantity"]').val(),
				shop_2_quantity : $(form).find('input[data-name="shop_2_quantity"]').val(),
				shop_3_quantity : $(form).find('input[data-name="shop_3_quantity"]').val(),
				shop_4_quantity : $(form).find('input[data-name="shop_4_quantity"]').val(),
				shop_ids : $(form).find('input[data-name="shop_ids"]').val(),
			}
		};


		$.post("cms.php", data, function(response) {
			var response = JSON.parse(response);
			console.log(response);
			if (response.success) {
				location.reload();
			} else {
				alert('Try again later, something went wrong');
			}
		});

	});

	$(".save-new-promotion").click(function(event) {
		event.preventDefault();
		var form = $('#newPromotion');
		
		var data = {
			promotion: {
				// active : $(form).find('input[data-name="active"]').prop('checked'),
				image_link : $(form).find('.image-preview').attr('src'),
				old_price : $(form).find('input[data-name="old_price"]').val(),
				new_price : $(form).find('input[data-name="new_price"]').val(),
				name_dk : $(form).find('textarea[data-name="name_dk"]').val(),
				name_en : $(form).find('textarea[data-name="name_en"]').val(),
				name_ru : $(form).find('textarea[data-name="name_ru"]').val(),
				description_dk : $(form).find('textarea[data-name="description_dk"]').val(),
				description_en : $(form).find('textarea[data-name="description_en"]').val(),
				description_ru : $(form).find('textarea[data-name="description_ru"]').val(),
				shop_1 : ($(form).find('input[data-name="shop_1"]').prop('checked')) ? 1 : 0,
				shop_2 : ($(form).find('input[data-name="shop_2"]').prop('checked')) ? 1 : 0,
				shop_3 : ($(form).find('input[data-name="shop_3"]').prop('checked')) ? 1 : 0,
				shop_4 : ($(form).find('input[data-name="shop_4"]').prop('checked')) ? 1 : 0,
				shop_1_quantity : $(form).find('input[data-name="shop_1_quantity"]').val(),
				shop_2_quantity : $(form).find('input[data-name="shop_2_quantity"]').val(),
				shop_3_quantity : $(form).find('input[data-name="shop_3_quantity"]').val(),
				shop_4_quantity : $(form).find('input[data-name="shop_4_quantity"]').val(),
				shop_ids : $(form).find('input[data-name="shop_ids"]').val(),
				type : $(form).find('input[data-name="type"]').val(),
			}
		};

		$.post("cms.php", data, function(response) {
			var response = JSON.parse(response);
			console.log(response);
			if (response.success) {
				location.reload();
			} else {
				alert('Try again later, something went wrong');
			}
		});

		console.log(data);
		return;
	});

	$(".save-new-top_product").click(function(event) {
		event.preventDefault();
		var form = $('#newTopProduct');
		
		var data = {
			promotion: {
				type : 'top',
				// active : $(form).find('input[data-name="active"]').prop('checked'),
				image_link : $(form).find('.image-preview').attr('src'),
				new_price : $(form).find('input[data-name="new_price"]').val(),
				name_dk : $(form).find('textarea[data-name="name_dk"]').val(),
				name_en : $(form).find('textarea[data-name="name_en"]').val(),
				name_ru : $(form).find('textarea[data-name="name_ru"]').val(),
				description_dk : $(form).find('textarea[data-name="description_dk"]').val(),
				description_en : $(form).find('textarea[data-name="description_en"]').val(),
				description_ru : $(form).find('textarea[data-name="description_ru"]').val(),
			}
		};

		$.post("cms.php", data, function(response) {
			var response = JSON.parse(response);
			console.log(response);
			if (response.success) {
				location.reload();
			} else {
				alert('Try again later, something went wrong');
			}
		});

		console.log(data);
		return;
	});

	var options = {
		btnCancelClass: 'btn-warning',
		popout: true
	};

	$('.btn-remove-text').click(function(event) {
		// $('[data-toggle="confirmation"]').confirmation('hide');
	});

	$('.btn-remove-promotion').click(function(event) {
		// $('[data-toggle="confirmation"]').confirmation('hide');
	});
	$('[data-toggle="confirmation"]').confirmation(options);


});
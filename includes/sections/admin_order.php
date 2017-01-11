<?php

if (!isSet($_GET['orderId'])) {
	die("ORDER ID IS MISSING!!!");
}


$orderId = intval($_GET['orderId']);
$query = 'SELECT * FROM orders WHERE `id`=:id';
$sql = $db->prepare($query);
$sql->execute(array(':id'=> $orderId));
$orderContent =  $sql->fetchAll(PDO::FETCH_ASSOC);


if (count($orderContent) === 0) {

	die("ORDER DOES NOT EXIST!!!");
}
/*
echo "<pre>";
var_dump($orderContent);
die();*/


$pricelists = [
	'bg' => array(
		'active' => ($texts['Pricelist.BG'] == 1) ? true : false,
	),
	'ru' => array(
		'active' => ($texts['Pricelist.RU'] == 1) ? true : false,
	), 
	'lt' => array(
		'active' => ($texts['Pricelist.LT'] == 1) ? true : false,
	),
	'lv' => array(
		'active' => ($texts['Pricelist.LV'] == 1) ? true : false,
	),
	'ro' => array(
		'active' => ($texts['Pricelist.RO'] == 1) ? true : false,
	),
	'hu' => array(
		'active' => ($texts['Pricelist.HU'] == 1) ? true : false,
	),
	'pl' => array(
		'active' => ($texts['Pricelist.PL'] == 1) ? true : false,
	),
	'ua' => array(
		'active' => ($texts['Pricelist.UA'] == 1) ? true : false,
	),
];

if ($dev) {
	$pricelists = [
		'bg' => array('active' => false),
		'ru' => array('active' => false), 
		'lt' => array('active' => false),
		'lv' => array('active' => false),
		'ro' => array('active' => true),
		'hu' => array('active' => false),
		'pl' => array('active' => false),
		'ua' => array('active' => false),
	];
}


$products = array();
?>
<script>
var products = <?php echo json_encode($products); ?>;
var pricelists = <?php echo json_encode($pricelists); ?>;
</script>

<script type="text/javascript">

var totalPrice = 0;
function updatePrice() {
	totalPrice = 0;
	$.each(selectedProducts, function(key, product) {
		var price = 0;
		
		if (product.price.indexOf("/") > -1) {
			price = (parseInt(product.quantity)/1000);
		} else {
			price = product.quantity;
		}

		if (parseInt(product.price) > 0) {
			price = price*parseInt(product.price);
		}
		totalPrice += price;
	})
	totalPrice = Math.ceil(totalPrice);
	

	$('#totalPrice').html(totalPrice);
}

function getPricelist(country) {
	if (country.length != 2) {
		alert('Wrong input.');
		return false;
	}
	// do smth before load
	// here
	updatePricelistTable([]);
	showLoading();

	$.post("core/mail/get_pricelist.php", {pricelist: country})
	.done(function( response ) {
		
		var response = JSON.parse(response);
		if (response.success) {
			var products = JSON.parse(response.body);
			updatePricelistTable(products);
			var products = [];	
		}
	})
	.fail(function() {
		alert('Can not load pricelist now.');
	})
	.always(function() {
			hideLoading();
	});
}

function showLoading(country) {
	$('#productsList').parents().find('.fixed-table-body').first().css({'background-image': 'url("' + $('#loadingGif').attr('src') + '")'});
}

function hideLoading(country) {
	$('#productsList').parents().find('.fixed-table-body').first().css({background: ''});
}





var selectedProducts = <?php echo $orderContent[0]['details']; ?>;
$(document).ready(function() {
	/*// get selectedProducts from session
	if ($.session.get('selectedProducts') != undefined) {
		selectedProducts = $.parseJSON($.session.get('selectedProducts'));
	} else {
		selectedProducts = [];
	}*/
	updatePrice();

	var orderItemId = 0;
	updatePricelistTable(getPricelist('bg'));



	$('#orderForm').submit(function(event) {
		// $("#subscribeSubmit").attr("disabled", true);
		event.preventDefault();
	});

	$('#sendOrderForm').click(function(event) {
		// $("#subscribeSubmit").attr("disabled", true);
		event.preventDefault();
		if (selectedProducts.length == 0) {
			return false;
		}
		// get values from FORM
		var orderId = $('#orderId').val();
		var email = $('#orderEmail').val();
		var name = $('#orderName').val();
		var address = $('#orderAddress').val();
		var phone = $('#orderPhone').val();
		var message = $('#orderMessage').val();

		if (name == "") {
			$('#orderName').css({'border':'1px solid red'});
			element = $('#orderName');
			offset = element.offset();
			offsetTop = offset.top - 200;
			$('html, body').animate({scrollTop: offsetTop}, 500, 'linear', function() {
				$('#orderName').focus();
			});

			return false;
		} else {
			$('#orderName').css({'border':'1px solid #c0c0c0'});
			
		}
		if (address == "") {
			$('#orderAddress').css({'border':'1px solid red'});
			element = $('#orderAddress');
			offset = element.offset();
			offsetTop = offset.top - 200;
			$('html, body').animate({scrollTop: offsetTop}, 500, 'linear', function() {
				$('#orderAddress').focus();
			});

			return false;
		} else {
			$('#orderAddress').css({'border':'1px solid #c0c0c0'});
			
		}
		if (phone == "") {
			$('#orderPhone').css({'border':'1px solid red'});
			element = $('#orderPhone');
			offset = element.offset();
			offsetTop = offset.top - 200;
			$('html, body').animate({scrollTop: offsetTop}, 500, 'linear', function() {
				$('#orderPhone').focus();
			});

			return false;
		} else {
			$('#orderPhone').css({'border':'1px solid #c0c0c0'});
			
		}

		var data = {
			'order_id': orderId,
			'email': email,
			'name': name,
			'address': address,
			'phone': phone,
			'message': message,
			'products': JSON.stringify(selectedProducts),
			'price': totalPrice,
			'sendOrderForm': true,
		}
		console.log(data);
		return false;
		$.ajax({
			url: "core/mail/contact_me.php",
			type: "POST",
			data: data,
			cache: false,
			success: function(response) {
				response = JSON.parse(response);
				if (response.success) {

					$.session.remove('selectedProducts');
					// Enable button & show success message

					selectedProducts = [];

		        	$('#selectedProductsList').bootstrapTable('refresh');
		        	$('#selectedProductsList').bootstrapTable('load', selectedProducts);
					updatePrice();
				}
				console.log(response);
				$('#orderSuccess').html(response.message);
				$('#orderSuccess').show();

			},
			error: function(response) {
				console.log(response);
				// $('#contactForm').trigger("reset");
			},
		})
	});
	var searchText = <?= json_encode($texts['OrderPage.search']); ?>;
	 $('#productsList').bootstrapTable({
        data: products,
        formatNoMatches: function() {
        	return emptyBasketText;
        },
        formatSearch: function() {
        	return searchText;
        },
        onClickRow: function(row, $element) {
/*        	if (!parseInt(row.ean)) {
        		return false;
        	}
*/
        	var selectedProduct = row;
    		var found = false;
        	
        	selectedProduct.id = parseInt(row.ean)	;

        	sp = [];

        	if (selectedProducts.length == 0 ) {
    			if (selectedProduct.price.indexOf("/") > -1) {
        			selectedProduct.quantity = 100 + "g";
    			} else {
        			selectedProduct.quantity = 1;
    			}
    			selectedProducts.unshift	(selectedProduct);	
        	} else {
	        	$.each(selectedProducts, function(key, product) {	
	        		if (product.id == selectedProduct.id) {
	        			// product.quantity = parseInt(product.quantity) + 1;
	        			
	        			if (selectedProduct.price.indexOf("/") > -1) {
	        				if (parseInt(selectedProducts[key].quantity) >= 1000) {
			        			selectedProducts[key].quantity = (parseInt(selectedProducts[key].quantity)+1000) + "g";

	        				} else {
			        			selectedProducts[key].quantity = (parseInt(selectedProducts[key].quantity)+100) + "g";
	        				}
		    			} else {
		        			selectedProducts[key].quantity++;
		    			}

	        			found = true;
	        		}
	        	})        		
	        			
	        	if (!found) {
					if (selectedProduct.price.indexOf("/") > -1) {
	        			selectedProduct.quantity = 100 + "g";
	    			} else {
	        			selectedProduct.quantity = 1;
	    			}
	    			
	        		selectedProducts.unshift(selectedProduct);
				}
			}

        	sp = selectedProducts;

			$.session.set('selectedProducts', JSON.stringify(selectedProducts));

        	$('#selectedProductsList').bootstrapTable('refresh');
        	$('#selectedProductsList').bootstrapTable('load', sp);
        	updatePrice();
			deactivateQuantityButtons();
			activateQuantityButtons(selectedProduct);

/*
        	var item;
        	item  += "<tr ><td class='remove'>X<input type='hidden' data-id='ean' name='" + orderItemId + ".ean' value='" + selectedRow.ean + "'></td>";
        	item  += "<td class=''><input type='hidden' data-id='company' name='" + orderItemId + ".company' value='" + selectedRow.company + "'>" + selectedRow.company + "</td>";
        	item  += "<td class=''><input type='hidden' data-id='name' name='" + orderItemId + ".name' value='" + selectedRow.name + "'>" + selectedRow.name + "</td>";
        	item  += "<td class=''><input type='hidden' data-id='name_en' name='" + orderItemId + ".name_en' value='" + selectedRow.name_en + "'>" + selectedRow.name_en + "</td>";
        	item  += "<td class=''><input type='hidden' data-id='amount' name='" + orderItemId + ".amount' value='" + selectedRow.amount + "'>" + selectedRow.amount + "</td>";
        	item  += "<td class=''><input type='hidden' data-id='price' name='" + orderItemId + ".price' value='" + selectedRow.price + "'>" + selectedRow.price + "</td><td><input type='text' data-id='quantity' name='" + orderItemId + ".quantity' class='quantity-field'></td></tr>";
        	
        	$('.orderItems > .items').append(item);

		    $('.remove').click(function(ev) {
		    	$(this).parent().remove();
		    })
*/
        }
    });

	 var emptyBasketText = <?= json_encode($texts['OrderPage.empty']); ?>; 
	  


	$('#selectedProductsList').bootstrapTable({
        data: selectedProducts,
        formatNoMatches: function() {
        	return emptyBasketText;
        },
        onClickRow: function(srow, $selement) {
        	activateQuantityButtons(srow);
			$('#selectedProductsList tr.active').removeClass('active');
			$selement.addClass('active');
			/*$('#productsList').bootstrapTable('scrollTo', 0);
			$('#productsList').bootstrapTable('scrollTo', ($('#productsList tr[data-index=' + srow.id + ']').position().top - 35 ));
			// $('#productsList tr[data-index=' + srow.id + ']').fadeTo('slow', 0.5).fadeTo('slow', 1.0);
			$('#productsList tr').removeClass('row-background');
			$('#productsList tr[data-index=' + srow.id + ']').addClass('row-background').addClass('row-highlight');
			
			setTimeout(function() {
				$('#productsList tr[data-index=' + srow.id + ']').removeClass('row-highlight');
			}, 500);*/
     	}
	})

    $(".mybtn-top").click(function () {
        $('#productsList').bootstrapTable('scrollTo', 0);
    });
    
    $(".mybtn-btm").click(function () {
        $('#productsList').bootstrapTable('scrollTo', 'bottom');
    });

    $('.remove-all').click(function(ev) {
    	$(this).parents().find('.items').html('');
    })

    $('#removeProducts').click(function () {
        var ids = $.map($('#selectedProductsList').bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        $('#selectedProductsList').bootstrapTable('remove', {
            field: 'id',
            values: ids
        });
        deactivateQuantityButtons();
		$.session.remove('selectedProducts');
		$('#productsList tr').removeClass('row-background');
    });

    function activateQuantityButtons(row) {
		if (quantityButtonsRow == row) {
			return false;
		}

	 	$('#quantity-change').find('#input').val(row.quantity);
    	quantityButtonsShown = true;
    	quantityButtonsRow = row;
    	$('#quantity-change').show();
    }
   
    $(".quantity-add").click(function(e){
		if (quantityButtonsRow.price.indexOf("/") > -1) {
			var curVal = parseInt(quantityButtonsRow.quantity);
			var newVal;
			if (curVal >= 1000) {

        		newVal = ((curVal + 1000) + "g");
			} else {
        		newVal = (curVal + 100) + "g";
			}
			
		} else {
        		newVal = parseInt($('#input').val()) + 1;
		}
    	$('#input').val(newVal);
        updateProductQuantity(quantityButtonsRow, newVal);
    });

    //Remove
    $(".quantity-remove").click(function(e){
		if (quantityButtonsRow.price.indexOf("/") > -1) {
			var curVal = parseInt(quantityButtonsRow.quantity);
			var newVal;
			if (curVal > 1000) {
        		newVal = ((curVal - 1000) + "g");
			} else {
				if (curVal - 100 <= 0) {return;}
        		newVal = (curVal - 100) + "g";
			}
		} else {
        	newVal = parseInt($('#input').val() - 1);
		}
    	$('#input').val(newVal);
        updateProductQuantity(quantityButtonsRow, newVal);
    });

    //Remove
    $("#input").change(function(e){
    	if (parseInt($('#input').val()) - 1 > 0) {
	        updateProductQuantity(quantityButtonsRow, parseInt($('#input').val()))
    	}
    });

    function updateProductQuantity(row, quantity) {
    	var selectedProduct = row;
    	$.each(selectedProducts, function(key, product) {
    	var price = 0;
    		if (product.id == selectedProduct.id) {
    			selectedProducts[key].quantity = quantity;
    		}
    	})
        $.session.set('selectedProducts', JSON.stringify(selectedProducts));
    	$('#selectedProductsList').bootstrapTable('refresh');
    	$('#selectedProductsList').bootstrapTable('load', selectedProducts);
    	updatePrice();
    }
    
	$('.pricelists li').click(function(ev) {
		if ($(this).hasClass('selected')) {
			return false;
		} else {
			$('.pricelists li').removeClass('selected');
			$(this).addClass('selected');
			getPricelist($(this).data('language'));
		}
	})

});


function deactivateQuantityButtons() {
	quantityButtonsShown = false;
	quantityButtonsRow = {};
	$('#quantity-change').hide();
}
function updatePricelistTable(products) {
	$('#productsList').bootstrapTable('refresh');
	$('#productsList').bootstrapTable('load', products);
}



function removeProduct(row) {
        $.each(selectedProducts, function(key, product) {
    		if (product.id === row.id) {
    			selectedProducts.splice(key,1);
    			return false;
    		}
    	});
        $.session.set('selectedProducts', JSON.stringify(selectedProducts));
    	$('#selectedProductsList').bootstrapTable('refresh');
    	$('#selectedProductsList').bootstrapTable('load', selectedProducts);
    	updatePrice();
    	deactivateQuantityButtons();
}


function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                '<i class="glyphicon glyphicon-remove"></i>',
            '</a>'
        ].join('');
    }

    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
        	removeProduct(row);
        }
    };
var quantityButtonsShown = false;
var quantityButtonsRow;
</script>

<style type="text/css">
	body {
		background: white !important;
	}
	.page-scroll a.navbar-brand {
    	padding-top: 22px !important;
	}	
	.pricelists li {
		cursor: pointer;
		border-radius: 5px;
		padding: 8px;
		margin-right: 10px;
		margin-bottom: 10px;
		background-color: #F0F0F0;
	}
	.pricelists li:hover {
		opacity: 0.8;
	}
</style>

<!-- 
<div class="form-inline">
    <button type="button" 
            class="btn btn-default mybtn-top">
        Scroll to top
    </button>
    <button type="button" 
            class="btn btn-default mybtn-btm">
        Scroll to bottom
    </button>
</div>
 -->

<!-- About Section -->
	<section id="orderOnline">
		<div class="container container-order">
			<div class="row">
				<div class="col-lg-12 shop-content-header">
					<span class="shop-content-header-text">
						<h1><?= "Order Nr: 001-".$orderContent[0]['id']; ?></h1>
				 	</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 col-lg-offset-1">
					<h3>Client:</h3>
					<p>
						<?php //echo $texts['OrderPage.description2']; ?>
					</p>
					<p>
						<img class="order-icon"  src="img/name.png" alt="<?= $texts['Contact.name']; ?>" />
						<input type="text" style="width:350px;" name="name" id="orderName"  value="<?= $orderContent[0]['name']; ?>" placeholder="<?= $texts['Contact.name']; ?>" />
						<input type="hidden" name="orderId" id="orderId" value="<?= $orderContent[0]['id'];?>" />
					</p>
					<p>
						<img class="order-icon"  src="img/shop/email.png" alt="<?= $texts['Contact.note']; ?>" />
						<input type="text" style="width:350px;" name="email" id="orderEmail"  value="<?= $orderContent[0]['email']; ?>" placeholder="<?= $texts['Contact.address']; ?>" />
						
					</p>
					<p>
						<img class="order-icon"  src="img/shop/address.png" alt="<?= $texts['Contact.address']; ?>" />
						<input type="text" style="width:350px;" name="address" id="orderAddress"  value="<?= $orderContent[0]['address']; ?>" placeholder="<?= $texts['Contact.city']; ?>" />
						
					</p>
					<p>
						<img class="order-icon"  src="img/shop/phone.png" alt="<?= $texts['Contact.phone']; ?>" />
						<input type="text" style="width:350px;" name="phone" id="orderPhone"  value="<?= $orderContent[0]['phone']; ?>" placeholder="<?= $texts['Contact.phone']; ?>" />
					</p>
					<p>
						<textarea style="width:350px;" name="message" id="orderMessage"  placeholder="<?= $texts['Contact.note']; ?>" /><?= $orderContent[0]['message']; ?>
						</textarea>
					</p>
				</div>
				<div class="col-lg-5">
				<div class="col-md-12" style="margin-bottom:20px;">
						<p>
							<?php //echo $texts['OrderPage.description1']; ?>
						</p>
					</div>
					<div class="col-md-5">
						<p>
							<?php //echo $texts['OrderPage.deliveryText']; ?>
						</p>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<!-- <a href="<?= $texts['OrderPage.deliveryLink']; ?>" target="_blank" title="<?= $texts['OrderPage.deliveryLinkText']; ?>">
							<img class="img-responsive"  src="<?= $texts['OrderPage.deliveryImage']; ?>" alt="" />

							<p style="color:black; text-align: center;"><?= $texts['OrderPage.clickMap']; ?>&#8593;</p>
						</a> -->	
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<ul class="pricelists">
					<p style="display:inline-block;"><?= $texts['OrderPage.selected_pricelist']; ?>
					</p>
					<?php 
					$pricelistHtml = '';
					$counter = 0;
					$selected = '';
					foreach($pricelists as $countryCode => $pricelist) {
						if ($counter < 1) {
							$selected = "selected";
						} else {
							$selected = '';
						}
						$pricelistHtml .= '
						<li data-language="' . $countryCode . '" class="' . $selected . '">
							<p style="margin:0"><img class="country-flag" src="img/flags/' . $countries[$countryCode]['lang'] . '.png" alt=""><span>' . $countries[$countryCode]['country_' . $languageSelected] . '</span></p>
						';
						$counter++;
					} 
					echo $pricelistHtml;
					?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
				    <table id="productsList" data-search="true" data-show-columns="true" data-height="600">
				        <thead>
				            <tr>
				                <th data-field="company" data-sortable="true"><?= $texts['OrderPage.company']; ?></th>
				                <th data-field="name" data-sortable="true"><?= $texts['OrderPage.name']; ?></th>
				                <th data-field="name_en" data-sortable="true">In English</th>
				                <th data-field="amount" data-sortable="true"><?= $texts['OrderPage.amount']; ?></th>
				                <th data-field="price" data-sortable="true"><?= $texts['OrderPage.price']; ?></th>
				                <th data-field="ean" data-sortable="true" class="hidden-xs hidden-sm hidden-md hidden-lg">ean</th>
				            </tr>
				        </thead>
				    </table>
				</div>
				<div class="col-lg-3">
					<div style="">
						<span style="width:100px;line-height:62px;font-size:20px"><?= $texts['OrderPage.order']; ?>
							<div id="quantity-change" class="col-lg-7 col-xs-7 col-sm-7 ">
				            	<div class="form-group form-group-options">
				                    <div id="1" class="input-group input-group-option quantity-wrapper">
				                    
				                        <span  class="input-group-addon input-group-addon-remove quantity-remove btn">
							            	<span class="glyphicon glyphicon-minus"></span>
				                        </span>
				                        
				                        <input  id="input" type="text" disabled="true" value="1" class="form-control quantity-count " placeholder="1">

				                        <span class="input-group-addon input-group-addon-remove quantity-add btn">
				                            <span class="glyphicon glyphicon-plus"></span>
				                        </span>
				                        
				                    </div>
				                    
				                </div>
				            </div>
			            </span>
						<!-- <button id="removeProducts" type="button" class="btn btn-warning pull-left">Remove</button> -->
						<form id="orderForm">
							<input type="hidden" id="orderEmail" value="<?php echo $_GET['email']; ?>">
	    					<table  id="selectedProductsList" data-sortable=false class="table orderItems" data-height="250">
								<thead>
							        <tr>
							            <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
    									<th data-field="name" data-sortable="true"><?= $texts['OrderPage.name']; ?></th>
							            <th data-field="amount" data-sortable="true"><?= $texts['OrderPage.amount']; ?></th>
							            <th data-field="price" data-sortable="true"><?= $texts['OrderPage.price']; ?></th>
							            <th data-field="quantity" data-width="10" data-sortable="true"><?= $texts['OrderPage.quantity']; ?></th>
							        </tr>
						        </thead>
							</table>
							<p style="margin-top:20px;font-size: 16px;">
								<button class="btn btn-primary" id="sendOrderForm" type="submit">Update and Save</button>
								<span id="totalPriceHolder">
									<?= $texts['OrderPage.total']; ?> <span id="totalPrice">0</span> DKK
									
								</span>
							</p>
							<p id="orderSuccess"></p>
						</div>
					</form>
				</div>
			</div>
			<div class="row" style="margin-top:20px">
				<div class="col-lg-12">
					<p>
						<?= $texts['OrderPage.TermsAndConditions']; ?>
					</p>
					</div>
				</div>
			</div>
		</div>
	</section>

<div id="loadingBar" style="display:none">
<img src="img/loading.gif" id="loadingGif" alt="" />
</div>
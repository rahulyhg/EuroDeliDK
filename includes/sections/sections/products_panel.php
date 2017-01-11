
<?php
$products = [
'top' => [],
'new' => []
];
// if (isSet($_POST['getProducts']) && in_array($_POST['getProducts'], ['new','top'])) {
$query = $db->prepare("SELECT * FROM `promotions` WHERE `type` != '' ORDER BY `created` DESC LIMIT 5");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($result)>0) {
	foreach($result as $promo) {

		if ($promo['type'] == 'top') {
			$products['top'][] = $promo;
		} else if ($promo['type'] == 'new') {
			$products['new'][] = $promo;
		} else {
			$products['else'][] = $promo;
		}
	}
}

function showProducts($products, $type, &$languageSelected, &$texts) {
	$name = 'name_' . $languageSelected;
	$description = 'description_' . $languageSelected;
	$quantity = 'shop_1_quantity';

	if (is_array($products) && count($products) > 0) {
		$tempHtml = '
		<div id="'.$type.'Products" class="row list-group productsSlider">';
	
		foreach ($products as $promo) {
			$tempProduct = '
			<div class="item productItem">
				<img class="group list-group-image" src="' . $promo['image_link'] . '" alt="" />
				<div class="col-xs-12 col-md-12">
					<h4 class="group inner list-group-item-heading">
						' . $promo[$name] . '
					</h4>
					<p class="group inner list-group-item-text">
						' . $promo[$description] . ' 
					</p>
					<p>
						<span class="price-new list-group-item-heading">
							' . $texts['ProductsPanel.'.ucfirst($type).'.Price'] . '
							' . $promo['new_price'] . '
						 DKK
						</span>
					</p>
				</div>
			</div>';
			$tempHtml .= $tempProduct;
		}		
		$tempHtml .= '</div></div>';
	} else {
		$tempHtml = $texts['ProductsPanel.no_products'];
	} 
	return $tempHtml;
}


?>
<style>
.price-list-bar {
    border-radius: 10px;
    border: 1px solid #F47B2D;
    padding: 0;
}

.price-list-bar .input-group:first-of-type {
	width: 100%;
}

#productsPanel {
	background-color: white;
    border-radius: 10px;
    border: 1px solid #3a4287;
	position: fixed;
	top: 32%;
	height: auto;
	opacity: 0.6;
	width:300px;
	left: -280px;
	z-index: 12;
	padding: 0 1.5vw 1.5vw 1.5vw;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.show-panel {
	left: 20px !important;
	opacity: 1 !important;
}

.products-panel-button {
    text-align: right;
    font-size: 16px;
    color: #3a4287;
    font-weight: bold;
    opacity:0.6;
}

.products-panel-button:hover {
	cursor: pointer;
	opacity: 1;
}

#productsPanel p {
	
}
/*
#productsPanel {
	left:0;
}*/

.hidden-products {
	/*right: -200px !important;*/
}

#productsPanelButton {
	position: absolute;
	cursor: pointer;
	background-image: url('images/arrow_right.png');
    background-size: 100% 100%;
	top: 50px;
	height: 50px;
	width: 50px;
	left: 285px;
	z-index: 12;
	opacity:0.6;
}

#productsPanelTitle {
    position: absolute;
    top: 100px;
    left: 295px;
    font-size: 24px;
    background: white;
    z-index: 12;
    border-radius: 5px;
    border-color: white;
    padding: 5px;
    padding-left: 10px;
    line-height: 22px;
}

#productsPanel:hover #productsPanelButton {
	opacity: 1;
}

#productsPanel .input-group-addon {
    border-radius: 0px;
}

.products-panel-foldable {
	height: 0px;
	overflow: hidden;
}

.productItem {
	width: 140px !important;
	text-align: center;
}

.vertical-text {
	transform: rotate(90deg);
	transform-origin: left top 0;
}

@media (max-width: 992px) {
	#productsPanel {
		top: 20%;
	}
	#subscribePanel {
		top: 20%;
	}
}

</style>
<div id="productsPanel" class="hidden-products">
<img src="images/arrow_right.png" alt="" id="arrow-right" style="display:none"/>
<img src="images/arrow_left.png" alt="" id="arrow-left" style="display:none"/>
	<div class="row">
		<div class="col-md-12" class="products-panel-foldable" id="top-sellers">
			<h3><?= $texts['ProductsPanel.Top.Title']?></h3>
			<img class="img-thumbnail" src="<?= isSet($products['top'][0]) ? $products['top'][0]['image_link'] : 'http://placehold.it/100x150'?>" style="width: 110px;float: left;margin-right: 5px;" alt="<?= $texts['ProductsPanel.Top.Title']?>"/>
			<p class="products-panel-text">
				<?= $texts['ProductsPanel.Top.Text']?>
			</p>
			<p data-toggle="modal" class="products-panel-button" data-target="#myTopProductsModal">
				<?= $texts['ProductsPanel.Top.Button']?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" class="products-panel-foldable" id="new-products">
			<h3><?= $texts['ProductsPanel.New.Title']?></h3>
			<img class="img-thumbnail" src="<?= isSet($products['new'][0]) ? $products['new'][0]['image_link'] : 'http://placehold.it/100x150'?>" style="width: 110px;float: left;margin-right: 5px;" alt="<?= $texts['ProductsPanel.New.Title']?>"/>
			<p class="products-panel-text">
				<?= $texts['ProductsPanel.New.Text']?>
			</p>
			<p data-toggle="modal" class="products-panel-button" data-target="#myNewProductsModal">
				<?= $texts['ProductsPanel.New.Button']?>
			</p>
		</div>
	</div>
	<div id="productsPanelButton">
		&nbsp;
	</div>
	<div id="productsPanelTitle" class="">
		<?php

		$chars = str_split($texts['ProductsPanel.Title']);
		for($i = 0; $i < count($chars); $i++) {
			echo "$chars[$i]<br/>";
		}
		?>
	</div>
</div>

<!-- Top Products Modal -->
<div class="modal fade" id="myTopProductsModal" tabindex="-1" role="dialog" aria-labelledby="myTopProductsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="myTopProductsModalLabel"><?= $texts['ProductsPanel.Top.Title']?></h2>
      </div>
      <div class="modal-body">
      <?= showProducts($products['top'], 'top', $languageSelected, $texts);?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- New Products Modal -->
<div class="modal fade" id="myNewProductsModal" tabindex="-1" role="dialog" aria-labelledby="myNewProductsModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title" id="myModalLabel"><?= $texts['ProductsPanel.New.Title']?></h2>
      </div>
      <div class="modal-body">
      <?= showProducts($products['new'], 'new', $languageSelected, $texts);?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#productsPanelButton').click(function(ev) {
		if ($('#productsPanel').hasClass('hidden-products')) {
			$('#productsPanel').removeClass('hidden-products');
			$('#productsPanel').addClass('show-panel');
			$('#productsPanelButton').css({'background-image': 'url('+$('#arrow-left').prop('src')+')'});
		} else {
			$('#productsPanelButton').css({'background-image': 'url('+$('#arrow-right').prop('src')+')'});
			$('#productsPanel').addClass('hidden-products');
			$('#productsPanel').removeClass('show-panel');
			
		}
	})

	$('#productsPa').click(function(ev) {
		console.log($('#productsPanelButton').css('background-image'));
		if ($('#productsPanel').hasClass('hidden-products')) {
			$('#productsPanel').animate({
			    opacity: 1,
			    left: "26px"
			  }, 1000, function() {

				$('#productsPanelButton').css({'background-image': 'url('+$('#arrow-left').prop('src')+')'});
				$('#productsPanel').removeClass('hidden-products');
				$('#productsPanel').animate({
				    left: "20px",
				    opacity: 1
			    	// height: "400px"
				  }, 100, function() {
				  	/*$('#top-sellers').animate({
				    	height: "100px"
				  	}, 100);
				  	$('#new-products').animate({
				    	height: "100px"
				  	}, 100);*/
				});
			  });
		} else {
			$('#productsPanel').animate({
			    opacity: 0.6,
			    left: "-336px"
			  }, 1000, function() {
				$('#productsPanelButton').css({'background-image': 'url('+$('#arrow-right').prop('src')+')'});
				$('#productsPanel').addClass('hidden-products');
				$('#productsPanel').animate({
				    left: "-330px",
			    	//height: "200px"
				  }, 100, function() {
				  	/*$('#top-sellers').animate({
				    	height: "0px"
				  	}, 100);
				  	$('#new-products').animate({
				    	height: "0px"
				  	}, 100);*/
				});
		  	});
		}
	})
});
</script>
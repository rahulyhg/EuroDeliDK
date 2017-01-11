<?php
$stmt = $db->query('SELECT name, ' . $languageSelected . ' FROM texts ORDER BY `name` ASC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$texts = array();
foreach ($results as $id => $text) {
	$texts[$text['name']] = $text[$languageSelected];
}

$stmt = $db->query('SELECT * FROM countries ORDER BY `country_en` ASC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$countries = array();
foreach ($results as $country) {
	$countries[$country['lang']] = $country;
}

$stmt = $db->query('SELECT * FROM promotions ORDER BY `created` DESC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$promotions = array();
foreach ($results as $promotion) {
	if ($promotion['shop_1'] == 1) {
		$promotions['shop_1'][] = $promotion;
		/*$promotions['shop_2'][] = $promotion;
		$promotions['shop_3'][] = $promotion;
		$promotions['shop_4'][] = $promotion;*/
	}

	if ($promotion['shop_2'] == 1) {
		$promotions['shop_2'][] = $promotion;
	}

	if ($promotion['shop_3'] == 1) {
		$promotions['shop_3'][] = $promotion;
	}

	if ($promotion['shop_4'] == 1) {
		$promotions['shop_4'][] = $promotion;
	}
}

$shops = [
			[
				'shop_name' => 'Aaboulevard',
				'id' => 'shop_1',
				'image' => 'img/aaboulevard_1.jpg',
				'dataname' => 'Magazin1',
				'mapId' => 'aaboulevard-map',
				'promotionsId' => 'aaboulevard-products',
			],
			[
				'shop_name' => 'Taastrup',
				'id' => 'shop_2',
				'image' => 'img/taastrup_1.jpg',
				'dataname' => 'Magazin2',
				'mapId' => 'taastrup-map',
				'promotionsId' => 'taastrup-products',
			],
			[
				'shop_name' => 'Odense',
				'id' => 'shop_3',
				'image' => 'img/odense_1.jpg',
				'dataname' => 'Magazin3',
				'mapId' => 'odense-map',
				'promotionsId' => 'odense-products',
			],
			[
				'shop_name' => 'Ikast',
				'id' => 'shop_4',
				'image' => 'img/ikast_1.jpg',
				'dataname' => 'Magazin4',
				'mapId' => 'ikast-map',
				'promotionsId' => 'ikast-products',
			],
		];


function showPromotions($promotions, $shop, &$languageSelected, &$texts) {
	$name = 'name_' . $languageSelected;
	$description = 'description_' . $languageSelected;
	$quantity = $shop['id'] . '_quantity';
	$promotions = (isset($promotions[$shop['id']])) ? $promotions[$shop['id']] : false;
	$dd = date("Y-m-d");
	if (is_array($promotions) && count($promotions) > 0) {


		$tempHtml = '
		<div class="col-lg-12 shop-content-promotions">
				<h3>
					' . $texts['Shops.promotions'] . '
				</h3>
				<div id="' . $shop['promotionsId'] . '" class="row list-group promoslider">';
	
		foreach ($promotions as $promo) {
			if ($promo['shop_ids'] !== "" && $promo['shop_ids'] < $dd) {continue;}
			$tempHtml .= '
			<div class="item">
				<a href="' . $promo['image_link'] . '" data-featherlight="image">
					<img class="group list-group-image img-thumbnail" src="' . $promo['image_link'] . '" alt="" />
				</a>
				<div class="col-xs-12 col-md-12">
					<p>
						<span class="price-new list-group-item-heading">
						' . $texts['Shops.promotion.newprice'] . '	' . $promo['new_price'] . '
						</span>
					</p>
					<h4 class="group inner list-group-item-heading">
						' . substr($promo[$name],0,10) . '
					</h4>
					<p class="group inner list-group-item-text">
						' . $promo[$description] . ' 
					</p>
					<p>
						<span class="price-old">
						' . $texts['Shops.promotion.oldprice'] . ' 
							' . $promo['old_price'] . '
						 DKK
						</span>
					</p>
				</div>
			</div>';
		}		
		$tempHtml .= '</div></div>';
		return $tempHtml;
	} 
}


?>
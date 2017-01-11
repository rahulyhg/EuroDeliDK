<?php
$response = array(
	'success' => false,
	'message' => '',
	'body' => ''
);
if (isSet($_POST['pricelist'])) {
	$countrySelected = (strlen($_POST['pricelist']) == 2) ? strtolower($_POST['pricelist']) : false;
	include('../Language.php');
	include('../Database.php');
	include('../content.php');



	$pricelists = [
		'bg' => array(
			'active' => ($texts['Pricelist.BG'] == 1) ? true : false,
			'ean_start' => 10000
		),
		'ru' => array(
			'active' => ($texts['Pricelist.RU'] == 1) ? true : false,
			'ean_start' => 20000
		), 
		'lt' => array(
			'active' => ($texts['Pricelist.LT'] == 1) ? true : false,
			'ean_start' => 30000
		),
		'lv' => array(
			'active' => ($texts['Pricelist.LV'] == 1) ? true : false,
			'ean_start' => 40000
		),
		'ro' => array(
			'active' => ($texts['Pricelist.RO'] == 1) ? true : false,
			'ean_start' => 50000
		),
		'hu' => array(
			'active' => ($texts['Pricelist.HU'] == 1) ? true : false,
			'ean_start' => 60000
		),
		'pl' => array(
			'active' => ($texts['Pricelist.PL'] == 1) ? true : false,
			'ean_start' => 70000
		),
		'ua' => array(
			'active' => ($texts['Pricelist.UA'] == 1) ? true : false,
			'ean_start' => 80000
		),
	];
	if ($countrySelected && isSet($pricelists[$countrySelected]) && $pricelists[$countrySelected]['active'] && ($handle = fopen("../../pricelists/$countrySelected.csv", "r")) !== FALSE) {
		$ean = $pricelists[$countrySelected]['ean_start'];
		$products = array();
        while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
        	if (is_array($data) && count($data) >= 7) {
	            $product = array(
	     			"company" => $data[0],
	     			"name" => $data[1],
	     			"name_en" => $data[2],
	     			"amount" => $data[3],
	     			"price" => $data[4],
	     			"ean" => str_replace(' ', '', $data[5]),
	     			"category" => $data[6],
	     			"cat" => (isSet($data[7])) ? $data[7] : "",
	     			"country" => $countrySelected
	 			);
        		if (intval($product['ean']) == 0) {
        			$product['ean'] = $ean;
					$ean++;
        		}
        		if (!empty($data[6])) {
	            	$products[] = $product;
        			
        		}
        	}
        }
        fclose($handle);
        if (count($products) == 0) {
		    $product = array(
	 			"company" => $texts['OrderPage.empty'],
	 			"name" => $texts['OrderPage.empty'],
	 			"name_en" => $texts['OrderPage.empty'],
	 			"amount" => '',
	 			"price" => '',
	 			"ean" => '',
	 			"country" => $countrySelected
				);
	        $products[] = $product;
	    }
	    $response = array(
			'success' => true,
			'message' => '',
			'body' => json_encode($products)
		);
	} else {
		$response = array(
			'success' => false,
			'message' => 'Try again',
			'body' => ''
		);
	}
}

echo json_encode($response);
exit;



?>
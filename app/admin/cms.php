<?php
include("Database.php");
if (!$_SESSION['logged']) {
	logIt('Try to access CMS');
	header("Location: " . $web_root);
	die();
}

function getHistory(&$db, $item) {
	$query = $db->prepare("SELECT * FROM `history` WHERE `table` = :table AND `item_id` = :item_id ORDER BY created DESC");
	$query->bindParam(':table', $item['table']);
	$query->bindParam(':item_id', $item['item_id']);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

logIt('Entered CMS');
include("aru.php");
$user = $_SESSION['user'];


$count = [
	'promotions' => 0,
	'new_products' => 0,
	'top_products' => 0,
	'orders' => 0,
	'subscribers' => 0,
	'messages' => 0,
];


$sql = "SELECT `id`,`status` FROM `orders` WHERE status = 0"; 
$result = $db->prepare($sql); 
$result->execute(); 
$results = $result->fetchAll(PDO::FETCH_ASSOC); 

$count['orders'] = count($results);

$sql = "SELECT `id`,`type` FROM `promotions` WHERE type = '' "; 
$result = $db->prepare($sql); 
$result->execute(); 
$results = $result->fetchAll(PDO::FETCH_ASSOC); 
$count['promotions'] = count($results);

$sql = "SELECT `id` FROM `messages` "; 
$result = $db->prepare($sql); 
$result->execute(); 
$results = $result->fetchAll(PDO::FETCH_ASSOC); 
$count['messages'] = count($results);





$panels = [
	[ 
		'id' => 'orders',
		'include_name' => 'orders_list.php',
		'name' => "Orders",
		'account_type' => 2,
		'icon' => '<i class="material-icons" style="color:#0D47A1
">&#xE8A1;</i>',
		'count' => $count['orders']
	],
	[ 
		'id' => 'teksts',
		'include_name' => 'texts_panel.php',
		'name' => "Translations",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#4c8bf5">&#xE8E2;</i>',
		'count' => 0
	],
	[ 
		'id' => 'events',
		'include_name' => 'events_panel.php',
		'name' => "Events",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#D50000">&#xE878;</i>',
		'count' => 0
	],
	[ 
		'id' => 'promotions',
		'include_name' => 'promotions_panel.php',
		'name' => "Promotions",
		'account_type' => 2,
		'icon' => '<i class="material-icons" style="color:#FF9800">&#xE8CB;</i>',
		'count' => $count['promotions']
	],
	[ 
		'id' => 'new_products',
		'include_name' => 'new_products_panel.php',
		'name' => "Special Products",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#D50000">&#xE87D;</i>',
		'count' => 0
	],
	[ 
		'id' => 'top_products',
		'include_name' => 'top_products_panel.php',
		'name' => "Best Selling Products",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#FFD600">&#xE838;</i>',
		'count' => 0
	],
	[ 
		'id' => 'messages',
		'include_name' => 'messages_panel.php',
		'name' => "Messages",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#2E7D32">&#xE0E1;</i>',
		'count' => $count['messages']
	],
	[ 
		'id' => 'pricelist_subscribers',
		'include_name' => 'customers_panel.php',
		'name' => "Subscribers",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#FFD600">&#xE7FE;</i>',
		'count' => 0
	],
	[ 
		'id' => 'pricelists',
		'include_name' => 'pricelists_panel.php',
		'name' => "Update pricelist",
		'account_type' => 1,
		'icon' => '<i class="material-icons" style="color:#2E7D32">&#xE2C6;</i>',
		'count' => 0
	]
];

$sectionHeader =  '<h3>Dashboard</h3>';

$sectionBody = '<div class="row"><div class="col-lg-12 categories">';
foreach($panels as $panel) {
	if ($_SESSION['user']['type'] <= $panel['account_type']) {
		$sectionBody .= '
		<a href="cms.php?page=' .$panel['id']. '" class="">
			<div class="col-lg-4 col-xs-6 category-item">
			<div class="category-icon">
			' . $panel['icon'];

			if (isSet($panel['count']) && $panel['count']!=0) {
			$sectionBody .= '<span class="counter"> ' . $panel['count'] . '</span>';
			}
			$sectionBody .= '
			</div>
			<h4>
			' . $panel['name'] . '
			</h4>
			</div>
		</a>
		';
	}
}
$sectionBody .= '</div></div>';






$selectedPanel = null;
if (isSet($_GET['page'])) {
	foreach($panels as $panel) {
		if ($panel['id'] != $_GET['page']) {
			continue;
		} else {
			if ($_SESSION['user']['type'] <= $panel['account_type']) {		
				$selectedPanel = $panel;
				$sectionHeader =  '<h3>Dashboard > ' . $selectedPanel['name'] . '</h3>';
			}
		}
	}
}
/*
include('panels/promotions_panel.php'); 
				// include('panels/top_products_panel.php'); 
				
				if ($_SESSION['user']['type'] <= 1) {
					include('panels/teksts_panel.php');
					include('panels/orders_panel.php');
					include('panels/pricelist_subscribers_panel.php');
					include('panels/messages_panel.php'); 
				}*/
?>
<!doctype html>

<html lang="en">
<head>
	<?php include('includes/head.php'); ?>
	<style>
	.categories a {
		color:black;
	}
	.category-item {/*
		width:33%;
		display: inline-block;*/
		text-align: center;
		border-radius: 3px;
		height:250px;
	}
	.category-item:hover {
		background-color: #EEEEEE;
	}
	.category-item i {
		font-size: 10em;
		margin:auto;
		margin-top: 20px;
	}
	.category-item h3 {
		margin-bottom: 20px;
	}

 .counter {
    position:relative;
    top:-10px;
    left:-26px;
    font-size:14px;
    border-radius: 50%;
    background-color: red;
    color:black;
    min-width:30px;
    min-height:20px;
    display: inline-block;
    background-color: white;
    border: 1px solid black;
    padding:3px;
 }

 	.category-icon {
 		height:165px;
 	}
 	
 .ed-button {
    background: rgba(158,158,158,.2);
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 2px;
    color:white;
 }

 .ed-button:active {
    box-shadow: 0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12),0 2px 4px -1px rgba(0,0,0,.2);
    background-color: rgba(158,158,158,.4);
 }

 .ed-button:focus {
    outline: none;
 }

	</style>
</head>

<body>
	<div class="container" style="margin-top:100px;">
		<div class="row">
			<div class="cold-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<?php include('includes/header.php'); ?>
						</div>
						<div class="row">
							<div class="col-md-6">
							<?php

								echo $sectionHeader;	
							?>
								
							</div>
						</div>
					</div>
					<div class="panel-body">
						  
						<?php
							if ($selectedPanel) {
								include('includes/' . $selectedPanel['include_name']);
							} else {
								echo $sectionBody;
								
							}
						?>

					</div>
				</div>
				</div>
		</div>
	</div>
<?php 
if ($user['name']==="Aleksandar Aleksandrov") {
	include("includes/orderModal2.php");
} else {
	include("includes/orderModal.php");
}
include("includes/messageModal.php");
?>
</body>
</html>
<?php
$title = 'name_' . $languageSelected;
$description = 'description_' . $languageSelected;


$tempHtml = '';
$events = [
	[
		'image_link' => 'http://placehold.it/100x150',
		'description_en' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_dk' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_ru' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'name_en' => 'Title event 1',
		'name_dk' => 'Title event 1',
		'name_ru' => 'Title event 1',
		'date' => '12.03.2017',
		'link' => 'http://eurodeli.dk'
	],
	[
		'image_link' => 'http://placehold.it/100x150',
		'description_en' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_dk' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_ru' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'name_en' => 'Title event 2',
		'name_dk' => 'Title event 2',
		'name_ru' => 'Title event 2',
		'date' => '12.03.2017',
		'link' => 'http://eurodeli.dk'
	],
	[
		'image_link' => 'http://placehold.it/100x150',
		'description_en' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_dk' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_ru' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'name_en' => 'Title event 3',
		'name_dk' => 'Title event 3',
		'name_ru' => 'Title event 3',
		'date' => '12.03.2017',
		'link' => 'http://eurodeli.dk'
	],
	[
		'image_link' => 'http://placehold.it/100x150',
		'description_en' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_dk' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'description_ru' => 'Description very  not so long, but descriptive trying to describe and review the thing at hand over here.',
		'name_en' => 'Title event 4',
		'name_dk' => 'Title event 4',
		'name_ru' => 'Title event 4',
		'date' => '12.03.2017',
		'link' => 'http://eurodeli.dk'
	]
];

foreach ($events as $event) {
	$tempHtml .= '
	<div class="item event-item col-md-6">
		<div class="row">
			<div class="col-md-4">
				<img class="group list-group-image" src="' . $event['image_link'] . '" alt="" />
			</div>
			<div class="col-md-8">
				<h3 class="group inner list-group-item-heading">
					' . $event[$title] . '
				</h3>
				<p class="group inner list-group-item-text">
					' . $event['date'] . ' 
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="group inner list-group-item-text">
					' . $event[$description] . ' 
				</p>
				<p>
					<a href="' . $event['link'] . '" target="_blank">link...</a>
				</p>
			</div>
		</div>
	</div>';
}		

?>
<style type="text/css">
	.event-item {
		margin: 20px;
		background-color: white;
		border-radius: 10px;
		padding: 5px;
		text-align: center;
	    -webkit-box-shadow: 11px 10px 22px 0px rgba(153,153,153,1);
	    -moz-box-shadow: 11px 10px 22px 0px rgba(153,153,153,1);
	    box-shadow: 11px 10px 22px 0px rgba(153,153,153,1);
	}

	.event-item a {
		color: #4c53a2;
	}
</style>

<!-- Events Section -->
<section id="events">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 shop-content-header" style="height:auto;">
				<span class="shop-content-header-text">
					<h1><?= $texts['Events.title']; ?></h1>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p>
					<?= $texts['Events.description']; ?>
				</p>
				<div class="row eventslider">
					<?= $tempHtml ?>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>
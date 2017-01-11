<?php
// get all promotions
$stmt = $db->prepare('SELECT * FROM promotions WHERE `type`="event" ');
$stmt->execute();

$promotions = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $promotions[$row['id']] = $row;
    // $promotions[$row['id']]['country_dk'] = $countries[$row['country_id']]['country_dk'];
}
/*
function list_countries($countries, $id) {
	$ttt = '';
	foreach ($countries as $country) {
		$selected = '';
		if ($country['id'] === $id) {
			$selected = 'selected';
		}
		$ttt .= '<option ' . $selected . ' value=' . $country['id'] . '>' .$country['country_dk']. '</option>';
	};
	return $ttt;
}*/

$user = $_SESSION['user'];
// $user['type'] = 1;
if ($user['type'] > 1) {
	$userName = $user['name'];
} else {
	$userName = 'admin';
}
$promotionsHtml = '';
foreach ($promotions as $text) {
	$id = $text['id'];
	$checked = ($text['active']) ? ' checked ' : '';
	$shop_1_checked = ($text['shop_1']) ? ' checked ' : '';
	$shop_2_checked = ($text['shop_2']) ? ' checked ' : '';
	$shop_3_checked = ($text['shop_3']) ? ' checked ' : '';
	$shop_4_checked = ($text['shop_4']) ? ' checked ' : '';





	$promotionsHtml .= '<li class="list-group-item">
		<div class="row promotion-box" data-id="' . $id . '">
			<span class="col-xs-2 col-md-2 col-lg-2">
				<div class="panel panel-default">
					<div class="row">
						<span class="col-xs-12 col-md-12 col-lg-12">
							<img class="img-responsive image-preview" data-id=' . $id . ' src="' . $text['image_link'] . '" data-name="image_link" alt="" >
							<input type="file" name="image" data-id=' . $id . ' class="image-input" data-name="image" onchange="imageUpload(this)" />
							<!--<div class="input-group">
								<label for="active">Is active?</label>
								<span class="input-group-addon">
									<input type="checkbox" name="active" data-name="active" ' . $checked . ' aria-label="...">
								</span>
							</div>-->
						</span>
					</div>
				</div>
			</span>
			<span class="col-xs-8 col-md-8 col-lg-8">
				<div class="panel panel-default">
					<div class="row">
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="name_dk">Name DK</label>
							<div class="input-group">
								<textarea class="form-control" data-name="name_dk" name="name_dk" rows="3">' . $text['name_dk'] . '</textarea>
							</div>
						</span>
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="name_en">Name EN</label>
							<div class="input-group">
								<textarea class="form-control" data-name="name_en" name="name_en" rows="3">' . $text['name_en'] . '</textarea>
							</div>
						</span>
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="name_ru">Name RU</label>
							<div class="input-group">
								<textarea class="form-control" data-name="name_ru" name="name_ru" rows="3">' . $text['name_ru'] . '</textarea>
							</div>
						</span>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="row">
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="description_dk">Description DK</label>
							<div class="input-group">
								<textarea class="form-control" data-name="description_dk" name="description_dk" rows="3">' . $text['description_dk'] . '</textarea>
							</div>
						</span>
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="description_en">Description EN</label>
							<div class="input-group">
								<textarea class="form-control" data-name="description_en" name="description_en" rows="3">' . $text['description_en'] . '</textarea>
							</div>
						</span>
						<span class="col-xs-4 col-md-4 col-lg-4">
							<label for="description_ru">Description RU</label>
							<div class="input-group">
								<textarea class="form-control" data-name="description_ru" name="description_ru" rows="3">' . $text['description_ru'] . '</textarea>
							</div>
						</span>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="row">
						<span class="col-xs-3 col-md-3 col-lg-3">
							<label for="shop_ids">Date</label>
							<div class="input-group">
								<input type="date" class="form-control" value="' . $text['shop_ids'] . '" data-name="shop_ids" name="shop_ids"  placeholder="Date">
							</div>
						</span>
						<span class="col-xs-3 col-md-3 col-lg-3">
							<label for="new_price">Link</label>
							<div class="input-group">
								<input type="text" class="form-control" value="' . $text['new_price'] . '" data-name="new_price" name="new_price"  placeholder="Link">
								<input type="hidden"  value="event" data-name="type" name="type">
							
							</div>
						</span>
					</div>
				</div>
			</span>
			<span class="col-xs-2 col-md-2 col-lg-2 button-group">
				<button type="button" class="btn btn-success btn-update-promotion" data-id=' . $id . '>
					<i class="fa fa-floppy-o"></i>
				</button>
				';
				if ($userName == 'admin') {
					$promotionsHtml .= '
				<button type="button" class="btn btn-danger btn-remove-promotion" data-toggle="confirmation" data-href="cms.php/?remove=true&what=promotion&id=' . $id . '" data-id=' . $id . '>
					<i class="fa fa-trash-o"></i>
				</button>
					';
				}
				$promotionsHtml .= '
			</span>
		</div>
	</li>';
}
?>

<script>
function savePromotion() {
	var form = $('#newPromotion');
	var data = form.serializeArray();

	var dataObject = {};
	$.each(data, function(id,input) {
		if (dataObject[input.name] !== undefined) {
            if (!dataObject[input.name].push) {
                dataObject[input.name] = [dataObject[input.name]];
            }
            dataObject[input.name].push(input.value || '');
        } else {
            dataObject[input.name] = input.value || '';
        }
	})
	console.log(dataObject);
}
</script>



<ul class="list-group">
	<li class="list-group-item table-headers">
		<div class="row">
			<span class="col-xs-10 col-md-10 col-lg-10"><h4>Event (not working):</h4></span>
			<span class="col-xs-2 col-md-2 col-lg-2"><h4>Actions</h4></span>
		</div>
	</li>
</ul>
<ul class="list-group">
	<li class="list-group-item new-text-line new-promotion">
		<div class="row">
			<form action="#" id="newPromotion" enctype="multipart/form-data" method="post">
				<div class="col-md-2">
					<img class="img-responsive image-preview" onclick="imageClick()" id="image-preview" src="http://placehold.it/200x200" alt="" >
					<input type="file" name="image" data-id=0 class="image-input" data-name="image" onchange="imageUpload(this)" />
					<div class="input-group">
						<span class="input-group">
						<!-- <label for="active">Is active?</label>
							<input type="checkbox" name="active" data-name="active" aria-label="...">
						</span> -->
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="row">
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="name_dk">Title DK</label>
								<div class="input-group">
									<textarea class="form-control" data-name="name_dk" name="name_dk" rows="3"></textarea>
								</div>
							</span>
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="name_en">Title EN</label>
								<div class="input-group">
									<textarea class="form-control" data-name="name_en" name="name_en" rows="3"></textarea>
								</div>
							</span>
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="name_ru">Title RU</label>
								<div class="input-group">
									<textarea class="form-control" data-name="name_ru" name="name_ru" rows="3"></textarea>
								</div>
							</span>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="row">
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="description_dk">Description DK</label>
								<div class="input-group">
									<textarea class="form-control" data-name="description_dk" name="description_dk" rows="3"></textarea>
								</div>
							</span>
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="description_en">Description EN</label>
								<div class="input-group">
									<textarea class="form-control" data-name="description_en" name="description_en" rows="3"></textarea>
								</div>
							</span>
							<span class="col-xs-4 col-md-4 col-lg-4">
								<label for="description_ru">Description RU</label>
								<div class="input-group">
									<textarea class="form-control" data-name="description_ru" name="description_ru" rows="3"></textarea>
								</div>
							</span>
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="row">
							<span class="col-xs-3 col-md-3 col-lg-3">
								<label for="old_price">Date</label>
								<div class="input-group">
									<input type="date" class="form-control" data-name="shop_ids" name="shop_ids"  placeholder="Date">
								</div>
							</span>
							<span class="col-xs-3 col-md-3 col-lg-3">
								<label for="new_price">Link</label>
								<div class="input-group">
									<input type="text" class="form-control" data-name="new_price" name="new_price"  placeholder="Link">
									<input type="hidden"  value="event" data-name="type" name="type">
							
								</div>
							</span>
						</div>
					</div>
				</div>
				<span class="col-xs-2 col-md-2 col-lg-2 button-group">
					<button type="submit" class="btn btn-primary save-new-promotion">
						<i class="fa fa-plus"></i>
					</button>
				</span>
			</form>
		</div>
	</li>
</ul>
<ul class="list-group text-rows">
	<?= $promotionsHtml; ?>
</ul>

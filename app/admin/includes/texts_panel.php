<?php

$stmt = $db->query('SELECT * FROM texts ORDER BY `name` ASC');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$textsHtml = "";
$texts = array();
foreach ($results as $id => $text) {
	$texts[] = array(
		'id' => htmlspecialchars($text['id']),
		'name' => htmlspecialchars($text['name']),
		'dk' => htmlspecialchars($text['dk']),
		'en' => htmlspecialchars($text['en']),
		'ru' => htmlspecialchars($text['ru']),
	);
}
foreach ($texts as$text) {
	$id = $text['id'];
	$textsHtml .= '<li class="list-group-item">
	<div class="row text-box" data-id="' . $id . '">
				<span class="col-xs-4 col-md-4 col-lg-2"><h5>' . $text['name'] . '</h5></span>
				<span class="col-xs-2 col-md-2 col-lg-3">
					<div class="input-group">
						<textarea class="form-control" data-name="dk" rows="3">' . $text['dk'] . '</textarea>
					</div>
				</span>
				<span class="col-xs-2 col-md-2 col-lg-3">
					<div class="input-group">
						<textarea class="form-control" data-name="en" rows="3">' . $text['en'] . '</textarea>
					</div>
				</span>
				<span class="col-xs-2 col-md-2 col-lg-3">
					<div class="input-group">
						<textarea class="form-control" data-name="ru" rows="3">' . $text['ru'] . '</textarea>
					</div>
				</span>
				<span class="col-xs-2 col-md-2 col-lg-1 button-group">
					<button type="button" class="btn btn-success btn-update-text" data-id=' . $id . '>
						<i class="fa fa-floppy-o"></i>
					</button>
				</span>	
				</div></li>';
}
/*					<button type="button" class="btn btn-danger btn-remove-text" data-toggle="confirmation" data-href=' . $web_self . '/?remove=true&what=text&id=' . $id . ' data-id=' . $id . '>
						<i class="fa fa-trash-o"></i>
					</button>
					*/
//use $results
?>
			<ul class="list-group">
				<li class="list-group-item table-headers">
					<div class="row">
						<span class="col-xs-4 col-md-4 col-lg-2"><h4>Name:</h4></span>
						<span class="col-xs-2 col-md-2 col-lg-3"><h4>DK:</h4></span>
						<span class="col-xs-2 col-md-2 col-lg-3"><h4>EN:</h4></span>
						<span class="col-xs-2 col-md-2 col-lg-3"><h4>RU:</h4></span>
						<span class="col-xs-2 col-md-2 col-lg-1"><h4>Actions</h4></span>
					</div>
				</li>
			</ul>
			<ul class="list-group">
				<li class="list-group-item new-text-line">
					<div class="row">
						<form action="#" method="POST">
							<span class="col-xs-4 col-md-4 col-lg-2">
							<label for="name">New text name:</label>
								<input type="text" name="name" class="form-control" placeholder="Text name">
								<input type="hidden" name="add" value=true>
							</span>
							<span class="col-xs-2 col-md-2 col-lg-3">
								<textarea class="form-control" name="dk" rows="3">Dansk tekst...</textarea>
							</span>
							<span class="col-xs-2 col-md-2 col-lg-3">
								<textarea class="form-control" name="en" rows="3">English text...</textarea>
							</span>
							<span class="col-xs-2 col-md-2 col-lg-3">
								<textarea class="form-control" name="ru" rows="3">Русский текст... </textarea>
							</span>
							<span class="col-xs-2 col-md-2 col-lg-1 button-group">
								<button type="submit" class="btn btn-primary add-new-text">
									<i class="fa fa-plus"></i>
								</button>
							</span>
						</form>
					</div>
				</li>
			</ul>
			<ul class="list-group text-rows">
				<?= $textsHtml; ?>
			</ul>
<?php
session_start();

if (
	isSet($_FILES['pricelist']) 
	&& ($_FILES['pricelist']['size'] > 1024 && $_FILES['pricelist']['size'] < 1024000) 
	
	&& isSet($_POST['country']) 
	&& in_array($_POST['country'], ['bg','ro','ru','ua','pl','lt','lv','hu'])
	) {
	
	$path = "../../pricelists/";
	$pricelist_name = $_POST['country'];
	
	if (move_uploaded_file($_FILES['pricelist']['tmp_name'], "$path".$pricelist_name.".csv")) {
		
		$_SESSION['message'] = '<div class="alert alert-success">
									<strong>Success!</strong> ' . $pricelist_name . ' pricelist Updated Sucessfully.
								</div>';
	}
} else {
	$_SESSION['message'] = '<div class="alert alert-danger">
								<strong>Danger!</strong> Could not save the file, try again;
							</div>';
}

$redirect = $_SERVER["HTTP_REFERER"];
header('location: '.$redirect);

?>
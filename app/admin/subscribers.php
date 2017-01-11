<?php
include("Database.php");


if (isset($_GET['yes'])) {
	$stmt = $db->prepare('SELECT * FROM pricelist_subscribers ORDER BY created DESC');
	
} else {
	$stmt = $db->prepare('SELECT * FROM pricelist_subscribers ORDER BY created DESC');
	
}
$stmt->execute();

$customers = array();
while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
    $customers[] = $row;
}
/*
echo "<pre>";
var_dump($customers);
die();*/

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">

<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>

<!-- Latest compiled and minified Locales -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/locale/bootstrap-table-zh-CN.min.js"></script>
<style>
</style>
</head>
<body>

<?php

if (isset($_GET['only'])) {
	foreach($customers as $email) {
		if ($email['send_newsletter'] == "Yes") {
			echo $email['email'] . "<br/>";
		}
	}
}

?>


<table id="table">
 <thead>
        <tr>
            <th data-field="email" data-sortable="true">Email</th>
            <th data-field="send_newsletter" data-sortable="true">Newsletter</th>
            <th data-field="country" data-sortable="true">Country</th>
            <th data-field="shop" data-sortable="true">Region</th>
            <th data-field="created" data-sortable="true">Date</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
var emails = <?php echo json_encode($customers); ?>;
$(document).ready(function() {
	$('#table').bootstrapTable({

	    data: emails
	});
})
    
</script>
</body>
</html>


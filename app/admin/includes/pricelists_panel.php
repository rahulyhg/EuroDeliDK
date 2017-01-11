<?php
$pricelists = [
	'bg' => array(
		'ean_start' => 10000,
		'name'=> 'Bulgarian'
	),
	'hu' => array(
		'ean_start' => 60000,
		'name'=> 'Hungary'
	),
	'lv' => array(
		'ean_start' => 40000,
		'name'=> 'Latvia'
	),
	'lt' => array(
		'ean_start' => 30000,
		'name'=> 'Lithuania'
	),
	'pl' => array(
		'ean_start' => 70000,
		'name'=> 'Poland'
	),
	'ro' => array(
		'ean_start' => 50000,
		'name'=> 'Romania'
	),
	'ru' => array(
		'ean_start' => 20000,
		'name'=> 'Russian'
	), 
	'ua' => array(
		'ean_start' => 80000,
		'name'=> 'Ukraine'
	),
];
?>

<div class="col-lg-12">
<?php
if (isSet($_SESSION['message'])) {
	echo "<p>".$_SESSION['message']."</p>";
	unset($_SESSION['message']);
}
?>

<form action="upload-pricelist.php" method="POST" id="pricelist-upload" enctype="multipart/form-data">
<div class="input-group-btn">
<select class="form-control" name="country">
  <?php 
  foreach ($pricelists as $key => $value) {
  	echo '<option value="' . $key . '">' . $value['name'] . '</option>';
  	// echo '<li><a href="#">' . $key . '</a></li>';
  }
  ?>
</select>
</div>
<div class="col-lg-12" style="margin-top:30px;margin-bottom:30px;">
<label class="control-label">Browse...</label>
<input id="pricelist_input" name="pricelist" multiple type="file" class="file file-loading" data-allowed-file-extensions='["csv"]'>
</div><!-- /btn-group -->
<button type="submit" class="ed-button btn-submit" style="color:black" disabled name=Submit>Submit</button>
</form>

<script type="text/javascript">
var pricelist;
$(':file').change(function(){
    var file = this.files[0];
    var name = file.name;
    var size = file.size;
    var type = file.type;
    var patt1=/\.[csv]+$/i;
    console.log(type);

    if (name.match(patt1)) {
    	pricelist = file;
    	$(':submit').prop('disabled', false);
    } else {
    	alert('Please upload CSV only');
    	$(this).val('');
    	$(':submit').prop('disabled', true);
    }


    //Your validation
});/*
$(document).ready(function() {
	$(':submit').click(function(ev){
		var data= {
			'country' : $(':country').val(),
			'pricelist' : pricelist,
		}
		var url = "upload-pricelist.php";
		$.ajax({
		  type: "POST",
		  url: url,
		  data: data,
		  success: success,
		  dataType: ''
		});
		$.post('upload-pricelist.php', data, function() {

		})	    
	});
})*/
</script>

</div>
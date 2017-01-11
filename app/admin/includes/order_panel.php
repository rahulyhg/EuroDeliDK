<?php
# Open the File.
    if (($handle = fopen("lt_pricelist.csv", "r")) !== FALSE) {
        # Set the parent multidimensional array key to 0.
        $nn = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            # Count the total keys in the row.
            $c = count($data);
            # Populate the multidimensional array.
     		
     		$product = array(
     			"company" => $data[0],
     			"name" => $data[1],
     			"name_en" => $data[2],
     			"amount" => $data[3],
     			"price" => $data[4],
     			"ean" => $data[5]
 			);

            $lt_pricelist[$nn] = $product;
            $nn++;
        }
        # Close the File.
        fclose($handle);
    }
?>
<script>
var data = <?php echo json_encode($lt_pricelist); ?>;

$(function () {
    $('#productsList').bootstrapTable({
        data: data,
        onClickRow: function(row, $element) {
        	console.log(row);
        	var item = "<tr data-order-item=" + row + "><td class='remove'>X</td>" + $($element).html() + "<td><input type='text' class='quantity-field'></td></tr>";
        	$('.orderItems > .items').append(item);

		    $('.remove').click(function(ev) {
		    	$(this).parent().remove();
		    })
        }
    });

    $(".mybtn-top").click(function () {
        $('#productsList').bootstrapTable('scrollTo', 0);
    });
    
    $(".mybtn-btm").click(function () {
        $('#productsList').bootstrapTable('scrollTo', 'bottom');
    });

    $('.remove-all').click(function(ev) {
    	$(this).parents().find('.items').html('');
    })


});
</script>
<!-- 
<div class="form-inline">
    <button type="button" 
            class="btn btn-default mybtn-top">
        Scroll to top
    </button>
    <button type="button" 
            class="btn btn-default mybtn-btm">
        Scroll to bottom
    </button>
</div>
 -->
<table class="table orderItems">
	<p>
	Your order
	</p>
	<thead>
        <tr>
            <th data-field="company" data-sortable="true" class="remove-all">X</th>
            <th data-field="company" data-sortable="true">Company</th>
            <th data-field="name" data-sortable="true">Original Name</th>
            <th data-field="name_en" data-sortable="true">In English</th>
            <th data-field="amount" data-sortable="true">Amount</th>
            <th data-field="price" data-sortable="true">Price</th>
            <th data-field="ean" data-sortable="true">Ean</th>
            <th data-field="quantity" data-sortable="true">Quatity</th>
        </tr>
    </thead>
    <tbody class="items">
    	
    </tbody>

</table>

<div style="">
    <table id="productsList" data-search="true" data-show-columns="true" data-pagination="true" data-height="250">
        <thead>
            <tr>
                <th data-field="company" data-sortable="true">Company</th>
                <th data-field="name" data-sortable="true">Original Name</th>
                <th data-field="name_en" data-sortable="true">In English</th>
                <th data-field="amount" data-sortable="true">Amount</th>
                <th data-field="price" data-sortable="true">Price</th>
                <th data-field="ean" data-sortable="true">ean</th>
            </tr>
        </thead>
    </table>
</div>
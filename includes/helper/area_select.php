<span class="input-group-addon shops-select">
	<select novalidate class="selectpicker selectpicker-shops" id="subscribeShop" title="<?= $texts['Home.shops.text']; ?>">
		<?php
		$htmlAreas = "";
		for($i=1; $i<=10; $i++) {
			
		$htmlAreas .= '<option value="'. $texts['Area.'.$i] .'" title="'. $texts['Area.' . $i] . '">'. $texts['Area.' . $i] . '</option>';
		}
		echo $htmlAreas;
		?>
		
	</select>
</span>
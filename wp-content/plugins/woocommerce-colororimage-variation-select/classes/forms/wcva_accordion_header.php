<div class="accordion-header" data-action="accordion" style="position: relative;">
			  
	<div class="attribute-label" style="position: absolute; top: 10px; left: 10px; font-family:Sans-serif; font-size:14px; ">
	    <?php
			if ($woo_version <2.1) {
	            echo $woocommerce->attribute_label( $key );  
	        } else {
	            echo wc_attribute_label( $key );
	        }
		?>
    </div>
			    
	<div class="mainpreviewdiv" style="height: 25px; position: absolute top: 5px; right: 5px; margin-left:170px;">
		  
        <?php 
		    if (isset( $selected_type)) {
				switch($selected_type) {
				    case "global":
				        echo '<strong>'.__('Global Values','wcva').'</strong>';
				    break;
					
					case "none":
				        echo '<strong>'.__('Dropdown Select','wcva').'</strong>';
				    break;
				  
				    case "colororimage":
				        echo '<strong>'.__('Custom Color/Image Swatches','wcva').'</strong>';
				    break;
					                    
					case "variationimage":
					    if (sizeof($attributes) == 1) {
				        echo '<strong>'.__('Variation Images','wcva').'</strong>';
					    }
				    break;
			    } 
		    } 
		?>
	</div>
</div>
<div class="wcvametaupperdiv" style="<?php if (isset($_coloredvariables[$key]['display_type']) && ($_coloredvariables[$key]['display_type'] == 'none')) { echo 'display:none;'; } else { echo 'display:;'; } ?>">
		 
    <p class="form-field">
		<label for="_display_size">
		        <span class="wcvaformfield"><?php echo __('Display Size','wcva'); ?></span>
		</label>
			
		<select name="coloredvariables[<?php echo $key; ?>][size]">
	        <option value="small"  <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'small')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Small (32px * 32px)','wcva'); ?></span></option>
		    <option value="extrasmall" <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'extrasmall')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Extra Small (22px * 22px)','wcva'); ?></span></option>
		    <option value="medium" <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'medium')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Middle (40px * 40px)','wcva'); ?></span></option>
		    <option value="big" <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'big')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Big (60px * 60px)','wcva'); ?></span></option>
		    <option value="extrabig" <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'extrabig')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Extra Big (90px * 90px)','wcva'); ?></span></option>
			<option value="custom" <?php if (isset($_coloredvariables[$key]['size']) && ($_coloredvariables[$key]['size'] == 'custom')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Custom','wcva'); ?></span></option>
		        <?php echo apply_filters('wcva_custom_attribute_display_size', $key ); ?>
	    </select>
			
		<select name="coloredvariables[<?php echo $key; ?>][displaytype]">
	        <option value="square" <?php if (isset($_coloredvariables[$key]['displaytype']) && ($_coloredvariables[$key]['displaytype'] == 'square')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Square','wcva'); ?></span></option>
		    <option value="round" <?php if (isset($_coloredvariables[$key]['displaytype']) && ($_coloredvariables[$key]['displaytype'] == 'round')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Round','wcva'); ?></span></option>
		    <?php echo apply_filters('wcva_custom_attribute_display_displaytype', $key ); ?>
	    </select>

		<img class="help_tip wcva_help_tip" data-tip='<?php echo __('These fields does not apply to shop/archive swatches.To change swatch size on archive/shop pages visit WooCommerce/settings/WooSwatches tab.If you chose custom as display type, make sure you have defined custom swatches height,width into woocommerce/settings/WooSwatches tab. ','wcva'); ?>' src="<?php echo $helpimg; ?>" height="16" width="16">
	</p>
		 
	<p class="form-field">
		
		    <label for="_show_name">
		        <span class="wcvaformfield"><?php echo __('Show Attribute Name','wcva'); ?></span>
            </label>
	        
	        <select name="coloredvariables[<?php echo $key; ?>][show_name]" class="wcvadisplaytype">
	            <option value="no" <?php if (isset($_coloredvariables[$key]['show_name']) && ($_coloredvariables[$key]['show_name'] == 'no')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('No','wcva'); ?></span></option>
		        <option value="yes" <?php if (isset($_coloredvariables[$key]['show_name']) && ($_coloredvariables[$key]['show_name'] == 'yes')) { echo 'selected'; }?>><span class="wcvaformfield"><?php echo __('Yes','wcva'); ?></span></option>
		    </select>
            <img class="help_tip wcva_help_tip" data-tip='<?php echo __('This field does not apply to shop/archive swatches.','wcva'); ?>' src="<?php echo $helpimg; ?>" height="16" width="16">
	</p>
</div>
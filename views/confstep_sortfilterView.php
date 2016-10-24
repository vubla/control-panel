<?php
//@$errors = json_decode(base64_decode($_GET['e']), true);
$errors = $vars->errors;

if(is_array($errors)){
    foreach ($errors as $errMsg) {
        echo $errMsg . '<br />';  
    }
} else {
    echo $errors. '<br />';
}
    
?>
	<h1 class="line signup"><?php _e('Filter opplysninger','vubla');?></h1>

	<div class="center">
		<p>
			<?php _e('Vælg hvilke attributter, som dine besøgende skal kunne filtrere søgeresultatet efter.','vubla');?> 
			<?php _e('Vælg en filtertype nedenfor de attributter der ønskes vist.','vubla');?>
		</p>
		<div class="space"></div>

		<form action="<? echo LOGIN_URL.'/'; ?>" method="post">
			<table id="filter_sort" border="1" class="search-table">
				<tr>
					<th>Attributter</th>
         	   <?php if($vars->showRdisplay): ?><th><?php _e('Type'); ?></th><?php endif; ?>
         	   <?php if($vars->showSortable): ?><th><?php _e('Sorter'); ?></th><?php endif; ?>
			      <?php if($vars->showFilter): ?><th><?php _e('Filtertype'); ?></th><?php endif; ?>
				  	<?php if($vars->showImportancy): ?><th><?php _e('Vigtighed'); ?></th><?php endif; ?>
				</tr>
				<?php $i = 0; ?>
				<?php foreach($vars->settings as $setting) : ?>
		    	<?php 
		   		$style = '';
          
		    		if($vars->wType->id != 4 && in_array($setting->name, OptionsSetting::$NOT_MULTIVALUE_OPTIONS)){
		        		$style = ' style="display:none;" ';
            	}
            	?>
				<tr<?php echo $style; ?>>
					<td>
            		<input type="hidden"  name="name[<?php echo $i; ?>]" value= "<?php echo $setting->name; ?>" />
            		<b>
            		<?php
            			if($vars->wType->id == 4 ){ //Custom 
            	   		echo $setting->name; 
                		} else {
                  		echo Text::_($setting->name, 'optionsSettings');
               		} 
                	?>
            		</b>
					</td>
				
				 	<?php if($vars->showRdisplay) : ?>
        			<td>
            		<select name="r_display_identifier[<?php echo $i; ?>]">
            			<option value=""></option>
            			<?php foreach(OptionHandler::$r_display_identifiers as $val): ?>
            			<option value="<?php echo $val; ?>" <? echo ($val==$setting->r_display_identifier)? 'selected':null;?>><? echo Text::_($val, 'optionsSettings'); ?></option>
            			<?php endforeach; ?>
            		</select> 
        			</td>
        		  	<?php else: ?>
               	<input type="hidden"  name="r_display_identifier[<?php echo $i; ?>]" value="<?php echo $setting->r_display_identifier; ?>">
               <?php endif; ?>
        		
        		
        		
				  	<?php if($vars->showSortable) : ?>
					<td>
			
            		<select name="sortable[]">
            			<?php foreach(OptionHandler::$sortable_as as $val): ?>
            			<option value="<?php echo $val; ?>" <? echo (($val==$setting->sortable)? 'selected':null);?>><? echo Text::_($val, 'optionsSettings'); ?></option>
            			<?php endforeach; ?>
           			</select> 	
					</td>
					<?php else : ?>
       	      <input type="hidden"  name="sortable[<?php echo $i; ?>]" value="<?php echo $setting->sortable; ?>">
               <?php endif; ?>
                
           		<?php if($vars->showFilter): ?>
           	 	<td>
           	 		<select name="facet_type[<?php echo $i; ?>]">
            			<option value=""></option>
            			<?php foreach(OptionHandler::$facet_types as $val): ?>
            			<?php if(!$val) $val = ''; ?>
            			<option value="<?php echo $val; ?>" <? echo ($val==$setting->facet_type)? 'selected':null;?>><? echo Text::_($val, 'optionsSettings'); ?></option>
            			<?php endforeach; ?>
            		</select>
            	</td>
            	<?php else: ?>    
            		<input type="hidden"  name="facet_type[<?php echo $i; ?>]" value="<?php echo $setting->facet_type; ?>">
            	<?php endif; ?>
        		
					<?php if($vars->showImportancy) : ?>
					<td>	
						<select name="importancy[<?php echo $i; ?>]">
            		<?php foreach(array('0','1','2','3') as $val):   ?>
							<option value="<?php echo $val; ?>" <?php echo (($val==$setting->importancy)? 'selected="selected"':null); ?>><?php echo $val; ?></option>
						<?php endforeach; ?>
			     </td>
         	<?php else: ?>
            	<input type="hidden"  name="importancy[<?=$i?>]" value= "<?php echo $setting->importancy; ?>"/>
         	<?php endif; ?>
         	
				</tr>
				<?php $i++ ?>
				<?php endforeach; ?>
			</table>
			<div class="space"></div>
			
			<input type="hidden" name="controller" value="configuration" />
			<input type="hidden" name="task" value="next" />
			<input type="submit" name="submit" class="next <?php echo Language::get()->getIso() ?>" value="<?php _e('Videre'); ?>">
		
			<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage','vubla');?></a>
		</form>
	</div>

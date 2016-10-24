	<h1 class="line signup"><?php _e('Personlige Informationer','vubla');?></h1>

	<p class="center"><?php _e('Indtast venligst dine personlige oplysninger i felterne nedenfor. Vubla bruger disse som faktureringsoplysninger.','vubla');?></p>
	<div class="space"></div>
	
	<form id="settings-form" action="<?php echo LOGIN_URL; ?>/" method="post">

    	<input type="hidden" name="controller" value="configuration" />
	 	<input type="hidden" name="task" value="next" />
	 	<div id="fields-wrapper">
   	<?php
   
    	foreach($vars->personnalSettings as $setting) {
    		if($setting->name != 'city') echo '<div class="field">'."\n";
            
      	    echo '<label for="'.$setting->name.'">'.$setting->longName.'</label>';
            if($setting->type == 'select')
            {
                echo '<select name="'.$setting->name.'">';
                foreach ($setting->options as $value) {
                    $selected = '';
                    if($value->country_code == $setting->value) $selected = ' selected="selected" ';
                    echo '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
                }
                echo '</select>';
            }
            else
            {
       	        echo '<input type="'.$setting->type.'" name="'.$setting->name.'" value="'.$setting->value.'" />'."\n";
            }
     		if($setting->name != 'postal') echo '</div>'."\n";
		}
		?>
		</div>
   	<input type="submit" name="next" class="next <?php echo Language::get()->getIso() ?>" value="Videre" /><br />
	</form>
	<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage','vubla');?></a>

<h1 class="line"><?php _e('Indstillinger');?></h1>

<div class="fullcol last">
<?php if(isset( $vars->msg) && $vars->msg){ ?>
<div id="error_display">
<?php echo $vars->msg ?>
</div>
<?php } ?>

<h2><?php _e('Generelt');?></h2>
<form id="settings-form" action="<?php echo LOGIN_URL.'/settings'; ?>/" method="post">
	<table id="settings">
	<?php 
		foreach($vars->list as $setting){
			echo "<tr>\n";
			
			if($setting->type == 'checkbox'){
				$value = (($setting->value)? 'checked  value="1"': 'value="1"' ).' id="iButton" ' ;
				echo '<input type="hidden" name="'.$setting->name.'" value="0" />';
			} elseif($setting->type == 'select') {
				echo '<td class="setting-text">' . $setting->long_name .'</td>'.
					'<td class="setting">'.
						'<select name="'.$setting->name.'">';
						foreach($setting->possible_values as $key => $value) {
							$selected = '';
							if($setting->value == $key) {
								$selected = ' selected="selected"';
							}
							echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
						}
				echo '</select>'.
				'</td>'.
				'<td class="settings-description">' . $setting->description . "</td>\n".
				"</tr>\n";
				continue;
			} else {
				$value = 'value="'.$setting->value.'"';
			}
				
			echo '<td class="setting-text">' . $setting->long_name .'</td> <td class="setting"><input type="'.$setting->type.'" name="'.$setting->name.'" '.$value.' /></td> <td class="settings-description">'.$setting->description."</td>\n";
				
			echo "</tr>\n";
		}
	?>
	</table>
	<input type="hidden" name="controller" value="settings" />

	<input type="submit" name="submitSettings" class="save <?php echo Language::get()->getIso() ?>" value="<?php _e('Gem'); ?>" />
	<input type="submit" name="cancel" class="cancel <?php echo Language::get()->getIso() ?>" value="<?php _e('Annuller'); ?>" /><br />
	<br />
	<br />
	
		<h2><?php _e('Personlige Informationer');?></h2>
        <table>
        <?php
            foreach($vars->personnalSettings as $setting) {
                echo '<tr>';
                    echo '<td class="setting-text"> '.$setting->longName.' </td>';
                    echo '<td class="setting"><input type="'.$setting->type.'" name="'.$setting->name.'" value="'.$setting->value.'" /><td>';
                   	if($setting->description){
                    	echo '<td class="settings-description">'.$setting->description."</td>\n";
					} else {
						echo '<td></td>';
					}
                echo '</tr>';
            }
        ?>
        </table>

        <input type="submit" name="submitUserData" class="save <?php echo Language::get()->getIso() ?>" value="<?php _e('Gem'); ?>" />
        <input type="submit" name="cancel" class="cancel <?php echo Language::get()->getIso() ?>" value="<?php _e('Annuller'); ?>" /><br />
      <br />
	<br />
	<br />  
    </div>
    
	
	<div class="fourcol last boxes">
		<h2><?php _e('Afmeld Vubla');?></h2>
		<p>
			<?php _e('Tryk på linket nedenfor, hvis du vil afmelde Vubla. Når du bekræfter din opsigelse af Vubla på den følgende side, vil du ikke kunne logge ind efterfølgende.');?><br />
			<br />
			<a href="<?php echo $this->link('user','delete',null,true)?>"><?php _e('Afmeld');?></a>
		</p>
	</div>
	</form>

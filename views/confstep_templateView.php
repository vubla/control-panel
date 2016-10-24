		<h1 class="line signup"><?php _e('Vælg design');?></h1>
		
		<p class="center">
			<?php _e('Her kan du bestemme hvordan designet af søgeresultatet skal præsenteres på din webshop.');?>
		</p>
		<div class="space"></div>
		<h2><?php _e('Vubla design eller rådata');?></h2>
		<p>
			<?php _e('Vil du ikke bruge templates, så vælg JSON i 	drop-down-menuen.');?>
		</p>
		<select id="output_format">
		<?php
			$values = Settings::getPossibleValues('search_result_output_format');
			$current_value = Settings::get('search_result_output_format',$vars->wid);

			while($value = current($values)) {
				echo '<option value="' . key($values) . '"';
				
				if(key($values) == $current_value) { echo ' selected="selected" '; }
				
				echo '>';
				
				if($value == 'HTML') { echo 'Design fra Vubla'; } else { echo $value; }
				
				echo '</option>' . "\n";
				next($values);
			}
		?>
		</select>
		<div class="space"></div>
		<div id="template_view">
			<?php $refreshController = 'configuration'; $refreshTask = 'saveandstay'; include 'views/edittemplateView.php'; ?>
		</div>
		<div class="space"></div>
		
		<input type="hidden" name="task" value="next" />
		<input type="hidden" name="controller" value="configuration" />
		<input type="submit" class="next <?php echo Language::get()->getIso() ?>" name="next" value="<?php _e('Næste'); ?>" />
	</form>
	<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage');?></a>
 

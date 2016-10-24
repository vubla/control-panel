	<script language="JavaScript">
            function hardRefresh() {
                <?php if(isset($refreshController)) {?>
                $('input[name="controller"]').attr('value','<?php echo $refreshController?>');
                <?php } if(isset($refreshTask)) {?>
                $('input[name="task"]').attr('value','<?php echo $refreshTask?>');
                <?php } ?>
                $('form').append('<input type="hidden" name="dummy" value="dummy" />');
                $('form').submit();
            }
    </script>
	<h2><?php _e('Vælg template');?></h2>
	<?php
	
		foreach($vars->templates as $template) {
			echo '<img src="' . LOGIN_URL . '/images/thumb_'
			. preg_replace('/ /','_',strtolower($template->name)) . 
			'.png" alt="$template->name" class="set_template ';

			if(Template::isCurrentTemplate($template->id,$vars->wid)) { echo 'picked'; }
			echo '" id="' . $template->id . '" />';
		}
	?>
	<br />
	<br />
	<br />
	<div id="attributes">
		<h2><?php _e('Indstillinger');?></h2>
		<div id="template_preview">
			<?php echo Template::generatePreview($vars->wid); ?>		
		</div>
		<form method="post" action="<?php echo LOGIN_URL; ?>/">
			<?php
				if($vars->current_template == null) {
					echo __('Vælg en template ovenfor først.');
				}
				else {
					$attributes = $vars->current_attributes;
        			function setHardRefresh($name = '') {
        			    switch ($name) {
							case __('Kolonne Antal'):
							case __('More Info Button'):
								return 'onchange="hardRefresh()"';
								break;
							
							default:
								return '';
								break;
						}
        			}
					while($value = current($vars->template_attributes)) {
						
						$key = key($vars->template_attributes);
						echo '<b>' . Text::_($key) . "</b><br />";
						echo '<select class="change_value twocol" name="'.preg_replace('/\ /','_',key($vars->template_attributes)).'[]"'.setHardRefresh($key).'>';
						if(!is_array($value)) {
							echo '<option value="' . $value . '">' . Text::_($value) . '</option>';		
						}
						else {
							foreach($value as $thingy) {
								echo '<option value="' . $thingy . '"';
								if($attributes->$key == $thingy) { echo ' selected="selected"'; }
                                if(strpos($value, 'Color') !== FALSE) {
                                    echo ' style="color:'.$thingy;
                                    if($thingy == 'white') {
                                        echo ';background-color:lightgrey';
                                    }
                                    echo '"';
                                 }
								echo'>' . Text::_($thingy) . '</option>';	
							}
						}
						echo '</select><br /><br />';
						echo __('Eller indsæt værdi:').'<br /><input class="custom_value twocol" type="text" name="'.preg_replace('/\ /','_',key($vars->template_attributes)).'[]"';
						if(is_array($value) && !in_array($attributes->$key,$value)) { echo ' value="'.$attributes->$key.'"'; }
						else { echo ' value=""'; }
						echo ' /><br /><br /><br />';
						next($vars->template_attributes);
					}
				}
			?>
		</div>

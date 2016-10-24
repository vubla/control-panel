
<div id="wrapper">
	<div id="header"></div>
	
	<form action="<?php echo LOGIN_URL.'/'; ?>" method="post">
		<p>
			<?php _e('Indtast den adgangskode du &oslash;nsker at benytte til brugeren med e-mail');?> '<?php echo $vars->email?>' <?php _e('herunder:');?>
		</p>
		<input type="password" name="password" placeholder="<?php _e('Adgangskode'); ?>" /><br />
		<input type="password" name="password2" placeholder="<?php _e('Genindtast adgangskode') ?>" /><br />
		<input type="hidden" name="task" value="setpassword" />
		<input type="hidden" name="controller" value="user" />
		<input type="hidden" name="code" value="<?php echo $vars->code?>"/>
		<input type="hidden" name="email" value="<?php echo $vars->email?>"/>
		<input type="submit" class="<?php echo Language::get()->getIso() ?>" name="vubla_set" value="<?php _e('Nulstil'); ?>" />  
	</form>
	<div id="messages">
	<?php
		if(isset($_GET['error'])) {
			echo base64_decode($_GET['error']);
		}
		
		if(isset($vars->error)) {
			echo $vars->error;
		}
	?>
	</div>
</div>


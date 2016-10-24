	<h1 class="line signup"><?php _e('Tilmeld dig Vubla','vubla');?></h1>
	
	<div class="center">
		<p>
			<?php _e('Indtast e-mail og password nedenfor. Bruges også som dit log-in til Vubla. Allerede registreret?','vubla');?> <a href="<?php echo LOGIN_URL; ?>"><?php _e('Log-in her.','vubla');?></a>		
		</p>
		<?php $extra_to_url = (isset($vars->extra_to_url)?$vars->extra_to_url: Null);  ?>
		<div class="space"></div>
		<form method="post" action="<?php echo LOGIN_URL.'/'.$extra_to_url; ?>">
			<b><?php _e('E-mail:','vubla');?></b> 
			<input type="text" name="email" value="<?php echo isset($vars->email)? $vars->email : '' ?>" />
			<b><?php _e('Password:','vubla');?></b> 
			<input type="password" name="password" value="<?php echo isset($vars->password)? $vars->password : '' ?>"/>
			<div class="space"></div>
			<?php if(isset($vars->email) && (!isset($vars->notSignedUp) || !$vars->notSignedUp)) : ?>
			<input type="hidden" name="task" value="next" />
 			<input type="hidden" name="controller" value="configuration" />
			<?php else : ?>
			<input type="hidden" name="task" value="signupsave" />
			<input type="hidden" name="controller" value="user" />
			<?php endif; ?>
			<input type="submit" name="submit" class="next <?php echo Language::get()->getIso() ?>" value="<?php _e('Videre') ?>" />
		</form>
	</div>




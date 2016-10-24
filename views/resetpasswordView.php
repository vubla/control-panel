<div id="wrapper">
	<div id="header"></div>
	
	<form action="<?php echo LOGIN_URL.'/'; ?>" method="post">
		<p>
			<?php _e('Indtast emailen for den bruger du &oslash;nsker at nulstille kodeordet for.');?>
			
			<?php _e('Du skulle modtage en mail kort efter du denne formular er udfyldt, hvorfra kodeordet kan nulstilles.');?>
		</p>
		<input type="text" name="email" placeholder="E-mail" /><br />
		<input type="hidden" name="task" value="resetpassword" />
		<input type="hidden" name="controller" value="user" />
		<input type="submit" name="vubla_reset" class="<?php echo Language::get()->getIso() ?>" value="<?php _e('Nulstil') ?>" />  
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
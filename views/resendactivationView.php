<div id="wrapper">
	<div id="header"></div>
	
	<form action="<?php echo LOGIN_URL.'/'; ?>" method="post">
		<p>
			<?php _e('For at aktivere din bruger skal du klikke på det link du har modtaget i e-mail beskeden fra os.');?><br/>
			
			<?php _e('&Oslash;nsker du er få gensendt dit aktiveringslink til e-mailen herunder kan du trykke på Gensend knappen.');?>
		</p>
		<input type="hidden" name="email" value="<?php echo $vars->email?>" /><br />
		<input type="hidden" name="task" value="resendactivation" />
		<input type="hidden" name="controller" value="user" />
		<input type="submit" name="vubla_resend" class="resend <?php echo Language::get()->getIso() ?>" value="Gensend" />
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
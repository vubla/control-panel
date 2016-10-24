<?php
	if(isset($_POST['vubla_login'])) {
		$user = new User();
		$user->checkLogin($_POST,LOGIN_URL."/user/resendactivation?email=".$_POST['email']);
	}
    @$email = $_POST['email'];
?>

<div id="wrapper">
	<div id="header"></div>
	
	<form action="<?php echo LOGIN_URL.'/'; ?>" method="post">
		<p>
			<?php _e('Log ind på din Vubla med dit brugernavn og adgangskode.');?><br />
			<?php _e('Ikke medlem? Så prøv Vubla');?> <a href="http://www.vubla.dk/priser/"><?php _e('gratis i 30 dage');?></a>.
		</p>
		<input type="text" name="email" placeholder="E-mail" value="<?php echo $email ?>" /><br />
		<input type="password" name="password" placeholder="<?php _e('Adgangskode'); ?>" /><br />
		<!--<input type="checkbox" name="remember" /> Husk mig | --><a href="<? echo LOGIN_URL .'/user/signup'; ?>"><?php _e('Registrer');?></a> | <a href="<?php echo $this->link('user','resetpassword');?>"><?php _e('Nulstil kodeord');?></a>
		<input type="submit" name="vubla_login" class="<?php echo Language::get()->getIso() ?>" value="Login" /> 
		<!--<input type="submit" name="vubla_reset" value="NulstilPassword" /> -->
	</form>
	<div id="messages">
	<?php
		if(isset($vars->error)) {
			echo $vars->error;
		}
	?>
	</div>
</div>

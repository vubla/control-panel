<div id="wrapper">
	<div id="header"></div>
<?php 

if(isset($vars->error)){ 
?>
<p><?php _e('Der opstod en fejl: ');?><?php echo $vars->error; ?></p>
<?php } else { ?>
<p><?php _e('Din adgangskode er nu &aelig;ndret.');?></p>
<a href="<?php echo $this->link('user','login');?>"><?php _e('Klik her for at logge ind');?></a>
<?php
}

?>
</div>

<div id="container">
	<div id="header"></div>
<?php 

if(isset($vars->error)){ 
?>
<p><?php _e('An error occered. ');?><?php echo $vars->error; ?></p>
<?php } else { ?>
<p><?php _e('Your email is validated.');?></p>
<?php
}

?>
</div>

<div id="wrapper">
	<div id="header"></div>
<?php 

if(isset($vars->error)){ 
?>
<p><?php _e('En fejl er opst&aring;et: ');?><?php echo $vars->error; ?></p>
<?php } else { ?>
<p><?php _e('Du vil modtage en email inden for kort tid, hvorfra du kan nulstille dit kodeord.');?></p>
<a href="<?php echo $this->link('user','login');?>"><?php _e('Klik her for at logge ind');?></a>
<?php
}

?>
</div>

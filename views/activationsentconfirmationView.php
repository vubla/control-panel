<div id="wrapper">
	<div id="header"></div>
<?php 

if(isset($vars->error)){ 
?>
<p><?php _e('En fejl er opst&aring;et: ','vubla');?><?php echo $vars->error; ?></p>
<?php } else { ?>
<p><?php _e('Du vil modtage en email inden for kort tid, hvorfra du kan aktivere din Vubla bruger.','vubla');?></p>
<a href="<?php echo $this->link('user','login');?>"><?php _e('Klik her for at logge ind','vubla');?></a>
<?php
}

?>

</div>
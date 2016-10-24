	<?php
	$vars->additionalHeaderClasses = 'signup';
	include 'views/paymentView.php'; 
	?>

	<a class="prev <?php echo Language::get()->getIso() ?>" style="position: relative; top: 40px;" href="<?php $this->link('configuration','previous'); ?>"><?php _e('Tilbage','vubla');?></a>

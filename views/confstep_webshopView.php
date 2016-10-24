<?php
	$style = '';
	
	//if(!is_object($vars->current_type) ){
  // 	$style = 'style="display:none;"';
  // }
   
	//if(isset($vars->error)) echo $vars->error;
?>	
<!-- Google Code for Oprettelse af bruger Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1006869427;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "Nyp_CK3VmwUQs7eO4AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1006869427/?value=0&amp;label=Nyp_CK3VmwUQs7eO4AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript">

var fb_param = {};

fb_param.pixel_id = '6007480994944';

fb_param.value = '0.00';

(function(){

var fpw = document.createElement('script');

fpw.async = true;

fpw.src = '//connect.facebook.net/en_US/fp.js';

var ref = document.getElementsByTagName('script')[0];

ref.parentNode.insertBefore(fpw, ref);

})();

</script>

<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6007480994944&amp;value=0" /></noscript>
	<h1 class="line signup"><?php _e('Din Magento webshops URL');?></h1>
    
	<div class="center">
	
		<form method="post" action="<?php echo LOGIN_URL.'/'; ?>">
	
		 
			<div id="hostname_div">
				<br /><b><?php _e('Din Magento webshops URL:');?></b><br /><br /> <input type="text" name="hostname"  style="width:250px; height: 30px;" placeholder="www.example.com" value="<?php echo $vars->hostname; ?>">
				<input type="hidden" name="controller" value="configuration" />
    			<input type="hidden" name="task" value="next" />	
			</div>
			<br /><br />
			<p><?php _e('Hvis du ikke har downloadet og installeret modulet'); echo '<a target="_blank" href="http://www.vubla.'; if(Language::get()->getIso() == 'en') { echo 'com'; } else { echo 'dk';} ?>/download"> <?php _e('tryk her.'); ?></a></p>
			<input type="submit" name="submit" class="next <?php echo Language::get()->getIso() ?>" value="">
			<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage');?></a>
            
		</form>
	</div>

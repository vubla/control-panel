	
	<div class="center">
	
		
   <div style="visibility: hidden;" id="wid"><? echo $vars->wid; ?></div>
   <div style="visibility: hidden;" id="loginurl"><? echo LOGIN_URL; ?></div>
   	<div id="normal-content">
			<?php
                                switch($vars->wtype->id){
                                        case 1:
                                                break;
                                        case 2:
                        ?>
                        <div><p>
                        <?php _e('Indsæt nedenstående API nøgle i Vublas API bruger.');?> <a href="http://www.vubla.com/insert-api-key" target="_blank"> <?php _e('se guide her');?></a>.</p> <br />
                                <div id="magento_key"><?php echo Settings::get('mage_api_key',$vars->wid); ?></div>
                                <?php _e('Ovenstående er din magento api nøgle');?>
                        </div>
                        <?php
                                        break;
				}
			?>
			<div class="space"></div>
		
			 <div id="error_display" style="display:none;"></div>
			<div class="space">
  			
			
			<div>
	   		<div id="emailme-div">
      	 		
      	 	    <p><?php _e('Denne side opdateres automatisk når din webshop er klar. Du vil samtidig modtage en email.');?></p>
   	 		</div>
		      
		<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage');?></a>
		</div>
	</div>

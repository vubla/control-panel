<?php  
if( isset($_GET['q'])){
    $_POST['q'] = $_GET['q'];
}
?>	
	<h1 class="line signup"><?php _e('Prøv din søgemaskine','vubla');?></h1>

	<div class="center">
	
		<p>
			<?php _e('Nedenfor kan du prøve Vubla søgemaskinen. Du søger efter de produkter, der også findes i din webshop.','vubla');?>
			<?php _e('Du kan også gå videre, hvis du vil vente med dette.','vubla');?>
		</p>
		<p>
			<b><?php _e('Husk:</b> Prøv at søge efter ord med æ, ø eller å. ','vubla');?><a href="javascript:void(0);" id="change_encoding_a"><?php _e('Vises æ ø å forkert?','vubla');?></a>
		</p>
		
    	<div id="change_encoding_div" <?php if(!isset($_POST['display_encode'])){ echo 'style="display:none;"'; } ?>>
    		<?php _e('Hvis æ, ø eller å vises forkert i søgeresultatet nedenfor, så skyldes det, at den valgte "encoding" er forkert.','vubla');?>
    		<?php _e('Vælg en anden i drop-down-menuen og tryk "Ændre og søg". Det tager op til flere minutter, da vi skal','vubla');?>
    		<?php _e('hente alle produkter fra din webshop på ny - vent venligst.','vubla');?>
      	<?php
      		$sets = Settings::getPossibleValues('encode_from');
            $html = '<form><select id="encode_from" name="encode_from">';
            
            foreach ($sets as $key => $value) {
                $html .= '<option value="'.$key.'" '. ((Settings::getLocal('encode_from', $vars->wid) == $key)? 'selected=selected': null).'>'.$value.'</option>';
            }
            $html .= '</select><input id="change_layout" class="change-and-search <?php echo Language::get()->getIso() ?>" name="submit" type="button" value="'. __('Ændre og søg').'"></form>';
            echo $html;
			?>
   	</div>

		<div id="crawl" style="display:none;">
			<?php _e('Vi ændrer nu dine produkters encoding. Dette kan tage nogle minutter afhængigt af din webshops størrelse. Luk ikke browseren.','vubla');?><br />
			<br />
			<img src="<?php echo LOGIN_URL; ?>/images/ajax-loader.gif" alt="Loading..." />
		</div>    
    	<div class="space"></div>
    
    	<form method="post" accept-charset="utf-8" action="<?php $this->link(); ?>" id="search_form">
        <?php if(isset($_POST['display_encode'])){ ?>
            <input type="hidden" name="display_encode">
        <?php } ?>
        <input name="q" type="text" class="search-field" value="<?php echo isset($_POST['q'])? $_POST['q'] : ''; ?>"/> <input class="search <?php echo Language::get()->getIso() ?>" name="search_submit" type="submit" value="Søg"/>
    	</form>
      <div class="space"></div>
		<a class="prev <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/previous"><?php _e('Tilbage','vubla');?></a>
		<a class="next <?php echo Language::get()->getIso() ?>" href="<?php echo LOGIN_URL; ?>/configuration/next"><?php _e('Videre','vubla');?></a>
		
		<div class="clear space"></div>
		
	 	<div id="demo_view">
    	<?php 
    
        if(isset($_POST['search_submit']) || isset($_GET['q'])){
       
         $link = API_URL.'/search/?q='.urlencode($_POST['q']).'&return_host='.LOGIN_URL.'&host='.urlencode($vars->host).'&param=q&enable=1&getvar='.urlencode(json_encode($_GET)).'&postvar='.urlencode(json_encode($_POST));        
	  
            /*if(VUBLA_DEBUG){
                $username = 'searcher';
                $password = 'Trekant01';
                $context = stream_context_create(array(
                    'http' => array(
                        'header'  => "Authorization: Basic " . base64_encode("$username:$passwo rd")
                    )
                ));
                @$raw = file_get_contents($link, false, $context);
            
            } else {
      
                @$raw = file_get_contents($link);
            }*/
            
                $raw = file_get_contents($link);
            //echo '<a href="'.$link.'">fff</a>';
            //echo '</pre>';
            echo($raw);
        }
    	?>
    	</div>
	</div>
	<script type="text/javascript">
		jQuery(function() {
			vbl_client_host = '<?php echo ($vars->host); ?>';
         }(jQuery));
    </script>

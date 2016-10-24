<h1 class="line"><?php _e('Prøv Vubla');?></h1>
<?php 
if( isset($_GET['q'])){
    $_POST['q'] = $_GET['q'];
}
?>
<div class="fivecol">
	<h2><?php _e('Prøv din søgemaskine');?></h2>
	<p>
		<?php _e('Nedenfor kan du prøve Vubla søgemaskinen. Du søger efter de produkter, der også findes i din webshop');?>
	</p>
	<p>
		<?php _e('<b>Husk:</b> Prøv at søge efter ord med æ, ø eller å. Hvis produkter ikke vises korrekt, gå da til');?> <a href="<?php $this->link('settings'); ?>"><?php _e('Indstillinger');?></a> <?php _e('og ændre "Din Encoding"');?>.
	</p>
	
	<form method="post" accept-charset="utf-8" action="<?php $this->link('searchlayout', 'view'); ?>">
		<input name="q" type="text" class="search-field" value="<?php echo $_POST['q']; ?>"/> <input class="search <?php echo Language::get()->getIso() ?>" name="search_submit" type="submit" value="Søg"/>
	</form>

	<?php 
	
    	if(isset($_POST['search_submit']) || isset($_GET['q'])){

            $link = API_URL.'/search/?q='.urlencode($_POST['q']).'&return_host='.LOGIN_URL.'&file=/searchlayout/view&host='.urlencode($vars->host).'&param=q&enable=1&getvar='.urlencode(json_encode($_GET)).'&postvar='.urlencode(json_encode($_POST)).
                //These two are only used in debug mode, otherwise not necesary:
                ((defined('VUBLA_DEBUG') && VUBLA_DEBUG) ? '&ip='.urlencode($_SERVER['REMOTE_ADDR']) : '').
                ((defined('VUBLA_DEBUG') && VUBLA_DEBUG) ? '&useragent='.urlencode($_SERVER['HTTP_USER_AGENT']) : '');
            //echo $link;
            /*if(VUBLA_DEBUG){
                $username = 'searcher';
                $password = 'Trekant01';
                $context = stream_context_create(array(
                    'http' => array(
                        'header'  => "Authorization: Basic " . base64_encode("$username:$password")
                    )
                ));
                @$raw = file_get_contents($link, false, $context);
            
            } else {
      
                @$raw = file_get_contents($link);
            }*/
            
                @$raw = file_get_contents($link);
            //echo '<a href="'.$link.'">fff</a>';
            //echo '</pre>';
            if(defined('VUBLA_DEBUG') && VUBLA_DEBUG) {
             //   echo '<div>';
               // echo $link.'<br/>';
             //   echo urlencode(json_encode(array("memory"=>16))).'<br/>';
             //   echo '</div>';
            }
        //    echo $raw; 
		}
	?>
</div>

<div class="fivecol last">
	<h2><?php _e('Udseende');?></h2>
	<p>
		<?php _e('Her kan du ændre udseendet af søgeresultatet, lige fra teksttyper til farver.');?><br />
		<form method="post" action="<?php $this->link('searchlayout', 'edit'); ?>">
			<input type="submit" value="ændre udseende" class="change-style <?php echo Language::get()->getIso() ?>" />
		</form>
	</p>
</div>
<div class="fullcol">
	<br />
	 <?php echo $raw; ?>

</div>
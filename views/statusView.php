<h1 class="line">Status</h1>
<div class="fullcol last">
<div>
    
<?php if(isset($vars->error)) {echo $vars->error;} ?>
</div>
<?php if(!$vars->products) : ?>
<p>
	<?php _e('Vi har endnu ikke besøgt din webshop. ');?><br /><?php _e('Hvis din webshop ikke er besøgt inden for en time efter du har installeret modulet til din webshop skal du kontakte info@vubla.com.');?>
	<?php if($vars->isBeeingCrawled){ ?>
	   <br /> <?php _e('Lige nu bliver din webshop besøgt. Hvis vi ikke er færdig inden for et par timer bedes du kontakte info@vubla.com');?>
	
	<?php } ?>

</p>
<?php else : ?>

	<h2><?php _e('Sidst opdateret');?></h2>
	<p>
		<?php _e('Her kan du se hvornår Vubla sidst var forbi din webshop for at opdatere dine produkter.');?>
	</p>
	
		<table class="search-table"> 
	<tr> 
		<th class="left"><?php _e('Sidste besøg');?></th> 
		<th class="right"><?php _e('Næste planlagte besøg');?></th> 
		<th class="right"><?php _e('Besøg tidligere');?> </th> 
	</tr> 
	<tr> 
<td class="no-border"><?php echo $this->datetime($vars->lastcrawled) ?></td> 
<td class="no-border"><?php echo $this->datetime($vars->nextCrawl) ?> (+/- 1 time)</td> 
<td class="no-border"><form action="<?php echo $this->link('status','crawlprior');?>" method="post">
		<input type="submit" name="crawl" class="crawl <?php echo Language::get()->getIso() ?>" value="<?php _e('Besøg hurtigst muligt'); ?>" />
	</form></td>
	</tr> 
</table> 
	</div>
	<div class="fivecol">
	<h2><?php _e('Abonnement');?></h2>

	<p><?php _e('Du har <b>{%a}</b> produkter og du må maks have <b>{%b}</b> før du skal skifte til en større pakke.',array('a'=>$vars->products, 'b'=>$vars->max_products)); ?></p>
	<div id="progressbar"></div>
	<br />
	
	<?php 
	if($vars->paydate > 0 || $vars->hasTnum){
		if($vars->isTrial){ ?>
		   <?php _e('Du har {%days_left} dage tilbage af din gratis prøve periode.', array('days_left'=>ceil(($vars->paydate-time())/60/60/24)));?>
		   <?php _e('Din pakke koster <b>{%price}</b>.', array('price'=>($vars->next_price))); ?><br />
		<?php } 
       
		
		else { 
		 
		  _e('Næste betaling falder <b>{%date}</b> beløbet er <b>{%price}</b>.',array('date'=>$this->date($vars->paydate), 'price'=>$vars->next_price));
		  echo('<br />');
	   
		} 
		Text::_e('<br />');
    }  
    if($vars->paydate <= time() && $vars->isTrial && !$vars->hasTnum){ 
    	?><?php _e('Din prøve periode er udløbet.');?>   <br />
    		<form action="<?php  $this->link('payment'); ?>" method="post">
				<input type="submit" name="crawl" class="pay" value="<?php _e('Køb Vubla') ?>" />
			</form> 
    		<br />
 	 <?php
  
     }  
      if(!$vars->hasTnum) { // The vubla debug should be removed ?>
		<br /> <br />
		<h3><?php _e('Køb af vubla');?></h3>
		<?php _e('Hvis du ønsker at opgradere til en plan med flere produkter skal du betale for Vubla. Tryk "køb Vubla" nedenfor.');?><br />
    	<form action="<?php echo $this->link('payment');?>" method="post">
			<input type="submit" name="pay" class="pay <?php echo Language::get()->getIso() ?>" value="<?php _e('Køb vubla') ?>" />
		</form> <br />
   <?php
        } else { ?>
        <br /> <br />
        <h3><?php _e('New credit card');?></h3>
        <?php _e('Click on the button below to change your credit card.');?><br />
        <form action="<?php echo $this->link('payment');?>" method="post">
            <input type="submit" name="changecreditcard" class="changecreditcard" value="<?php _e('Køb vubla') ?>" />
        </form> <br />
        <?php
	   }
	
    if ($vars->webshop->pack_id != $vars->webshop->next_pack_id) {
    	if($vars->next_max_products <= $vars->products ){ ?>
    		<br /> <?php _e('<b>Vigtigt!</b> I næste måned skifter du til en pakke der gør at vi ikke kan finde alle dine produkter.');?> 
    		<br /> <?php _e('Vi anbefaler at du skifter til en større pakke.');?><br />
		<?php	
    	}
	}
    ?>
	 <br />
       <h2><?php _e('Pakke i næste måned');?></h2>
	 <? if($vars->products > $vars->max_products) { ?>
	<p><br />
		<b><?php _e('Vigtigt!</b> Du har i øjeblikket flere produkter på din webshop end din pakke tillader.');?><br/>
		
		<?php _e('Du bliver nød til at opgradere hvis du fortsat ønsker at benytte vubla fuldtud.');?><br />
	</p>
	<?php } elseif($vars->products*$vars->warnRatio > $vars->max_products) { ?>
	<p><br />
		<?php _e('Du er tæt på at overskride det maksimale antal produkter for din nuværende pakke.');?><br/>
		
		<?php _e('Overvej at opgradere din pakke til at tillade flere produkter med det samme for at undgå at nye produkter ikke kan findes med Vubla');?><br/>
		
	</p>
	<?php }?>
	   
	    <?
	    switch($vars->webshop->next_pack_id){
            case 1:
                $pack_name = __('Gratis');
                break;
            case 2:
                $pack_name = __('Mellem');
                break;
            case 3:
                $pack_name = __('Stor');
                
                break;
            default:
                $pack_name = __('Speciel');
             
            
	    } ?>
     	<?php _e('Din pakke i næste måned er: <b>{%pack_name}</b> Den tillader <b>{%max}</b> produkter.', array('pack_name'=>$pack_name, 'max'=>$vars->next_max_products));?> 
     	<br /> <?php _e('Hvis du ønsker at skifte pakke kan du vælge det herunder');?> <br />
		<form action="<?php  $this->link('payment','changepackage'); ?>" method="post">
			<?php 
			if($vars->webshop->next_pack_id != 1 && $vars->products <= $vars->products_small){ ?>
			<input type="submit" name="pack[1]" class="pack_small <?php echo Language::get()->getIso() ?>" value="<?php _e('Gratis') ?>" />
				<?php
			} 
			if($vars->webshop->next_pack_id != 2 && $vars->products <= $vars->products_medium){ ?>
				
			<input type="submit" name="pack[2]" class="pack_medium <?php echo Language::get()->getIso() ?>" value="<?php _e('Mellem') ?>" />
				<?php
	
			} 
			if($vars->webshop->next_pack_id != 3 && $vars->products <= $vars->products_medium){ ?>
			<input type="submit" name="pack[3]" class="pack_large <?php echo Language::get()->getIso() ?>" value="<?php _e('Speciel') ?>" />
				<?php
			} ?>
		
		</form> 
	<?php
     	 
    
    ?> 
</div>
</div>
<?php endif ?>
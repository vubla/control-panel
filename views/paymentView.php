<h1 class="line <?=$vars->additionalHeaderClasses?>"><?php _e('Betalingsoplysninger');?></h1>
<div class="fullcol last">

<p class="center"><?php _e('Din webshop indeholder');?> <?php echo $vars->products; ?> <?php _e('produkter. Din pakke koster derfor');?> <?php echo $vars->package_price; ?> <?php _e('DKK.');?></p>
	<div class="space"></div>
</div>
<div class="fivecol">
	<h2><?php _e('Binder vi os til noget?');?></h2>
	<p><?php _e('Nej. Vubla har ingen bindingsperiode. Vælger du at opsige dit abonnement trækker vi ikke yderligere penge, din konto er aktiv til næste betalingsdato.');?></p>
</div>	
<div class="fivecol last">
	<h2><?php _e('30 dages gratis prøveperiode');?></h2>
	<p>
		<?php _e('Alle kunder kan frit prøve Vubla i 30 dage - det koster altså 0 DKK de første 30 dage. Du kan frit annullere købet indenfor de første 30 dage.');?>
	</p>
</div>	
<form action="https://secure.quickpay.dk/form/" method="post">
    <input type="hidden" name="protocol" value="<?php echo $vars->pinfo->protocol ?>" />
    <input type="hidden" name="msgtype" value="<?php echo $vars->pinfo->msgtype ?>" />
    <input type="hidden" name="merchant" value="<?php echo $vars->pinfo->merchant ?>" />
    <input type="hidden" name="language" value="<?php echo $vars->pinfo->language ?>" />
    <input type="hidden" name="ordernumber" value="<?php echo $vars->pinfo->ordernumber ?>" />
    <input type="hidden" name="amount" value="<?php echo $vars->pinfo->amount ?>" />
    <input type="hidden" name="currency" value="<?php echo $vars->pinfo->currency ?>" />
    <input type="hidden" name="continueurl" value="<?php echo $vars->pinfo->continueurl ?>" />
    <input type="hidden" name="cancelurl" value="<?php echo $vars->pinfo->cancelurl ?>" />
    <input type="hidden" name="callbackurl" value="<?php echo $vars->pinfo->callbackurl ?>" />
    <input type="hidden" name="description" value="<?php echo $vars->pinfo->description ?>" />
    <input type="hidden" name="cardtypelock" value="<?php echo $vars->pinfo->cardtypelock ?>" />
    <input type="hidden" name="splitpayment" value="<?php echo $vars->pinfo->splitpayment ?>" />
    <input type="hidden" name="testmode" value="<?php echo $vars->pinfo->testmode ?>" />
    <input type="hidden" name="md5check" value="<?php echo $vars->pinfo->md5check ?>" />
    <input type="hidden" name="CUSTOM_wid" value="<?php echo $vars->pinfo->CUSTOM_wid ?>" />
    <div class="paymenticons">
		<div class="accept"><input type="checkbox" name="accept" id="acceptBox" value="" /> <?php _e('Acceptér');?> <a href="http://www.vubla.dk/conditions" target="_blank"><?php _e('betingelser og vilkår.');?></a></div>

	<img src="<?php echo LOGIN_URL; ?>/images/paymenticons.png" alt="" /><input onClick="return checkacc('<?php _e('Du skal acceptere betingelserne før du kan gå videre');?>');" type="submit" class="pay2 <?php echo Language::get()->getIso() ?>" value="Pay" /></div>
</form>

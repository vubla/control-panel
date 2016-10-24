<?php 

######### 
#
#
#
#########


class statusController extends BaseController {

    function standard(){
		$this->addJs('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');
		$this->addJs('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
		
        $this->addCss('stylesheets/jqueryuitheme.css');
        $this->view = 'status';
        
        
        
        
  
        $wid = User::getWid($_SESSION['uid']);
        $db = Vpdo::getVdo(DB_METADATA);
        
        $this->vars->lastcrawled = $db->fetchOne('select time from crawl_log where wid = ? order by time desc', array($wid));
        
        $stat = new WebshopStatisticsProvider($wid);
        $this->vars->products = $stat->getProductsCount(); 
       
        $this->vars->paydate = $db->fetchOne('select paydate from webshops where id = ?', array($wid));
        $this->vars->nextCrawl = $db->fetchOne('select last_updated + update_interval from crawllist where wid = ?', array($wid));
        $this->vars->max_products = $db->fetchOne('Select max_products from subscription_packages s inner join webshops w on s.id = w.pack_id where w.id = ?', array($wid));
        if(Payment::getCurrency($wid) == 'USD')
        {
            setlocale(LC_MONETARY, 'en_US');
        }
        $this->vars->price = Text::money(Payment::getPrice($wid));
        $this->vars->next_price = Text::money(Payment::getNextPrice($wid));
        $this->vars->next_max_products = $db->fetchOne('Select max_products from subscription_packages s inner join webshops w on s.id = w.next_pack_id where w.id = ?', array($wid));
       
	    $this->vars->products_small = $db->fetchOne('Select max_products from subscription_packages s inner join webshops w on s.id = 1');
        $this->vars->products_medium = $db->fetchOne('Select max_products from subscription_packages s inner join webshops w on s.id = 2');
        $this->vars->products_large = $db->fetchOne('Select max_products from subscription_packages s inner join webshops w on s.id = 3');
       
	    $percent =   $this->vars->products / $this->vars->max_products * 100;
        $this->addJs('js/progressbar.php?val='.ceil($percent));
	    $stm  = $db->prepare('select * from webshops where id = ?');
    	$stm->execute( array($wid));
        $this->vars->webshop = $stm->fetchObject();
        $stm->closeCursor();
        $this->vars->isTrial = Payment::isTrial($wid);
	    $this->vars->hasTnum = Payment::getTnum($wid) > 0 ? true : false; 
        $this->vars->warnRatio = Settings::get('package_warn_ratio');

    }
    
    function crawlprior(){
        
         $db = Vpdo::getVdo(DB_METADATA);
         $wid = User::getWid($_SESSION['uid']);
         $sql = 'update crawllist set scrape_asap = 1, email_me = 1 where wid = '.(int)$wid;
        if($db->exec($sql)){
           $this->view = 'success';
            $this->vars->error = __('Din webshop bliver besøgt indenfor en time. <br /> Du vil modtage en email når vi har besøgt din webshop.');
            $this->vars->continue = LOGIN_URL.'/status';
        } else {
            $this->view = 'error';
            $this->vars->error = __('Der skete en fejl');
            $this->vars->continue = LOGIN_URL.'/status';
        }
         
        
    }
    
   
}











?>

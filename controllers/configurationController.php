<?php



class ConfigurationController extends BaseController {
    
    private $error;
    
    function __construct(){
        parent::__construct();
        $this->layout = 'configuration';
    }
    
    function signupstep(){
        $this->vars->stepname = __FUNCTION__;;
        
        $this->vars->email = $_SESSION['email'];
        $this->layout = 'configuration';
        $this->view = 'confstep_signup';
  //      echo $_GET['e'];
        if( isset($_GET['e']) ) {
            $this->vars->errors[] = $_GET['e'];
        } 
        
        
    }
    
    function signupsave(){
       
         // this step is unfortunatly located in userController 
      
        $status = VublaFramework::$user->setEmail($_POST['email'],$_POST['password']);
        
        if($status !== true){
           
            $this->vars->errors[] = $status;
            return false;
        }
        
        return true; 
         
    }
    
    
    function templatestep(){ 
        $this->vars->stepname = __FUNCTION__;;
        $this->vars->wid = $this->getWid();
    	$this->addJs("js/configuration.php");
    	$this->addJs("js/template.php");
    	$this->vars->templates = Template::getTemplates();
    	if($this->vars->current_template = Template::getCurrentTemplate($this->vars->wid)) {
       	    $this->vars->current_template = $this->vars->current_template[0];
        	$this->vars->template_attributes = Template::getAttributes($this->vars->current_template->template_id);
		 	$this->vars->current_attributes = Template::getCurrentAttributes($this->vars->wid);	
    	 }
         $this->view = 'confstep_template';
         switch(WebshopDbManager::getCurrentType($this->getWid())->id){
            case 3:case 2:  // Presta dont use templates
                $this->skip();
                break;
            default:
               
        }
        
    }
    
    function templateset() {   	   
         if(isset($_GET['template'])) {
         	Template::setCurrentTemplate($_GET['template'],$this->getWid());
         }
         elseif(isset($_GET['output_format'])) {
         	Settings::setLocal('search_result_output_format',$_GET['output_format'],$this->getWid());
         }
    }
    
     function templatesave(){
			$attributes = array();
            
			array_pop($_POST);
			array_pop($_POST);
			array_pop($_POST);

			while($value = current($_POST)) {
				$key = preg_replace('/_/',' ',key($_POST));

				if($value[1] == '') { $attributes[$key] = $value[0]; }
				else { $attributes[$key] = $value[1]; }
					
				next($_POST);
			}      
			
        Template::setAttributes($this->getWid(),$attributes);
        
        return true;
    }
    
    
    
    
    function webshopstep(){
        $this->vars->stepname = __FUNCTION__;;
      
        $db = VPDO::getVdo(DB_METADATA);
        $this->view = 'confstep_webshop';
        $this->addJs("js/configuration.php");
        $this->vars->wid = $this->getWid(); 
        $this->vars->types = WebshopDbManager::getWebshopTypes();
        $this->vars->current_type = WebshopDbManager::getCurrentType($this->getWid());
        $this->vars->hostname = $db->fetchOne('select hostname from webshops where id = ?', array($this->getWid()));
       
    }
    
    
    function webshopsave(){
        $db = VPDO::getVdo(DB_METADATA);
        $url = strip_tags(preg_replace(array('/http:\/\//','/\/$/'),'',$_POST['hostname']));
        if($url == ''){
            $this->vars->errors[] = __('Der mangler et hostname.');
            return false;
        }
        if($db->fetchOne('select hostname from webshops where id = ?', array($this->getWid())) == $url){
           if($db->fetchOne('select type from webshops where id = ?', array($this->getWid())) < 1){
                 $this->vars->errors[] = __('Du skal vælge en webshop type.');
               return false;
           }
           return true;
        }
        
        try {
            $res = $db->exec('update webshops set hostname = '. $db->quote($url).' where id = '. $this->getWid());
        } catch(VublaException $e){
            error_log($e->getMessage());
            $this->vars->errors[] = __('Der mangler et hostname.');
        }
        if($res > 0){
  
            return true;   
        }
  
        return false;
    }
    
    
    function statusstep(){
       $this->vars->stepname = __FUNCTION__;;
       $this->view = 'confstep_status';
       $db = VPDO::getVdo(DB_PREFIX.$this->getWid());
       $db_meta = VPDO::getVdo(DB_METADATA);
       $this->addJs("js/statusView.js");
       if($db->fetchOne('select count(*) from products') < 1){
           $this->vars->wtype = WebshopDbManager::getCurrentType($this->getWid());
           $this->vars->wid = $this->getWid();
           $this->vars->currentlyBeingCrawled = $db_meta->fetchOne('select currentlybeingcrawled from crawllist where wid = '.$this->getWid());
           $this->vars->emailme = $db_meta->fetchOne('select email_me from crawllist where wid = ?', array($this->getWid()));
       } else {
         $this->skip();
       }
       
    }
    
    
    
    function statussave(){
        $db = VPDO::getVdo(DB_PREFIX.$this->getWid());
        if($db->fetchOne('select count(*) from products') >= 1){
            return true;
        } 
        return false;
    }
    
    
    

    function sortfilterstep(){
         $this->vars->stepname = __FUNCTION__;;
         $this->vars->wType = $wType = WebshopDbManager::getCurrentType($this->getWid());
         $this->vars->showFilter = true;  // Facet_type
         $this->vars->showImportancy = false;
         $this->vars->showRdisplay = false;
         $this->vars->showSortable = false;
         $this->vars->wid = $this->getWid(); 
        switch($wType->name){
            case 'oscommerce':
 
                break;
            case 'magento':
                 $this->skip(); return ;
                 
                break;
            case 'presta':
                $this->skip(); return ;
                
                break;
            default: 
                $this->vars->showSortable = true;
                $this->vars->showRdisplay = true;
                $this->vars->showImportancy = true;
                break;
                
        }
        $this->vars->errors = $this->error;  
        $this->view = 'confstep_sortfilter';   
        if(!isset($this->vars->settings)){
            $this->vars->settings = OptionHandler::createOptionsSettingSet($this->getWid());
        }
       
         
       
    }
    
    function sortfiltersave(){
        
     //   var_dump($_POST['sortable']);
 
         $data = array_map(NULL,$_POST['name'],$_POST['importancy'], $_POST['sortable'], $_POST['r_display_identifier'], $_POST['facet_type']); 
         $setset = OptionHandler::createOptionsSettingSet($this->getWid(), $data);
        
         if($setset->validate()){
            $setset->save();
             return true;
         } else {
             $this->error = $setset->errors;//json_encode($setset->errors); 
             $this->vars->settings = $setset;
             return false;
         }
       
    }
    
    
    
    function demostep(){
         $this->vars->stepname = __FUNCTION__;;
        $this->view = 'confstep_demo';
     //   $this->addJs("js/configuration.php");
        $this->vars->host = User::getHost($_SESSION['uid']); 
        $this->vars->wid = $this->getWid();  
        switch(WebshopDbManager::getCurrentType($this->getWid())->id){
            case 3:case 2:  // Presta dont use templates
                $this->skip();
                break;
            default:
               
        }   
    }
    
    function demosave(){
       return true;
           
    }
    
    
    
    function finalstep(){
         $this->vars->stepname = __FUNCTION__;;
      
        $this->view = 'confstep_final';
         
        $this->vars->personnalSettings = array();
     
        if(!isset($this->userData) || is_null($this->userData)){
            $data = VublaFramework::$user->getCustomerData($_SESSION['uid']);
        } else {
            $data = $this->userData;
        }
        // Bør bruge name
            $longNames = array(
            __("Fulde Navn"),
            //"E-mail",
            __("Telefon"),
            __("Virksomhed"),   
            __("Addresse"),
            "",
            __("Postnummer"),
           __("By"),
           __("Land")
            
           
        );
       
        $i = 0;
    
        foreach($data as $col => $val){
            $work = new stdClass();
            $work->name = $col;
            if($val === 0 || $val === '0'){ $val = null; } // Skal ændres i default værdien i DB.
            $work->value = $val;
            //$work->description = $descriptions[$i];
            $work->longName = $longNames[$i];
            $work->type = "text";
            if($col == 'country_id')
            {
                $work->type = "select";
                $work->options = VDO::meta()->getTableList('SELECT * FROM countries');
                if($work->value == 0)
                {
                    $lang = geoip_country_code_by_name($_SERVER['REMOTE_ADDR']);
                    $work->value = $lang;
                }
                else 
                {
                    foreach ($work->options as $option) 
                    {
                        if($work->value == $option->id)
                        {
                            $work->value = $option->country_code;
                            break;
                        }
                    }
                }
            }
            $this->vars->personnalSettings[] = clone $work;
            $work = null;
            $i++;
        }
        
        $stat = new WebshopStatisticsProvider($this->getWid());
        $this->vars->products = $stat->getProductsCount(); 
        $sql = 'select id, price from `subscription_packages`  where id < 4 and max_products > ? order by max_products asc limit 1';
        $db = VPDO::getVdo(DB_METADATA);
        list($this->vars->pack_id, $this->vars->package_price) = $db->getRowArray($sql, array($this->vars->products));  
        $stm =$db->prepare('update webshops set pack_id = ?, next_pack_id = ?  where id = ?');
        $stm->execute(array($this->vars->pack_id,$this->vars->pack_id,$this->getWid() ));
        $stm->closeCursor();
   //    var_dump($this->vars);
        $this->vars->errors = $this->error;
       
    }
    
    function finalsave(){
     
        if(($e = VublaFramework::$user->updateCustomerData($_SESSION['uid'],$_POST)) != ''){
            $this->error = $e; // We Json encode because this param is only string. 
            $list = array('name','phone','company','address','address2','postal','city', 'country');
            foreach ($list as $key ) {
                $this->userData[$key] = $_POST[$key];  
            } 
         
            return false;
      }
    
      return true;
        
    }
    
    
    function checkoutstep(){
      //  echo  $this->vars->stepname = __FUNCTION__;
      
         if(isset($_GET['task']) && $_GET['task'] == 'succes'){
            $this->view = 'success';
            $this->vars->error = __('Din tilmelding gik igennem vi trækker pengene ved næste betalingsdag.');
            $this->vars->continue =  LOGIN_URL.'/configuration/next';
        } else if(isset($_GET['task']) && $_GET['task'] == 'failure'){
            $this->view = 'error';
            $this->vars->error = __('Der skete en fejl i forbindelse med din betaling. Prøv igen eller kontakt info@vubla.com.');
            $this->vars->continue =  LOGIN_URL.'/';
   
        } else {
            $db = VPDO::getVdo(DB_METADATA);
            if($db->fetchOne('select transactionnum from webshops where id = ?', array($this->getWid()))){
                $this->skip();     
            }
            $this->view = 'confstep_checkout';
            $this->vars->pinfo = Payment::getFormInfo($this->getWid());
            $db = VPDO::getVdo(DB_METADATA);
           // $sql = 'select price from `subscription_packages` sp join `webshops` w on w.pack_id = sp.id where w.id = ? limit 1';
            //$this->vars->package_price = $db->fetchOne($sql,array($this->getWid()));
            $stat = new WebshopStatisticsProvider($this->getWid());
            $this->vars->products = $stat->getProductsCount();
			if($this->vars->products < 1){
				throw new VublaException("Webshop had no products, this is likely a programming fault. <br/>".print_r($this,true), 1);
				
			}
			$package = WebshopDbManager::getPackageFromProducts($this->vars->products);  
        	$stm = $db->prepare('update webshops set pack_id = ?, next_pack_id = ?  where id = ?');
     	    $stm->execute(array($package->id,$package->id,$this->getWid() ));
            $stm->closeCursor();
       	 	$this->vars->pack_id = $package->id;
    	    $this->vars->package_price = $package->price;
            if($package->price == 0)
            {
                $db->exec('update  customers set on_config = 0 where id = '.(int) $_SESSION['uid']);
                $this->skip();     
            }
        }
		
	    $this->vars->stepname = __FUNCTION__;
        $this->addJs("js/checkout.js");
		
	
    }
    
    function checkoutsave(){
        $db = VPDO::getVdo(DB_METADATA);
      
         $stat = new WebshopStatisticsProvider($this->getWid());
        if($db->fetchOne('select transactionnum from webshops where id = ?', array($this->getWid()))
         or 
           WebshopDbManager::getPackageFromProducts($stat->getProductsCount())->price  == 0
            ){
          return true;     
        } else {
          return false;
        }
       
    }
    
    function donestep(){
         $this->vars->stepname ==  $this->vars->stepnameION__;
        $db = VPDO::getVdo(DB_METADATA);
        $db->exec('update  customers set on_config = 0 where id = '.(int) $_SESSION['uid']);
        $this->redirect();
    }
    
    function donesave(){
        $this->donestep();
    }
    
    function next(){
         $db = VPDO::getVdo(DB_METADATA);
         $q = 'select * from 
                                        configuration_steps 
                                    where id =
                                        ( select 
                                            (conf_steps_id + 1) as iddd
                                        from  
                                            configuration_progress cp
                                        where 
                                            uid = ? 
                                        order by 
                                            cp.id desc limit 1 )' ;
        $stm = $db->prepare($q);  
        $stm->execute( array($_SESSION['uid']));
        $currentstep = $stm->fetchObject(); 
        $stm->closeCursor();    
        
        $stm = $db->prepare('select * from 
                                        configuration_steps 
                                    where id =
                                        ( select 
                                            (conf_steps_id) as iddd
                                        from  
                                            configuration_progress cp
                                        where 
                                            uid = ? 
                                        order by 
                                            cp.id desc limit 1 )');  
        $stm->execute( array($_SESSION['uid']));
        $previousstep = $stm->fetchObject();   
        $stm->closeCursor();  
    
        $method = $currentstep->name.'step';
        $savemethod = $previousstep->name.'save';
        $prevmethod = $previousstep->name.'step';
        $this->vars->task = $method;     
        if($this->$savemethod()){
            $db->exec('insert into configuration_progress (uid, conf_steps_id, start) values ('.(int) $_SESSION['uid'].','.($currentstep->id).','.time().')');
            $q = 'update  configuration_progress set finish = '.time().' where uid = '.(int) $_SESSION['uid'].' and conf_steps_id = '. ($currentstep->id - 1).' order by id desc limit 1 ';              
            $db->exec($q);
            if(!isset($_GET['task'])){
                $this->$method();
            }
           
        } else {
            if(!isset($_GET['task'])){
                $this->$prevmethod();
            }
        }
/*
        $param = '';
        if(!is_null($this->error)){
            $param = '?e='.base64_encode($this->error);
        } 
 * *
 */
        if(isset($_GET['task'])){
             $this->redirect(null,null,LOGIN_URL,$param);
        }
    }

    function saveandstay() {
        $db = VPDO::getVdo(DB_METADATA);  
        
        $stm = $db->prepare('select * from 
                                        configuration_steps 
                                    where id =
                                        ( select 
                                            (conf_steps_id) as iddd
                                        from  
                                            configuration_progress cp
                                        where 
                                            uid = ? 
                                        order by 
                                            cp.id desc limit 1 )');  
        $stm->execute( array($_SESSION['uid']));
        $previousstep = $stm->fetchObject(); 
        $stm->closeCursor();    
    
        $savemethod = $previousstep->name.'save';
        $prevmethod = $previousstep->name.'step';
        $this->vars->task = $prevmethod;     
        $this->$savemethod(); 
        if(!isset($_GET['task'])){
            $this->$prevmethod();
        } else {
            $this->redirect(null,null,LOGIN_URL,$param);
        }
    }
        
        
    function previous(){
       
         $db = VPDO::getVdo(DB_METADATA);
         $stm = $db->prepare('select * from 
                                        configuration_steps 
                                    where id =
                                        ( select 
                                            (conf_steps_id -1) as iddd
                                        from  
                                            configuration_progress cp
                                        where 
                                            uid = ? 
                                        order by 
                                            cp.id desc limit 1 )');  
        $stm->execute( array($_SESSION['uid']));
        $currentstep = $stm->fetchObject();   
        $stm->closeCursor();  

        $method = $currentstep->name.'step';
        $this->vars->task = $method;       
        if($currentstep->id < 1){
            return false;
        }
        $db->exec('insert into configuration_progress (uid, conf_steps_id, start) values ('.(int) $_SESSION['uid'].','.($currentstep->id).','.time().')');
       // echo $q = 'update  configuration_progress set finish = '.time().' where uid = '.(int) $_SESSION['uid'].' and conf_steps_id = '. $currentstep->conf_steps_id;              
          //  $db->exec($q);
       
        $this->redirect();
        
       
        
      
    }
    function crawl(){
       
        $c = new ScrapeHandler($this->getWid()); 
        $this->view = 'none';
        try 
        {
            $result = $c->startSafeScraping();
            echo 'true';
        } 
        catch (NoConnectionException $e)
        {
            echo Text::_('no_connection','scrape'); 
        }
        catch (MagentoLoginException $e)
        {
            echo Text::_('failed_magento_login','scrape'); 
        }
        catch (AlreadyScrapingException $e)
        {
            echo Text::_('already_crawling','scrape'); 
        }
        catch (MissingWsdlException $e)
        {
            echo Text::_('missing_wsdl','scrape');
        }
         catch (NoScrapeFileException $e)
        {
            echo Text::_('missing_scrape_file','scrape');
        }
        catch (ScrapeException $e)
        {
            echo Text::_('error','scrape'); 
        }
        if(isset($e) && defined('VUBLA_DEBUG') && VUBLA_DEBUG)
        {
            var_dump($e);
        }
    
        
      
        
    }

      function logout(){
        VublaFramework::$user->_logout();
        exit();
        $this->redirect();
        
    }
    
    
    function getsetwebshoptype(){
       if(WebshopDbManager::setWebshopType(User::getWid($_SESSION['uid']), $_GET['id'])){
          if($_GET['id'] == 'oscommerce' ||$_GET['id'] == 1)  { 
             Settings::setLocal('encode_from', 'ISO-8859-1', User::getWid($_SESSION['uid']));    
        // For some reason osCommerce works with UTF-8
        // Not for me :( 
          }
          if($_GET['id'] == 'magento' ||$_GET['id'] == 2)  { 
             Settings::setLocal('encode_from', 'UTF-8', User::getWid($_SESSION['uid'])); 
             Settings::setLocal('api_out', '1', User::getWid($_SESSION['uid']));    
        // For some reason osCommerce works with UTF-8
        // Not for me :( 
          }
          echo 'good'; exit; // JavaScript encoded answer
       }
       echo 'bad'; exit; // JavaScript encoded answer
    }

    function changeencoding(){
       Settings::setLocal('encode_from', $_GET['id'], User::getWid($_SESSION['uid']));
    
   }
    
    function iscrawled(){
          $db = VPDO::getVdo(DB_PREFIX.$this->getWid());
         if($db->fetchOne('select count(*) from products') < 1){
           echo "Nothing";
       } else {
         echo 'okay';
       }
       exit;
   }
    
    
    function emailme(){
        $db = VPDO::getVdo(DB_METADATA);
        $db->exec('update crawllist set email_me = 1 where wid = '.$this->getWid());  
   }       
        
       
    
    private function skip(){
        $db = VPDO::getVdo(DB_METADATA);
       
        $thetwo= $db->getTableList('select * from configuration_progress where uid = ? order by id desc limit 2','stdClass', array($_SESSION['uid']));
 
     //   var_dump($thetwo);  
      //  echo $thetwo[1]['conf_steps_id']; exit;
        if($thetwo[0]->conf_steps_id < $thetwo[1]->conf_steps_id){
            $this->previous();
        } else {
            $this->next();
        }
    }
    
}




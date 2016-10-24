<?php
/**
 * This controller is the default controller,
 * Do not add any methods to it. This controller is special since it takes care of login.
 * 
 */ 
class defaultController extends BaseController {

    function standard(){
        parent::standard();
        $db = vpdo::getVdo(DB_METADATA);
        $wid = VublaFramework::$user->wid();
        $this->vars->hasbeencrawled = $db->fetchOne('select products from crawl_log where wid = ? order by time desc limit 1', array($wid)) > 0;
        
        /// Remove below when the proper view has been made
        //if($this->vars->hasbeencrawled){
           $this->redirect('statistics');
       // }
   }
    
    
  

}
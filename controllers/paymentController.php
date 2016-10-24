<?php 
class paymentController extends BaseController {
 
    function standard(){
        $this->view = 'payment';
        $this->vars->pinfo = Payment::getFormInfo($this->getWid());
        
    }
    
    function succes(){
        $this->view = 'success';
	    $this->vars->error =  __('Din tilmelding gik igennem vi trækker pengene ved næste betalingsdag.');
	    $this->vars->continue =  LOGIN_URL.'/';
    }
    
     function failure(){
        $this->view = 'error';
	    $this->vars->error =  __('Der skete en fejl i forbindelse med din betaling. Prøv igen eller kontakt info@vubla.com.');
	    $this->vars->continue =  LOGIN_URL.'/';
    }
	 
	 function changepackage(){
	 	foreach ($_POST['pack'] as $key => $value) {
			 $pack_id = $key;
		 }
		if(Payment::setNextPackId($key, $this->getWid())){
        	$this->view = 'success';
 	    	$this->vars->error =  __('Du har nu skiftet pakke.');
 	    	$this->vars->continue =  LOGIN_URL.'/status';	
		} else {
			$this->view = 'error';
 	    	$this->vars->error = __('Din pakke blev ikke skiftet. Dette skyldtes formentligt at du kun må skifte din pakke en gang. Kontakt info@vubla.com hvis du har brug for hjælp.');
 	    	$this->vars->continue =  LOGIN_URL.'/status';	
		}
    }
  
  
}
?>
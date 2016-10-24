<?php
//var_dump($_POST);
class searchlayoutController extends BaseController {
	
	 function __construct() {
	     $this->vars->host = User::getHost($_SESSION['uid']);  
		  $this->vars->wid = User::getWid($_SESSION['uid']);
		  $this->addJs('js/template.php');
	 }
	
    function view(){
        $this->view = 'viewsearchlayout';
    }
    
    function edit(){    
 
        if(isset($_POST['save_attributes'])) {
				$attributes = array();
				
				array_pop($_POST);
				while($value = current($_POST)) {
					$key = preg_replace('/_/',' ',key($_POST));

					if($value[1] == '') { $attributes[$key] = $value[0]; }
					else { $attributes[$key] = $value[1]; }
					
					next($_POST);
				}

        		Template::setAttributes($this->vars->wid,$attributes);
        }
            
        $this->vars->templates = Template::getTemplates();
        $this->vars->current_template = Template::getCurrentTemplate($this->vars->wid);
        $this->vars->current_template = $this->vars->current_template[0];
        $this->vars->template_attributes = Template::getAttributes($this->vars->current_template->template_id);
		  $this->vars->current_attributes = Template::getCurrentAttributes($this->vars->wid);
		  $this->view = 'editsearchlayout';        
    }
    
    function templateset() {   	   
    		if(isset($_GET['template'])) {
         	Template::setCurrentTemplate($_GET['template'],$this->getWid());
         }
    }
    

}

class TestSearch extends Searcher {

    function getLayout($type = 0){
        if($type == 0){
            return $_POST['layout'];
        } else {
            return $_POST['emptylayout'];
        }
    
    }
}

?>
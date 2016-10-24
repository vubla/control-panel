<?php

class userdefinedkeywordsController extends BaseController {

    function standard(){
        $wid = User::getWid($_SESSION['uid']);
        $this->vars->keywords = UserDefinedKeyword::getAllUserDefinedKeywords($wid);
        foreach ($this->vars->keywords  as $keyword) {
            $keyword->words = implode(',',$keyword->words);
        }
        
        $this->view = 'userdefinedkeywordsindex';
    }
    
    function edit() {
        $wid = User::getWid($_SESSION['uid']);
        if(!isset($_GET['id'])) {
            if(!isset($_POST['id']) || !isset($_POST['submit'])) {
                //ERROR
				$this->vars->error = __('Ingen ID blev fundet for denne forespørgsel');
				$this->vars->controller = 'userdefinedkeywords';
				$this->vars->task = 'standard';
				$this->view = 'error';
				return;
            } else {
                //POST DATA
                $this->vars->msg = '';
                $id = (int)$_POST['id'];
                $keyword = new stdClass();
                $keyword->text = trim($_POST['text']);
                $keyword->id = $_POST['id'];
                $keyword->url = trim($_POST['url']);
				if(substr($keyword->url,0,4) != "http"){
					$keyword->url = 'http://' . $keyword->url;
				}
                $keyword->words = array();
                $words = explode(',',$_POST['words']);
				foreach ($words as $word) {
					$word = trim($word);
					$maxLen = (int)Settings::get('keyword_max_len');
					if(strlen($word) > $maxLen) {
						$this->vars->msg .= __('Vær opmærksom på at hvert nøgleord max kan være {%a} karakterer lang',array('a'=>$maxLen)).'<br/>';
					}
					if(strlen($word) > 0){
						$keyword->words[] = $word;
					}
				}
				$keyword->words = array_unique($keyword->words);
                UserDefinedKeyword::setUserDefinedKeyword($keyword,$wid);
				$this->vars->msg .= __('Nøgleordet er gemt.');
            }
        } else {
            //GET
            $id = (int)$_GET['id'];
        }
        $this->vars->keyword = UserDefinedKeyword::getUserDefinedKeyword($id,$wid);
        
        $this->vars->keyword->words = implode(',',$this->vars->keyword->words);
        
        $this->view = 'userdefinedkeywordsedit';
    }

	function add() {
        
        $wid = User::getWid($_SESSION['uid']);
		if(isset($_POST['submit'])) {
			
            $id = (int)$_POST['id'];
            $keyword = new stdClass();
            $keyword->text = trim($_POST['text']);
            $keyword->id = $_POST['id'];
            $keyword->url = trim($_POST['url']);
			if(substr($keyword->url,0,4) != "http"){
				$keyword->url = 'http://' . $keyword->url;
			}
            $keyword->words = array();
            $words = explode(',',$_POST['words']);
			foreach ($words as $word) {
				$keyword->words[] = trim($word);
			}
			$keyword->words = array_unique($keyword->words);
            UserDefinedKeyword::setUserDefinedKeyword($keyword,$wid);
			$this->vars->msg = __('Nøgleord oprettet!');
	        $this->redirect('userdefinedkeywords');
		} else {
	        $this->vars->keyword = new stdClass();
	        $this->vars->keyword->text = '';
	        $this->vars->keyword->id = 0;
	        $this->vars->keyword->url = '';
	        $this->vars->keyword->words = '';
	        $this->view = 'userdefinedkeywordsadd';
		}
	} 
	
	function delete() {
		$wid = User::getWid($_SESSION['uid']);
		if(isset($_POST['ok'])) {
			if(isset($_POST['id'])) {
				//DELETE THIS ONE
				UserDefinedKeyword::removeUserDefinedKeyword($_POST['id'],$wid);
				$this->vars->msg = __('Nøgleord slettet!');
	        	$this->redirect('userdefinedkeywords');
			} else {
				$this->vars->error = __('Ingen ID blev fundet for denne forespørgsel');
				$this->vars->controller = 'userdefinedkeywords';
				$this->vars->task = 'standard';
				$this->view = 'error';
			}
		} else if(isset($_POST['cancel'])) {
	        $this->redirect('userdefinedkeywords');
		} else {
			if(isset($_GET['id'])) {
		        //START DELETION
		        $this->vars->keyword = UserDefinedKeyword::getUserDefinedKeyword($_GET['id'],$wid);
		        
		        $this->vars->keyword->words = implode(',',$this->vars->keyword->words);
	        	//$this->view = 'userdefinedkeywordsdelete';
	        	$this->vars->message =  __('Er du sikker på at du vil slette følgende nøgleord:').'<br/><br/>'.
	        							'<span style="color:#ea8f2c"><b>Nøgleord:  </b></span>'. $this->vars->keyword->words . '<br/>'.
	        							'<span style="color:#ea8f2c"><b>Text: </b></span>'. $this->vars->keyword->text . '<br/>'.
	        							'<span style="color:#ea8f2c"><b>Link URL: </b></span>'. $this->vars->keyword->url;
				$this->vars->posts = array('id' => $this->vars->keyword->id);
				$this->vars->controller = 'userdefinedkeywords';
				$this->vars->task = 'delete';
				$this->vars->backController = 'userdefinedkeywords';
				$this->vars->headerText = 'Brugerdefinerede Nøgleord';
				$this->view = 'confirm';
	        } else {
				$this->vars->error = __('Ingen ID blev fundet for denne forespørgsel');
				$this->vars->controller = 'userdefinedkeywords';
				$this->vars->task = 'standard';
				$this->view = 'error';
	        }
		}
	}
}
?>
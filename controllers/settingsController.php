<?php

class settingsController extends BaseController {

    function standard(){
        if(isset($_POST) && sizeof($_POST) > 1) {
            if(isset($_POST['submitSettings'])) {
                Settings::setAllLocal($_POST, $wid = User::getWid($_SESSION['uid']));
                $this->vars->msg = __('Indstillingerne er gemt');
            }
            elseif(isset($_POST['submitUserData'])) {
                $_POST['password'] = $_POST['newPassword'];
                $_POST['password2'] = $_POST['newPassword2'];
                $errors = VublaFramework::$user->updateCustomerData($_SESSION['uid'],$_POST);
                $this->vars->msg = '';
                if(is_array($errors)){
                    foreach($errors as $error) {
                        $this->vars->msg .= $error;
                    }
                }
                if(empty($this->vars->msg)) {
                    $this->vars->msg = __('Indstillingerne er gemt');
                } else {
                    $this->vars->msg .= __(' Indstillingerne er ikke gemt!');
                }
            }
        }  
        ########## SETTINGS
        $wid = User::getWid($_SESSION['uid']);    
        $this->vars->list = Settings::getSettingsArray($wid, 1);
        $this->view = 'settings';
        
        ############ PERSONAL INFO
        $this->vars->personnalSettings = array();
        $data = VublaFramework::$user->getCustomerData($_SESSION['uid']);
        $longNames = array(
            __("Fulde Navn"),
            //"E-mail",
            __("Telefon Nummer"),
             __("Virksomhed"),
            __("Addresse"),
            "",
           
             __("Postnummer"),
            __("By"),
            "",
            "",
            ""
           
        );
        $descriptions = array(
            "",
            //"Det er denne E-mail vi vil kontakte dig på. OBS hvis du ændre din email, skal den aktiveres igen!",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
        );
        $i = 0;
        foreach($data as $col => $val){
            $work = new stdClass();
            $work->name = $col;
            $work->value = $val;
            $work->description = $descriptions[$i];
            $work->longName = $longNames[$i];
            $work->type = "text";
            $this->vars->personnalSettings[] = clone $work;
            $work = null;
            $i++;
        }
        $oldPassword = new stdClass();
        $oldPassword->name = 'oldPassword';
        $oldPassword->value = '';
        $oldPassword->description = __("Indtast dit gamle kodeord her");
        $oldPassword->longName = __("Kodeord");
        $oldPassword->type = "password";
        $this->vars->personnalSettings[] = $oldPassword;
        
        $password = new stdClass();
        $password->name = 'newPassword';
        $password->value = '';
        $password->description = __("Indtast dit nye kodeord her");
        $password->longName = __("Nyt Kodeord");
        $password->type = "password";
        $this->vars->personnalSettings[] = $password;
        
        $password2 = new stdClass();
        $password2->name = 'newPassword2';
        $password2->value = '';
        $password2->description = __("Genindtast dit nye kodeord her");
        $password2->longName = __("Gentast Nyt Kodeord");
        $password2->type = "password";
        $this->vars->personnalSettings[] = $password2;
		$this->addJs(LOGIN_URL.'/js/jquery.ibutton.min.js');
		$this->addCss(LOGIN_URL.'/stylesheets/jquery.ibutton-giva-original.css');
		$this->addCss(LOGIN_URL.'/stylesheets/controlpanel.css');
    }
}

?>
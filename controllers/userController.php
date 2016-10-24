<?php
/**
 * This controller is the user controller,
 * Do not add any methods to it. This controller is special since it takes care of login.
 * This is the only controller accebla offline.
 */ 
class userController extends BaseController {

	function standard(){
		/*if(isset($_POST['vubla_reset'])) {
			
			return $this->resetpassword();
		}*/
        if(isset($_GET) && isset($_GET['error']))
        {
            $this->vars->error = base64_decode($_GET['error']);
        }
        $this->view = 'login';
    }

    function display(){
        $this->view = 'login';
    }

    function login(){
        VublaFramework::$user->checkLogin($_POST,LOGIN_URL."/user/resendactivation?email=".$_POST['email']);

        $this->redirect();
    }
    
    function logout(){
        VublaFramework::$user->_logout();
        exit();
        $this->redirect();
        
    }
    
    function signup(){
       
        $this->layout = 'configuration';
        $this->view = 'confstep_signup';
         $this->vars->extra_to_url = 'user/signup';
    }
    
    function signupsave(){
          
       $user = new User();
       $this->vars->errors = $user->create_new($_POST);
       
       $this->vars->notSignedUp = true;
       if(empty($this->vars->errors)) {
           VublaFramework::$user->checkLogin($_POST);
            $this->redirect();
       } else {
            $this->layout = 'configuration';
            $this->view = 'confstep_signup';
            $this->vars->email = $_POST['email'];
            $this->vars->password = $_POST['password'];
          
       
       }
   
    }
    
    function register(){
        if(isset($_POST['vubla_register'])){
            $errors = VublaFramework::$user->create($_POST);
            if(empty($errors)){
                $this->redirect('user','display');
            }
			else {
				header('Location: http://blog.vubla.com/tilmeld-dig/?errors=' . base64_encode(serialize($errors)));
				die();
			}
        }
    }
	
	function validateuserdata() {
		die(VublaFramework::$user->validate_user_data($_POST));
	}
	
	 function contactme(){
        if(!VublaMailer::sendContactRequest()){
            $this->vars->error = true;
        } else {
            $this->vars->error = false;
        }
        $this->view = 'contactrequest';
   
    }
   
    function activate(){
        $this->view = 'login';
        if (isset($_GET['key']) && isset($_GET['email'])){
            $email = $_GET['email'];
            $db = Vpdo::getVdo(DB_METADATA);
            $list = $db->getTableList('SELECT * FROM customers WHERE email = ?', null, array($email));
            $list = $list[0];
            if(is_null($list)){
                $this->vars->error = __('Din email kunne ikke findes.');
                return;
            } 
            $key_org = md5($list->id. $list->email.VublaMailer::generateEmailValSalt());
           
            if($key_org != $_GET['key']){
                 $this->vars->error = __('Aktiverings koden passede ikke.');
                 return;
            }
        } else {
            $this->vars->error = __('Der skete en fejl.');
            return;
        }
        if(User::activate($email)){
            $this->vars->error = __("Din email blev aktiveret. Log ind.");
        } else {
            $this->vars->error = __('Der skete en fejl.');
        }
        
    }

	public function resetpassword() {
		$this->view = 'resetpassword';
		if(isset($_POST['vubla_reset'])){
			
			if(isset($_POST['email'])) {
				$errors = VublaFramework::$user->resetPassword($_POST['email']);
				if (empty($errors))
				{
					$this->view = 'resetpasswordconfirmation';
				}
				else
				{
					$this->vars->error = $errors[0];
				}
			}
			else
			{
				$this->vars->error = __("Der er ikke indtastet nogen e-mail.");
			}
		}
	}
	
	public function setpassword() {
		if($_SESSION['logged']) { //Recursion, might be dangerous
			VublaFramework::$user->_logout(LOGIN_URL.'/user/setpassword?email='.$_GET['email'].'&code='.$_GET['code']);
		}
		$this->view = 'setpassword';
		if(isset($_POST['vubla_set']))
		{
		######## POSTING
			
			if(isset($_POST['email'])) {
				if(isset($_POST['code'])) {
					$email = $_POST['email'];
					$code = $_POST['code'];
					if(isset($_POST['password']) && isset($_POST['password2'])) {
						$password = $_POST['password'];
						$password2 = $_POST['password2'];
						$errors = VublaFramework::$user->validateResetPassword($email,$code,$password,$password2);
						if(!empty($errors)) {
							$this->vars->error = $errors[0];
							$_GET['email'] = $email;
							$_GET['code']  = $code;
							$_POST['vubla_set'] = null;
							return $this->setpassword();
						}
						else {
							$this->view = 'setpasswordconfirmation';
						}
					} else {
						$_GET['email'] = $email;
						$_GET['code']  = $code;
						
						$this->vars->error = __("Passwords not set in post");
					}
				} else {
					$this->vars->error = __("Code not set in post");
				}
			}else{
				$this->vars->error = __("E-mail not set in post");
			}
		}
		else
		{
		############ NOT POSTING
			if(isset($_GET['email'])) {
				if(isset($_GET['code'])) {
					$this->vars->email = $_GET['email']; //Consider using SESSION instead
					$this->vars->code = $_GET['code'];   //Consider using SESSION instead
					$errors = VublaFramework::$user->validateEmailCodeCombination($this->vars->email,$this->vars->code);
					if(!empty($errors)) {
						$this->view = 'error';
						$this->vars->error = $errors[0];
					}
					
				} else {
					$this->vars->error = __("Code not set in get");
				}
			}
			else
			{
				$this->vars->error = __("E-mail not set in get");
			}
		}
	}
	
	function resendactivation() {
		$email = $_POST['email'];
		if(!isset($email))
		{
			$email = $_GET['email'];
		}
		
		if(isset($email)) {
			$this->view = 'resendactivation';
			if(isset($_POST['vubla_resend'])) {
				$errors = VublaFramework::$user->resendActivationLink($email);
				if(empty($errors)) {
					
					$this->view = 'activationsentconfirmation';
				} else {
					$this->vars->error = $errors[0];
				}
			} else {
				$this->vars->email = $email;
			}
		} else {
			$this->vars->error = __('Der er ikke indtastet nogen email');
		}
	}
	    
	function delete() {
		if(isset($_POST) && sizeof($_POST) > 1) {
			if(isset($_POST['ok'])) {
				$result = VublaFramework::$user->delete($_SESSION['uid']);
				if(empty($result)) {
					$this->view = 'error';
					$this->vars->error = __("Din bruger er nu afmeldt og du skulle modtage en e-mail indenfor kort tid, der bekræfter dette.");
				} else {
					$this->view = 'error';
					$this->vars->error = $result[0];
				}
			} elseif(isset($_POST['cancel'])) {
				$this->redirect('settings');
			} else {
				$this->view = 'error';
				$this->vars->error = __("Ukendt fejl.");
				$this->vars->back = LOGIN_URL . "/settings";
			}
		} else {
			$this->vars->controller = 'user';
			$this->vars->task = 'delete';
			$this->vars->message = __('Er du sikker på at du vil afmelde din Vubla bruger?');
			$this->vars->back = LOGIN_URL . "/settings";
			$this->view = 'confirm';
		}
	}
	
	//Consider disbling the following task:
	/*
	function recover() {
		if(VUBLA_DEBUG) {
			if(isset($_GET) && sizeof($_GET) > 1) {
				if(isset($_GET['id'])) {
					$result = VublaFramework::$user->recover($_GET['id']);
					if(!empty($result)) {
						echo "Error: ";
						var_dump($result);
						exit();
					}
				}
			}
		}
		$this->redirect('user');
	}
	*/
	
	 function callback(){
		payment::makeSubscription($_POST);

        die();
    }

	
}

?>
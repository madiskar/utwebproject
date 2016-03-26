<?php
class Login extends CI_Controller {
               
	var $fb;	
        var $data;
        public function __construct()
        {
                parent::__construct();
                $this->load->model('login_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
                
                $this->lang->load('menu_lang',$this->session->userdata('language'));
                
                $this->data["nav_home"] = $this->lang->line('menu_homepage');
                $this->data["nav_login"] = $this->lang->line('menu_log_in');
                $this->data["nav_register"] = $this->lang->line('menu_register');
                $this->data["nav_language"] = $this->lang->line('menu_language');
                $this->data["nav_search"] = $this->lang->line('menu_search');
                $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
                $this->data["title"] = $this->lang->line('menu_title');
                $this->data["game_rating"] = $this->lang->line('menu_rating');
                $this->data['base_url'] = base_url();
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
                require_once 'application/vendor/autoload.php';
        }

        public function index()
        {	
        	$this->load->library('user_agent');
        	$this->session->set_userdata('redirect_back', $this->agent->referrer() );

                $this->fb = new Facebook\Facebook([
        			'app_id' => '236256526721516',
        			'app_secret' => 'b57a708a9a383fd15a50c2d22f1e0f74',
        			'default_graph_version' => 'v2.5',
        	]);
        	
        	
        	$helper = $this->fb->getRedirectLoginHelper();
        	$permissions = ['email']; // optional
        	
        	try {
        		if (isset($_SESSION['facebook_access_token'])) {
        			$accessToken = $_SESSION['facebook_access_token'];
        		} else {
        			$accessToken = $helper->getAccessToken();
        		}
        	} catch(Facebook\Exceptions\FacebookResponseException $e) {
        		// When Graph returns an error
        		echo 'Graph returned an error: ' . $e->getMessage();
        		exit;
        	} catch(Facebook\Exceptions\FacebookSDKException $e) {
        		// When validation fails or other local issues
        		echo 'Facebook SDK returned an error: ' . $e->getMessage();
        		exit;
        	}
        	
        	if (isset($accessToken)) {
        		if (isset($_SESSION['facebook_access_token'])) {
        			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        		} else {
        			 
        			$_SESSION['facebook_access_token'] = (string) $accessToken;
        	
        			$oAuth2Client = $this->fb->getOAuth2Client();
        	
        			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        	
        			$this->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        		}
        	
        		if (isset($_GET['code'])) {
        			header('Location: ./');
        		}
        	
        		try {
        			$profile_request = $this->fb->get('/me?fields=name,first_name,last_name,email');
        			$profile = $profile_request->getGraphNode()->asArray();
        			$this->session->set_userdata(array(
        					'username' => $profile['first_name'] . " " . $profile['last_name'],
                                                'email' => $profile['email'],
        					'is_admin' => FALSE,
        					'allowed' => TRUE,
        					'user_id' => null,
        					'is_logged_in' => TRUE
        			));
        			

        		} catch(Facebook\Exceptions\FacebookResponseException $e) {
        			 
        			echo 'Graph returned an error: ' . $e->getMessage();
        			session_destroy();
        			 
        			header("Location: ./");
        			exit;
        		} catch(Facebook\Exceptions\FacebookSDKException $e) {
        			 
        			echo 'Facebook SDK returned an error: ' . $e->getMessage();
        			exit;
        		}
                        if($this->login_model->get_user_fb($this->session->userdata('username')) == FALSE) {
        	               $this->login_model->set_fbuser($this->session->userdata('username'), $this->session->userdata('email'));
                        }

                        $this->session->set_userdata('user_id', $this->login_model->get_userid($this->session->userdata('username')));
                        $this->session->set_userdata('allowed', $this->login_model->get_fb_user_is_allowed($this->session->userdata('username')));
                        $this->session->set_userdata('is_admin', $this->login_model->get_fb_user_is_admin($this->session->userdata('username')));
        		redirect('');
        		
        	
        	} else {
        		$this->data['loginUrl'] = $helper->getLoginUrl('http://wasdreviews.cs.ut.ee/index.php/login', $permissions);
        	
        	}
        	   
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->lang->load('form_validation',$this->session->userdata('language'));
                
                $this->form_validation->set_rules('username', 'Kasutajanimi', 'trim|required');
                $this->form_validation->set_rules('password', 'Parool', 'trim|required');
                
                
                $this->data['info'] = "";
                
                $this->lang->load('login_lang',$this->session->userdata('language'));
                
                $this->data["login_username"] = $this->lang->line('login_username');
                $this->data["login_password"] = $this->lang->line('login_password');
                $this->data["login_forgot_pass"] = $this->lang->line('login_forgot_pass');
                $this->data["login_login"] = $this->lang->line('login_login');
                $this->data["login_noaccount"] = $this->lang->line('login_noaccount');
                $this->data["login_register"] = $this->lang->line('login_register');
                
                if ($this->form_validation->run() === FALSE)
                {
                	$this->load->view('templates/header', $this->data);
                	$this->load->view('login/view_login',$this->data);
                        $this->load->view('login/view_facebook', $this->data);
                	$this->load->view('templates/footer');
                }
                else
                {
                	$password = $this->input->post('password');
                	if(password_verify($password, $this->login_model->get_user())) {
                		
                		$this->session->set_userdata(array(
                				'username' => $this->input->post('username'),
                				'is_admin' => $this->login_model->check_if_admin(),
                                'allowed' => $this->login_model->check_if_allowed(),
                                'user_id' => $this->login_model->get_user_id(),
                				'is_logged_in' => true
                		));
                		
                	if($this->session->userdata('redirect')) {
   						$redirect = $this->session->userdata('redirect');  // grab value and put into a temp variable so we unset the session value
   						$this->session->unset_userdata('redirect');
    					redirect($redirect);
					}
					else {
						redirect(pages);
					}
                		
                		
                	} else {
                		
                		$this->data['info'] = $this->lang->line('login_fail');
                		$this->load->view('templates/header', $this->data);
                		$this->load->view('login/view_login', $this->data);
                		$this->load->view('templates/footer');
                	}
                }
        }
        public function logout() {
        	$this->session->unset_userdata(array('username','is_admin','is_logged_in','facebook_access_token','redirect')); 
        	redirect('');
        }
}
?>
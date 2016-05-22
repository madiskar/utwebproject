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
                $this->data["nav_about"] = $this->lang->line('menu_about');
                $this->data["nav_search"] = $this->lang->line('menu_search');
                $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
                $this->data["title"] = $this->lang->line('menu_log_in');
                $this->data["game_rating"] = $this->lang->line('menu_rating');
                $this->data['base_url'] = base_url();
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
                $this->data["admin_go_home"] = $this->lang->line('admin_go_home');
                require_once 'application/vendor/autoload.php';
                
                $this->data["active_tab"] = 6;
        }

        public function index()
        {	

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
        		if($this->session->userdata('redirect')) {
                $redirect = $this->session->userdata('redirect');  // grab value and put into a temp variable so we unset the session value
                $this->session->unset_userdata('redirect');
                    redirect($redirect);
            }
            else {
                redirect('');
            }
        		
        	
        	} else {
        		$this->data['loginUrl'] = $helper->getLoginUrl('http://wasdreviews.cs.ut.ee/index.php/login', $permissions);
        	
        	}
        	$this->lang->load('login_lang',$this->session->userdata('language'));
        	
        	$this->config->set_item('language', $this->session->userdata('language'));
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->lang->load('form_validation',$this->session->userdata('language'));
                
                $this->form_validation->set_rules('username', $this->lang->line('login_username'), 'trim|required');
                $this->form_validation->set_rules('password', $this->lang->line('login_password'), 'trim|required');
                
                
                $this->data['info'] = "";
                
                
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
                	if(password_verify(addslashes($password), $this->login_model->get_user())) {
                		
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
                    redirect('');
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
        	$this->session->unset_userdata(array('username','is_admin','is_logged_in','facebook_access_token')); 
        	redirect('');
        }
        
        public function forgot_password(){
        	$this->config->set_item('language', $this->session->userdata('language'));
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->lang->load('register_lang',$this->session->userdata('language'));
                $this->lang->load('login_lang',$this->session->userdata('language'));
                $this->data["title"] = $this->lang->line('recovery_button');
                $this->data['register_email'] = $this->lang->line('register_email');
                $this->form_validation->set_rules('email', $this->lang->line('register_email'), 'trim|required');
                
        	if ($this->form_validation->run() === FALSE)
                {
                	$this->data['recovery_title'] = $this->lang->line('recovery_title');
                	$this->data['recovery_button'] = $this->lang->line('recovery_button');
                	$this->load->view('templates/header', $this->data);
                	$this->load->view('login/view_forgot_password',$this->data);
                	$this->load->view('templates/footer');
                }
                else
                {
                	$email = $this->input->post('email');
                	$this->load->helper('string');
                	if ($this->login_model->get_user_by_email($email)!=""){
                		$this->data['recovery_text'] = $this->lang->line('recovery_sent') . $email;
	                	$this->load->library('email');
				$this->email->from('recovery@wasdreviews.cs.ut.ee', 'WASDreviews');
				$this->email->to($email);
			
				$recovery_key = random_string('alnum', 64);
				$user_id = $this->login_model->get_userid($this->login_model->get_user_by_email($email));
				
				$this->login_model->set_recovery_key($user_id, $recovery_key);
				
				$this->email->subject($this->lang->line('recovery_email_subject'));
				$this->email->message($this->lang->line('recovery_email_title') . $this->login_model->get_user_by_email($email) . $this->lang->line('recovery_email_body') . '
{unwrap}http://wasdreviews.cs.ut.ee/index.php/login/recover_password/'.$user_id.'/'.$recovery_key.'/{/unwrap}
				
WASDreviews');
				$this->email->send();
			} else {
				$this->data['recovery_text'] = $this->lang->line('recovery_send_fail_begin') . $email . $this->lang->line('recovery_send_fail_end');
			}
			
                	$this->load->view('templates/header', $this->data);
                	$this->load->view('login/view_forget_sent', $this->data);
                	$this->load->view('templates/footer');
                }
        }
        
        public function recover_password($user_id, $rec_key){
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->lang->load('register_lang',$this->session->userdata('language'));
                $this->data['register_email'] = $this->lang->line('register_email');
                $this->data["register_password"] = $this->lang->line('register_password');
                $this->data["register_pass_repeat"] = $this->lang->line('register_pass_repeat');
                
                $this->data['user_id'] = $user_id;
                $this->data['rec_key'] = $rec_key;
                
                $this->form_validation->set_rules('password', $this->lang->line('register_password'), 'trim|required|min_length[8]|max_length[30]');
                $this->form_validation->set_rules('passConfirm', $this->lang->line('register_pass_repeat'), 'trim|required|matches[password]');
                
        	if ($this->form_validation->run() === FALSE)
                {
                	$this->lang->load('login_lang',$this->session->userdata('language'));
                	$this->data['recovery_change_title'] = $this->lang->line('recovery_change_title');
                	$this->data['recovery_change_button'] = $this->lang->line('recovery_change_button');
                	$this->load->view('templates/header', $this->data);
                	$this->load->view('login/view_recover_password',$this->data);
                	$this->load->view('templates/footer');
                }
                else
                {	
                	$this->lang->load('login_lang',$this->session->userdata('language'));
                	$this->data['recovery_success'] = $this->lang->line('recovery_success');
                	$this->data['recovery_fail'] = $this->lang->line('recovery_fail');
                	$this->load->view('templates/header', $this->data);
                	if (password_verify($rec_key, $this->login_model->get_current_recovery_key($user_id))){
                		$this->login_model->set_new_password($user_id, $this->input->post('password'));
                		$this->load->view('login/view_recover_success',$this->data);
                	} else {
                		$this->load->view('login/view_recover_invalid_key',$this->data);
                	}
                	$this->load->view('templates/footer');
                }
        }
}
?>
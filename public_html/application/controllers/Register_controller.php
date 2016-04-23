<?php
class Register_controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('register_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
                
                $this->lang->load('menu_lang',$this->session->userdata('language'));
                
                $this->data["nav_home"] = $this->lang->line('menu_homepage');
                $this->data["nav_login"] = $this->lang->line('menu_log_in');
                $this->data["nav_register"] = $this->lang->line('menu_register');
                $this->data["nav_search"] = $this->lang->line('menu_search');
                $this->data["nav_about"] = $this->lang->line('menu_about');
                $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
                $this->data["nav_language"] = $this->lang->line('menu_language');
                $this->data["title"] = $this->lang->line('menu_title');
                $this->data['base_url'] = base_url();

                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
        }

        public function index()
        {
                $this->config->set_item('language', $this->session->userdata('language'));
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->lang->load('register_lang',$this->session->userdata('language'));
                
                $this->form_validation->set_rules('username', $this->lang->line('register_username'), 'trim|required|min_length[4]|max_length[30]');
                $this->form_validation->set_rules('email', $this->lang->line('register_email'), 'trim|required');
                $this->form_validation->set_rules('password', $this->lang->line('register_password'), 'trim|required|min_length[8]|max_length[30]');
                $this->form_validation->set_rules('passConfirm', $this->lang->line('register_pass_repeat'), 'trim|required|matches[password]');
                
                $this->lang->load('register_lang',$this->session->userdata('language'));
                
                $this->data["register_username"] = $this->lang->line('register_username');
                $this->data["register_email"] = $this->lang->line('register_email');
                $this->data["register_password"] = $this->lang->line('register_password');
                $this->data["register_pass_repeat"] = $this->lang->line('register_pass_repeat');
                $this->data["register_createaccount"] = $this->lang->line('register_createaccount');
                
                $this->data['info'] = '';
                
                if ($this->form_validation->run() === FALSE)
                {
                	$this->load->view('templates/header', $this->data);
                	$this->load->view('registration/register', $this->data);
                	$this->load->view('templates/footer');
                }
                else
                {
                	if ($this->register_model->get_user($this->input->post('username')) && $this->register_model->get_email($this->input->post('email'))) {
                	
                		$query = $this->register_model->set_users();
                		$this->data['info'] = $this->lang->line('register_success');
                		
                		$this->lang->load('login_lang',$this->session->userdata('language'));

                                $this->data["login_username"] = $this->lang->line('login_username');
                                $this->data["login_password"] = $this->lang->line('login_password');
                                $this->data["login_forgot_pass"] = $this->lang->line('login_forgot_pass');
                                $this->data["login_login"] = $this->lang->line('login_login');
                                $this->data["login_noaccount"] = $this->lang->line('login_noaccount');
                                $this->data["login_register"] = $this->lang->line('login_register');
                		
                		$this->load->view('templates/header', $this->data);
                		$this->load->view('login/view_login');
                		$this->load->view('templates/footer');
                	}
                	else {
                		$user = $this->input->post('username');
                		$email = $this->input->post('email');
                		
                		if (! $this->callback_checkusername($user)) {
                			if (! $this->callback_checkemail($email)) {
                				$this->data['info'] = $this->lang->line('register_fail_user_and_email');
                			}
                			else {
                				$this->data['info'] = $this->lang->line('register_fail_user');
                			}	
                		}
                		elseif (! $this->callback_checkemail($email)) {
                			$this->data['info'] = $this->lang->line('register_fail_email');
                		}
                		
                		$this->load->view('templates/header', $this->data);
                		$this->load->view('registration/register');
                		$this->load->view('templates/footer');
                	}
                }
        }
        
        function callback_checkusername($username) {
        	$possible_user = $this->register_model->get_user($username);
        	if ($possible_user) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }
        
        function callback_checkemail($email) {
        	$possible_email = $this->register_model->get_email($email);
        	if ($possible_email) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }
}
?>
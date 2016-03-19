<?php
class Login extends CI_Controller {

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
        }

        public function index()
        {	
        	   
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
                		
                		$this->load->model('games_model');
                		$this->data['games'] = $this->games_model->get_games();     
                		$this->data['title'] = $this->lang->line('login_title');
						
                		$this->load->view('templates/header', $this->data);
                		$this->load->view('games/index', $this->data);
                		$this->load->view('templates/footer');
                		
                		
                		
                	} else {
                		
                		$this->data['info'] = $this->lang->line('login_fail');
                		$this->load->view('templates/header', $this->data);
                		$this->load->view('login/view_login', $this->data);
                		$this->load->view('templates/footer');
                	}
                }
        }
        public function logout() {
        	$this->session->unset_userdata(array('username','is_admin','is_logged_in'));
        	redirect(pages);
        }
}
?>
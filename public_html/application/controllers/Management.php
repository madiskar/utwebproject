<?php
class Management extends CI_Controller {

		var $data;
        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
                $this->load->model('management_model');
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
                $this->data["game_rating"] = $this->lang->line('menu_rating');
                $this->data['base_url'] = base_url();
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
                $this->data["admin_searchusers"] = $this->lang->line('admin_searchusers');
                $this->data["admin_search"] = $this->lang->line('admin_search');
                $this->data["admin_username"] = $this->lang->line('admin_username');
                $this->data["admin_email"] = $this->lang->line('admin_email');
                $this->data["admin_allowed"] = $this->lang->line('admin_allowed');
                $this->data["admin_administrator"] = $this->lang->line('admin_administrator');
                $this->data["admin_submituserdata"] = $this->lang->line('admin_submituserdata');
                $this->data["admin_game_name"] = $this->lang->line('admin_game_name');
                $this->data["admin_game_description"] = $this->lang->line('admin_game_description');
                $this->data["admin_game_tmb"] = $this->lang->line('admin_game_tmb');
                $this->data["admin_game_no_file"] = $this->lang->line('admin_game_no_file');
                $this->data["admin_game_choose_file"] = $this->lang->line('admin_game_choose_file');
                $this->data["admin_game_review"] = $this->lang->line('admin_game_review');
                $this->data["admin_game_rating"] = $this->lang->line('admin_game_rating');
                $this->data["admin_no_user"] = $this->lang->line('admin_no_user');
        }

        public function index()
        {	
        	$this->load->helper('form');
        	$this->load->library('form_validation');
        	
        	$this->form_validation->set_rules('usersearch', 'Usersearch', 'trim|required');
        	
        	
        	if (!isset($_POST['submit']))
        	{
        		$this->load->view('templates/header', $this->data);
        		$this->load->view('login/admin/view_management', $this->data);
        		$this->load->view('templates/footer');
        	}
        	else
        	{
        		$user = $this->input->post('usersearch');
        		
        		/*if ($this->management_model->get_userinfo($user)) {
        			
        			$this->data['user_info'] = $this->management_model->get_userinfo($user);
        			$this->data['eksisteerib'] = TRUE;
        			$this->data['username'] = $this->data['user_info']['username'];
        			$this->data['email'] = $this->data['user_info']['email'];
        			$this->data['allowed'] = $this->data['user_info']['allowed'];
        			$this->data['admin'] = $this->data['user_info']['admin'];
        		}*/
                if ($this->management_model->get_matching_users($user)) {
                                
                	$this->data['user_info'] = $this->management_model->get_matching_users($user);
                    $this->data['eksisteerib'] = TRUE;
                }
        		else {
        			$this->data['eksisteerib'] = FALSE;
        		}
        		$this->update();
        	}
        }
        
        public function update() {
        	$this->load->view('templates/header', $this->data);
        	$this->load->view('login/admin/view_management', $this->data);
        	$this->load->view('login/admin/view_user_list', $this->data);
        	$this->load->view('templates/footer');
        	
        	
        	if(isset($_POST['confirmation'])){
        		if(isset($_POST['allowed']) && isset($_POST['admin'])) {
        			$this->management_model->update_userinfo($username, 1, 1);
        		}
        		elseif(isset($_POST['allowed'])) {
        			$this->management_model->update_userinfo($username, 1, 0);
        		}
        		elseif(isset($_POST['admin'])) {
        			$this->management_model->update_userinfo($username, 0, 1);
        		}
        	}
        }
        
		public function change_states($userid){
			
			$this->management_model->update_userinfo($userid, $this->input->post('allowed'), $this->input->post('admin'));
			
			$this->output->set_output('user id: ' . $userid . '|allowed: ' . $this->input->post('allowed') . "|admin: " . $this->input->post('admin'));
   
        }
}
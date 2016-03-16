<?php
class Management extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
                $this->load->model('management_model');
                $this->load->helper('url');
        }

        public function index()
        {	
        	$this->load->helper('form');
        	$this->load->library('form_validation');
        	
        	$this->form_validation->set_rules('usersearch', 'Usersearch', 'trim|required');
        	
        	$data['base_url'] = base_url();
        	
        	if (!isset($_POST['submit']))
        	{
        		$this->load->view('templates/header', $data);
        		$this->load->view('login/admin/view_management');
        		$this->load->view('templates/footer');
        	}
        	else
        	{
        		$user = $this->input->post('usersearch');
        		
        		if ($this->management_model->get_userinfo($user)) {
        			
        			$data['user_info'] = $this->management_model->get_userinfo($user);
        			$data['eksisteerib'] = TRUE;
        			$data['username'] = $data['user_info']['username'];
        			$data['email'] = $data['user_info']['email'];
        			$data['allowed'] = $data['user_info']['allowed'];
        			$data['admin'] = $data['user_info']['admin'];
        		}
                        /*if ($this->management_model->get_matching_users($user)) {
                                
                                $data['user_info'] = $this->management_model->get_matching_users($user);
                                $data['eksisteerib'] = TRUE;
                        }*/
        		else {
        			$data['eksisteerib'] = FALSE;
        		}
        		$this->update($data);
        	}
        }
        
        public function update($data) {
        	$this->load->view('templates/header', $data);
        	$this->load->view('login/admin/view_management');
        	$this->load->view('login/admin/view_user', $data);
        	$this->load->view('templates/footer');
        	
        	
        	if(isset($_POST['confirmation'])){
        		echo "wot nagu";
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
}
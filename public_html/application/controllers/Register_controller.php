<?php
class Register_controller extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('register_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
        }

        public function index()
        {
                $data['base_url'] = base_url();
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('username', 'Kasutajanimi', 'trim|required|min_length[4]|max_length[30]');
                $this->form_validation->set_rules('email', 'E-Posti aadress', 'trim|required');
                $this->form_validation->set_rules('password', 'Parool', 'trim|required|min_length[8]|max_length[30]');
                $this->form_validation->set_rules('passConfirm', 'Korda parooli', 'trim|required|matches[password]');
                
                if ($this->form_validation->run() === FALSE)
                {
                	$this->load->view('templates/header', $data);
                	$this->load->view('registration/register');
                	$this->load->view('templates/footer');
                }
                else
                {
                	if ($query = $this->register_model->set_users()) {
                	
                		$data['info'] = 'Kasutaja loomine õnnestus!';
                		
                		$this->load->view('templates/header', $data);
                		$this->load->view('login/view_regsuccess', $data);
                		$this->load->view('login/view_login');
                		$this->load->view('templates/footer');
                	}
                	else {
                		$user = $this->input->post('username');
                		$email = $this->input->post('email');
                		
                		if (! $this->callback_checkusername($user)) {
                			if (! $this->callback_checkemail($email)) {
                				$data['info'] = 'Kasutaja loomine ebaõnnestus.<br/>Soovitud kasutajatunnus ja e-posti aadress on juba kasutuses.';
                			}
                			else {
                				$data['info'] = 'Kasutaja loomine ebaõnnestus.<br/>Soovitud kasutajatunnus on juba kasutuses.';
                			}	
                		}
                		elseif (! $this->callback_checkemail($email)) {
                			$data['info'] = 'Kasutaja loomine ebaõnnestus.<br/>Soovitud e-posti aadress on juba kasutuses.';
                		}
                		
                		$this->load->view('templates/header', $data);
                		$this->load->view('registration/view_reginfo', $data);
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
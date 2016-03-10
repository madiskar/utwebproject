<?php
class Login extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('login_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
        }

        public function index()
        {	
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('username', 'Kasutajanimi', 'trim|required');
                $this->form_validation->set_rules('password', 'Parool', 'trim|required');
                
                $data['base_url'] = base_url();
                
                if ($this->form_validation->run() === FALSE)
                {
                	$this->load->view('templates/header', $data);
                	$this->load->view('login/view_login');
                	$this->load->view('templates/footer');
                }
                else
                {
                	$password = $this->input->post('password');
                	if(password_verify($password, $this->login_model->get_user())) {
                		
                		$data = array(
                				'username' => $this->input->post('username'),
                				'is_logged_in' => true
                		);
                		
                		$this->session->set_userdata($data);
                		redirect(games);
                		
                	} else {
                		echo "sisetatud kasutajatunnus ja/või parool on vale(d)";
                	}
                	
                	$this->load->view('templates/header', $data);
                	$this->load->view('registration/register');
                	$this->load->view('templates/footer');
                }
        }
}
?>
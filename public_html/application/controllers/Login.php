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
                $data['info'] = "";
                
                if ($this->form_validation->run() === FALSE)
                {
                	$this->load->view('templates/header', $data);
                	$this->load->view('login/view_login',$data);
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
                		$data['games'] = $this->games_model->get_games();     
                		$data['title'] = 'Pelade arhiiv';
                		$data['base_url'] = base_url();
						
                		$this->load->view('templates/header', $data);
                		$this->load->view('games/index', $data);
                		$this->load->view('templates/footer');
                		
                		
                		
                	} else {
                		
                		$data['info'] = "Sisetatud kasutajatunnus ja/või parool on vale(d)";
                		$this->load->view('templates/header', $data);
                		$this->load->view('login/view_login', $data);
                		$this->load->view('templates/footer');
                	}
                }
        }
        public function logout() {
        	$this->session->sess_destroy();
        	redirect(games);
        }
}
?>
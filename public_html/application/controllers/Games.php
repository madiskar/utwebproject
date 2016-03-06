<?php
class Games extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('games_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
        }

        public function index()
        {
                $data['games'] = $this->games_model->get_games();

                $data['title'] = 'Pelade arhiiva';
                $data['base_url'] = base_url();

                $this->load->view('templates/header', $data);
                $this->load->view('games/index', $data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $this->load->helper('form');
   				$this->load->library('form_validation');

                $data['games_item'] = $this->games_model->get_games($slug);
                if (empty($data['games_item']))
                {
                        show_404();
                }

                
                $this->form_validation->set_rules('rating', 'Hinnang', 'required');
    			$this->form_validation->set_rules('review', 'Arvustus', 'required');
    			$this->form_validation->set_rules('game_id', 'gid', 'required');
    			$this->form_validation->set_rules('user_id', 'Afsadasvustus', 'required');

                $data['reviews'] = $this->games_model->get_reviews($data['games_item']['id']);

                $data['title'] = $data['games_item']['title'];
                $data['base_url'] = base_url();

                
                if ($this->form_validation->run() === FALSE)
                {
		            $this->load->view('templates/header', $data);
		            $this->load->view('games/view_top', $data);
		            $this->load->view('games/view_form', $data);
		            $this->load->view('games/view_bottom', $data);
		            $this->load->view('templates/footer');
	            }
	            else
                {
                	$this->games_model->set_reviews();
                	$this->load->view('templates/header', $data);
		            $this->load->view('games/view_top', $data);
		            $this->load->view('games/view_success', $data);
		            $this->load->view('games/view_bottom', $data);
		            $this->load->view('templates/footer');
                }
        }

}
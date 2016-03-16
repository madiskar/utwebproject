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

                $data['title'] = 'Mängud';
                $data['base_url'] = base_url();
                
                $this->load->view('templates/header', $data);
                $this->load->view('games/index', $data);
                $this->load->view('templates/footer');
        }

        public function search()
        {
                $data['games'] = $this->games_model->get_games_search($this->input->post('searchQuery'));

                $this->load->helper('form');
                $this->load->library('form_validation');

                $data['title'] = 'Otsing';
                $data['base_url'] = base_url();
                $data['searchquery'] = $this->input->post('searchQuery');
                
                $this->load->view('templates/header', $data);
                if (empty($data['games'])){
                    $this->load->view('games/searchfail', $data);
                } else {
                    $this->load->view('games/searchresults', $data);
                }
                $this->load->view('games/index', $data);
                $this->load->view('templates/footer');
        }
		
		public function add()
        {
                $this->load->helper('form');
                $this->load->library('form_validation');

                $data['base_url'] = base_url();

                $this->form_validation->set_rules('title', 'Nimi', 'required');
                $this->form_validation->set_rules('description', 'Lühikirjeldus', 'required');
                $this->form_validation->set_rules('mainrev', 'Arvustus', 'required');
                $this->form_validation->set_rules('mainrating', 'Hinnang', 'required');

                if (!is_dir('./public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/')) {
                    mkdir('./public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/', 0777, TRUE);
                }

                $config['upload_path']          = './public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000000;
                $config['max_width']            = 9999;
                $config['max_height']           = 9999;
                $config['file_name']            = "thumbnail";

                $this->load->library('upload', $config);

                $data['title'] = "Lisa Mäng";
                
                if ($this->form_validation->run() === FALSE || !$this->upload->do_upload("thumbnail"))
                {
                    $this->load->view('templates/header', $data);
                    $this->load->view('games/add', $data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $thumbnail = array('data' => $this->upload->data());
                    $this->games_model->set_games($thumbnail);
                    $this->load->view('templates/header', $data);
                    $this->load->view('games/add_success', $data);
                    $this->load->view('templates/footer');
                }
        }

        function do_upload()
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            $config['max_width']  = '102400';
            $config['max_height']  = '76800';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                    $this->load->view('pages/avaleht');
                    $this->load->view('templates/footer');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                    $this->load->view('pages/avaleht');
                    $this->load->view('templates/footer');
            }
        }

        private function set_upload_options()
        {   
            //upload an image options
            $config = array();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            $config['max_width']  = '102400';
            $config['max_height']  = '76800';

            return $config;
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
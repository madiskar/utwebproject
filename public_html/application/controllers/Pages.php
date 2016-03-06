<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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

                $data['title'] = 'Avaleht';
                $data['base_url'] = base_url();

                $this->load->view('templates/header', $data);
                $this->load->view('games/index', $data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['games_item'] = $this->games_model->get_games($slug);
                if (empty($data['games_item']))
                {
                        show_404();
                }


                $data['reviews'] = $this->games_model->get_reviews($data['games_item']['id']);

                $data['title'] = $data['games_item']['title'];
                $data['base_url'] = base_url();

                $this->load->view('templates/header', $data);
                $this->load->view('games/view', $data);
                $this->load->view('templates/footer');
        }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	var $data;
	public function __construct()
        {
                parent::__construct();
                $this->load->model('games_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
                //if ($this->session->has_userdata('language') == FALSE) {
                if (!$this->session->userdata('language') == 'english' || !$this->session->userdata('language') == 'estonian') {
                	$lang = $this->config->item('language');
                	$this->session->set_userdata('language', $lang);
                }
                $this->lang->load('menu_lang',$this->session->userdata('language'));
                
                $this->data["nav_home"] = $this->lang->line('menu_homepage');
                $this->data["nav_login"] = $this->lang->line('menu_log_in');
                $this->data["nav_about"] = $this->lang->line('menu_about');
                $this->data["nav_register"] = $this->lang->line('menu_register');
                $this->data["nav_search"] = $this->lang->line('menu_search');
                $this->data["nav_language"] = $this->lang->line('menu_language');
                $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
                $this->data["title"] = $this->lang->line('menu_title');
                $this->data["game_rating"] = $this->lang->line('menu_rating');
                $this->data['base_url'] = base_url();
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
                
                if (!isset($_GET['rand'])){
                $this->session->set_userdata('redirect', $this->uri->uri_string());
                }
                
                $this->data["active_tab"] = 1;
        }

        public function index()
        {
                $this->data['games'] = $this->games_model->get_games();

                
                $this->load->view('templates/header', $this->data);
                $this->load->view('games/index', $this->data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['games_item'] = $this->games_model->get_games($slug);
                if (empty($data['games_item']))
                {
                        show_404();
                }


               $this->data['reviews'] = $this->games_model->get_reviews($data['games_item']['id']);

                $this->data['title'] = $data['games_item']['title'];

                $this->load->view('templates/header', $this->data);
                $this->load->view('games/view', $this->data);
                $this->load->view('templates/footer');
        }
}
<?php
class About extends CI_Controller {

	var $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('games_model');
		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->lang->load('menu_lang',$this->session->userdata('language'));
		$this->data["nav_home"] = $this->lang->line('menu_homepage');
		$this->data["nav_login"] = $this->lang->line('menu_log_in');
		$this->data["nav_register"] = $this->lang->line('menu_register');
		$this->data["nav_search"] = $this->lang->line('menu_search');
		$this->data["nav_game_search"] = $this->lang->line('menu_search_games');
		$this->data["nav_language"] = $this->lang->line('menu_language');
		$this->data["title"] = $this->lang->line('menu_title');
		$this->data["game_rating"] = $this->lang->line('menu_rating');
		$this->data['base_url'] = base_url();

		$this->lang->load('admin_lang',$this->session->userdata('language'));

		$this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
		$this->data["admin_addgames"] = $this->lang->line('admin_addgames');

		if (strpos($this->uri->uri_string(), 'loadReviews') == false)
			$this->session->set_userdata('redirect', $this->uri->uri_string());
	}
	
	public function index() {
		$this->load->library('googlemaps');
		$config['center'] = '58.380116, 26.7224966';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		
		$marker = array();
		$marker['position'] = '58.380116, 26.7224966';
		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('about/view_about', $this->data);
		$this->load->view('templates/footer');
	}
}

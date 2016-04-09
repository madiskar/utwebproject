<?php
class About extends CI_Controller {

	var $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('stats_model');
		$this->load->helper('url_helper');
		$this->load->helper('url');
		$this->lang->load('menu_lang',$this->session->userdata('language'));
		$this->lang->load('about_lang',$this->session->userdata('language'));
		$this->data["nav_home"] = $this->lang->line('menu_homepage');
		$this->data["nav_login"] = $this->lang->line('menu_log_in');
		$this->data["nav_register"] = $this->lang->line('menu_register');
		$this->data["nav_search"] = $this->lang->line('menu_search');
		$this->data["nav_game_search"] = $this->lang->line('menu_search_games');
		$this->data["nav_language"] = $this->lang->line('menu_language');
		$this->data["title"] = $this->lang->line('menu_title');
		$this->data["game_rating"] = $this->lang->line('menu_rating');
		$this->data['base_url'] = base_url();
		$this->data["gamecount"] = $this->lang->line('gamecount');
		$this->data["usercount"] = $this->lang->line('usercount');
		$this->data["reviewcount"] = $this->lang->line('reviewcount');
		
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
		
		$this->statsToXML();
		
		$marker = array();
		$marker['position'] = '58.380116, 26.7224966';
		$this->googlemaps->add_marker($marker);
		$this->data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('about/view_map', $this->data);
		$this->load->view('about/view_stats', $this->data);
		$this->load->view('templates/footer');
	}
	
	public function statsToXML() {
		$gamecount = $this->stats_model->getGameCount();
		$reviewcount = $this->stats_model->getReviewCount();
		$usercount = $this->stats_model->getUserCount();
		
		$xml = new DOMDocument();		
		
		$xml_statsnode = $xml->createElement("stats");
		
		$xml_gamecount = $xml->createElement("gamecount");
		$xml_gamecount->nodeValue = $gamecount[0]['gamecount'];
		
		$xml_reviewcount = $xml->createElement("reviewcount");
		$xml_reviewcount->nodeValue = $reviewcount[0]['reviewcount'];
		
		$xml_usercount = $xml->createElement("usercount");
		$xml_usercount->nodeValue = $usercount[0]['usercount'];
		
		$xml_statsnode->appendChild($xml_gamecount);
		$xml_statsnode->appendChild($xml_reviewcount);
		$xml_statsnode->appendChild($xml_usercount);
		$xml->appendChild($xml_statsnode);
		
		$xml->formatOutput = true;	
		$xml->save("/webpages/wasdreviewscsut/public_html/public/xml/stats.xml");
	}
}

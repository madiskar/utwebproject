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
		$this->data["nav_about"] = $this->lang->line('menu_about');
		$this->data["nav_login"] = $this->lang->line('menu_log_in');
		$this->data["nav_register"] = $this->lang->line('menu_register');
		$this->data["nav_search"] = $this->lang->line('menu_search');
		$this->data["nav_about"] = $this->lang->line('menu_about');
		$this->data["nav_game_search"] = $this->lang->line('menu_search_games');
		$this->data["nav_language"] = $this->lang->line('menu_language');
		$this->data["title"] = $this->lang->line('menu_title');
		$this->data["game_rating"] = $this->lang->line('menu_rating');
		$this->data['base_url'] = base_url();
		$this->data["gamecount"] = $this->lang->line('gamecount');
		$this->data["usercount"] = $this->lang->line('usercount');
		$this->data["reviewcount"] = $this->lang->line('reviewcount');
		$this->data["gamecount1"] = $this->lang->line('gamecount1');
		$this->data["gamecount2"] = $this->lang->line('gamecount2');
		$this->data["gamecount3"] = $this->lang->line('gamecount3');
		$this->data["gamecount4"] = $this->lang->line('gamecount4');
		$this->data["gamecount5"] = $this->lang->line('gamecount5');
		$this->data["gamecount6"] = $this->lang->line('gamecount6');
		$this->data["gamecount7"] = $this->lang->line('gamecount7');
		$this->data["gamecount8"] = $this->lang->line('gamecount8');
		$this->data["gamecount9"] = $this->lang->line('gamecount9');
		$this->data["gamecount10"] = $this->lang->line('gamecount10');
		$this->data["mostactive"] = $this->lang->line('mostactive');
		$this->data["howmany"] = $this->lang->line('reviews');
		$this->data["mapstuff"] = $this->lang->line('mapstuff');
		$this->data["statstuff"] = $this->lang->line('statstuff');
		
		$this->lang->load('admin_lang',$this->session->userdata('language'));

		$this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
		$this->data["admin_addgames"] = $this->lang->line('admin_addgames');

		if (strpos($this->uri->uri_string(), 'loadReviews') == false)
			$this->session->set_userdata('redirect', $this->uri->uri_string());
	}
	
	public function index() {
		$this->load->library('googlemaps');
		$config['center'] = '58.380116, 26.7224966';
		$config['zoom'] = '15';
		$this->googlemaps->initialize($config);
		
		$this->statsToXML();
		
		$marker = array();
		$marker['position'] = '58.380116, 26.7224966';
		$marker['animation'] = 'BOUNCE';
		$marker['infowindow_content'] = 'raekoja plats';
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
		$activeuser = $this->stats_model->getMostActiveUser();
		
		$xml = new DOMDocument();
		$xml_statsnode = $xml->createElement("stats");
		$xml_genrecount = $xml->createElement("genrecount");
		
		$genreCountArray = $gamecount[0];
		foreach($genreCountArray as $genre => $countValue) {
			$xml_valuenode = $xml->createElement($genre);
			$xml_valuenode->nodeValue = $countValue;
			$xml_genrecount->appendChild($xml_valuenode);
		}
			
		$xml_reviewcount = $xml->createElement("reviewcount");
		$xml_reviewcount->nodeValue = $reviewcount[0]['reviewcount'];
		
		$xml_usercount = $xml->createElement("usercount");
		$xml_usercount->nodeValue = $usercount[0]['usercount'];
		
		$xml_mostactive = $xml->createElement("mostactive");
		$xml_username = $xml->createElement("username");
		$xml_username->nodeValue = $activeuser[0]['username'];
		$xml_userreviewcount = $xml->createElement("userreviewcount");
		$xml_userreviewcount->nodeValue = $activeuser[0]['reviews'];
		$xml_mostactive->appendChild($xml_username);
		$xml_mostactive->appendChild($xml_userreviewcount);
		
		$xml_statsnode->appendChild($xml_genrecount);
		$xml_statsnode->appendChild($xml_reviewcount);
		$xml_statsnode->appendChild($xml_usercount);
		$xml_statsnode->appendChild($xml_mostactive);
		$xml->appendChild($xml_statsnode);
		
		$xml->formatOutput = true;	
		$xml->save("/webpages/wasdreviewscsut/public_html/public/xml/stats.xml");
	}
}

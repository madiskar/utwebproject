<?php

class Browse extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('games_model');
		$this->load->helper('url_helper');
		$this->load->helper('url');
	}
	
	public function update_games()
	{
		$sorted = $this->games_model->get_games();
		
		$sortBY = $_REQUEST["sortby"];
		$zanr = $_REQUEST["genre"];
		//echo $sortBY;
		//echo $zanr;
	
		if($sortBY == "AZ") {
			sort($sorted);
		}
	
		if($sortBY == "ZA") {
			rsort($sorted);
		}
		$toJsArr = array();
		foreach($sorted as $game):
			$internalArr = array();
			$internalArr[] = $game['title'];
			$internalArr[] = $game['description'];
			$internalArr[] = $game['average_rating'];
			$internalArr[] = $game['slug'];
			$toJsArr[] = $internalArr;
			
		endforeach;
		echo json_encode($toJsArr);
	}
	
	public function index()
	{			
		//$data['gameselection'] = $this->games_model->get_games();
		$data['title'] = 'Sirvi pelasid';
		$data['base_url'] = base_url();
		
		
	
		$this->load->view('templates/header', $data);
		$this->load->view('browse/view_browse', $data);
		$this->load->view('templates/footer');
		
		
	}
	

}

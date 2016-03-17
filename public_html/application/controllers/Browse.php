<?php

class Browse extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('games_model');
		$this->load->helper('url_helper');
		$this->load->helper('url');
	}
	
	public function cmpRating($a, $b)
	{	
		return strcmp($a['average_rating'], $b['average_rating']);
	}
	
	public function cmpTitle($a, $b)
	{
		return strcmp($a['title'], $b['title']);
	}
	
	public function update_games()
	{
		$games = $this->games_model->get_games();
		
		$sortBY = $_REQUEST["sortby"];
		$zanr = $_REQUEST["genre"];

		
		if($sortBY == "bestFirst")
		{
			usort($games, array($this, "cmpRating"));
			$games = array_reverse($games);
		}
		
		if($sortBY == "worstFirst")
		{
			usort($games, array($this, "cmpRating"));
		}
	
		if($sortBY == "AZ") {
			usort($games, array($this, "cmpTitle"));
		}
	
		if($sortBY == "ZA") {
			usort($games, array($this, "cmpTitle"));
			$games = array_reverse($games);
		}
		
		$toJs = array();
		foreach($games as $game):
			$internalArr = array();
			$internalArr[] = $game['title'];
			$internalArr[] = $game['description'];
			$internalArr[] = $game['average_rating'];
			$internalArr[] = $game['slug'];
			$toJs[] = $internalArr;
		endforeach;
		
		echo json_encode($toJs);
	}
	
	public function index()
	{			
		$data['title'] = 'Sirvi pelasid';
		$data['base_url'] = base_url();
		
		$this->load->view('templates/header', $data);
		$this->load->view('browse/view_browse', $data);
		$this->load->view('templates/footer');			
	}

}

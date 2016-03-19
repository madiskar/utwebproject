<?php

class Browse extends CI_Controller {
	
	
	public function __construct()
	{
        parent::__construct();
        $this->load->model('games_model');
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->lang->load('menu_lang',$this->session->userdata('language'));
        $this->lang->load('browse_lang',$this->session->userdata('language'));
        $this->data["nav_home"] = $this->lang->line('menu_homepage');
        $this->data["nav_login"] = $this->lang->line('menu_log_in');
        $this->data["nav_register"] = $this->lang->line('menu_register');
        $this->data["nav_search"] = $this->lang->line('menu_search');
        $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
        $this->data["nav_language"] = $this->lang->line('menu_language');
        $this->data["title"] = $this->lang->line('menu_title');
        $this->data["game_rating"] = $this->lang->line('menu_rating');
        //browse bar & sort
        $this->data["genre"] = $this->lang->line('genre');
        $this->data["sort"] = $this->lang->line('sort');
        $this->data["parimad"] = $this->lang->line('parimad');
        $this->data["halvimad"] = $this->lang->line('halvimad');
        $this->data["sirvi"] = $this->lang->line('sirvi');
        //Genres
        $this->data["all"] = $this->lang->line('all');
		$this->data["action"] = $this->lang->line('action');
		$this->data["adventure"] = $this->lang->line('adventure');
		$this->data["casual"] = $this->lang->line('casual');
		$this->data["indie"] = $this->lang->line('indie');
		$this->data["mmo"] = $this->lang->line('mmo');
		$this->data["racing"] = $this->lang->line('racing');
		$this->data["rpg"] = $this->lang->line('rpg');
		$this->data["simulation"] = $this->lang->line('simulation');
		$this->data["sports"] = $this->lang->line('sports');
		$this->data["strategy"] = $this->lang->line('strategy');

        $this->data['base_url'] = base_url();
                
        $this->lang->load('admin_lang',$this->session->userdata('language'));
                
        $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
        $this->data["admin_addgames"] = $this->lang->line('admin_addgames');

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
		$sortBY = $_REQUEST["sortby"];
		$zanr = $_REQUEST["genre"];

		$games = $this->games_model->get_games_browse($zanr);
		
		if($sortBY == "bestFirst")
		{
			usort($games, array($this, "cmpRating"));
			$games = array_reverse($games);
		}
		
		else if($sortBY == "worstFirst")
		{
			usort($games, array($this, "cmpRating"));
		}
	
		else if($sortBY == "AZ") {
			usort($games, array($this, "cmpTitle"));
		}
	
		else if($sortBY == "ZA") {
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
			$internalArr[] = $game['thmb_extension'];
			$toJs[] = $internalArr;
		endforeach;
		
		echo json_encode($toJs);
	}
	
	public function index()
	{			
		$this->data['title'] = 'Sirvi pelasid';
		$this->data['base_url'] = base_url();
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('browse/view_browse', $this->data);
		$this->load->view('templates/footer');			
	}

}

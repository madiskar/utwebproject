<?php
class Games_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
		
		public function get_games($slug = FALSE)
		{
				if ($slug === FALSE)
				{
						$query = $this->db->query("SELECT * FROM view_games ORDER BY id DESC LIMIT 20");
						return $query->result_array();
				}
				$query = $this->db->query("SELECT * FROM view_game_page WHERE slug='" .$slug. "'");
				return $query->row_array();
		}
		public function get_games_browse($genre)
		{
			if($genre == "all") 
			{
				$query = $this->db->query("SELECT * FROM view_games");
				return $query->result_array();
			}
			else
			{
				$query = $this->db->query("SELECT * FROM view_games_by_genres WHERE genre = '".$genre."'");
				return $query->result_array();
			}
		}
		public function get_newest_game($id = FALSE){
			$query = $this->db->query("SELECT * FROM view_games WHERE id>'" .$id. "'");
			return $query->result_array();
		}

		public function get_newest_id(){
			$query = $this->db->query("SELECT id FROM view_games ORDER BY id DESC LIMIT 1");
			return $query->row_array();
		}
		public function get_games_search($searchquery)
		{
				$newQuery = str_replace(' ', '%', $searchquery);
				$query = $this->db->query("SELECT * FROM view_search WHERE title LIKE '%" . addslashes($newQuery) . "%'");
						return $query->result_array();
		}
		public function get_reviews($gameid = 1, $start)
		{
			$query = $this->db->query("SELECT * FROM view_reviews_by_game WHERE game_id = '" . $gameid . " ' ORDER BY id DESC LIMIT " . $start . ",5");
			return $query->result_array();
		}
		
		public function get_has_user_reviewed($gameid = 1, $username){
			$query = $this->db->query("SELECT * FROM view_reviews_by_game WHERE game_id = '" . $gameid . "' AND username = '" . $username . "' ORDER BY id DESC");
			if($query->num_rows() == 0) {
				return FALSE;
			} else {
				return $query->row_array();
			}
		}
		
		public function set_games($thumbnail)
		{
		    $this->load->helper('url');
		    $slug = url_title($this->input->post('title'), 'dash', TRUE);
		    $name = $thumbnail['data']['file_name'];
		    $scrsht_extensions = '';
		    $screenshots = $this->input->post('screenshots');
		    $trimmed = rtrim($screenshots, "|");
		    $pieces = explode("|", $trimmed);
			$i = 1;
			foreach ($pieces as $piece){
				$nameParts = explode(".", $piece);
				$newName = str_replace(' ', '_', $piece);
				rename("./uploads/".$newName, "./public/images/" . $slug . "/screenshot" . $i . "." . $nameParts[1]);
				$scrsht_extensions = $scrsht_extensions . "." . end($nameParts) . " ";
				$i += 1;
			}
			$trimmed_ext = rtrim($scrsht_extensions, " ");
			$newRev = nl2br($this->input->post('mainrev'));
		    $data = array(
		        'title' => $this->input->post('title'),
		        'slug' => $slug,
		        'description' => $this->input->post('description'),
		        'mainrev' => $newRev,
		        'mainrating' => $this->input->post('mainrating'),
		        'thmb_extension' => $name,
		        'scrsht_extensions' => $trimmed_ext
		    );
		    $qry = $this->db->query("CALL set_games_procedure('". addslashes($data['title']) ."','". addslashes($data['slug']) ."', '". addslashes($data['description']) ."','". addslashes($data['mainrev']) ."','". $data['mainrating'] ."','". $data['thmb_extension'] ."', '". $data['scrsht_extensions'] ."')"); 
		    $query = $this->db->query("SELECT id FROM games WHERE slug='" . addslashes($slug) . "'");
        	$newId = $query->row('id');
        	$genreArray = $this->input->post('genres');
        	foreach($genreArray as $genre){
        		$this->db->query("CALL set_games_to_genres_procedure('". $newId."', '". $genre ."')");
        	}
		    return $qry;
		}
		
		public function remove_games($id)
		{
			$qry = $this->db->query("CALL remove_game(".$id.")");
			return $qry;
		}
		
		public function set_reviews()
		{
		    $this->load->helper('url');
		    $data = array(
		        'review' => nl2br($this->input->post('review')),
		        'rating' => $this->input->post('rating'),
		        'user_id' => $this->input->post('user_id'),
		        'game_id' => $this->input->post('game_id')
		    );
		    if ($this->input->post('is_update')=='0'){
		    	return $this->db->query("CALL set_reviews_procedure('". addslashes($data['review']) ."', '". $data['rating'] ."','". $data['user_id'] ."', '". $data['game_id'] ."')");
		    } else {
		    	return $this->db->query("CALL update_reviews_procedure('". addslashes($data['review']) ."', '". $data['rating'] ."','". $data['user_id'] ."', '". $data['game_id'] ."')");
		    }
		}
		
		public function remove_reviews()
		{
		    $this->load->helper('url');
		    $data = array(
		        'user_id' => $this->input->post('user_id'),
		        'game_id' => $this->input->post('game_id')
		    );
		    
		    return $this->db->query("CALL remove_reviews_procedure('". $data['user_id'] ."', '". $data['game_id'] ."')");
		}
}
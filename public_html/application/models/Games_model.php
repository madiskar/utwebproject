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
						$query = $this->db->query("SELECT games.id, mainrev, mainrating, slug, title, description, thmb_extension, ROUND((SUM(rating)+mainrating)/(COUNT(*)+1),2) AS average_rating FROM games LEFT JOIN reviews ON reviews.game_id = games.id GROUP BY games.id");
						return $query->result_array();
				}
				$query = $this->db->query("SELECT games.id, mainrev, mainrating, slug, title, description, scrsht_extensions FROM games WHERE games.slug='" .$slug. "'");
				return $query->row_array();
		}
		public function get_games_search($searchquery)
		{
				$newQuery = str_replace(' ', '%', $searchquery);
				$query = $this->db->query("SELECT games.id, mainrev, mainrating, slug, title, description, thmb_extension, ROUND((SUM(rating)+mainrating)/(COUNT(*)+1),2) AS average_rating FROM games LEFT JOIN reviews ON reviews.game_id = games.id GROUP BY games.id HAVING games.title LIKE '%" . $newQuery . "%'");
						return $query->result_array();
		}
		public function get_reviews($gameid = 1, $start)
		{
			$query = $this->db->query("SELECT reviews.review, reviews.rating, users.username FROM reviews INNER JOIN users ON reviews.user_id=users.id Where game_id = '" . $gameid . " ' ORDER BY reviews.id DESC LIMIT " . $start . ",5");
			return $query->result_array();
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
		    $data = array(
		        'title' => $this->input->post('title'),
		        'slug' => $slug,
		        'description' => $this->input->post('description'),
		        'mainrev' => $this->input->post('mainrev'),
		        'mainrating' => $this->input->post('mainrating'),
		        'thmb_extension' => $name,
		        'scrsht_extensions' => $trimmed_ext
		    );
		    $qry = $this->db->query("INSERT INTO games (title, slug, description, mainrev, mainrating, thmb_extension, scrsht_extensions) VALUES ('" . $data['title'] . "', '" . $data['slug'] . "', '" . $data['description'] . "', '" . $data['mainrev'] . "', " . $data['mainrating'] . ", '" . $data['thmb_extension'] . "', '" . $data['scrsht_extensions'] . "')"); 
		    $query = $this->db->query("SELECT id FROM games WHERE slug='" . $slug . "'");
        	$newId = $query->row('id');
        	$genreArray = $this->input->post('genres');
        	foreach($genreArray as $genre){
        		$this->db->query("INSERT INTO games_to_genres(game_id, genre_id) VALUES (" . $newId . ", " . $genre . ")");
        	}
		    return $qry;
		}
		
		public function set_reviews()
		{
		    $this->load->helper('url');
		    $data = array(
		        'review' => $this->input->post('review'),
		        'rating' => $this->input->post('rating'),
		        'user_id' => $this->input->post('user_id'),
		        'game_id' => $this->input->post('game_id')
		    );
		    return $this->db->query("INSERT INTO reviews (review, rating, user_id, game_id) VALUES ('" . $data['review'] . "', " . $data['rating'] . ", " . $data['user_id'] . ", " . $data['game_id'] . ")"); /*$this->db->insert('reviews', $data);*/
		}
}
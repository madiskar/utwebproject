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
						$query = $this->db->query("SELECT games.id, mainrev, mainrating, slug, title, description, ROUND((SUM(rating)+mainrating)/(COUNT(*)+1),2) AS average_rating FROM games JOIN reviews ON reviews.game_id = games.id GROUP BY games.id");
						return $query->result_array();
				}

				/*$query = $this->db->query("SELECT * FROM games WHERE slug = '" . $slug . "'"); $this->db->get_where('games', array('slug' => $slug));*/
				$query = $this->db->query("SELECT games.id, mainrev, mainrating, slug, title, description, ROUND((SUM(rating)+mainrating)/(COUNT(*)+1),2) AS average_rating FROM games JOIN reviews ON reviews.game_id = games.id WHERE games.slug='" .$slug. "'");
				return $query->row_array();
		}

		public function get_reviews($gameid = 1)
		{
			$query = $this->db->query("SELECT reviews.review, reviews.rating, users.username FROM reviews INNER JOIN users ON reviews.user_id=users.id Where game_id = '" . $gameid . "'");
			return $query->result_array();
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
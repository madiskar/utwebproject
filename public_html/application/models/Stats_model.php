<?php
class Stats_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
		
	public function getGameCount() {
		$query = $this->db->query("SELECT (SELECT COUNT(*) FROM view_games) AS total_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='action') AS action_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='adventure') AS adventure_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='casual') AS casual_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='indie') AS indie_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='mmo') AS mmo_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='racing') AS racing_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='rpg') AS rpg_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='simulation') AS simulation_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='sports') AS sports_count, (SELECT COUNT(*) FROM view_games_by_genres WHERE genre='strategy') AS strategy_count");
		return $query->result_array();
	}
	
	public function getReviewCount() {
		$query = $this->db->query("SELECT COUNT(*) as reviewcount FROM view_reviews_by_game");
		return $query->result_array();
	}
	
	public function getUserCount() {
		$query = $this->db->query("SELECT COUNT(*) as usercount FROM view_user_info");
		return $query->result_array();
	}
	
	public function getMostActiveUser() {
		$query = $this->db->query("SELECT username, COUNT(*) AS reviews FROM view_reviews_by_game GROUP BY username ORDER BY COUNT(*) DESC LIMIT 1");
		return $query->result_array();
	}
}
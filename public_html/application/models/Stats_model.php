<?php
class Stats_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
		
	public function getGameCount() {
		$query = $this->db->query("SELECT COUNT(*) as gamecount FROM view_games");
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
}
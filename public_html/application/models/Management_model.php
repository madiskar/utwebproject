<?php
class Management_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_userinfo($username) {
		
		$query = $this->db->query("SELECT * FROM view_user_info WHERE username='" . $username . "'");
		if($query->num_rows() == 1) {
			return $query->row_array();
		}
		else {
			return FALSE;
		}
	}
	public function get_matching_users($username){
		$query = $this->db->query("SELECT * FROM view_user_info WHERE username LIKE '%" . $username . "%'");
		return $query->result_array();
	}
	
	public function update_userinfo($userid, $allowed, $admin) {
		return $this->db->query("CALL update_userinfo_procedure('". $userid ."','". $allowed ."','". $admin ."')");
		//return $this->db->query("UPDATE users SET allowed=1, admin=1 WHERE id=3");
	}
	
}
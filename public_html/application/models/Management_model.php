<?php

class Management_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_userinfo($username) {
		
		$query = $this->db->query("SELECT username, email, allowed, admin FROM users WHERE username='" . $username . "'");
		if($query->num_rows() == 1) {
			return $query->row_array();
		}
		else {
			return FALSE;
		}
	}
	
	public function update_userinfo($username, $allowed, $admin) {
		return $this->db->query("UPDATE users SET allowed='" . $allowed . "', admin='" . $admin . "' WHERE username='" . $username . "'");
	}
	
}
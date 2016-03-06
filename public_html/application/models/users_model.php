<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user($userid) 
	{
		$query = $this->db->query("SELECT * FROM users WHERE username = '" . $userid . "'");
		return $query;
	}
}
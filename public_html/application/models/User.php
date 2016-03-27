<?php
class User extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function log_in($user, $pass){
		
		$query = $this->db->query("SELECT * FROM view_user_passwords WHERE username='" . $user . "' AND password='". $pass . "'");
		if ($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
		
		
	}
}
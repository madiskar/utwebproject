<?php
class login_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_user(){
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT password FROM users WHERE username='" . $username . "'");
        	if($query->num_rows() > 0) {
        		$pass = $query->row("password");
        		return $pass;
        	} else {
        		return "";
        	}
        }
        
        public function check_if_admin() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT admin FROM users WHERE username='" . $username . "'");
        	if($query->row('admin') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function check_if_allowed() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT allowed FROM users WHERE username='" . $username . "'");
        	if($query->row('allowed') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function get_user_id() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT id FROM users WHERE username='" . $username . "'");
        	return $query->row('id');
        }
}
?>
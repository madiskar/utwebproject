<?php
class login_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function set_fbuser($username,$email){
        	 
        	return $this->db->query("CALL set_fbuser_procedure('" . $this->session->userdata('email') . "', '" . $this->session->userdata('username') . "')");
        	 
        }

        public function get_userid($username){
                $query = $this->db->query("SELECT id FROM view_user_info WHERE username='" . $username . "'");
                if($query->num_rows() == 1) {
                         return $query->row('id');
                }
        }
        
        public function get_fb_user_is_admin($username){
        	$query = $this->db->query("SELECT admin FROM view_user_info WHERE username='" . $username . "'");
        	if($query->row('admin') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }
        
        public function get_fb_user_is_allowed($username) {
        	
        	$query = $this->db->query("SELECT allowed FROM view_user_info WHERE username='" . $username . "'");
        	if($query->row('allowed') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }
        
        public function get_user(){
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT password FROM view_user_passwords WHERE username='" . $username . "'");
        	if($query->num_rows() > 0) {
        		$pass = $query->row("password");
        		return $pass;
        	} else {
        		return "";
        	}
        }

       public function get_user_fb($username){
        
        	$query = $this->db->query("SELECT username FROM view_user_info WHERE username='" . $username . "'");
        	if($query->num_rows() == 1) {
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        }
        
        public function check_if_admin() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT admin FROM view_user_info WHERE username='" . $username . "'");
        	if($query->row('admin') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function check_if_allowed() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT allowed FROM view_user_info WHERE username='" . $username . "'");
        	if($query->row('allowed') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function get_user_id() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT id FROM view_user_info WHERE username='" . $username . "'");
        	return $query->row('id');
        }
}
?>
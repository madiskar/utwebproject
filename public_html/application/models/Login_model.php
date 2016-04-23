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
                $query = $this->db->query("SELECT id FROM view_user_info WHERE username='" . addslashes($username) . "'");
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
        	
        	$query = $this->db->query("SELECT password FROM view_user_passwords WHERE username='" . addslashes($username) . "'");
        	if($query->num_rows() > 0) {
        		$pass = $query->row("password");
        		return $pass;
        	} else {
        		return "";
        	}
        }
        
        public function get_user_by_email($email){
        	
        	$query = $this->db->query("SELECT username FROM view_user_info WHERE email='" . addslashes($email) . "'");
        	if($query->num_rows() > 0) {
        		$pass = $query->row("username");
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
        	
        	$query = $this->db->query("SELECT admin FROM view_user_info WHERE username='" . addslashes($username) . "'");
        	if($query->row('admin') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function check_if_allowed() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT allowed FROM view_user_info WHERE username='" . addslashes($username) . "'");
        	if($query->row('allowed') == 1) {
        		return TRUE;
        	}
        	else {
        		return FALSE;
        	}
        }

        public function get_user_id() {
        	
        	$username = $this->input->post('username');
        	
        	$query = $this->db->query("SELECT id FROM view_user_info WHERE username='" . addslashes($username) . "'");
        	return $query->row('id');
        }
        
        public function get_current_recovery_key($user_id){
        	$query = $this->db->query("SELECT recovery_key FROM view_recovery_key WHERE user_id=" . $user_id . " AND expire_time > " . (time()) . "");
        	if($query->num_rows() > 0) {
        		$pass = $query->row("recovery_key");
        		return $pass;
        	} else {
        		return "";
        	}
        }
        
        public function set_recovery_key($user_id, $rec_key){
        	return $this->db->query("CALL add_recovery_key(".$user_id.", '". password_hash($rec_key, PASSWORD_DEFAULT) ."', " . (time() + 60*60) . ")");
        }
        
        public function set_new_password($user_id, $password){
        	return $this->db->query("CALL recover_user_password(".$user_id.", '". password_hash($password, PASSWORD_DEFAULT) ."')");
        }
}
?>
<?php
class Register_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function set_users(){
        	
        	$data = array(
        			'username' => $this->input->post('username'),
        			'email' => $this->input->post('email'),
        			'password' => $this->input->post('password'),
        	);
        	
        	return $this->db->query("CALL set_users_procedure('". addslashes($data['username']) ."','". addslashes($data['email']) ."', '". password_hash(addslashes($data['password']), PASSWORD_DEFAULT) ."')");
        	
        }
        
        public function get_user($username){
        	$query = $this->db->query("SELECT * FROM view_user_info WHERE username = '" . addslashes($username) . "'");
        	 if($query->num_rows() < 1) {
        	 	return true;
        	 }
        	 else {
        	 	return false;
        	 }
        }
        
        public function get_email($email) {
        	$query = $this->db->query("SELECT * FROM view_user_info WHERE email = '" . addslashes($email) . "'");
        	if($query->num_rows() < 1) {
        		return true;
        	}
        	else {
        		return false;
        	}
        }
}
?>
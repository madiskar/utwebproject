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
        	
        	return $this->db->query("INSERT INTO users (email, username, password, allowed, admin) VALUES ('" . $data['email'] . "', '" . $data['username'] . "', '" . password_hash($data['password'], PASSWORD_DEFAULT) . "', 1, 0)");
        	
        }
}
?>
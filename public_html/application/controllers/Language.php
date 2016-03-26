<?php
class Language extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
                $this->load->helper('url');
        }
        
        public function est(){
        	$this->session->set_userdata('language', 'estonian');
        	redirect('');
        }
        
        public function eng(){
        	$this->session->set_userdata('language', 'english');
        	redirect('');
        }
}
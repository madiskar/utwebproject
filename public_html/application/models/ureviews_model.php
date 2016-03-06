<?php
class Ureviews_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
		public function get_reviews($gameid = 1)
		{
				$query = $this->db->get_where('userreviews', array('gameid' => $gameid));
				return $query->row_array();
		}
}
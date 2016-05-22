<?php
class Games extends CI_Controller {
		
		var $data;
        public function __construct()
        {
                parent::__construct();
                $this->load->model('games_model');
                $this->load->helper('url_helper');
                $this->load->helper('url');
                $this->lang->load('menu_lang',$this->session->userdata('language'));
                $this->data["nav_home"] = $this->lang->line('menu_homepage');
                $this->data["nav_login"] = $this->lang->line('menu_log_in');
                $this->data["nav_register"] = $this->lang->line('menu_register');
                $this->data["nav_about"] = $this->lang->line('menu_about');
                $this->data["nav_search"] = $this->lang->line('menu_search');
                $this->data["nav_game_search"] = $this->lang->line('menu_search_games');
                $this->data["nav_language"] = $this->lang->line('menu_language');
                $this->data["title"] = $this->lang->line('menu_title');
                $this->data["game_rating"] = $this->lang->line('menu_rating');
                $this->data['base_url'] = base_url();
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_usermanagement"] = $this->lang->line('admin_usermanagement');
                $this->data["admin_addgames"] = $this->lang->line('admin_addgames');
            
				if (strpos($this->uri->uri_string(), 'loadReviews') == false && strpos($this->uri->uri_string(), 'get_new_game_event') == false && strpos($this->uri->uri_string(), 'get_newest_game') == false)
					$this->session->set_userdata('redirect', $this->uri->uri_string());
                
                $this->data["active_tab"] = 0;
        }

        public function index()
        {
                $this->data['games'] = $this->games_model->get_games();

                $this->data['title'] = 'M채ngud';
                
                $this->load->view('templates/header', $data);
                $this->load->view('games/index', $data);
                $this->load->view('templates/footer');
        }

        public function search()
        {
                $this->data['games'] = $this->games_model->get_games_search($this->input->post('searchQuery'));

                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->lang->load('menu_lang',$this->session->userdata('language'));
                $this->data["menu_search_result_success"] = $this->lang->line('menu_search_result_success');
                $this->data["menu_search_result_fail_begin"] = $this->lang->line('menu_search_result_fail_begin');
                $this->data["menu_search_result_fail_end"] = $this->lang->line('menu_search_result_fail_end');
                
                $this->data['title'] =  $this->data["nav_search"];
                $this->data['searchquery'] = $this->input->post('searchQuery');
                
                $this->load->view('templates/header', $this->data);
                if (empty($this->data['games'])){
                    $this->load->view('games/searchfail', $this->data);
                } else {
                    $this->load->view('games/searchresults', $this->data);
                }
                $this->load->view('games/index', $this->data);
                $this->load->view('templates/footer');
        }
		
		public function add()
        {
                $this->data["active_tab"] = 4;
                
                $this->config->set_item('language', $this->session->userdata('language'));
                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_game_name"] = $this->lang->line('admin_game_name');
                $this->data["admin_game_description"] = $this->lang->line('admin_game_description');
                $this->data["admin_game_tmb"] = $this->lang->line('admin_game_tmb');
                $this->data["admin_game_no_file"] = $this->lang->line('admin_game_no_file');
                $this->data["admin_game_choose_file"] = $this->lang->line('admin_game_choose_file');
                $this->data["admin_game_review"] = $this->lang->line('admin_game_review');
                $this->data["admin_game_rating"] = $this->lang->line('admin_game_rating');
                $this->data["admin_no_user"] = $this->lang->line('admin_no_user');
                $this->data["admin_game_add_success"] = $this->lang->line('admin_game_add_success');
                $this->data["admin_another_one"] = $this->lang->line('admin_another_one');
                $this->data["admin_go_home"] = $this->lang->line('admin_go_home');

		$this->lang->load('game_lang',$this->session->userdata('language'));
		$this->data["game_screenshot_text"] = $this->lang->line('game_screenshot_text');
		
                $this->form_validation->set_rules('title', $this->lang->line('game_empty_title'), 'required');
                $this->form_validation->set_rules('description', $this->lang->line('game_empty_description'), 'required');
                $this->form_validation->set_rules('mainrev', $this->lang->line('game_empty_mainrev'), 'required');
                $this->form_validation->set_rules('mainrating', $this->lang->line('game_empty_mainrating'), 'required');
                $this->form_validation->set_rules('screenshots', $this->lang->line('game_empty_screenshots'), 'required');
                $this->form_validation->set_rules('genres[]', $this->lang->line('game_empty_genres'), 'required');
                //$this->form_validation->set_rules('thumbnail', $this->lang->line('game_empty_thumbnail'), 'required');

                if (!is_dir('./public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/')) {
                    mkdir('./public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/', 0777, TRUE);
                }

                $config['upload_path']          = './public/images/'.url_title($this->input->post('title'), 'dash', TRUE).'/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000000;
                $config['max_width']            = 9999;
                $config['max_height']           = 9999;
                $config['file_name']            = "thumbnail";

                $this->load->library('upload', $config);
                
                $this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data['title'] = $this->lang->line('admin_addgames');
                
                if ($this->form_validation->run() === FALSE || !$this->upload->do_upload("thumbnail"))
                {
                    $this->load->view('templates/header', $this->data);
                    $this->load->view('games/add', $this->data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $thumbnail = array('data' => $this->upload->data());
                    $this->games_model->set_games($thumbnail);
                    $this->load->view('templates/header', $this->data);
                    $this->load->view('games/add_success', $this->data);
                    $this->load->view('templates/footer');
                }
        }
        
        function get_new_game_event()
        {
        	$this->data['data'] = $this->games_model->get_newest_id();
            $this->load->view('event/new_game', $this->data);
        }

        function get_newest_game($game_id){
        	$games = $this->games_model->get_newest_game($game_id);
        	$internalArr = array();
        	foreach($games as $game):
			$internalArr[] = $game['title'];
			$internalArr[] = $game['description'];
			if($game['average_rating']==null)
			{
				$internalArr[] = $game['mainrating'].".00";
			}
			else
			{
				$internalArr[] = $game['average_rating'];
			}
			$internalArr[] = $game['slug'];
			$internalArr[] = $game['thmb_extension'];
			$toJs[] = $internalArr;
		endforeach;
		
		echo json_encode($toJs);
        }
        
        function remove_game($game_id)
        {
        	
        	$this->lang->load('admin_lang',$this->session->userdata('language'));
                
                $this->data["admin_remove_success"] = $this->lang->line('admin_remove_success');
                $this->data["admin_remove_denied"] = $this->lang->line('admin_remove_denied');
                $this->data["admin_go_home"] = $this->lang->line('admin_go_home');
                $this->data['title'] = $this->lang->line('admin_remove_game');
                
        	if($this->session->userdata('is_admin') == TRUE)
        	{
        	    $this->games_model->remove_games($game_id);
                    $this->load->view('templates/header', $this->data);
                    $this->load->view('games/remove_success', $this->data);
                    $this->load->view('templates/footer');
        	}
        	else
        	{
        	    $this->load->view('templates/header', $this->data);
                    $this->load->view('games/remove_fail', $this->data);
                    $this->load->view('templates/footer');
        	}
        }

        function do_upload()
        {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            $config['max_width']  = '102400';
            $config['max_height']  = '76800';

            $this->load->library('upload', $config);
            
            if (!is_dir('./uploads/')) {
                    mkdir('./uploads/', 0777, TRUE);
                }

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                    $this->load->view('pages/avaleht');
                    $this->load->view('templates/footer');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                    $this->load->view('pages/avaleht');
                    $this->load->view('templates/footer');
                    $this->output->set_output($data['upload_data']['file_name']);
            }
        }

        private function set_upload_options()
        {   
            //upload an image options
            $config = array();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000';
            $config['max_width']  = '102400';
            $config['max_height']  = '76800';

            return $config;
        }

        public function view($slug = NULL)
        {
         $this->config->set_item('language', $this->session->userdata('language'));
                $this->load->helper('form');
   				$this->load->library('form_validation');
   				$this->lang->load('game_lang',$this->session->userdata('language'));
   				
   				
   				$this->data["game_admin_review"] = $this->lang->line('game_admin_review');
   				$this->data["game_final_rating"] = $this->lang->line('game_final_rating');
   				$this->data["game_not_logged_in"] = $this->lang->line('game_not_logged_in');
   				$this->data["game_log_in_to_review"] = $this->lang->line('game_log_in_to_review');
   				$this->data["game_user"] = $this->lang->line('game_user');
   				$this->data["game_user_end"] = $this->lang->line('game_user_end');
   				$this->data["game_not_allowed"] = $this->lang->line('game_not_allowed');
   				$this->data["game_leave_review"] = $this->lang->line('game_leave_review');
   				$this->data["game_review"] = $this->lang->line('game_review');
   				$this->data["game_rating"] = $this->lang->line('game_rating');
   				$this->data["game_add_review"] = $this->lang->line('game_add_review');
   				$this->data["game_change_review"] = $this->lang->line('game_change_review');
   				$this->data["game_update_review"] = $this->lang->line('game_update_review');
   				$this->data["game_delete_review"] = $this->lang->line('game_delete_review');
   				$this->data["game_delete_review_confirm"] = $this->lang->line('game_delete_review_confirm');
   				$this->data["game_review_added"] = $this->lang->line('game_review_added');
   				
   				
        	$this->lang->load('admin_lang',$this->session->userdata('language'));
                $this->data["admin_remove_game"] = $this->lang->line('admin_remove_game');
   					
   				
   				
                $this->data['games_item'] = $this->games_model->get_games($slug);
                if (empty($this->data['games_item']))
                {
                        show_404();
                }

                $this->lang->load('game_lang',$this->session->userdata('language'));
                $this->form_validation->set_rules('rating', $this->lang->line('game_rating'), 'required');
    			$this->form_validation->set_rules('review', $this->lang->line('game_review'), 'required');
    			$this->form_validation->set_rules('game_id', 'gid', 'required');
    			$this->form_validation->set_rules('user_id', 'Afsadasvustus', 'required');

                //$this->data['reviews'] = $this->games_model->get_reviews($this->data['games_item']['id']);

                $this->data['title'] = $this->data['games_item']['title'];
                if ($this->session->userdata('username') == FALSE){
                	$this->data['userHasLeftReview'] = FALSE;
                } else {
                	$review_array = $this->games_model->get_has_user_reviewed($this->data['games_item']['id'], $this->session->userdata('username'));
                	if ($review_array == FALSE) {
                		$this->data['userHasLeftReview'] = FALSE;
                		$this->data['prev_review'] = array(
				        'review' => "",
				        'rating' => "5"
				    );
                	} else {
                		$this->data['userHasLeftReview'] = TRUE;
                		$this->data['prev_review'] = $review_array;
                	}
                }

                
                if ($this->form_validation->run() === FALSE)
                {
		            $this->load->view('templates/header', $this->data);
		            $this->load->view('games/view_top', $this->data);
		            $this->load->view('games/view_form', $this->data);
		            $this->load->view('games/view_bottom', $this->data);
		            $this->load->view('templates/footer');
	            }
	            else
                {
		            if ($this->input->post('is_remove')=='0'){
		            	if (($this->input->post('is_update')=='0' && $this->data['userHasLeftReview'] == FALSE) || $this->input->post('is_update')=='1'){
	                		$this->games_model->set_reviews();
	                	}
	                    } else {
	                	$this->games_model->remove_reviews();
	                    }
                	    $this->load->view('templates/header', $this->data);
		            $this->load->view('games/view_top', $this->data);
		            if ($this->input->post('is_update')=='1'){
   				$this->data["game_review_added"] = $this->lang->line('game_review_updated');
		            }
		            if ($this->input->post('is_remove')=='1'){
   				$this->data["game_review_added"] = $this->lang->line('game_review_removed');
		            }
		            $this->load->view('games/view_success', $this->data);
		            $this->load->view('games/view_bottom', $this->data);
		            $this->load->view('templates/footer');
                }
        }
        
        public function loadReviews($game_id, $startInt){
        	$this->data['reviews'] = $this->games_model->get_reviews($game_id, $startInt);
        	$this->output->set_content_type('application/json')->set_output(json_encode($this->data['reviews']));
        }
}

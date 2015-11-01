<?php
	class Say_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('session');
		}
		
		/* table "say"
			fields - 	say_id | subject | statement | slug | views |
						positive | negative
		*/
		
		public function get_most_viewed_statements(){
			$this->db->order_by('views', 'DESC');
			$query = $this->db->get('say');
			return $query->results_array();
		}

		public function most_recent_count(){
			$this->db->order_by('views', 'DESC');
			$this->db->from('say');
			
			return $this->db->count_all_results();
		}
		
		public function most_recent_return($limit, $start){
		
			$this->db->order_by('date', 'DESC');
			$this->db->limit($limit, $start);
			$query = $this->db->get('say');
			
			return $query->result_array();
		}
		
		public function most_popular_count(){
			$this->db->order_by('views', 'DESC');
			$this->db->from('say');
			
			return $this->db->count_all_results();
		}
		
		public function most_popular_return($limit, $start){
		
			$this->db->order_by('views', 'DESC');
			$this->db->limit($limit, $start);
			$query = $this->db->get('say');
			
			return $query->result_array();
		}

		public function results_count(){
			$search = $this->session->userdata('search');
			
			$this->db->like('slug', $search);
			$this->db->or_like('statement', $search);
			$this->db->from('say');
			
			return $this->db->count_all_results();
			
			
			/* UNION ATTEMP CODES
			$this->db->like('slug', $search);
			$this->db->from('say');
			$data1 = $this->db->count_all_results();

			$this->db->like('slug', $search);
			$this->db->from('posts');
			$data2 = $this->db->count_all_results();
			
			$results = $data1 + $data2;
			
			return $results;*/
		}
		
		public function search_2($limit, $start){

			$search = $this->session->userdata('search');
		
			$this->db->order_by('views', 'DESC');
			$this->db->limit($limit, $start);
			$this->db->like('slug', $search);
			$this->db->or_like('statement', $search);
			$query = $this->db->get('say');
			
			return $query->result_array();
			
			/* UNION ATTEMPT CODES
			$this->db->like('slug', $search);
			$this->db->select('slug, image_url, subject');
			$this->db->get('say');
			$query1 = $this->db->last_query();
			
			$this->db->like('slug', $search);
			$this->db->select('slug, image_url, subject');
			$this->db->get('posts');
			$query2 = $this->db->last_query();
			
			$query = $this->db->query($query1.' UNION '.$query2.' LIMIT '.$start.', '.$limit);
			return $query->result_array();*/
		}
		
		public function vote(){
			$id = $this->input->post('say_id');
			
			if(isset($_POST['yes'])){
				$this->db->select('positive');
				$this->db->select('slug');
				$this->db->where('say_id', $id);
				$query = $this->db->get('say');
				
				foreach($query->result() as $row){
					$vote = $row->positive;
					$slug = $row->slug;
				}
				
				$data = array(
						'positive'	=> $vote + 1
				);
				$this->db->where('say_id', $id);
				$this->db->update('say', $data);
				//positive +1 done
			}
			else{
				$this->db->select('negative');
				$this->db->select('slug');
				$this->db->where('say_id', $id);
				$query = $this->db->get('say');
				
				foreach($query->result() as $row){
					$vote = $row->negative;
					$slug = $row->slug;
				}
				
				$data = array(
						'negative'	=> $vote + 1
				);
				$this->db->where('say_id', $id);
				$this->db->update('say', $data);
				//negative +1 done
			}

			$query = $this->db->get_where('say', array('slug' => $slug));
			return $slug;
		}
		
		public function post_say(){
			$this->db->select('post_number');
			$query = $this->db->get('post_number');
			
			foreach($query->result() as $row){
				$post_number = $row->post_number + 1;
			}
			$data = array(
				'post_number' => $post_number
			);
			$this->db->update('post_number', $data);
			
			$slug = "statement to ".$this->input->post('subject')."-".$post_number;
			$slug = url_title($slug, 'dash', TRUE);
			$hits = 1;
			
			$data = array(
					'subject'	=> $this->input->post('subject'),
					'statement'	=> $this->input->post('statement'),
					'image_url'	=> $this->input->post('image_url'),
					'slug'		=> $slug,
					'views'		=> 0,
					'positive'	=> 0,
					'negative'	=> 0,
					'date' => date("Y-m-d")
			);
			$this->db->insert('say', $data);
			
			return $slug;
		}
		
		public function get_recent_statements(){
			$this->db->order_by('say_id', 'DESC');
			$query = $this->db->get('say', 5);
			return $query->result_array();
		}
		
		public function get_related($slug){
			$this->db->select('subject');
			$this->db->where('slug', $slug);
			$query = $this->db->get('say');
			
			foreach($query->result() as $row){
				$subject = $row->subject;
			}
			
			$this->db->order_by('views', 'DESC');
			$this->db->like('subject', $subject);
			$this->db->or_like('statement', $subject);
			$this->db->or_like('slug', $subject);
			$this->db->where('slug !=', $slug);
			$query = $this->db->get('say', 5);
			
			return $query->result_array();
		}
		
		public function get_say($slug = FALSE){
			if($slug === FALSE){
				$this->db->order_by('views', 'DESC');
				$query = $this->db->get('say', 5);
				return $query->result_array();
			}
			
			//$query = $this->db->get_where('say', array('slug' => $slug));
			
			// add 1 to views every request
			$this->db->select('views');
			$this->db->where('slug', $slug);
			$query = $this->db->get('say');
			
			foreach ($query->result() as$row){
				$views = $row->views;
			}
			
			$data = array(
					'views' => $views + 1
			);
			$this->db->where('slug', $slug);
			$this->db->update('say', $data);
			// views add 1 done!
			
			//now return the requested data
			$query = $this->db->get_where('say', array('slug' => $slug));
			return $query->row_array();
		}
		
	}
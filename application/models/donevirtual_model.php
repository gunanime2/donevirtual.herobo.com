<?php
	class Donevirtual_model extends CI_Model{
		
		public function __construct(){
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('session');
		}
		
		public function post_deed(){
			/*get the post_number first before 
			actually inserting the post, for uniqueness*/
			$this->db->select('post_number');	
			$query = $this->db->get('post_number');
			foreach ($query->result() as $row){
				$post_number = $row->post_number + 1;
			}
			$data = array(
					'post_number' => $post_number
			);
			$this->db->update('post_number', $data); //then update the post_number to recent number
			
			//for a longer much more clean and understandable URL
			$slug1 = $this->input->post('subject')." ".$this->input->post('action')." in the ".$this->input->post('setting');
		
			$slug = url_title($slug1, 'dash', TRUE);
			$hits = 1;
			$slug = $slug."-".$post_number; //post_number concatinated to the URL,for uniqueness and prevent duplicated url
			
			$data = array(
					'subject' => $this->input->post('subject'),
					'slug' => $slug, 
					'action' => $this->input->post('action'),
					'setting' => $this->input->post('setting'),
					'image_url' => $this->input->post('image_url'),
					'hits' => $hits,
					'date' => date("Y-m-d")
					);
					
					$this->db->insert('posts', $data);

					return $slug;
		}
		
		public function get_recent_deeds(){
			$this->db->order_by('post_id', 'DESC');
			$query = $this->db->get('posts', 5);
			return $query->result_array();
		}
		
		public function get_post($slug = FALSE){
			if($slug === FALSE){ //if the slug is not detirmined show all posts
				$this->db->order_by('hits', 'DESC');
				$query = $this->db->get('posts', 5);
				return $query->result_array();
			}
			
			//if slug is determined, provide requested post according to slug
			//$query = $this->db->get_where('posts', array('slug' => $slug));
			
			//update, +1 to the views per request
			$this->db->select('views');
			$this->db->where('slug', $slug);
			$query = $this->db->get('posts');
			
			foreach ($query->result() as $row){
				$views = $row->views;
			}
			
			$data = array(
					'views' => $views + 1
			);
			$this->db->where('slug', $slug);
			$this->db->update('posts', $data);
			//views column updated, +1 done
			
			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}
		
		public function get_related($slug)
		{
			$this->db->select('subject');
			$this->db->select('post_id');
			$this->db->where('slug', $slug);
			$query = $this->db->get('posts'); //get the subject of the current requested post
			
			foreach ($query->result() as $row){
				$subject = $row->subject;	//store subject in a variable
				$post_id = $row->post_id;
			}
			
			$this->db->order_by('views', 'DESC');
			$this->db->like('subject', $subject);
			$this->db->or_like('slug', $subject);
			$this->db->or_like('action', $subject);
			$this->db->where('slug !=', $slug);
			$query = $this->db->get('posts', 5); //select subject from posts where subject is like $subject
			
			return $query->result_array(); //return related posts
		}
		
		public function plus_one(){
			$id = $this->input->post('post_id'); //save the id value into variable for better accesibility
			$slug = $this->input->post('slug');
			
			$this->db->select('hits'); 		//select hits column
			$this->db->select('post_id');	//and post id column
			$query = $this->db->get('posts');//from posts table
			
			foreach ($query->result() as $row){
				if ($row->post_id === $id){ //pick the row according to the post id that needs to be updated
				$post_number = $row->hits + 1;
				}
			}

			$data = array(
					'hits' => $post_number
			);
			$this->db->where('slug', $slug);
			$this->db->update('posts', $data);
			
			return $slug; //returned slug instead for user to be redirected to his updated query

		}
		
		public function search(){
			$search = $this->input->post('search');
			
			$this->db->like('slug', $search);
			$query = $this->db->get('posts');
			return $query->result_array();
		}
		
		//under construction search function 2
		public function results_count(){
			$search = $this->session->userdata('search');
			
			$this->db->like('slug', $search);
			$this->db->from('posts');
			
			return $this->db->count_all_results();
		}
		
		public function search_2($limit, $start){
			$search = $this->session->userdata('search');
		
			$this->db->limit($limit, $start);
			$this->db->like('slug', $search);
			$query = $this->db->get('posts');
			
			return $query->result_array();
		}
		
	}
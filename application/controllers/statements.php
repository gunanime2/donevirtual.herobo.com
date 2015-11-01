<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statements extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('say_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('text');
		$this->load->library('pagination');
	}

	public function index(){
		$data['title'] = 'Statements - Done Virtual';
		
		$this->load->view('statements/statements_header', $data);
		$this->load->view('statements/search_bar');
		
		$data['post'] = $this->say_model->get_say(); // get most viewed
		$data['recent'] = $this->say_model->get_recent_statements(); // get most viewed
		$this->load->view('statements/popular_slider', $data);
		$this->load->view('statements/statements_most_viewed', $data); // display most viewed
		
		$data['post'] = $this->say_model->get_recent_statements(); //get recent statements
		$this->load->view('statements/statements_most_recent', $data); //display most recent
		
		$this->load->view('templates/footer');
	}
	
	public function about(){
		$data['title'] = 'About Us';
		
		$this->load->view('statements/statements_header', $data);
		$this->load->view('statements/search_bar');
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
		
	}
		
	public function search_value(){
		if($this->input->post('search') == NULL){
				redirect('statements'); //if search is empty
		}
			
			$search = array(
						'search' => $this->input->post('search')
					);
			$this->session->set_userdata($search); 
			$this->search_2();
	}
		
	public function search_2(){
			$search = $this->session->userdata('search');
			$config = array();
			$config['base_url'] = base_url() . 'statements/search_2';
			$config['total_rows'] = $this->say_model->results_count();
			$config['per_page'] = 2;
			$config['uri_segment'] = 3;
			$choice = $config['total_rows'] / $config['per_page'];
			$config['num_links'] = round($choice);

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['post'] = $this->say_model->search_2($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();
			
			$data['title'] = 'Results for '.$this->session->userdata('search');
			$this->load->view('statements/statements_header', $data);
			$this->load->view('statements/search_bar');
			$this->load->view('statements/statements_results', $data);
			
			$data['post'] = $this->say_model->get_say(); // get most viewed
			$this->load->view('statements/statements_most_viewed', $data); // display most viewed
			
			$data['post'] = $this->say_model->get_recent_statements(); //get recent statements
			$this->load->view('statements/statements_most_recent', $data); //display most recent
			
			$this->load->view('templates/footer');
	}
	
	public function vote(){
		session_start();
		$captcha = $this->captcha_check();
		
		if($captcha == FALSE){
			$data['title'] = 'Captcha Error!';
			$this->load->view('statements/statements_header', $data);
			$this->load->view('statements/search_bar');
			$this->load->view('pages/captcha_error');
			$this->load->view('templates/footer');
		}
		else{
			$slug = $this->say_model->vote();
			
			redirect('view_statements/'.$slug);
		}
	}
	
	public function say(){
		session_start();
		
		$data['title'] = 'Say It Virtual - Done Virtual';
		$this->load->library('form_validation');

		if($this->form_validation)
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('statement', 'Statement', 'required');
			$this->form_validation->set_rules('image_url', 'Image Url', 'required');
			
			if($this->form_validation->run() === FALSE){
				$this->load->view('statements/statements_header', $data);
				$this->load->view('statements/search_bar');
				$this->load->view('statements/say');
				$this->load->view('templates/footer');
			}
			else{
				$captcha = $this->captcha_check();
				
				if($captcha == FALSE){
					$data['title'] = 'Captcha Error!';
					$this->load->view('statements/statements_header', $data);
					$this->load->view('statements/search_bar');
					$this->load->view('pages/captcha_error');
					$this->load->view('templates/footer');
				}
				else{
					$slug = $this->say_model->post_say();
					redirect('view_statements/'.$slug);
				}
			}
	}
	
	public function captcha_check(){
		include_once $_SERVER['DOCUMENT_ROOT'] . 'donevirtual.com/securimage/securimage.php';
		$securimage = new Securimage();
		
		if($securimage->check($_POST['captcha_code']) == FALSE){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	// View page based on URL
	public function view_statements($slug){
		$data['post_item'] = $this->say_model->get_say($slug);
		if(empty($data['post_item'])){
			show_404();
		}
		
		$data['title'] = ucfirst($slug);
		
		$this->load->view('statements/statements_header', $data);
		$this->load->view('statements/search_bar');
		$this->load->view('statements/statements_view', $data);

		$data['post'] = $this->say_model->get_say(); // get most viewed
		$this->load->view('statements/statements_most_viewed', $data); // display most viewed
			
		$data['post'] = $this->say_model->get_recent_statements(); //get recent statements
		$this->load->view('statements/statements_most_recent', $data); //display most recent

		$data['post'] = $this->say_model->get_related($slug); //get related post from database
		if($data['post'] != NULL){
			$data['slug'] = $slug; //used for the present post not be displayed as related
			$this->load->view('statements/statements_related', $data); // display related posts to view
		}
		
		$this->load->view('pages/social');
		
		$this->load->view('templates/footer');
	}
	
	public function most_popular(){
		$config = array();
		$config['base_url'] = base_url() . 'statements/most_popular';
		$config['total_rows'] = $this->say_model->most_popular_count();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['post'] = $this->say_model->most_popular_return($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		
			$data['title'] = 'Most Popular';
			$this->load->view('statements/statements_header', $data);
			$this->load->view('statements/search_bar');
			$this->load->view('statements/most_popular', $data);
			
			$this->load->view('templates/footer');
	}
	
	public function most_recent(){
		$config = array();
		$config['base_url'] = base_url() . 'statements/most_recent';
		$config['total_rows'] = $this->say_model->most_recent_count();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['post'] = $this->say_model->most_recent_return($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		
			$data['title'] = 'Most Popular';
			$this->load->view('statements/statements_header', $data);
			$this->load->view('statements/search_bar');
			$this->load->view('statements/most_recent', $data);
			
			$this->load->view('templates/footer');
	}

}
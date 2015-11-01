<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('donevirtual_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('pagination');
	}

	public function index(){
		$data['post'] = $this->donevirtual_model->get_post();
		$data['title'] = 'Home';
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home');
		
		$data['post'] = $this->donevirtual_model->get_post(); //get most viewed deed
		$this->load->view('pages/deeds_most_viewed', $data);
		
		$data['post'] = $this->donevirtual_model->get_recent_deeds();// get most recent deeds
		$this->load->view('pages/deeds_most_recent', $data);
		
		$this->load->view('templates/footer');
	}

	public function search_2(){
		$search = $this->session->userdata('search');
        $config = array();
        $config['base_url'] = base_url() . 'pages/search_2';
        $config['total_rows'] = $this->donevirtual_model->results_count();
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['post'] = $this->donevirtual_model->search_2($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
		
		$data['title'] = 'Results for '.$this->session->userdata('search');
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home');
        $this->load->view('pages/search', $data);
		
		$data['post'] = $this->donevirtual_model->get_post(); //get most viewed deed
		$this->load->view('pages/deeds_most_viewed', $data);
		
		$data['post'] = $this->donevirtual_model->get_recent_deeds();// get most recent deeds
		$this->load->view('pages/deeds_most_recent', $data);
		
		$this->load->view('templates/footer');
	}
	
	public function search_value(){
		if($this->input->post('search') == NULL){
			redirect('pages');
		}
		
		$search = array(
					'search' => $this->input->post('search')
				);
		$this->session->set_userdata($search);
		$this->search_2();
	}
	
	public function search(){
	
	if ($this->input->post('search') == NULL){
		redirect('pages');
	}
	
		$data['post'] = $this->donevirtual_model->search();
		
		$this->load->view('templates/header');
		$this->load->view('pages/home');
		$this->load->view('pages/results', $data);
		$this->load->view('templates/footer');
	}
	
	public function view($slug){
	
		$data['post_item'] = $this->donevirtual_model->get_post($slug);
		if(empty($data['post_item'])){
			show_404();
		}
		
		$data['title'] = ucfirst($slug); //capitalize the first letter
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home');
		$this->load->view('pages/view', $data);
		
		$data['post'] = $this->donevirtual_model->get_related($slug); //get related post
		$this->load->view('pages/deeds_related', $data);	//display related posts

		$data['post'] = $this->donevirtual_model->get_post(); //get most viewed deed
		$this->load->view('pages/deeds_most_viewed', $data);	//displaymost viewed
		
		$data['post'] = $this->donevirtual_model->get_recent_deeds();// get most recent deeds
		$this->load->view('pages/deeds_most_recent', $data);	//display recent
		
		$this->load->view('templates/footer');
	}	
	
	public function post(){
		session_start();
		
		$data['title'] = 'Post New'; //for page title
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('action', 'Action', 'required');
		$this->form_validation->set_rules('setting', 'Setting', 'required');
		
		if($this->form_validation->run() === FALSE){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/home');
			$this->load->view('pages/post');
			$this->load->view('templates/footer');
		}
		else{
			$captcha = $this->captcha_check();
			
			if($captcha == FALSE){
				$this->load->view('templates/header');
				$this->load->view('pages/home');
				$this->load->view('pages/captcha_error');			
				$this->load->view('templates/footer');
			}
			else{
				$slug = $this->donevirtual_model->post_deed();
				redirect('pages/'.$slug); //redirect user to the newly created post
			}
		}
	}
	
	public function plus(){ //plus one to the post or hits
		session_start();
		$captcha = $this->captcha_check();
		if($captcha == FALSE){
			$this->load->view('templates/header');
			$this->load->view('pages/home');
			$this->load->view('pages/captcha_error');			
			$this->load->view('templates/footer');	
		}
		else{
			$slug = $this->donevirtual_model->plus_one();
		
			
			redirect('pages/'.$slug); //redirect to the same post but with updated data or hits
		}
	}
	
	public function about(){
		$data['title'] = 'About Us';
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/home');		
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}
	
	public function captcha_check(){ //checks the captcha input if correct
			include_once $_SERVER['DOCUMENT_ROOT'] . 'donevirtual.com/securimage/securimage.php';
			$securimage = new Securimage();
			
			if ($securimage->check($_POST['captcha_code']) == false) {
				return FALSE;
			}
			else{
				return TRUE;
			}
	}
}
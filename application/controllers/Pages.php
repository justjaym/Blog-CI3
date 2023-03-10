<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($param = null)
	{
		if($param == null){
			$page = "home";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}

			$data['title'] = "New Posts";
			$data['posts'] = $this->Posts_model->get_posts();
			$data['total'] = count($data['posts']);


			// print_r($data['document']);

			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}else {

			$page = "single";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}

			$data = $this->Posts_model->get_posts_edit($param);
			// print_r($data);
			// echo "<pre>";
			// $data['title'] = $data['posts']['title'];
			// $data['body'] = $data['posts']['body'];
			// $data['date'] = $data['posts']['date_published'];
			// $data['id'] = $data['posts']['id'];
			// $data['user_id'] = $data['posts']['user_id'];
			// $data['first_name'] = $data['posts']['user_id'];
			


			// print_r($data);
			if($data){
				$this->load->view('templates/header');
				$this->load->view('pages/'.$page, $data);
				$this->load->view('templates/modal');
				$this->load->view('templates/footer');
			}else{
				show_404();
			}
			

		}
		
	}

	public function search(){

		$page = "home";
		$param = $this->input->post('search');
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
		}

		$data['title'] = "New Posts";
		$data['posts'] = $this->Posts_model->get_posts_search($param);
		$data['total'] = count($data['posts']);
		$this->load->view('templates/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
	}

	public function login(){

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE) {

			$page = "login";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer');
		}else {
			
			$user_id = $this->Posts_model->login();

			if($user_id){

				$user_data = array(
					'id' => $user_id['id'],
					'first_name' => $user_id['first_name'],
					'last_name' => $user_id['last_name'],
					'full_name' => ucfirst($user_id['first_name']) . ' ' . ucfirst($user_id['last_name']),
					'access' => $user_id['is_admin'],
					'logged_in'=> true
				);

				$this->session->set_userdata($user_data);
				$this->session->set_flashdata('user_loggedin', 'You are now logged in as '. $this->session->full_name);
				redirect(base_url());

			}else{

				$this->session->set_flashdata('failed_login', 'Invalid Login');
				redirect('login');

			}

		}
	}

	public function logout(){

		// $this->session->unset_userdata('first_name');
		// $this->session->unset_userdata('last_name');
		// $this->session->unset_userdata('full_name');
		// $this->session->unset_userdata('access');
		// $this->session->unset_userdata('logged_in');
		// $this->session->sess_create();
		// $this->session->set_flashdata('user_loggedout', 'You are now logged out');

		$this->session->sess_destroy();
		redirect('login');
	}

	public function register(){
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('username', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {

			$page = "register";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer');
		}else {
			
			$this->Posts_model->register_user();
			$this->session->set_flashdata('register_user','You have succesfully created an account!');
			redirect('login');
		}

	}

	public function add(){

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if ($this->form_validation->run() == FALSE) {
			$page = "add";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}
	
			$data['title'] = "Add New Posts";
	
	
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}else {
			$this->Posts_model->insert_post();
			$this->session->set_flashdata('post_added','New post was added');
			redirect(base_url());
		}

	} 

	public function edit($param){
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if ($this->form_validation->run() == FALSE) {

			$page = "edit";

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
					show_404();
			}
	
			// $data['title'] = "Edit Posts";
			$data['posts'] = $this->Posts_model->get_posts_single($param);
			$data['title'] = $data['posts']['title'];
			$data['body'] = $data['posts']['body'];
			$data['date'] = $data['posts']['date_published'];
			$data['id'] = $data['posts']['id'];

	
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}else {
			
			$this->Posts_model->update_post();
			$this->session->set_flashdata('post_updated','Post was updated');
			redirect(base_url().'edit/'.$param);
		}
	}

	
	public function delete(){
		
		$this->Posts_model->delete_post();
		$this->session->set_flashdata('post_delete', 'Post was deleted successfully!');
		redirect(base_url());

	}
}

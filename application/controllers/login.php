<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index($param=0)
	{
		$data['param'] = $param;
		$this->load->view('login',$data);
	}

	public function singup(){
		if($this->Login_model->createUser()){
			$this->session->set_flashdata('msg_type','alert alert-success');
			$this->session->set_flashdata('msg', SINGUP_SUCCESS);
			redirect('login/index', 'refresh');
		}
	}

	public function validate(){
		if($this->Login_model->validateLogin()){
			redirect('site/dashbord', 'refresh');	
		} else {
			$this->session->set_flashdata('msg_type','alert alert-error');
			$this->session->set_flashdata('msg', LOGIN_INVALID);
			redirect('login/index', 'refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('user_details');
		$this->session->sess_destroy();
		redirect('login/index','refresh');
	}
}

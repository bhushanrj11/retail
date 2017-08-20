<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('user_details')){
	        redirect('login/index', 'refresh');
	    }
		$this->load->model('User_model');
	}

	public function index(){
		$Urlstocks = array(	'userStatus' 	=> 	base_url('dashbord/userStatus'),
							'logout'		=>	base_url('login/logout'));
		$data['view_file'] = 'dashboard';
		$this->load->view('main',$data);
	}

	public function userStatus(){
		$msg = $this->User_model->approveUser();
		if($msg){
			echo json_encode( array('msg' => $msg,'id'=>  $this->input->post('id')) );
		}
	}
}

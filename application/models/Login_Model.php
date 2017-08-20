<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* login class
*/
class Login_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function createUser(){
		
		$saveArray = array(	'first_name' 	=>	$this->input->post('first_name'),
							'last_name'		=>	$this->input->post('last_name'),
							'email'			=>	$this->input->post('email'),
							'mobile'		=>	$this->input->post('mobile'),
							//'passwd'		=>	$this->input->post('passwd'),
							'company_name'	=>	$this->input->post('company_name'),
							'country'		=>	$this->input->post('country'),
							'inserted_date'	=> 	date("Y-m-d H:i:s"),
							'is_active'		=>	1,
							'is_approve'	=>	0
						 );
		return $this->db->insert('usermaster', $saveArray);
	}

	public function getCountry(){
		return $this->db->get('apps_countries')->result_array();
	}

	public function validateLogin(){
		$matchArray = array('user_name' 	=> 	$this->input->post('email'),
							'password'	=>	$this->input->post('passwd'),
							'is_active'	=>	1
							); 

		$userData =  $this->db->get_where('user_deatils', $matchArray)->result_array();

		if(count($userData) == 1){
			$this->session->set_userdata("user_details",$userData);
			return 1;
		} else {
			return 0;
		}
	}
}

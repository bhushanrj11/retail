<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User class
*/
class User_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	public function getAllUsers(){
		return $this->db->query('SELECT *, 
							CASE WHEN is_approve = 1 THEN "APPROVE"  WHEN is_approve = 2 THEN "REJECTED" ELSE "PENDING" END as status
							FROM `usermaster` 
							WHERE `is_admin`= 0 AND `is_active` = 1
							ORDER BY `is_approve` ASC, `first_name` ASC, `last_name` ASC')->result_array();		
		/*$this->db->select('*, ')
				->where('is_admin',0)
				->order_by('is_approve','asc')
				->order_by('first_name','asc')
				->order_by('last_name','asc')
				->get('usermaster')
				->result_array();*/
	}

	public function approveUser(){
		$status = $this->input->post('status');
		$sendMail = false;

		switch ($status) {
			case 'A':
				$data = array('is_approve' => 1);
				$msg = APPROVE;
				$sendMail = true;
				break;
			case 'R':
				$data = array('is_approve' => 2);
				$msg = REJECTED;
				$sendMail = false;
				break;	
			case 'D':
				$data = array('is_active' => 0);
				$msg = DELETED;
				$sendMail = false;
				break;
			default:
				$data = array();
				$msg = "";
				$sendMail = false;
		}

		if( count($data) ){
			$this->db->where( 'id', $this->input->post('id') );
			$this->db->update('usermaster',$data);
			if($sendMail){
				$detailsUser = $this->db->where( 'id', $this->input->post('id') )
						 				->get('usermaster')->result_array();	
				
				$details = array('to' 		=> 	$detailsUser[0]['email'],
								 'subject'	=>	SUBJECTAPPROVE,
								 'message'	=>	'Welcome to Agri tech.'.'\n\n'.
								 				'Following are the details of login'.'\n\n'.
								 				'Userid: '. $detailsUser[0]['email'].'\n'.
								 				'Password: '. $this->genratePassword() .'\n\n'.
								 				'Thanks!');
				//$this->mailFunc($details);
			}
			return $msg;
		} else {
			return 0;
		}

	}

	public function mailFunc($details){
		if(count($details)){
			$headers = "From: info@agritech.com" . "\r\n" .
						"CC: jagtap.bhushan7@gmail.com";
			mail($details['to'], $details['subject'], $details['message'], $headers);
		} else {
			return false;
		}
	}

	public function genratePassword($length = 6 ){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*()_";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
}

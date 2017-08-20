<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Add_model class
*/
class Add_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	public function add_compony_info($flag=0){
		
		$fileNmae = "";
		$config['upload_path']   = './assets/uploads/'; 
		$config['allowed_types'] = 'gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		$upload_details = $this->upload->do_upload('file');
		if ( ! $upload_details) {
			/*$error = array('error' => $this->upload->display_errors()); 
			print_r($error); die; */
		}
		else { 
			$fileNmae = $this->upload->data()['file_name'];
		} 

		$save_data = Array(
		    'name' 			=> 	$this->input->post('c_name'),   
		    'mobile_one' 	=> 	$this->input->post('mobile'),   
		    'mobile_two' 	=> 	$this->input->post('mobile_2'),   
		    'owner_fname' 	=> 	$this->input->post('o_fname'),   
		    'owner_lname' 	=> 	$this->input->post('o_lname'),   
		    'address' 		=> 	$this->input->post('address'),   
		    'pin_code' 		=> 	$this->input->post('pin_code'),   
		    'email' 		=> 	$this->input->post('email'),
		    'website' 		=> 	$this->input->post('website'),
		    'gst_no' 		=> 	$this->input->post('gst_no'),
		    'created_on'	=>	date('Y-m-d'),
		    'created_by'	=>	$this->session->userdata['user_details'][0]['id']
		);
		if($_FILES['file']['name']){
			$save_data['logo'] = $fileNmae;
		}
		
		if($this->input->post('company_id')){
			$this->db->where('id',$this->input->post('company_id'));
			return $this->db->update('compony_info',$save_data);
		} 
		else {
			return $this->db->insert('compony_info', $save_data);
		}
	}

	function delete(){
		$tableName = "";
		
		switch ($this->input->post('target')) {
			case 'comapny':
				$tableName = 'compony_info';
				break;
			case 'vender':
				$tableName = 'custumer_table';
				break;
			case 'item':
				$tableName = 'item';
				break;	
			case 'unit_measure':
				$tableName = 'unit_measure';
				break;
			default:
				# code...
				break;

		}

		if(!$tableName){
			return 0;
		}
		$this->db->where('id',$this->input->post('id'));
		return $this->db->update($tableName ,array('delete_flag' => 1));		
	}

	public function add_vender($flag=0){
		
		$save_data = Array(
		    'fname' 		=> 	$this->input->post('fname'),   
		    'lname' 		=> 	$this->input->post('lname'),   
		    'address' 		=> 	$this->input->post('address'),   
		    'mobile' 		=> 	$this->input->post('mobile'),   
		    'email' 		=> 	$this->input->post('email'),   
		    'pin_code' 		=> 	$this->input->post('pin_code'),   
		    'gst_no' 		=> 	$this->input->post('gst_no'),
		    'type'			=>	$this->input->post('type'),
		    'created_on'	=>	date('Y-m-d'),
		    'created_by'	=>	$this->session->userdata['user_details'][0]['id']
		);
		
		if($this->input->post('id')){
			$this->db->where('id',$this->input->post('id'));
			return $this->db->update('custumer_table',$save_data);
		} 
		else {
			return $this->db->insert('custumer_table', $save_data);
		}
	}

	public function add_item($flag=0){
		
		$save_data = Array(
		    'name' 				=> 	$this->input->post('name'),   
		    'number' 			=> 	$this->input->post('number'),   
		    'unit_measure' 		=> 	$this->input->post('unit_measure'),   
		    'sell_price' 		=> 	$this->input->post('sell_price'),   
		    'purchase_price' 	=> 	$this->input->post('purchase_price'),   
		    'qty' 				=> 	$this->input->post('qty'),
		    'barcode'			=>	$this->input->post('barcode'),
		    'discount_perc'		=>	$this->input->post('discount_perc'),
		    'compony_info_id'	=>	$this->input->post('compony_info_id'),
		    'created_on'		=>	date('Y-m-d'),
		    'created_by'		=>	$this->session->userdata['user_details'][0]['id']
		);
		
		if($this->input->post('id')){
			$this->db->where('id',$this->input->post('id'));
			return $this->db->update('item',$save_data);
		} 
		else {
			return $this->db->insert('item', $save_data);
		}
	}

	public function addUnitMeasure(){
		$save_data = Array(
		    'type' 				=> 	$this->input->post('type'),   
		    'qty' 				=> 	$this->input->post('qty'),
		    'description' 		=> 	$this->input->post('description'),
		    'created_on'		=>	date('Y-m-d'),
		    'created_by'		=>	$this->session->userdata['user_details'][0]['id']
		);
		
		if($this->input->post('id')){
			$this->db->where('id',$this->input->post('id'));
			return $this->db->update('unit_measure',$save_data);
		} 
		else {
			return $this->db->insert('unit_measure', $save_data);
		}
	}

}

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
			case 'orders':
				$tableName = array('id' => 'sales_header', 'sales_header_id' => 'sales_line' );
				break;	
			default:
				# code...
				break;

		}

		if(!$tableName){
			return 0;
		}
		if(is_array($tableName)){
			foreach ($tableName as $key => $value) {
				$this->db->where($key,$this->input->post('id'));
				$this->db->update($value ,array('delete_flag' => 1));
			}	
			return true;	
		} else{
			$this->db->where('id',$this->input->post('id'));
			return $this->db->update($tableName ,array('delete_flag' => 1));		
		}
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

		if($this->input->post('gst_percentage')){
			$save_data['gst_percentage'] = $this->input->post('gst_percentage');
		}
		
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

	public function putSaleOrder($salesOrder=0){
		$is_order_complete = $this->input->post('is_complete_order');
		$errorFlag = 0;
		$this->db->trans_begin();
		$saveDataSalesHeader = array(	'comp_id' 				=> 	$this->input->post('company_info_id'),
										'cust_id' 				=>	$this->input->post('customer_info_id'),
										'cust_address' 			=>	$this->input->post('address'),
										'cust_pin' 				=>	$this->input->post('pin_code'),
										'cust_mobile' 			=>	$this->input->post('mobile'),
										'cust_email' 			=>	$this->input->post('email'),
										'cust_gst_no' 			=>	$this->input->post('gst_no'),
										'order_date' 			=>	$this->input->post('order_date'),
										'delivery_date' 		=>	$this->input->post('delivery_date'),
										'amount_exlcuding_gst' 	=>	$this->input->post('excluding_amount_gst'),
										'discont' 				=>	$this->input->post('total_discount'),
										'sgst' 					=>	$this->input->post('sgst'),
										'cgst' 					=>	$this->input->post('cgst'),
										'total_amount' 			=>	$this->input->post('total_amount'),
										'is_order_complete'		=>	$is_order_complete,
										'created_at'			=>	date('Y-m-d'),
					    				'created_by'			=>	$this->session->userdata['user_details'][0]['id']
									);
		if($salesOrder){
			$this->db->where('id', $salesOrder)->update('sales_header', $saveDataSalesHeader);

			$this->db->where('sales_header_id', $salesOrder)->delete('sales_line');
			$lastIdOfSalesHeader = $salesOrder;
		} else {
			$this->db->insert('sales_header', $saveDataSalesHeader);
			$lastIdOfSalesHeader = $this->db->insert_id();
		}
		//$lastIdOfSalesHeader = 12;

		$arrayLineData = array();
		
		foreach ($this->input->post('sale_price[]') as $key => $value) {
			
			$itemDetails = explode("-",$this->input->post('item_id[]')[$key]);

			$saveDataSalesLines = array(	'sales_header_id' 	=>	$lastIdOfSalesHeader, 	
											'item_id'			=>	$itemDetails[0],
											'item_name'			=>	$itemDetails[1],
											'item_sales_price'	=>	$this->input->post('sale_price[]')[$key],
											'item_qty'			=>	$this->input->post('qty[]')[$key],
											'item_disc'			=>	$this->input->post('discount[]')[$key],
											'item_line_amount'	=>	$this->input->post('amount[]')[$key],
											'created_at'		=>	date('Y-m-d'),
						    				'created_by'		=>	$this->session->userdata['user_details'][0]['id']
										);
			if($is_order_complete){
				$item = $this->db->where('id', $itemDetails[0])->get('item')->result_array();
				$availableQty = $item[0]['qty'] - $this->input->post('qty[]')[$key];
				$this->db->where('id', $itemDetails[0])->update('item', array('qty' => $availableQty));
				if($availableQty < 0 ){
					// $this->db->where('sales_header_id', $lastIdOfSalesHeader)->delete('sales_line');
					// $this->db->where('id', $lastIdOfSalesHeader)->delete('sales_header');
					$errorFlag = 1;
					$msgError = "<br>Item Name: ".$item[0]['name']."<br>".
								"Available Qty: ".$item[0]['qty'];
				}
			}

			$this->db->insert('sales_line', $saveDataSalesLines);
			
			array_push($arrayLineData,$saveDataSalesLines);
		}	

		if($errorFlag){
			$this->db->trans_rollback();
			$this->doRedirect('alert-danger',QTYERROR.$msgError, 'site/add_sell_order/'.$salesOrder);
		} else {
			$this->db->trans_commit();
			return array('lineData' => $arrayLineData, 'headerData' => $saveDataSalesHeader );
		}
	}

	public function doRedirect($type,$msg,$destination){
		$this->session->set_flashdata('msg_type','alert '.$type);
		$this->session->set_flashdata('msg', $msg);
		redirect($destination, 'refresh');
	}
}

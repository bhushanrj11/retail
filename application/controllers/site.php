<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(! $this->session->userdata('user_details')){
	        redirect('login/index', 'refresh');
	    }
	}

	function successRedirect(){
		$this->session->set_flashdata('msg_type','alert alert-success');
		if($this->input->post('id')){
			$this->session->set_flashdata('msg', UPDATECOMPANYINFO);
		} else {
			
		}
		redirect('site/company_info', 'refresh');
	}

	public function dashbord(){
		$Urlstocks = array(	'userStatus' 	=> 	base_url('dashbord/userStatus'),
							'logout'		=>	base_url('login/logout'));
		$data['page_title'] = 'Dashboard';
		$data['view_file'] = 'dashboard';
		$this->load->view('main',$data);
	}

	public function company_info(){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Name','Owner','Mobile','Email','Address','GST No','Action');
		$tableInfo = array('id'=> null, 'tableName' => 'compony_info' , 'order_by' => 'name' , 'order_type' => 'ASC');		
		$data['companyInfo'] = $this->Get_model->get($tableInfo);
		$data['page_title'] = 'Company Info';
		$data['view_file'] = 'company_info';
		$this->load->view('main',$data);
	}

	public function add_company_info($id=0){
		$data['urlStocks'] = URLSTOCKS;
		if(count($_POST)){
			if($this->Add_model->add_compony_info()){
				$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/company_info');
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/company_info');
			}
			
		}
		if($id){
			$tableInfo = array('id'=> $id, 'tableName' => 'compony_info' , 'order_by' => 'name' , 'order_type' => 'ASC');
			$result = $this->Get_model->get($tableInfo);			
			$data['companyInfo']= $result ? $result[0] : array();
		} else {
			$data['companyInfo'] = array();
		}
		$data['page_title'] = 'Add Company Info';
		$data['view_file'] = 'add_company_info';
		$this->load->view('main',$data);
	}

	public function vender($type=0){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Name','Address','Mobile','Email','GST No','Action');
		
		if ($type) {
			$data['page_title'] = 'Customer';
			$data['page_type'] = '1';	
		} else {
			$data['page_title'] = 'Vender';
			$data['page_type'] = '0';	
		}
		$data['info'] = $this->Get_model->getVenderInfo(null,$data['page_type']);
		$data['view_file'] = 'vender';
		$this->load->view('main',$data);
	}

	public function add($id=0,$type){
		$data['urlStocks'] = URLSTOCKS;
		if(count($_POST)){
			if($this->Add_model->add_vender()){
				$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/vender');
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/vender');
			}
			
		}
		if ($type) {
			$data['page_title'] = 'Add Customer';
			$data['page_type'] = '1';	
		} else {
			$data['page_title'] = 'Add Vender';
			$data['page_type'] = '0';	
		}
		
		if($id){
			$result = $this->Get_model->getVenderInfo($id,$type);			
			$data['info']= $result  ? $result[0] : array();
		} else {
			$data['info'] = array();
		}
		$data['view_file'] = 'add_vender';
		$this->load->view('main',$data);
	}

	public function item(){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Name','Item Code','Inventory','Unit Measure','Sell Price','Company Name','Action');
		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'item.name' , 'order_type' => 'ASC','join' => 'compony_info','join_relation' => 'compony_info.id = item.compony_info_id','select' => 'item.name as name,item.number as number, item.sell_price as sell_price, item.qty as qty,item.unit_measure as unit_measure,compony_info.name as company_name,item.id as id');
		$data['info'] = $this->Get_model->get($tableInfo);		
		$data['page_title'] = 'Items';
		$data['view_file'] = 'item';
		$this->load->view('main',$data);
	}

	public function add_item($id=0){
		$data['urlStocks'] = URLSTOCKS;
		$data['info'] = array();
		
		if(count($_POST)){
			if($this->Add_model->add_item()){
				$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/item');
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/item');
			}
			
		} else {
			$data['info']['number'] = $this->Get_model->getTablePriameryNumer('item');
		}

		if($id){
			$tableInfo = array('id'=> $id, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
			$result = $this->Get_model->get($tableInfo);
			$data['info']= $result ? $result[0] : array(); 
		} 

		$data['companyInfoDropdown'] = $this->getAllCompanyInfo();

		$tableInfo = array('id'=> null, 'tableName' => 'unit_measure' , 'order_by' => 'type' , 'order_type' => 'ASC');
		$data['unitMeasure'] = $this->Get_model->get($tableInfo);
		$data['page_title'] = 'Add Item';
		$data['view_file'] = 'add_item';
		$this->load->view('main',$data);
	}

	public function unit_measure(){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Name','Quantity','Description','Action');

		$tableInfo = array('id'=> null, 'tableName' => 'unit_measure' , 'order_by' => 'type' , 'order_type' => 'ASC');
		$data['info'] = $this->Get_model->get($tableInfo);
		$data['page_title'] = 'Unit Measure';
		$data['view_file'] = 'unit_measure';
		$this->load->view('main',$data);	
	}

	public function add_unit_measure($id=0){
		$data['urlStocks'] = URLSTOCKS;
		$data['info'] = array();
		
		if(count($_POST)){
			if($this->Add_model->addUnitMeasure()){
				$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/unit_measure');
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/unit_measure');
			}
			
		}

		if($id){
			$tableInfo = array('id'=> $id, 'tableName' => 'unit_measure' , 'order_by' => 'type' , 'order_type' => 'ASC');
			$result = $this->Get_model->get($tableInfo);
			$data['info']= $result ? $result[0] : array(); 
		} 
		$data['page_title'] = 'Add Unit Measure';
		$data['view_file'] = 'add_unit_measure';
		$this->load->view('main',$data);
	}

	public function sell_order(){
		$data['urlStocks'] = URLSTOCKS;
		$data['page_title'] = 'Sell Order';
		$data['view_file'] = 'sell_order';
		$this->load->view('main',$data);
	}
	public function add_sell_order(){
		$data['companyInfoDropdown'] = $this->getAllCompanyInfo();
		$data['customerInfoDropdown'] = $this->Get_model->getVenderInfo(null,1);
		
		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 

		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 
		
		$data['urlStocks'] = URLSTOCKS;
		$data['page_title'] = 'Add Sell Order';
		$data['view_file'] = 'add_sell_order';
		$this->load->view('main',$data);
	}
	public function delete($obj = array()){
		if(! $this->input->post('id') ){
			echo json_encode(array(	'msg' 	=> 	INVALIDPARAMS,'status'=> 'danger'));
		} else {
			$this->Add_model->delete();
			echo json_encode( array('msg' => DELETED,'id'=>  $this->input->post('id'), 'status'=>	'success') );
		}
	}

	public function validateNumber(){
		if(! ( $this->input->post('number') && $this->input->post('target') ) ){
			echo json_encode(array(	'msg' 	=> 	INVALIDPARAMS,'status'=> 'danger', 'flag' => 1));
		} else {
			echo json_encode( array('msg' => DUPLICATENUMBER,'id'=>  null, 'status'=> 'danger', 'flag' => $this->Get_model->validateNumber()) );	
		}
	}

	public function getAllCompanyInfo(){
		$tableInfo = array('id'=> null, 'tableName' => 'compony_info' , 'order_by' => 'name' , 'order_type' => 'ASC');
		return $this->Get_model->get($tableInfo);
	}

	public function doRedirect($type,$msg,$destination){
		$this->session->set_flashdata('msg_type','alert '.$type);
		$this->session->set_flashdata('msg', $msg);
		redirect($destination, 'refresh');
	}

	public function saveSalesOrder(){
		
	}
}

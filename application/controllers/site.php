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

		// ob_start(); 
		// system('ipconfig /all'); 
		// $mycom=ob_get_contents();
		// ob_clean(); 

		// $findme = "Physical"; 
		// $pmac = strpos($mycom, $findme); 
		// $mac=substr($mycom,($pmac+36),17); 

		// echo $mac; 


		
		$Urlstocks = array(	'userStatus' 	=> 	base_url('dashbord/userStatus'),
							'logout'		=>	base_url('login/logout'));

		$data['total_sell'] = $this->Get_model->getTotalSell();
		$data['total_orders'] = $this->Get_model->getTotalOrders();
		$counts = $this->Get_model->getCustmerAndVender();
		$result = $this->Get_model->loadGraphSeriesLables();
		$data['loadGraphSeriesLables'] = $result;
		//$data['loadGraphLables'] = $result[1];
		
		$data['total_cust'] = $counts ? $counts[0]['type'] : 0;
		$data['total_vender'] = $counts ? $counts[1]['type'] : 0;
		$data['urlStocks'] = URLSTOCKS;
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
				$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/vender/'.$type);
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

		$data['id'] = $id;
		
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

	public function purchase_orders(){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Company','Customer','Bill No.','Total Amount','Order','Action');

		$data['orders'] = $this->Get_model->getPurchaseOrders(0);
		$data['completeOrders'] = $this->Get_model->getPurchaseOrders(1);
		// echo "<pre>";
		// print_r($data['orders']);
		// die;
		$data['page_title'] = 'Purchase Orders';
		$data['view_file'] = 'purchase_orders';
		$this->load->view('main',$data);
	}

	public function orders(){
		$data['urlStocks'] = URLSTOCKS;
		$data['tableHeading'] = array('Sr.','Company','Customer','Bill No.','Total Amount','Order','Action');

		$data['orders'] = $this->Get_model->getOrders(0);
		$data['completeOrders'] = $this->Get_model->getOrders(1);
		// echo "<pre>";
		// print_r($data['orders']);
		// die;
		$data['page_title'] = 'Orders';
		$data['view_file'] = 'orders';
		$this->load->view('main',$data);
	}

	public function sell_order(){
		$data['urlStocks'] = URLSTOCKS;
		$data['page_title'] = 'Sell Order';
		$data['view_file'] = 'sell_order';
		$this->load->view('main',$data);
	}
	public function add_sell_order($salesHeaderID=0, $returnOrder = 0){
		
		/*ob_start(); // Turn on output buffering
		system('ipconfig /all'); //Execute external program to display output
		$mycom=ob_get_contents(); // Capture the output into a variable
		ob_clean(); // Clean (erase) the output buffer
		$findme = "Physical";
		$pmac = strpos($mycom, $findme); // Find the position of Physical text
		$mac=substr($mycom,($pmac+36),17); // Get Physical Address
		echo $mac;*/
		
		if($this->input->post('print') == 'print'){
			$this->printFromForm();
			return false;
		}
		
		$headerData = array();
		if($this->input->post('id')){
			$salesHeaderID = $this->input->post('id');
		}

		$returnData = array();
		if(count($_POST)){
			$returnData = $this->Add_model->putSaleOrder($salesHeaderID);
			if(count($returnData) > 1){
				if($this->input->post('savePrint')){
					$company_info =	$this->getAllCompanyInfo($this->input->post('company_info_id'));
					if(is_array($company_info)){
						$printInfo = array('company_info' 	=>	$company_info,
											'cust_name' 	=>	$this->input->post('cust_name'),
											'formDetails' 	=>  $returnData);


						$this->printInvoice($printInfo);
						return true;
					} 
					//$this->load->view('print');
				} else {
					echo "<script type='text/javascript'>window.close();</script>";
					$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/add_sell_order');
				}
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/add_sell_order');
			}
		}

		if($salesHeaderID){
			$headerData = $this->Get_model->getOrderByID($salesHeaderID);
			// echo "<pre>";
			// print_r($data['headerData']);
			// die()
		}
		$data['headerData'] = json_encode( $headerData );

		$data['companyInfoDropdown'] = $this->getAllCompanyInfo();
		$data['customerInfoDropdown'] = $this->Get_model->getVenderInfo(null,1,$salesHeaderID);
		
		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 

		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 

		$data['returnOrder'] = $returnOrder;

		$data['urlStocks'] = URLSTOCKS;
		$data['page_title'] = 'Add Sell Order';
		$data['view_file'] = 'add_sell_order';
		$this->load->view('main',$data);
	}

	public function add_purchase_order($salesHeaderID=0){
		
		/*ob_start(); // Turn on output buffering
		system('ipconfig /all'); //Execute external program to display output
		$mycom=ob_get_contents(); // Capture the output into a variable
		ob_clean(); // Clean (erase) the output buffer
		$findme = "Physical";
		$pmac = strpos($mycom, $findme); // Find the position of Physical text
		$mac=substr($mycom,($pmac+36),17); // Get Physical Address
		echo $mac;*/
		
		if($this->input->post('print') == 'print'){
			$this->printPurchaseFromForm();
			return false;
		}
		
		$headerData = array();
		if($this->input->post('id')){
			$salesHeaderID = $this->input->post('id');
		}

		$returnData = array();
		if(count($_POST)){
			$returnData = $this->Add_model->putPurchaseOrder($salesHeaderID);
			if(count($returnData) > 1){
				if($this->input->post('savePrint')){
					$company_info =	$this->getAllCompanyInfo($this->input->post('company_info_id'));
					if(is_array($compony_info)){
						$printInfo = array('company_info' 	=>	$company_info,
											'cust_name' 	=>	$this->input->post('cust_name'),
											'formDetails' 	=>  $returnData);


						$this->printInvoice($printInfo);
						return true;
					} 
					//$this->load->view('print');
				} else {
					echo "<script type='text/javascript'>window.close();</script>";
					$this->doRedirect('alert-success',ADDCOMPANYINFO, 'site/add_purchase_order');
				}
			} else {
				$this->doRedirect('alert-error',ERROR, 'site/add_purchase_order');
			}
		}

		if($salesHeaderID){
			$headerData = $this->Get_model->getPurchaseOrderByID($salesHeaderID);
			// echo "<pre>";
			// print_r($data['headerData']);
			// die()
		}
		$data['headerData'] = json_encode( $headerData );

		$data['companyInfoDropdown'] = $this->getAllCompanyInfo();
		$data['customerInfoDropdown'] = $this->Get_model->getVenderInfo(null,0);
		
		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 

		$tableInfo = array('id'=> null, 'tableName' => 'item' , 'order_by' => 'name' , 'order_type' => 'ASC');
		$result = $this->Get_model->get($tableInfo);
		$data['info']= $result ? $result : array(); 
		
		$data['urlStocks'] = URLSTOCKS;
		$data['page_title'] = 'Add Purchase Order';
		$data['view_file'] = 'add_purchase_order';
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

	public function getAllCompanyInfo($id=null){
		$tableInfo = array('id'=> $id, 'tableName' => 'compony_info' , 'order_by' => 'name' , 'order_type' => 'ASC');
		return $this->Get_model->get($tableInfo);
	}

	public function doRedirect($type,$msg,$destination){
		$this->session->set_flashdata('msg_type','alert '.$type);
		$this->session->set_flashdata('msg', $msg);
		redirect($destination, 'refresh');
	}

	public function saveSalesOrder(){
		// echo "<pre>";
		// print_r($this->input->post('salesHeaderData'));
		// print_r( $this->input->post('salesLineData'));
		// die();
		if(! ( $this->input->post('salesHeaderData') && $this->input->post('salesLineData') ) ){
			echo json_encode(array(	'msg' 	=> 	INVALIDPARAMS,'status'=> 'danger', 'flag' => 1));
		} else {
			echo json_encode( array('msg' => DUPLICATENUMBER,'id'=>  null, 'status'=> 'success', 'flag' => 1) );	
		}
	}

	public function printFromForm(){
		$printInfo = array('company_info' 	=>	$this->getAllCompanyInfo($this->input->post('company_info_id')),
							'cust_name' 	=>	$this->input->post('cust_name'),
							'formDetails' 	=>  array('lineData' => $this->Get_model->getSalesLine(), 'headerData' => $this->Get_model->getSalesHeader()[0] ));

		$this->printInvoice($printInfo);
	}

	public function printPurchaseFromForm(){
		$printInfo = array('company_info' 	=>	$this->getAllCompanyInfo($this->input->post('company_info_id')),
							'cust_name' 	=>	$this->input->post('cust_name'),
							'formDetails' 	=>  array('lineData' => $this->Get_model->getPurchaseSalesLine(), 'headerData' => $this->Get_model->getPurchaseSalesHeader()[0] ));

		$this->printInvoice($printInfo, 'purchase_print');
	}

	public function printInvoice($printInfo=array(), $print = 'print'){
		$data['printInfo'] = $printInfo;
		$this->load->view($print, $data);
		//die();
	}
}

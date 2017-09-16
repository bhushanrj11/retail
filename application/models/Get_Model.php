<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Add_model class
*/
class Get_model extends CI_Model{
	var $start_date;
	var $end_date;

	function __construct(){
		parent::__construct();
		$this->start_date = $this->input->post('start_date') == "" ? date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month ago" ) ) : $this->input->post('start_date');
		$this->end_date = $this->input->post('end_date') == "" ? date('Y-m-d') : $this->input->post('end_date');		
	}

	public function get($tableInfo = array()){
		if(!$tableInfo) return false;

		if($tableInfo['id']){
			$this->db->where('id',$tableInfo['id']);			
		}
		$this->db->where($tableInfo['tableName'].".".'delete_flag',0);

		if(@$tableInfo['join']){
			$this->db->join($tableInfo['join'], $tableInfo['join_relation']);
		}
		if(@$tableInfo['select']){
			$select = $tableInfo['select'];
		} else {
			$select = '*';
		}

		return $this->db->select($select)->order_by($tableInfo['order_by'], $tableInfo['order_type'])->get($tableInfo['tableName'])->result_array();
	}

	public function getVenderInfo($id=0,$type, $flag = 0){
		if($id){
			$this->db->where('id',$id);			
		}
		$this->db->where('type',$type);

		if(!$flag){
			$this->db->where('delete_flag',0);
		}
		return $this->db->order_by('fname','asc')->get('custumer_table')->result_array();
	}

	public function getTablePriameryNumer($tableName){
		$result = $this->db->order_by('id','desc')->limit(1)->get($tableName)->result();
		return $result ? $result[0]->number + 1 : 1 ;
	}

	public function validateNumber(){
		return $this->db->select('number')
						->where('number',$this->input->post('number'))
						->from($this->input->post('target'))
						->count_all_results();
	}

	public function getOrders($is_order_complete){
		$query = "	SELECT `cust_id`,`comp_id`,`order_date`,`total_amount`,
					(case when (is_order_complete = 1) 
					 THEN
					      'YES' 
					 ELSE
					      'NO' 
					 END) as is_order_complete,
					concat(c.fname,' ',c.lname) as cutomer_name, m.name as compony_name,s.id as sales_header_id,cust_name
					FROM `sales_header` s, custumer_table c, compony_info m
					where s.cust_id = c.id and s.comp_id = m.id and s.delete_flag = 0 and s.is_order_complete = $is_order_complete 
					order by is_order_complete desc,compony_name ASC,cutomer_name ASC";

		return $this->db->query($query)->result_array();
	}


	public function getPurchaseOrders($is_order_complete){
		$query = "	SELECT `cust_id`,`comp_id`,`order_date`,`total_amount`,
					(case when (is_order_complete = 1) 
					 THEN
					      'YES' 
					 ELSE
					      'NO' 
					 END) as is_order_complete,
					concat(c.fname,' ',c.lname) as cutomer_name, m.name as compony_name,s.id as sales_header_id
					FROM `purchase_sales_header` s, custumer_table c, compony_info m
					where s.cust_id = c.id and s.comp_id = m.id and s.delete_flag = 0 and s.is_order_complete = $is_order_complete 
					order by is_order_complete desc,compony_name ASC,cutomer_name ASC";

		return $this->db->query($query)->result_array();
	}
	public function getOrderByID($id=0){
		if(!$id){
			return 0;
		}
		
		$saleHeader = $this->db->where('id', $id)->get('sales_header')->result_array();
		$saleLines = $this->db->where('sales_header_id', $id)->get('sales_line')->result_array();

		return array('saleHeader' => $saleHeader, 'saleLines' => $saleLines);

	}

	public function getPurchaseOrderByID($id=0){
		if(!$id){
			return 0;
		}
		
		$saleHeader = $this->db->where('id', $id)->get('purchase_sales_header')->result_array();
		$saleLines = $this->db->where('sales_header_id', $id)->get('purchase_sales_line')->result_array();

		return array('saleHeader' => $saleHeader, 'saleLines' => $saleLines);

	}

	public function getSalesHeader(){
		return $this->db->where('id', $this->input->post('id'))->get('sales_header')->result_array();
	}

	public function getSalesLine(){
		return $this->db->where('sales_header_id', $this->input->post('id'))->get('sales_line')->result_array();
	}

	public function getPurchaseSalesHeader(){
		return $this->db->where('id', $this->input->post('id'))->get('purchase_sales_header')->result_array();
	}

	public function getPurchaseSalesLine(){
		return $this->db->where('sales_header_id', $this->input->post('id'))->get('purchase_sales_line')->result_array();
	}

	public function getTotalSell(){

		$result = $this->db->select_sum('total_amount')
							->where('is_order_complete',1)
							->where('created_at >=', $this->start_date)
							->where('created_at <=', $this->end_date)
							->get('sales_header')
							->result_array();

		if(count($result)){
			return $result[0]['total_amount'];
		} else {
			return 0;
		}
	}

	public function getTotalOrders(){
		$result = $this->db->where('is_order_complete',1)
							->where('created_at >=', $this->start_date)
							->where('created_at <=', $this->end_date)
							->get('sales_header')
							->result_array();

		return count($result);
	}

	public function getCustmerAndVender(){
		$result = $this->db->select('count(type) as type')
							->where('delete_flag',0)
							->where('created_on >=', $this->start_date)
							->where('created_on <=', $this->end_date)
							->group_by('type')
							->order_by('type', 'asc')
							->get('custumer_table')
							->result_array();
		return $result;
	}

	public function loadGraphSeriesLables(){
		
		$loadGraphLables = array();
		$loadGraphSeries = array();

		$query = "  SELECT sum(`total_amount`) as val, date_format(created_at, '%d-%m-%Y') as dates  
					FROM `sales_header` 
					WHERE `created_at` between '".$this->start_date."' and '".$this->end_date."'
					AND `is_order_complete` = 1
					group by created_at order by created_at asc";
		
		$result = $this->db->query($query)->result_array();			
		
		if(count($result)){
			foreach ($result as $key => $value) {
				array_push($loadGraphLables, $result[$key]['dates']);
				array_push($loadGraphSeries, $result[$key]['val']);
			}

		} 

		return json_encode(array($loadGraphLables, $loadGraphSeries,$this->start_date,$this->end_date));
	}

	/*public function getCompanyInfo($id=0){
		if($id){
			$this->db->where('id',$id);			
		}
		$this->db->where('delete_flag',0);
		return $this->db->order_by('name','asc')->get('compony_info')->result_array();
	}*/


	/*public function getItem($id=0){
		if($id){
			$this->db->where('id',$id);			
		}
		$this->db->where('delete_flag',0);
		return $this->db->order_by('name','asc')->get('item')->result_array();
	}*/


}

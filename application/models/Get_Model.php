<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Add_model class
*/
class Get_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
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

	public function getVenderInfo($id=0,$type){
		if($id){
			$this->db->where('id',$id);			
		}
		$this->db->where('type',$type);
		$this->db->where('delete_flag',0);
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
					concat(c.fname,' ',c.lname) as cutomer_name, m.name as compony_name,s.id as sales_header_id
					FROM `sales_header` s, custumer_table c, compony_info m
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

	public function getSalesHeader(){
		return $this->db->where('id', $this->input->post('id'))->get('sales_header')->result_array();
	}

	public function getSalesLine(){
		return $this->db->where('sales_header_id', $this->input->post('id'))->get('sales_line')->result_array();
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

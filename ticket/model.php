<?php
/**
 * @author 
 * @copyright 2018
 */
 class TicketModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function findID($id){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_ticket'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($companyid)){
			$sql.= " and tk.customerid = '".$companyid."' ";	
		}
		if(!empty($search['ticket_code'])){
			$sql.= " and tk.ticket_code like '%".$search['ticket_code']."%' ";	
		}
		if(!empty($search['ticket_name'])){
			$sql.= " and tk.ticket_name like '%".$search['ticket_name']."%' ";	
		}
		if(!empty($search['priorityid'])){
			$sql.= " and tk.priorityid in (".$search['priorityid'].") ";	
		}
		if(!empty($search['ticket_description'])){
			$sql.= " and tk.ticket_description like '%".$search['ticket_description']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = "SELECT tk.*, pt.priority_name, c.customer_name
				FROM `".$tb['crmd_ticket']."` AS tk
				LEFT JOIN `".$tb['crmd_priority']."` AS pt on pt.id = tk.priorityid
				LEFT JOIN `".$tb['crmd_customer']."` AS c on c.id = tk.customerid
				WHERE tk.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY tk.datecreate asc, tk.priorityid asc';
		}
		else{
			$sql.= ' ORDER BY '.$search['order'].' '.$search['index'].' ';
		}
		$sql.= ' limit '.$page.','.$rows;
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " 
		SELECT count(1) total
		FROM `".$tb['crmd_ticket']."` AS tk
		WHERE tk.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table($tb['crmd_ticket'])
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('ticket_code',$array['ticket_code'])
					  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$result = $this->model->table($tb['crmd_ticket'])->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		 $check = $this->model->table($tb['crmd_ticket'])
		 ->select('id')
		 ->where('isdelete',0)
		 ->where('id <>',$id)
		 ->where('ticket_code',$array['ticket_code'])
		 ->find();
		 if(!empty($check->id)){
			 return -1;	
		 }
		 $result = $this->model->table($tb['crmd_ticket'])->where('id',$id)->update($array);	
		 return $id;
	}
	
}
<?php
/**
 * @author Son Nguyen
 * @copyright 2015
 */
 class HomeModel extends CI_Model{
	function __construct(){
		//$this->load->database();
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function findID($id) {
        $query = $this->model->table('hr_groups')
					  ->where('isdelete',0)
					  ->where('id',$id)
					  ->find();
        return $query;
    }
	function getCustomer(){
		//$login = $this->login;
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_customer'])
					  ->select('count(1) total')
					  ->where('isdelete',0)
					  ->find();
		return $query;
	}
	function getStatus($reply_result){
		//$login = $this->login;
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_ticket'])
					  ->select('count(1) total')
					  ->where('isdelete',0)
					  ->where('reply_result',$reply_result)
					  ->find();
		return $query;
	}
	function doanhThuTrongNgay($fromdate,$todate){
		$customerid = $this->login->customerid;
		$tb = $this->base_model->loadTable();
		$and = "";
		if(!empty($customerid)){
			$and.= " and c.customerid = '$customerid'";
		}
		$sql = "
			SELECT sum(c.amount) price
			FROM `".$tb['crmd_pay']."` c
			where c.isdelete = 0
			and c.datepo >= '$fromdate 00:00:00'
			and c.datepo <= '$todate 23:59:59'
			$and
			;
		";
		$query = $this->model->query($sql)->execute(); 
		if(empty($query[0]->price)){
			return 0;
		}
		else{
			return $query[0]->price;
		}
		
	}
	function doanhThuBanhang($fromdate,$todate){
		$customerid = $this->login->customerid;
		$tb = $this->base_model->loadTable();
		$and = "";
		if(!empty($customerid)){
			$and.= " and c.customerid = '$customerid'";
		}
		$sql = "
			SELECT sum(c.amount) price
			FROM `".$tb['crmd_pay']."` c
			where c.isdelete = 0
			and c.datepo >= '$fromdate 00:00:00'
			and c.datepo <= '$todate 23:59:59'
			$and
			;
		";
		$query = $this->model->query($sql)->execute(); 
		if(empty($query[0]->price)){
			return 0;
		}
		else{
			return $query[0]->price;
		}
		
	}
	function getPriority($fromdate,$todate){
		$customerid = $this->login->customerid;
		$tb = $this->base_model->loadTable();
		$and = "";
		if(!empty($customerid)){
			$and.= " and tk.customerid = '$customerid'";
		}
		$sql = "
			SELECT p.priority_name,  count(1) total
			FROM `".$tb['crmd_ticket']."` tk
			LEFT JOIN `".$tb['crmd_priority']."` p on p.id = tk.priorityid
			where tk.isdelete = 0
			and tk.datecreate >= '$fromdate 00:00:00'
			and tk.datecreate <= '$todate 23:59:59'
			and p.isdelete = 0
			group by tk.priorityid
			;
		"; 
		$query = $this->model->query($sql)->execute();
		return $query;
	}
 }
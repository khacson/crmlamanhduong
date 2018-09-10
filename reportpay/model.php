<?php
/**
 * @author 
 * @copyright 2018
 */
 class ReportpayModel extends CI_Model{
	function __construct(){
		parent::__construct('');
		$this->login = $this->site->getSession('login');
	}
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($companyid)){
			$sql.= " and tk.customerid = '".$companyid."' ";	
		}
		if(!empty($search['customerid'])){
			$sql.= " and tk.customerid in (".$search['customerid'].") ";	
		}
		if(!empty($search['ticket_code'])){
			$sql.= " and tk.ticket_code like  '%".fmNumberSave($search['ticket_code'])."%' ";	
		}
		if(!empty($search['ticket_price'])){
			$sql.= " and tk.ticket_price like  '%".$search['ticket_price']."%' ";	
		}
		if(!empty($search['ticket_description_pay'])){
			$sql.= " and tk.ticket_description_pay like  '%".$search['ticket_description_pay']."%' ";	
		}
		if(!empty($search['usercreate'])){
			$sql.= " and p.usercreate like  '%".$search['usercreate']."%' ";	
		}
		if(!empty($search['datecreate'])){
			$arrdate = explode ('-',$search['datecreate']);
			$formdate = fmDateSave(trim($arrdate[0]));
			$todate = fmDateSave(trim($arrdate[1]));
			$sql.= " and p.datecreate >= '".fmDateSave($formdate)." 00:00:00' ";	
			$sql.= " and p.datecreate <= '".fmDateSave($todate)." 23:59:59' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$tb = $this->base_model->loadTable();
		$sql = "SELECT tk.ticket_code, tk.ticket_name, tk.customerid, c.customer_name,
				p.*
				FROM `".$tb['crmd_pay']."` AS p
				LEFT JOIN `".$tb['crmd_ticket']."` tk on tk.id = p.ticket_id 
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = tk.customerid 
				WHERE p.isdelete = 0  
				and c.isdelete = 0
				and tk.isdelete = 0
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.datecreate DESC ';
		}
		else{
			$sql.= ' ORDER BY '.$search['order'].' '.$search['index'].' ';
		}
		if(!empty($rows)){
			$sql.= ' limit '.$page.','.$rows;
		}
		$query = $this->model->query($sql)->execute();
		return $query;
	}
	function getTotal($search){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = " 
			SELECT count(1) total
				FROM `".$tb['crmd_pay']."` AS p
				LEFT JOIN `".$tb['crmd_ticket']."` tk on tk.id = p.ticket_id 
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = tk.customerid 
				WHERE p.isdelete = 0  
				and c.isdelete = 0
				and tk.isdelete = 0
				$searchs
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function findID($id){
		 $tb = $this->base_model->loadTable();
		 $query = $this->model->table($tb['crmd_ticket'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	 function findDetail($id){
		 $tb = $this->base_model->loadTable();
		 $query = $this->model->table($tb['crmd_pay'])
					  ->select('*')
					  ->where('ticket_id',$id)
					  ->order_by('datecreate','desc')
					  ->find_all();
		return $query;
	}
}
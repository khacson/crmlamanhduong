<?php
/**
 * @author 
 * @copyright 2015
 */
 class CustomerModel extends CI_Model{
	function __construct(){
		parent::__construct('');
		$this->login = $this->site->getSession('login');
		
	}
	function getSearch($search){
		//$companyid = $this->login->companyid;
		$sql = "";
		if(!empty($search['customer_name'])){
			$sql.= " and c.customer_name like '%".$search['customer_name']."%' ";	
		}
		if(!empty($search['customer_code'])){
			$sql.= " and c.customer_code like '%".$search['customer_code']."%' ";	
		}
		if(!empty($search['phone'])){
			$sql.= " and c.phone like '%".$search['phone']."%' ";	
		}
		if(!empty($search['fax'])){
			$sql.= " and c.fax like '%".$search['fax']."%' ";	
		}
		if(!empty($search['email'])){
			$sql.= " and c.email like '%".$search['email']."%' ";	
		}
		if(!empty($search['provinceid'])){
			$sql.= " and c.provinceid in (".$search['provinceid'].") ";	
		}
		if(!empty($search['bankname'])){
			$sql.= " and c.bankname like '%".$search['bankname']."%' ";	
		}
		if(!empty($search['contact_name'])){
			$sql.= " and c.contact_name like '%".$search['contact_name']."%' ";	
		}
		if(!empty($search['contact_phone'])){
			$sql.= " and c.contact_phone like '%".$search['contact_phone']."%' ";	
		}
		if(!empty($search['web'])){
			$sql.= " and c.web like '%".$search['web']."%' ";	
		}
		if(!empty($search['birthday'])){
			$sql.= " and c.birthday = '".fmDateSave($search['birthday'])."' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = "
				SELECT c.*
				FROM `".$tb['crmd_customer']."` AS c
				WHERE c.isdelete = 0  
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.id DESC ';
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
		$searchs = $this->getSearch($search);
		$tb = $this->base_model->loadTable();
		$sql = " 
		SELECT count(1) total
		FROM `".$tb['crmd_customer']."` AS c
		WHERE c.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array,$checkprint){
		$tb = $this->base_model->loadTable();
		//$companyid = $this->login->companyid;
		if(!empty($array['birthday'])){
			$birthday = fmDateSave($array['birthday']);
		}
		else{
			$birthday = '0000-00-00';
		}
		$sqlCheck = "
			select s.id
			from `".$tb['crmd_customer']."` s
			where s.isdelete = 0
			and s.customer_code = '".$array['customer_code']."'
			and s.customer_name = '".$array['customer_name']."'
		";
		$check = $this->model->query($sqlCheck)->execute();
		if(!empty($check[0]->id)){
			return -1;	
		}
		$array['birthday'] = $birthday;
		$this->model->table($tb['crmd_customer'])->insert($array);
		return 1;
	}
	function edits($array,$id,$checkprint){
		$tb = $this->base_model->loadTable();
		if(!empty($array['birthday'])){
			$birthday = fmDateSave($array['birthday']);
		}
		else{
			$birthday = '0000-00-00';
		}
		$sqlCheck = "
			select s.id
			from `".$tb['crmd_customer']."` s
			where s.isdelete = 0
			and s.id <> '$id'
			and s.customer_code = '".$array['customer_code']."'
			and s.customer_name = '".$array['customer_name']."'
		";
		$check = $this->model->query($sqlCheck)->execute();
		if(!empty($check[0]->id)){
			return -1;	
		}
		$array['birthday'] = $birthday;
		$this->model->table($tb['crmd_customer'])->save($id,$array);
		return $id;
	 }
	function findID($id){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_customer'])
					  ->select("*")
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
}
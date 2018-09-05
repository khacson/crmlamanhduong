<?php
/**
 * @author 
 * @copyright 2018
 */
 class RegistrationstationModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function findID($id){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_registrationstation'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($search['registrationstation_code'])){
			$sql.= " and c.registrationstation_code like '%".$search['registrationstation_code']."%' ";	
		}
		if(!empty($search['registrationstation_name'])){
			$sql.= " and c.registrationstation_name like '%".$search['registrationstation_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = "SELECT c.*
				FROM `".$tb['crmd_registrationstation']."` AS c
				WHERE c.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.registrationstation_name asc ';
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
		FROM `".$tb['crmd_registrationstation']."` AS c
		WHERE c.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table($tb['crmd_registrationstation'])
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('registrationstation_name',$array['registrationstation_name'])
					  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$result = $this->model->table($tb['crmd_registrationstation'])->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		 $check = $this->model->table($tb['crmd_registrationstation'])
		 ->select('id')
		 ->where('isdelete',0)
		 ->where('id <>',$id)
		 ->where('registrationstation_name',$array['registrationstation_name'])
		 ->find();
		 if(!empty($check->id)){
			 return -1;	
		 }
		 $result = $this->model->table($tb['crmd_registrationstation'])->where('id',$id)->update($array);	
		 return $id;
	}
	
}
<?php
/**
 * @author 
 * @copyright 2018
 */
 class TypecarModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function findID($id){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_typecar'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($search['typecar_name'])){
			$sql.= " and c.typecar_name like '%".$search['typecar_name']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = "SELECT c.id, c.typecar_name
				FROM `".$tb['crmd_typecar']."` AS c
				WHERE c.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.typecar_name asc ';
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
		FROM `".$tb['crmd_typecar']."` AS c
		WHERE c.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$tb = $this->base_model->loadTable();
		$check = $this->model->table($tb['crmd_typecar'])
					  ->select('id')
					  ->where('isdelete',0)
					  ->where('typecar_name',$array['typecar_name'])
					  ->find();
		if(!empty($check->id)){
			return -1;	
		}
		$result = $this->model->table($tb['crmd_typecar'])->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		 $check = $this->model->table($tb['crmd_typecar'])
		 ->select('id')
		 ->where('isdelete',0)
		 ->where('id <>',$id)
		 ->where('typecar_name',$array['typecar_name'])
		 ->find();
		 if(!empty($check->id)){
			 return -1;	
		 }
		 $result = $this->model->table($tb['crmd_typecar'])->where('id',$id)->update($array);	
		 return $id;
	}
	
}
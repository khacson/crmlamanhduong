<?php
/**
 * @author 
 * @copyright 2018
 */
 class SellModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function findID($id){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_output'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($search['car_number'])){
			$sql.= " and c.car_number like '%".$search['car_number']."%' ";	
		}
		if(!empty($search['car_cavet_name'])){
			$sql.= " and c.car_cavet_name like '%".$search['car_cavet_name']."%' ";	
		}
		if(!empty($search['customer_name'])){
			$sql.= " and c.customer_name like '%".$search['customer_name']."%' ";	
		}
		if(!empty($search['customer_phone'])){
			$sql.= " and c.customer_phone like '%".$search['customer_phone']."%' ";	
		}
		if(!empty($search['presenter_name'])){
			$sql.= " and c.presenter_name like '%".$search['presenter_name']."%' ";	
		}
		if(!empty($search['presenter_phone'])){
			$sql.= " and c.presenter_phone like '%".$search['presenter_phone']."%' ";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$tb = $this->base_model->loadTable();
		$searchs = $this->getSearch($search);
		$sql = "SELECT c.*, mf.manufacturer_name, tc.typecar_name, vc.vehicleload_name, rg.registrationstation_name, iss.insurance_name
				FROM `".$tb['crmd_output']."` AS c
				LEFT JOIN `".$tb['crmd_manufacturer']."` AS mf on mf.id = c.manufacturer_id
				LEFT JOIN `".$tb['crmd_typecar']."` AS tc on tc.id = c.cartype_id
				LEFT JOIN `".$tb['crmd_vehicleload']."` AS vc on vc.id = c.vehicleload_id
				LEFT JOIN `".$tb['crmd_registrationstation']."` AS rg on rg.id = c.registrationstation_id
				LEFT JOIN `".$tb['crmd_insurance']."` AS iss on iss.id = c.insurance_id
				WHERE c.isdelete = 0 
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.datecreate desc';
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
		FROM `".$tb['crmd_output']."` AS c
		WHERE c.isdelete = 0 
		$searchs	
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$tb = $this->base_model->loadTable();
		$array['pay_total'] = fmNumberSave($array['pay_total']);
		$array['pay_advance'] = fmNumberSave($array['pay_advance']);
		if(!empty($array['insurance_expires'])){
			$array['insurance_expires'] =  fmDateSave($array['insurance_expires']);
		}
		if(!empty($array['registrationstation_expires'])){
			$array['registrationstation_expires'] =  fmDateSave($array['registrationstation_expires']);
		}
		if(!empty($array['registrationstation_date'])){
			$array['registrationstation_date'] =  fmDateSave($array['registrationstation_date']);
		}
		if(!empty($array['box_guarantee'])){
			$array['box_guarantee'] =  fmDateSave($array['box_guarantee']);
		}
		if(!empty($array['pay_start_date'])){
			$array['pay_start_date'] =  fmDateSave($array['pay_start_date']);
		}
		if(!empty($array['pay_expires_date'])){
			$array['pay_expires_date'] =  fmDateSave($array['pay_expires_date']);
		}
		unset($array['typecar_name']);
		$result = $this->model->table($tb['crmd_output'])->insert($array);	
		return $result;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		$array['pay_total'] = fmNumberSave($array['pay_total']);
		$array['pay_advance'] = fmNumberSave($array['pay_advance']);
		if(!empty($array['insurance_expires'])){
			$array['insurance_expires'] =  fmDateSave($array['insurance_expires']);
		}
		if(!empty($array['registrationstation_expires'])){
			$array['registrationstation_expires'] =  fmDateSave($array['registrationstation_expires']);
		}
		if(!empty($array['registrationstation_date'])){
			$array['registrationstation_date'] =  fmDateSave($array['registrationstation_date']);
		}
		if(!empty($array['box_guarantee'])){
			$array['box_guarantee'] =  fmDateSave($array['box_guarantee']);
		}
		if(!empty($array['pay_start_date'])){
			$array['pay_start_date'] =  fmDateSave($array['pay_start_date']);
		}
		if(!empty($array['pay_expires_date'])){
			$array['pay_expires_date'] =  fmDateSave($array['pay_expires_date']);
		}
		unset($array['typecar_name']);
		$result = $this->model->table($tb['crmd_output'])->where('id',$id)->update($array);	
		return $id;
	}
	
}
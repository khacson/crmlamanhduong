<?php
/**
 * @author 
 * @copyright 2018
 */
 class DebtsModel extends CI_Model{
	function __construct(){
		parent::__construct('');
		$this->login = $this->site->getSession('login');
	}
	function getSearch($search){
		$sql = "";
		$companyid = $this->login->companyid;
		if(!empty($search['customerid'])){
			$sql.= " and l.customerid in (".$search['customerid'].") ";	
		}
		if(!empty($search['pxk'])){
			$sql.= " and l.pxk like  '%".$search['pxk']."%' ";	
		}
		if(!empty($search['price'])){
			$sql.= " and l.price like  '%".fmNumberSave($search['price'])."%' ";	
		}
		if(!empty($search['amount_debt'])){
			$sql.= " and l.amount_debt like  '%".fmNumberSave($search['amount_debt'])."%' ";	
		}
		if(!empty($search['description'])){
			$sql.= " and l.description like  '%".$search['description']."%' ";	
		}
		if(!empty($search['expirationdate'])){
			$sql.=" and l.expirationdate = '".fmDateSave($search['expirationdate'])." '";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$tb = $this->base_model->loadTable();
		$sql = "SELECT l.*, c.customer_name,
				(
					select sum(amount)
					from `".$tb['crmd_receipts']."`
					where isdelete = 0
					and orderid = l.id
					and receipts_type = 3
				) da_thanh_toan
				FROM `".$tb['crmd_liabilities']."` AS l
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = l.customerid 
				WHERE l.isdelete = 0  
				and l.liabilities = 2
				and c.isdelete = 0
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.id DESC ';
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
		FROM `".$tb['crmd_liabilities']."` AS l
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = l.customerid 
				WHERE l.isdelete = 0  
				and l.liabilities = 2
				and c.isdelete = 0
				$searchs
		";
		$query = $this->model->query($sql)->execute();
		return $query[0]->total;	
	}
	function saves($array){
		$tb = $this->base_model->loadTable();
		$array['price'] = fmNumberSave($array['price']);
		$array['expirationdate'] =  fmDateSave($array['expirationdate']);
		$uniqueid = $this->base_model->getUniqueid();
		$array['liabilities'] = 1;
		$array['orderid'] = -1;
		$array['branchid'] = $this->login->branchid;
		//Check exit;
		$checkExit = $this->model->table($tb['crmd_liabilities'])
						  ->select('id')
						  ->where('liabilities',1)
						  ->where('customerid',$array['customerid'])
						  ->find();
		if(!empty($checkExit->id)){
			return -1;
		}
		$this->model->table($tb['crmd_liabilities'])->insert($array);	
		return 1;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		$updates = array();
		$updates['expirationdate'] =  fmDateSave($array['expirationdate']);
		$updates['description'] = $array['description'];
		$this->model->table($tb['crmd_liabilities'])->where('id',$id)->update($updates);	
		return 1;
	 }
	function findID($id){
		 $tb = $this->base_model->loadTable();
		 $query = $this->model->table($tb['crmd_liabilities'])
					  ->select('*')
					  ->where('id',$id)
					  ->find();
		return $query;
	 }
	function findDetail($id){
		 $tb = $this->base_model->loadTable();
		 $query = $this->model->table($tb['crmd_receipts'])
					  ->select('*')
					  ->where('orderid',$id)
					  ->where('receipts_type',3)
					  ->order_by('datecreate','desc')
					  ->find_all();
		return $query;
	}
	//Tạo phiếu chi
	function saveRecept($array,$id){
		$tb = $this->base_model->loadTable();
		//$this->db->trans_start();
		$branchid = $this->login->branchid;
		$finds = $this->findID($id);
		$insert = array();
		$datepo = fmDateSave($array['datepo']);
		$poid = $this->createPoPay($branchid,$datepo);
		$insert['receipts_code']  = $poid;
		$insert['poid']  = $finds->pxk; //chi khac
		$insert['branchid']  = $branchid; //chi khac
		$insert['amount'] = fmNumberSave($array['amount']);
		$insert['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$insert['usercreate'] = $this->login->username;
		$insert['signature'] = $this->login->signature;
		$insert['signature_name'] = $this->login->fullname;
		$insert['notes'] = $array['notes'];
		$insert['payment'] = $array['payment'];
		$insert['receipts_type'] = 3; //= 3 Cập nhật công nợ
		$insert['bankid'] = $array['bankid'];
		if(empty($array['bankid'])){
			$insert['bankid'] = 0;
		}
		if( $array['payment'] == 1){
			$insert['bankid'] = 0;
		}
		$insert['orderid'] = $id;
		$insert['datepo'] = $datepo; 
		$insert['customerid'] = $array['customerid'];
		$this->model->table($tb['crmd_receipts'])->insert($insert);	
		
		$description = getLanguage('them-moi').': '.$poid;
		$this->base_model->addAcction(getLanguage('phieu-thu'),$this->uri->segment(2),'','',$description);
		return $poid;
	 }
	function findPOID($receipts_code){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_receipts'])
					  ->select('*')
					  ->where('receipts_code',$receipts_code);
		$query = $query->find();
		return $query;
	}
	 //Tạo mã phiếu chi
	function createPoPay($branchid,$datecreate){//Phieu chi
		$tb = $this->base_model->loadTable();
		$yearDay = fmMonthSave($datecreate);
		$checkPOid = $this->model->table($tb['crmd_receipts'])
							 ->select('receipts_code')
							 ->where("datepo like '$yearDay%'")
							 //->where('branchid',$branchid)
							 ->where('isdelete',0)
							 ->order_by('id','DESC')
							 ->find();
		$cfpt = cfpt();
		if(!empty($checkPOid->receipts_code)){
			$poid = str_replace($cfpt,'',$checkPOid->receipts_code);
			$poc = (float)$poid;
		}
		else{
			$poc = date('ym',strtotime($yearDay)).'00000';
		}
		$receipts_code = $cfpt.($poc + 1);
		return $receipts_code;
	}
}
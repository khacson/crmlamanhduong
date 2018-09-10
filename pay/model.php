<?php
/**
 * @author 
 * @copyright 2018
 */
 class PayModel extends CI_Model{
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
			$sql.= " and tk.ticket_code like  '%".$search['ticket_code']."%' ";	
		}
		if(!empty($search['ticket_name'])){
			$sql.= " and tk.ticket_name like  '%".$search['ticket_name']."%' ";	
		}
		if(!empty($search['ticket_price'])){
			$sql.= " and tk.ticket_price like  '%".$search['ticket_price']."%' ";	
		}
		if(!empty($search['ticket_description_pay'])){
			$sql.= " and tk.ticket_description_pay like  '%".$search['ticket_description_pay']."%' ";	
		}
		if(!empty($search['ticket_date_expired'])){
			$sql.=" and tk.ticket_date_expired = '".fmDateSave($search['ticket_date_expired'])." '";	
		}
		return $sql;
	}
	function getList($search,$page,$rows){
		$searchs = $this->getSearch($search);
		$tb = $this->base_model->loadTable();
		$sql = "SELECT tk.*, c.customer_name,
				(
					select sum(amount)
					from `".$tb['crmd_pay']."`
					where isdelete = 0
					and ticket_id = tk.id
				) da_thanh_toan
				FROM `".$tb['crmd_ticket']."` AS tk
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = tk.customerid 
				WHERE tk.isdelete = 0  
				and c.isdelete = 0
				$searchs
				";
		if(empty($search['order'])){
			$sql.= ' ORDER BY c.datecreate DESC ';
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
				LEFT JOIN `".$tb['crmd_customer']."` c on c.id = tk.customerid 
				WHERE tk.isdelete = 0  
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
		$array['ticket_id'] = -1;
		$array['branchid'] = $this->login->branchid;
		//Check exit;
		$checkExit = $this->model->table($tb['crmd_ticket'])
						  ->select('id')
						  ->where('liabilities',1)
						  ->where('customerid',$array['customerid'])
						  ->find();
		if(!empty($checkExit->id)){
			return -1;
		}
		$this->model->table($tb['crmd_ticket'])->insert($array);	
		return 1;
	}
	function edits($array,$id){
		$tb = $this->base_model->loadTable();
		$updates = array();
		$updates['ticket_date_expired'] =  fmDateSave($array['ticket_date_expired']);
		$updates['ticket_price'] = fmNumberSave($array['ticket_price']);
		$this->model->table($tb['crmd_ticket'])->where('id',$id)->update($updates);	
		return 1;
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
	//Tạo phiếu chi
	function saveRecept($array,$id){
		$tb = $this->base_model->loadTable();
		//$this->db->trans_start();
		$branchid = $this->login->branchid;
		$finds = $this->findID($id);
		$insert = array();
		$datepo = fmDateSave($array['datepo']);
		$poid = $this->createPoPay($branchid,$datepo);
		$insert['pay_code']  = $poid;
		$insert['amount'] = fmNumberSave($array['amount']);
		$insert['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$insert['usercreate'] = $this->login->username;
		$insert['notes'] = $array['notes'];
		$insert['payment'] = $array['payment'];
		$insert['bankid'] = $array['bankid'];
		if(empty($array['bankid'])){
			$insert['bankid'] = 0;
		}
		if( $array['payment'] == 1){
			$insert['bankid'] = 0;
		}
		$insert['ticket_id'] = $id;
		$insert['datepo'] = $datepo; 
		$insert['customerid'] = $array['customerid'];
		$this->model->table($tb['crmd_pay'])->insert($insert);	
		
		$description = getLanguage('them-moi').': '.$poid;
		$this->base_model->addAcction(getLanguage('phieu-chi'),$this->uri->segment(2),'','',$description);
		return $poid;
	 }
	function findPOID($pay_code){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_pay'])
					  ->select('*')
					  ->where('pay_code',$pay_code);
		$query = $query->find();
		return $query;
	}
	 //Tạo mã phiếu chi
	function createPoPay($branchid,$datecreate){//Phieu chi
		$tb = $this->base_model->loadTable();
		$yearDay = fmMonthSave($datecreate);
		$checkPOid = $this->model->table($tb['crmd_pay'])
							 ->select('pay_code')
							 ->where("datepo like '$yearDay%'")
							 //->where('branchid',$branchid)
							 ->where('isdelete',0)
							 ->order_by('id','DESC')
							 ->find();
		$cfpt = cfpt();
		if(!empty($checkPOid->pay_code)){
			$poid = str_replace($cfpt,'',$checkPOid->pay_code);
			$poc = (float)$poid;
		}
		else{
			$poc = date('ym',strtotime($yearDay)).'00000';
		}
		$pay_code = $cfpt.($poc + 1);
		return $pay_code;
	}
}
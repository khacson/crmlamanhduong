<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  
 * @copyright 2018
 */
class Pay extends CI_Controller {
    private $route;
	private $login;
	function __construct(){
		parent::__construct();	
		$this->load->model(array('excel_model','base_model'));
		$this->login = $this->site->getSession('login');
		$this->route = $this->router->class;
		$menus = $this->site->getSession('menus');
		$this->title = $menus[$this->route];
	}
	function _remap($method, $params = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->_view();
    }
	function _view(){
		$data = new stdClass();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		if (!isset($permission['view'])) {
	    	//redirect('authorize');
	    }
		$login = $this->login;
		$companyid = $this->login->companyid;
		
	    $data->permission = $permission;
		$data->csrfName = $this->security->get_csrf_token_name();
		$data->csrfHash = $this->security->get_csrf_hash();		
	    $data->controller = base_url().$this->route;
		$data->routes = $this->route;
		
		$data->customers = $this->base_model->getCustomer('');	
		$content = $this->load->view('view',$data,true);
		$this->site->write('content',$content,true);
		$this->site->write('title',$this->title,true);
        $this->site->render();
	}
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$tb = $this->base_model->loadTable();
			$find = $this->base_model->getColumns($tb['crmd_ticket_buy']);
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		$result->title = getLanguage('ticket').': '.$find->ticket_code;
		$data->title = $result->title;
		$data->customers = $this->base_model->getCustomer('');
		$data->branchid = $login->branchid;
        $result->content = $this->load->view('form', $data, true);
		$result->id = $id;
        echo json_encode($result);
	}
	function formPay(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		$tb = $this->base_model->loadTable();
		if(empty($find->id)){
			$find = $this->base_model->getColumns($tb['crmd_ticket']);
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('them-moi');
		}
		else{
			$result->title = getLanguage('sua');
		}
		$customerid = $find->customerid;
		$data->customers = $this->model->table($tb['crmd_customer'])
						  ->select('id,customer_name')
						  ->where('id',$customerid)
						  ->find();
		$data->customerid = $customerid;
		$data->title = $result->title;
		$details = $this->model->findDetail($id);
		$amount = 0;
		foreach($details as $item){
			$amount+= $item->amount;
		}
		$data->details = $details;
		$data->amount = $amount;
		$data->banks = $this->base_model->getBank();	
		$data->branchid = $login->branchid;
        $result->content = $this->load->view('formPay', $data, true);
		$result->id = $id;
        echo json_encode($result);
	}
	function getList(){
		$rows = 20; //$this->site->config['row'];
		$page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
		$start = empty($page) ? 1 : $page+1;
		$searchss = json_decode($this->input->post('search'),true);
		$searchss['order'] = substr($this->input->post('order'),4);
		$searchss['index'] = $this->input->post('index');
		$data = new stdClass();
		$result = new stdClass();
		$searchs = array();
		foreach($searchss as $key=>$val){
			$searchs[$key] = addslashes($val); 
		}
		$query = $this->model->getList($searchs,$page,$rows);
		$count = $this->model->getTotal($searchs);
		$data->datas = $query;
		$data->start = $start;
		$data->permission = $this->base_model->getPermission($this->login, $this->route);
		//print_r($query); exit;
		$page_view=$this->site->pagination($count,$rows,5,$this->route,$page);
		$result->paging = $page_view;
		$result->csrfHash = $this->security->get_csrf_hash();
		$result->viewtotal = number_format($count); 
        $result->content = $this->load->view('list', $data, true);
		echo json_encode($result);
	}
	function save() {
		$token =  $this->security->get_csrf_hash();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		
		$result = array();
		if (!isset($permission['add'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$array = json_decode($this->input->post('search'),true);
		$login = $this->login;
		$array['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['usercreate'] = $this->login->username;
		$result['status'] =$this->model->saves($array);
		$description = 'Thêm mới';
		$this->base_model->addAcction('Công nợ đầu kỳ',$this->uri->segment(2),'','',$description);
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function edit() {
		$token =  $this->security->get_csrf_hash();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		if (!isset($permission['edit'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$array = json_decode($this->input->post('search'),true);
		$id = $this->input->post('id');
		$login = $this->login;
		$acction_before = $this->model->findID($id);
		$array['date_update_pay']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['user_update_pay'] = $this->login->username;
		$result['status'] =$this->model->edits($array,$id);
		
		$arr_log['func'] = $this->uri->segment(2);
		$description = 'Sửa';
		$this->base_model->addAcction('Sủa công nợ',$this->uri->segment(2),json_encode($acction_before),json_encode($array),$description);
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function deletes() {
		$token =  $this->security->get_csrf_hash();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		if (!isset($permission['delete'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$tb = $this->base_model->loadTable();
		$id = $this->input->post('id');//print_r($id);exit;
		$login = $this->login;
		$array['dateupdate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['isdelete'] = 1;
		$array['userupdate'] = $this->login->username;
		#region check edit
		$finds = $this->model->findID($id);
		$checkExit = $this->model->table($tb['crmd_pay'])
									  ->select('uniqueid')
									  ->where('isdelete',0)
									  ->where('uniqueid',$finds->uniqueid)
									  ->find();
		if(!empty($checkExit->uniqueid)){
			$result['status'] = -1;	
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;
		}
		#end
		$acction_before = $this->model->findID($id);
		$this->model->table($tb['crmd_ticket_buy'])
					->where('id',$id)
					->delete();
		$description = "Xóa: ".$finds->uniqueid;
		$this->base_model->addAcction('Công nợ đầu kỳ - Mua hàng',$this->uri->segment(2),json_encode($acction_before),'',$description);
		
		$result['status'] = 1;	
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function saveRecept(){
		$tb = $this->base_model->loadTable();
		$id = $this->input->post('id');
		$amount = $this->input->post('money');
		$description = $this->input->post('description');
		$payment = $this->input->post('payment');
		$bankid = $this->input->post('bankid');
		$datepo =  $this->input->post('datepo');
		$customerid =  $this->input->post('customerid');
		$array = array();
		$array['customerid'] = $customerid;
		$array['notes'] = $description;
		$array['amount'] = $amount;
		$array['payment'] = $payment;
		$array['bankid'] = $bankid;
		$array['datepo'] = $datepo;
		$poid = $this->model->saveRecept($array,$id);
		echo $poid;		
		//Tao phieu thu
	}
	function getDataPrintPC(){
		$ptid = $this->input->post('ptid');
		$result = $data = new stdClass();
		$data->company = $this->login->company_name;
		$data->login = $this->login;
		$dataprint = $this->model->findPOID($ptid); 
		if(empty($dataprint->id)){
			exit;
		}
		/*
		$type = $this->model->payType($dataprint->receipts_type);
		
		if(!empty($type->receipts_type_name)){
			$data->type = $type->receipts_type_name;
		}
		else{
			$data->type = '';
		}*/
		$data->datas = $dataprint;
		$data->type = '';
		$data->fmprice = $this->base_model->docso($dataprint->amount);
		$result->content = $this->load->view('printpc', $data, true);
		echo json_encode($result);
	}
	function getDetail(){
		$id = $this->input->post('id');
		$result = new stdClass();
		$data = new stdClass();
		$data->details = $this->model->findDetail($id);
		$result->content = $this->load->view('listdetail', $data, true);
		echo json_encode($result); exit;
	}
}
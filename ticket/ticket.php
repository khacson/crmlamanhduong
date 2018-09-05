<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  
 * @copyright 2018
 */
class Ticket extends CI_Controller {
    private $route;
	private $login;
	function __construct(){
		parent::__construct();	
		$this->load->model(array('model','base_model'));
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
	    $data->permission = $permission;
		$data->csrfName = $this->security->get_csrf_token_name();
		$data->csrfHash = $this->security->get_csrf_hash();		
	    $data->controller = base_url().$this->route;
		$data->routes = $this->route;	
		$data->prioritys = $this->base_model->getPriority();
		$content = $this->load->view('view',$data,true);
		$this->site->write('content',$content,true);
		$this->site->write('title',getLanguage('quan-ly-ticket'),true);
        $this->site->render();
	}
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$tbs = $this->base_model->loadTable();
			$find = $this->base_model->getColumns($tbs['crmd_ticket']);
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('tao-ticket');
		}
		else{
			$result->title = getLanguage('sua');
		}
		$data->prioritys = $this->base_model->getPriority();
		$data->companyid = $login->companyid;
        $result->content = $this->load->view('form', $data, true);
		$result->id = $id;
        echo json_encode($result); exit;
	}
	function feedback(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$tbs = $this->base_model->loadTable();
			$find = $this->base_model->getColumns($tbs['crmd_ticket']);
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		$result->title = getLanguage('danh-gia');
		$data->prioritys = $this->base_model->getPriority();
		$data->companyid = $login->companyid;
        $result->content = $this->load->view('feedback', $data, true);
		$result->id = $id;
        echo json_encode($result); exit;
	}
	function getList(){
		$rows = 20; //$this->site->config['row'];
		$page = $this->input->post('page');
        $pageStart = $page * $rows;
        $rowEnd = ($page + 1) * $rows;
		$start = empty($page) ? 1 : $page+1;
		$searchs = json_decode($this->input->post('search'),true);
		$searchs['order'] = substr($this->input->post('order'),4);
		$searchs['index'] = $this->input->post('index');
		$data = new stdClass();
		$result = new stdClass();
		$query = $this->model->getList($searchs,$page,$rows);
		$count = $this->model->getTotal($searchs);
		$data->datas = $query;
		$data->start = $start;
		$data->permission = $this->base_model->getPermission($this->login, $this->route);
		
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
		
		if (!isset($permission['add'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$array = json_decode($this->input->post('search'),true);
		$login = $this->login;
		$array['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['ticket_code'] = randCode();
		$array['usercreate'] = $this->login->username;
		$result['status'] =$this->model->saves($array);
		$array['customerid'] = $login->customerid;
		
		$description = getLanguage('them-moi').': '.$array['ticket_code'];
		$this->base_model->addAcction(getLanguage('quan-ly-ticket'),$this->uri->segment(2),'','',$description);
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	function saveFeedback(){
		$tb = $this->base_model->loadTable();
		$token =  $this->security->get_csrf_hash();
		$permission = $this->base_model->getPermission($this->login, $this->route);
		$length = $this->input->post('length');
		if (!isset($permission['add'])){
			$result['status'] = 0;
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;	
		}
		$array = json_decode($this->input->post('search'),true);
		$login = $this->login;
		$insert = array();
		$ticket_image = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['ticket_image'.$i]) && $_FILES['ticket_image'.$i]['name'] != "") {
				$imge_name = $_FILES['ticket_image'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('ticket_image'.$i, $imge_name); //Ten hinh 
				$ticket_image.= $image_data.';';	
			}
		}
		$array['ticket_image']  = $ticket_image;
		
		$insert['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$insert['usercreate'] = $this->login->username;
		$insert['customerid'] = $array['customerid'];
		$insert['ticket_id'] = $array['id'];
		$insert['feedback_status'] = $array['customer_reviews_status'];
		$insert['feedback_content'] = $array['customer_reviews'];
		$this->model->table($tb['crmd_ticket_feedback'])->insert($insert);
		
		$result['status'] = 1;
		$description = getLanguage('phan-hoi').': '.$array['ticket_code'];
		$this->base_model->addAcction(getLanguage('quan-ly-ticket'),$this->uri->segment(2),'','',$description);
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
		$ticket_image = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['ticket_image'.$i]) && $_FILES['ticket_image'.$i]['name'] != "") {
				$imge_name = $_FILES['ticket_image'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('ticket_image'.$i, $imge_name); //Ten hinh 
				$ticket_image.= $image_data.';';	
			}
		}
		if(!empty($ticket_image)){
			$array['ticket_image']  = $ticket_image;
		}
		$id = $this->input->post('id');
		$login = $this->login;
		$acction_before = $this->model->findID($id);
		$array['dateupdate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['userupdate'] = $this->login->username;
		$result['status'] =$this->model->edits($array,$id);
		$arr_log['func'] = $this->uri->segment(2);
		$description = getLanguage('sua').': '.$acction_before->ticket_code;
		$this->base_model->addAcction(getLanguage('quan-ly-ticket'),$this->uri->segment(2),json_encode($acction_before),json_encode($array),$description);
		
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
		$id = $this->input->post('id');//print_r($id);exit;
		$login = $this->login;
		$array['datedelete']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['isdelete'] = 1;
		$array['userdelete'] = $this->login->username;
		$tb = $this->base_model->loadTable();
		$find = $this->model->table($tb['crmd_ticket'])
					->select("group_concat(ticket_code) ticket_code")
					->where("id in ($id)")
					->where('reply_result',0)
					->find();	
		if(empty($find->ticket_code)){
			$result['status'] = 0;	
			$result['csrfHash'] = $token;
			echo json_encode($result); exit;
		}
		
		$description = getLanguage('xoa').": ".$find->ticket_code;
		$this->base_model->addAcction(getLanguage('quan-ly-ticket'),$this->uri->segment(2),'','',$description);
		
		$this->model->table($tb['crmd_ticket'])
					->where("id in ($id)")
					->where('reply_result',0)
					->update($array);	
					
		$result['status'] = 1;	
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	private function set_upload_options() {
        $config = array();
        $config['allowed_types'] = 'jpg|jpeg|gif|png|pdf|doc|docx';
        $config['upload_path'] = './files/ticket/';
        $config['encrypt_nam'] = 'TRUE';
        $config['remove_spaces'] = TRUE;
        //$config['max_size'] = 0024;
        return $config;
    }
}
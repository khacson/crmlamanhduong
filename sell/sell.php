<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  
 * @copyright 2018
 */
class Sell extends CI_Controller {
    private $route;
	private $login;
	function __construct(){
		parent::__construct();	
		$this->load->model(array('model','base_model'));
		$this->login = $this->site->getSession('login');
		$this->route = $this->router->class;
		$menus = $this->site->getSession('menus');
		$this->title = $menus[$this->route];
		$this->load->library('upload');
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
		
		$data->manufacturers = $this->base_model->getManufacturer();
		$data->cartypes = $this->base_model->getCarType();
		$data->vehicleloads = $this->base_model->getVehicleload();
		$data->registrationstations = $this->base_model->getRegistrationstation();
		$data->insurances = $this->base_model->getInsurance();
		
		
		$content = $this->load->view('view',$data,true);
		$this->site->write('content',$content,true);
		$this->site->write('title',getLanguage('ban-hang'),true);
        $this->site->render();
	}
	function form(){
		$login = $this->login;
		$id = $this->input->post('id');
		$find = $this->model->findID($id);
		if(empty($find->id)){
			$tbs = $this->base_model->loadTable();
			$find = $this->base_model->getColumns($tbs['crmd_output']);
		}
		$data = new stdClass();
        $result = new stdClass();
		$data->finds = $find;  
		if(empty($id)){
			$result->title = getLanguage('xuat-ban');
		}
		else{
			$result->title = getLanguage('sua');
		}
		
		$data->manufacturers = $this->base_model->getManufacturer();
		$data->cartypes = $this->base_model->getCarType();
		$data->vehicleloads = $this->base_model->getVehicleload();
		$data->registrationstations = $this->base_model->getRegistrationstation();
		$data->insurances = $this->base_model->getInsurance();
		
		
		$data->branchid = $login->branchid;
        $result->content = $this->load->view('form', $data, true);
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
		$length1 = $this->input->post('length1');
		$length2 = $this->input->post('length2');
		$car_images = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['car_images'.$i]) && $_FILES['car_images'.$i]['name'] != "") {
				$imge_name = $_FILES['car_images'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('car_images'.$i, $imge_name); //Ten hinh 
				$car_images.= $image_data.';';		
			}
		}
		$array['car_images']  = $car_images;
		//box_images
		$box_images = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['box_images'.$i]) && $_FILES['box_images'.$i]['name'] != "") {
				$imge_name = $_FILES['box_images'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('box_images'.$i, $imge_name); //Ten hinh 
				$box_images.= $image_data.';';	
			}
		}
		$array['box_images']  = $box_images;
		
		
		$login = $this->login;
		$array['datecreate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['usercreate'] = $this->login->username;
		$result['status'] =$this->model->saves($array);
		$description = getLanguage('them-moi').': '.$array['car_number'];
		$this->base_model->addAcction(getLanguage('ban-hang'),$this->uri->segment(2),'','',$description);
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
		
		$length1 = $this->input->post('length1');
		$length2 = $this->input->post('length2');
		$car_images = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['car_images'.$i]) && $_FILES['car_images'.$i]['name'] != "") {
				$imge_name = $_FILES['car_images'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('car_images'.$i, $imge_name); //Ten hinh 
				$car_images.= $image_data.';';	
			}
		}
		$array['car_images']  = $car_images;
		//box_images
		$box_images = '';
		for($i=0;$i< $length1; $i++){
			if(isset($_FILES['box_images'.$i]) && $_FILES['box_images'.$i]['name'] != "") {
				$imge_name = $_FILES['box_images'.$i]['name'];
				$this->upload->initialize($this->set_upload_options());
				$image_data = $this->upload->do_upload('box_images'.$i, $imge_name); //Ten hinh 
				$box_images.= $image_data.';';	
			}
		}
		$array['box_images']  = $box_images;
		
		$id = $this->input->post('id');
		$login = $this->login;
		$acction_before = $this->model->findID($id);
		$array['dateupdate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['userupdate'] = $this->login->username;
		//$array['ipupdate'] = $this->base_model->getMacAddress();
		$result['status'] =$this->model->edits($array,$id);
		
		$arr_log['func'] = $this->uri->segment(2);
		$description = getLanguage('sua').': '.$array['car_number'];
		$this->base_model->addAcction(getLanguage('ban-hang'),$this->uri->segment(2),json_encode($acction_before),json_encode($array),$description);
		
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
		$array['dateupdate']  = gmdate("Y-m-d H:i:s", time() + 7 * 3600);
		$array['isdelete'] = 1;
		$array['userupdate'] = $this->login->username;
		$tb = $this->base_model->loadTable();
		$this->model->table($tb['crmd_typecar'])
					->where('id',$id)
					->where('id <> 1')
					->update($array);	
		
		$queryDelete = $this->model->table($tb['crmd_typecar'])
					->select('group_concat(typecar_name) as deletes')
					->where("id in ($id)")
					->find();
		$description = getLanguage('xoa').": ".$queryDelete->deletes;
		$this->base_model->addAcction(getLanguage('ban-hang'),$this->uri->segment(2),'','',$description);
		
		if($id == 1){
			$result['status'] = 0;	
		}
		else{
			$result['status'] = 1;	
		}
		$result['csrfHash'] = $token;
		echo json_encode($result);
	}
	private function set_upload_options() {
        $config = array();
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['upload_path'] = './files/goods/';
        $config['encrypt_nam'] = 'TRUE';
        $config['remove_spaces'] = TRUE;
        //$config['max_size'] = 0024;
        return $config;
    }
}
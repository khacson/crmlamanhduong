<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  
 * @copyright 2018
 */
class Reportpay extends CI_Controller {
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
		$login = $this->login;
		$companyid = $this->login->companyid;
		
	    $data->permission = $permission;
		$data->csrfName = $this->security->get_csrf_token_name();
		$data->csrfHash = $this->security->get_csrf_hash();		
	    $data->controller = base_url().$this->route;
		$data->routes = $this->route;
		
		$dateNow =  gmdate("d-m-Y", time() + 7 * 3600); 
		$week = strtotime(date("d-m-Y", strtotime($dateNow))." -1 week"); 
		$week = strftime("%d/%m/%Y", $week);
		$data->todates = $dateNow;
		$data->fromdates = $week;
		
		$data->customers = $this->base_model->getCustomer('');	
		$content = $this->load->view('view',$data,true);
		$this->site->write('content',$content,true);
		$this->site->write('title',$this->title,true);
        $this->site->render();
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
	function export(){
		$login = $this->login;
		$search = $_GET['search'];
		$searchs = json_decode($search,true);
		$datas = $this->model->getList($searchs,0,0);

		include(APPPATH . 'libraries/excel2013/PHPExcel/IOFactory' . EXT);
        $fileName = APPPATH . 'Template/report.xls';
        $versionExcel = 'Excel5';
        $inputFileType = PHPExcel_IOFactory::identify($fileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($fileName);
        $sheetIndex = $objPHPExcel->setActiveSheetIndex(0);
        $sheetIndex->setTitle('Report');
        $sheetIndex->getDefaultStyle()->getFont()
                ->setName('Times New Roman')
                ->setSize(12);

		//Header
		$sheetIndex->setCellValueByColumnAndRow(0,1,getLanguage('stt'));	
		$sheetIndex->setCellValueByColumnAndRow(1,1,getLanguage('khach-hang'));
		$sheetIndex->setCellValueByColumnAndRow(2,1,getLanguage('ma-yeu-cau'));
		$sheetIndex->setCellValueByColumnAndRow(3,1,getLanguage('yeu-cau'));
		$sheetIndex->setCellValueByColumnAndRow(4,1,getLanguage('so-tien'));
		$sheetIndex->setCellValueByColumnAndRow(5,1,getLanguage('ngay-nhan'));
		$sheetIndex->setCellValueByColumnAndRow(6,1,getLanguage('nguoi-nhan'));
		$sheetIndex->setCellValueByColumnAndRow(7,1,getLanguage('ghi-chu'));
			
		$i= 2; 
		foreach ($datas as $item) { 
			$datepo = '';
			if($item->datepo != '0000-00-00' && !empty($item->datepo)){
				$datepo = date(cfdate(),strtotime($item->datepo));
			}
			$sheetIndex->setCellValueByColumnAndRow(0,$i,$i-1);	
			$sheetIndex->setCellValueByColumnAndRow(1,$i,$item->customer_name);
			$sheetIndex->setCellValueByColumnAndRow(2,$i,$item->ticket_code);
			$sheetIndex->setCellValueByColumnAndRow(3,$i,$item->ticket_name);
			$sheetIndex->setCellValueByColumnAndRow(4,$i,$item->amount);
			$sheetIndex->setCellValueByColumnAndRow(5,$i,$datepo);
			$sheetIndex->setCellValueByColumnAndRow(6,$item->usercreate);
			$sheetIndex->setCellValueByColumnAndRow(7,$i,$item->notes);
			$i++;
		}
		$boderthin = "A2:H".($i-1); 
		$sheetIndex->getStyle($boderthin)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		#end
		$objPHPExcel->setActiveSheetIndex(0);
		$date = gmdate("dmYHis", time() + 7 * 3600);
		//$endxls = '.xls';
        $this->excel_model->exportExcel($objPHPExcel, $versionExcel, "report_".$date.'.xls');
	}
}
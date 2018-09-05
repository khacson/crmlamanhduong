<?php
/**
 * @author Son Nguyen
 * @copyright 2018
 */
 class AuthorizeModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function login($u, $p) {
		$sql = "
			SELECT cf.* , u.id, u.username,u.password ,u.fullname, u.mobile, u.email, u.groupid, 
			u.image,u.signature,g.groupname, g.grouptype, g.params, c.customer_name as company_name, g.companyid, 
			u.branchid, c.phone as cphone, 
			c.address as caddress, c.fax as cfax,u.departmentid, c.id as customerid ,signature
						FROM crmd_users u
						LEFT Join crmd_groups g on g.id = u.groupid
						LEFT Join crmd_customer_1 c on c.id = g.companyid and u.isdelete = 0
						LEFT JOIN crmd_config cf on cf.id = 1
						where u.isdelete = 0
						and u.username = '$u'
						and g.isdelete = 0
			;
		";
		$query = $this->model->query($sql)->execute();
		if(!empty($query[0]->username)){
			return $query[0];
		}
		else{
			return array();
		}
	}
	function getListMenu(){
		$menu = $this->model->table('crmd_menus')
							->select('name,route')
							->where('isdelete',0)
							->where('route <>','')
							->where('route <>','#')
							->find_all();
		$arr = array();
		foreach($menu as $item){
			$arr[$item->route] = $item->name;
		}
		return $arr;
	}
	function getRouter($str){
		$json = json_decode($str);
		$menu = $this->model->table('crmd_menus')
							->select('id,route')
							->where('isdelete',0)
							->where('route <>','')
							->find_all();
		$arr_menu = array();
		foreach($menu as $item){
			$arr_menu[$item->id] = $item->route;
		}
		$arr_right = array();
		foreach($json as $id=>$right){
			if(isset($arr_menu[$id])){
				$arr_right[$arr_menu[$id]] = $right;
			}	
		}
		return $arr_right;
	}
	function insertTimeLog($uid , $address, $GMTTime){
		$data['timelogin'] = $GMTTime;
		$data['ipaddress'] = $address;
		$data['username'] = $uid;	
		$id = $this->model->table('crmd_time_login')->save('', $data);
		return $id;
	}
	function getLanguage($lang=''){
		if($lang != ""){
			$langs = $lang;	
		}
		else{
			$langs = "vn";	
		}
		$query = $this->model->table('crmd_translate')
					  ->select('keyword,translation')
					  ->where('isdelete',0)
					  ->where('langkey',$langs)
					  ->find_all();
		$arr = array();
		foreach($query as $item){
			$arr[$item->keyword]	= $item->translation;
		}
		return $arr;
	}
}
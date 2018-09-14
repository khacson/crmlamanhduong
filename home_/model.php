<?php
/**
 * @author Son Nguyen
 * @copyright 2018
 */
 class HomeModel extends CI_Model{
	function __construct(){
		//$this->load->database();
		parent::__construct();
		$this->login = $this->site->getSession('login');
	}
	function getCustomer(){
		//$login = $this->login;
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_customer'])
					  ->select('count(1) total')
					  ->where('isdelete',0)
					  ->find();
		return $query;
	}
	function getSupplier(){
		//$login = $this->login;
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_supplier'])
					  ->select('count(1) total')
					  ->where('isdelete',0)
					  ->find();
		return $query;
	}
	function getGoods(){
		$tb = $this->base_model->loadTable();
		$query = $this->model->table($tb['crmd_goods'])
					  ->select('count(1) total')
					  ->where('isdelete',0)
					  ->find();
		return $query;
	}
 }
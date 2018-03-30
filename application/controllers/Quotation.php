<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//行情接口

class Quotation extends MY_Controller {

	public function __construct()
	{
	 	parent::__construct();
		//手动连接数据库
		$this->load->database();
	}
   //url http://localhost/api/Quotation/getList?type=1
	public function getList()
	{
		//type必须传
		if (empty($_GET['type'])) {

			$this->outData('名称必须',400);
			exit();
		}

		//接收参数type

		$type = $this->input->get('type',true);


		$this->db->where('type',$type);

		//从info表中查出对应的字段
		$data = $this->db->select('exchange_name,last, hight, low, degree, vol,exchange_icon')->get('quotation')->result_array();

		if (empty($data)){

			//获取数据失败
			$this->outData(0,'获取数据失败','');

		}else{

			//获取数据成功
			$this->outData(1,'获取数据成功',$data);
		}
	}
	
}

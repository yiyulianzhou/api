<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct()
	{
	 	parent::__construct();
		//手动连接数据库
		$this->load->database();
	}
   //url http://localhost/api/index.php/test/index?title=2&author=3
	public function index()
	{

		if (empty($_GET['title'])){

			$this->outData('名称必须',400);
		}

		$author = $this->input->get('author',true);

		$this->db->where('author',$author);

		//从info表中查出对应的字段
		$data = $this->db->select('title,author')->get('info')->result_array();

		if (empty($data)){
			//获取数据失败
			$this->outData(0,'获取数据失败','');
		}else{
			//获取数据成功
			$this->outData(1,'获取数据成功',$data);
		}
	}
	
}

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
	//币种接口 url http:10.10.10.109/api/getType
	public function getType()
	{

		$data =array(
			1=>'btc',
			2=>'eth',
			3=>'bcd',
			4=>'elf',
			5=>'ink',
			6=>'trx',
			7=>'aidoc',
			8=>'pst',
			9=>'ddd',
			10=>'eko',
			11=>'pra',
			12=>'uc',
			13=>'aif',
			14=>'bch',
			15=>'bcx',
			16=>'etc',
			17=>'ltc',
			18=>'sbtc',
			19=>'qtum',
			20=>'neo',
			21=>'nem',
			22=>'hsr',
			23=>'xrp',
			24=>'dash',
			25=>'xmr',
			26=>'eos',
			27=>'omg',
			28=>'iota',
			29=>'zec',
			30=>'waves',
			31=>'btg',
			32=>'bts',
			33=>'xlm',
			34=>'lsk'
		);

		if (empty($data)){
			//获取数据失败
			$this->outData(0,'获取数据失败','');
		}else{
			//获取数据成功
			$this->outData(1,'获取数据成功',$data);
		}
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

		//从quotation表中查出对应的字段

		$data = $this->db->select('exchange_name,last, high, low, degree, vol,exchange_icon')->get('quotation_test')->result_array();

		if (empty($data)){

			//获取数据失败
			$this->outData(0,'获取数据失败','');

		}else{

			//获取数据成功
			$this->outData(1,'获取数据成功',$data);
		}
	}

	//url http://10.10.10.102/api/Quotation/search?exchange=btc
	public function search()
	{
		$exchange = $this->input->get('exchange',true);

		//exchange必须传
		if (empty($exchange)) {

			$this->outData('搜索条件必须',400);
			exit();
		}

		$this->db->where('symbolId like','%'.$exchange.'%');

		//从news表中查出对应的字段

		$this->db->select('exchange_name,last, high, low, degree, vol,exchange_icon');

		$this->db->limit(5);

		$data = $this->db->get('quotation_test')->result_array();

		if (empty($data)){

			//获取数据失败
			$this->outData(0,'获取数据失败','');

		}else{

			//获取数据成功
			$this->outData(1,'获取数据成功',$data);
		}
	}
	
}

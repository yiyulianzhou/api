<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

	protected function outData($code = 0,$msg = '操作成功',$data = [])
	{
		$result = [
			'code'  => $code,
			'msg'   => $msg,
			'data'  => $data ? $data : [],
		];
		echo json_encode($result);
		exit;
	}

}
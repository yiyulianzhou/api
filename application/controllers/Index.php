<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 10:51
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//加载文档

class Index extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->load->view('index/index.html');
    }

}

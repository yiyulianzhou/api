<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:59
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//行情接口

class Info extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //手动连接数据库
        $this->load->database();
    }
    //快讯列表数据
    //url http://localhost/api/Info/getList
    public function getList()
    {
        $page = $this->input->get('page',true);

        if (empty($page)){
            //获取数据失败
            $this->outData('页码必须',400);
            exit();
        }
        $start = ($page-1)*9;

        //从info表中查出对应的字段

        $this->db->select('id,title, post_time,contents');

        $this->db->limit(10,$start);

        $data = $this->db->get('kuaixun_test')->result_array();

        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }


}

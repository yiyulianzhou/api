<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:59
 */
defined('BASEPATH') OR exit('No direct script access allowed');


//行情接口

class News extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //手动连接数据库
        $this->load->database();
    }

    //url http://localhost/api/News/getList?type=1
    public function getList()
    {
        //type必须传
        if (empty($_GET['type'])) {

            $this->outData('类型必须',400);
            exit();
        }

        //接收参数type
        $type = $this->input->get('type',true);

        //接收页码
        $page = $this->input->get('page',true);

        $start = ($page-1)*9;

        $this->db->where('type',$type);

        //从quotation表中查出对应的字段

        $this->db->select('id,amount,title,small_img,post_time,brief');

        //新闻按发布时间排序
        $this->db->order_by('post_time','desc');

        $this->db->limit(10,$start);

        $data = $this->db->get('news_test')->result_array();

        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

    //获取新闻详情
    //url http://10.10.10.109/api/News/getDetail?id=1&amount=0
    public function getDetail( )
    {
        //id必须传
        if (empty($_GET['id'])) {

            $this->outData('id必须',400);
            exit();
        }

        //接收参数type

        $id = $this->input->get('id',true);

        $amount = $this->input->get('amount',true);

        //从news表中查出对应的字段
        $update['amount'] = $amount+1;

        $res = $this->db->update('news_test', $update, array('id' => $id));

        if ($res){
            $this->db->select('type,title,post_time,amount,contents');

            $this->db->where('id = ',$id);

            $data = $this->db->get('news_test')->row_array();
        }


        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }
    //url http://10.10.10.109/api/News/search?news='投资'

    public function search()
    {

        $news = $this->input->get('news',true);

        //type必须传
        if (empty($news)) {

            $this->outData('搜索条件必须',400);
            exit();
        }

        $this->db->where('title like','%'.$news.'%');

        //从news表中查出对应的字段

        $this->db->select('id,amount,title,small_img,post_time,brief');

        $this->db->limit(5);

        $data = $this->db->get('news_test')->result_array();

        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

}

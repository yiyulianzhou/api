<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 12:00
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//行情接口

class Find extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //手动连接数据库
        $this->load->database();
    }
    //公司列表数据
    //url http://10.10.10.109/api/Find/getData?type=1&page=1

    public function getData()
    {
        //type必须传
        if (empty($_GET['type'])) {

            $this->outData('type必须',400);
            exit();
        }

        //接收参数type

        $type = $this->input->get('type',true);

        //接收页码
        $page = $this->input->get('page',true);

        //从company表中查出对应的字段
        switch ($type){
            //公司
            case '1':
                $data = $this->company($page);
                break;
            //人物
            case '2':
                $data = $this->person($page);
                break;
            //事件
            case '3':
                $data = $this->event($page);
                break;
            //钱包
            case '4':
                $data = $this->wallet($page);
                break;
            //挖矿
            case '5':
                $data = $this->dig($page);
                break;
            //交易所
            case '6':
                $data = $this->exchange($page);
                break;
            //应用
            case '7':
                $data = $this->apply($page);
                break;
        }


        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

    public function company($page)
    {
        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        //通过传页码加载更多数据
        $start = ($page-1)*9;


        $this->db->limit(10,$start);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    //人物
    public function person($page)
    {
        $this->db->select('id,name,avatar,brief,company');

        $start = ($page-1)*9;

        $this->db->limit(10,$start);

        $this->db->order_by('id','desc');

        $data = $this->db->get('person_test')->result_array();

        return $data;
    }

    //事件

    public function event($page)
    {
        $this->db->select('id,name,money,touzifang,lunci,create_time');

        $start = ($page-1)*9;

        $this->db->limit(10,$start);

        $data = $this->db->get('event_test')->result_array();

        return $data;
    }

    //钱包
    public function wallet($page)
    {
        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        $start = ($page-1)*9;

        $this->db->where('apply =','钱包');

        $this->db->limit(10,$start);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    //挖矿
    public function dig($page)
    {
        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        $start = ($page-1)*9;

        $this->db->where('apply =','挖矿');

        $this->db->limit(10,$start);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    //交易所
    public function exchange($page)
    {
        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        $start = ($page-1)*9;

        $this->db->where('apply =','交易所');

        $this->db->limit(10,$start);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    //应用
    public function apply($page)
    {
        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        $start = ($page-1)*9;

        $this->db->where('apply =','区块链应用');

        $this->db->limit(10,$start);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    //获取详情数据
    //url http://10.10.10.109/api/Find/getDetail?&kind=1&id=1
    public function getDetail()
    {

        //type必须传
        if (empty($_GET['kind'])) {

            $this->outData('kind必须',400);
            exit();
        }

        //接收参数type

        $kind = $this->input->get('kind',true);

        //type必须传
        if (empty($_GET['id'])) {

            $this->outData('id必须',400);
            exit();
        }
        //接收参数type

        $id = $this->input->get('id',true);


        switch ($kind){
            //公司
            case '1':
                $data = $this->get_company($id);
                break;
            //人物
            case '2':
                $data = $this->get_person($id);
                break;
            //事件
            case '3':
                $data = $this->get_event($id);
                break;
            //钱包
            case '4':
                $data = $this->get_wallet($id);
                break;
            //挖矿
            case '5':
                $data = $this->get_dig($id);
                break;
            //交易所
            case '6':
                $data = $this->get_exchange($id);
                break;
            //应用
            case '7':
                $data = $this->get_apply($id);
                break;
        }


        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

    public function get_company($id)
    {
        $this->db->select('name,avatar,basic,status,create_time,apply');

        $this->db->where('id = ',$id);

        $data = $this->db->get('company_test')->row_array();
        return $data;
    }

    //人物详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=2&id=1
    public function get_person($id)
    {

        $this->db->select('name,avatar,company,basic,zhiwei');

        $this->db->where('id = ',$id);

        $data = $this->db->get('person_test')->row_array();

        return $data;
    }

    //事件详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=3&id=1
    public function get_event($id)
    {

        $this->db->select('company,money,touzifang,lunci,create_time,name,basic');

        $this->db->where('id = ',$id);

        $data = $this->db->get('event_test')->row_array();

        return $data;
    }

    //钱包详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=4&id=1
    public function get_wallet($id)
    {

        $this->db->select('name,avatar,basic,status,create_time,apply');

        $this->db->where('id = ',$id);

        $data = $this->db->get('company_test')->row_array();

        return $data;
    }

    //挖矿详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=5&id=1
    public function get_dig($id)
    {

        $this->db->select('name,avatar,basic,status,create_time,apply');

        $this->db->where('id = ',$id);

        $data = $this->db->get('company_test')->row_array();

        return $data;
    }
    //交易所详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=6&id=1
    public function get_exchange($id)
    {

        $this->db->select('name,avatar,basic,status,create_time,apply');

        $this->db->where('id = ',$id);

        $data = $this->db->get('company_test')->row_array();

        return $data;
    }

    //区块链应用详情数据
    //url http://10.10.10.109/api/Find/getDetail?kind=7&id=1
    public function get_apply($id)
    {

        $this->db->select('name,avatar,basic,status,create_time,apply');

        $this->db->where('id = ',$id);

        $data = $this->db->get('company_test')->row_array();

        return $data;
    }

    //导航栏接口 url http:10.10.10.109/api/Find/getMenu
    public function getMenu()
    {

        $data =array(
            1=>'公司',
            2=>'人物',
            3=>'事件',
            4=>'钱包',
            5=>'挖矿',
            6=>'交易所',
            7=>'应用'
        );

        if (empty($data)){
            //获取数据失败
            $this->outData(0,'获取数据失败','');
        }else{
            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

    //发现页搜索
    //url http://10.10.10.109/api/Find/search?name=ONO
    public function search()
    {
        $name = $this->input->get('name',true);

        $type = $this->input->get('types',true);
        //name必须传
        if (empty($name)) {

            $this->outData('搜索条件必须',400);
            exit();
        }

        //type必须传
        if (empty($type)) {

            $this->outData('搜索条件必须',400);
            exit();
        }

        switch($type){

            case 1:
                $data = $this->searchCompany($name);
                break;
            case 2:

                $data = $this->searchPerson($name);
                break;
            case 3:
                $data = $this->searchEvent($name);
                break;
            case 4:
                $data = $this->searchCompany($name);
                break;
            case 5:
                $data = $this->searchCompany($name);
                break;
            case 6:
                $data = $this->searchCompany($name);
                break;
            case 7:
                $data = $this->searchCompany($name);
                break;
        }



        if (empty($data)){

            //获取数据失败
            $this->outData(0,'获取数据失败','');

        }else{

            //获取数据成功
            $this->outData(1,'获取数据成功',$data);
        }
    }

    public function searchCompany($name)
    {
        $this->db->where('name like','%'.$name.'%');

        //从news表中查出对应的字段

        $this->db->select('id,name,avatar,create_time,area,point,apply,tag');

        $this->db->limit(5);

        $data = $this->db->get('company_test')->result_array();

        return $data;
    }

    public function searchPerson($name)
    {
        $this->db->where('name like','%'.$name.'%');

        //从news表中查出对应的字段

        $this->db->select('name,avatar,company,basic,zhiwei');

        $this->db->limit(5);

        $data = $this->db->get('person_test')->result_array();

        return $data;
    }

    public function searchEvent($name)
    {
        $this->db->where('company like','%'.$name.'%');

        //从news表中查出对应的字段

        $this->db->select('company,money,touzifang,lunci,create_time,name,basic');

        $this->db->limit(5);

        $data = $this->db->get('event_test')->result_array();

        return $data;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zhangbin
 * Date: 2019/6/11
 * Time: 2:02 PM
 */


namespace app\index\controller;


use think\Controller;
use think\facade\Cache;

class Redis extends Controller
{
    public $redisObject;

    /*public function __construct()
    {
        $this->redisObject = new \think\cache\driver\Redis();
        if(!$this->redisObject->connect('127.0.0.1',6379)){
            die('can not connect to redis server');
        }
    }*/

    public function index(){
        $objRedis = Cache::init()->handler();
        //dump($objRedis);
        //存储字符串
        $objRedis->Set('packt_title','Packt Publishing');
        echo $objRedis->Get('packt_title');
        //存储数组，集合
        $array = ['PHP5.4','PHP5.5','PHP5.6','PHP7.0'];
        $encoded = json_encode($array);
        $objRedis->SELECT(1);
        $objRedis->Set('my_array',$encoded);
        $data = $objRedis->Get('my_array');
        $decoded = json_decode($data,true);
        print_r($decoded);
    }
    
}
<?php
namespace app\index\controller;

//use think\cache\driver\Redis;
use think\Controller;
use think\facade\Cache;

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    /**
     * 设置缓存
     * @param string $name
     * @return string
     */
    public function setCache($name = 'ThinkPHP5')
    {
        //string
        $value = 'zhangbin135';
        Cache::set('name135',$value,3600);
        //init
        $cache = Cache::init();
        // 获取缓存对象句柄
        $handler = $cache->handler();
        // 获取Redis对象 进行额外方法调用
        $len = $handler->StrLen('name135');
        //halt($len);
        //list
        $handler->LPUSH('hello','beyond is very good brand');
        return 'hello,' . $value;
    }

    /**
     * 获取缓存
     * @return mixed
     */
    public function getCache(){
        //$name = Cache::get('name135');
        //$name = Cache::init()->handler()->LRANGE('hello',0,1);
        //$name = Cache::init()->handler()->LPop('hello');
        //$cache = Cache::init();
        //$handler = $cache->handler();
        //$name = $handler->StrLen('name135');
        $objRedis = new Redis();
        $name = $objRedis->Get('name135');
        //$name = $handler->Get('name135');
        //$name = $handler->LPop('hello');
        halt($name);

        return $name;
    }

    public function sendCache(){
        Cache::set('string','hello,zhangbin');

        

        Cache::set('age',18);
        $cache = Cache::init();
        $cache->handler()->DECR('age');
        

        return '程序运行成功...';
    }
    public function acceptCache(){
        return $this->fetch();
    }
    public function showCache(){
        $string = date('Y-m-d H:i:s');
        $strCache = Cache::get('string');
        $strCache = Cache::get('age');
        $this->assign('strCache',$strCache);
        $this->assign('string',$string);
        return $this->fetch();
    }

}
//$objIndex = new Index();
//$objIndex->sendCache();
<?php
namespace app\index\controller;

use think\cache\driver\Redis;
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
        //公共函数测试
        //test();



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

        $arrSStr = $cache->handler()->SMembers('SetTest');
        $sql = "insert into pageList(`url`,`title`,`time`) values ";
        foreach($arrSStr as $str){
            $str = json_decode($str,true);
            //dump($str);
            foreach($str as $k=>$v){
                $time = date('Y-m-d H:i:s');
                $sql .= "('{$k}','{$v}','{$time}'),";
                $this->pageShow($k);
            }
        }
        $sql = trim($sql,',').';';
        echo $sql;die;
        halt($arrSStr);

        //list
        $handler->LPUSH('hello','beyond is very good brand');

        //$cache->handler()->ZAdd('ZSet2','1 Book1 2 Book2 3 Book3');
        $cache->handler()->ZAdd('ZSet2',1,'Book1');
        $cache->handler()->ZAdd('ZSet2',2,'Book2');
        $cache->handler()->ZAdd('ZSet2',3,'Book3');

        //$cache->handler()->ZAdd('ZSet3','2 Book1 2 Book2 4 Book4');
        $cache->handler()->ZAdd('ZSet3',2,'Book1');
        $cache->handler()->ZAdd('ZSet3',2,'Book2');
        $cache->handler()->ZAdd('ZSet3',4,'Book4');

        //$a = $cache->handler()->ZRange('ZSet2',0,-1);
        //halt($a);
        $cache->handler()->ZUnionStore(
            'ZEnd0',
            array('ZSet2','ZSet3'),
            array(1,2)
        );
        //weights参数表示权重，其中表示并集后 zset1集合的分 * 2 后存储到 zset3 集合， zset2集合的分 * 1 后存储到 zset3 集合，这个代码的weihgts是错误的，经过测试。
        //$redis->zunionstore('zset3', array('zset1', 'zset2'), array('weights' => array(2, 1)));

        $cache->handler()->ZInterStore('ZEnd1',array('ZSet2','ZSet3'),array(1,2));


        $arrZEnd = $cache->handler()->ZRange('ZEnd0',0,-1,'WithScores');
        $arrZEnd = $cache->handler()->ZRange('ZEnd1',0,-1,'WithScores');

        $cache->handler()->Publish('ChatChannel1','在家么');

        $arrConfig = $cache->handler()->Config('get','*');
        halt($arrConfig);

        halt($arrZEnd);

        return 'hello,' . $value;
    }

    /**
     * 获取缓存
     * @return mixed
     */
    public function getCache(){
        //echo 1;die;

        $prefix = config('cache.prefix');
        //$name = Cache::get('name135');
        //list
        //$name = Cache::init()->handler()->LRANGE('hello',0,1);
        //$name = Cache::init()->handler()->LPop('hello');
        $cache = Cache::init();
        $handler = $cache->handler();
        $name = $handler->StrLen($prefix.'name135');
        $name = $handler->Get($prefix.'name135');
        //显示客户端的连接信息列表
        $name = $handler->Client('List');
        //获取客户端连接名称
        $name = $handler->Client('SetName','Conn2');
        $name = $handler->Client('GetName');

        $name = $handler->Client('List');
        //$name = $handler->Command();
        $name = $handler->Keys('*');

        $arrSStr = $cache->handler()->SMembers('SetAdd');
        halt($arrSStr);

        halt($name);
        return $name;
    }

    public function sendCache(){
        $cache = Cache::init();
        $prefix = config('cache.prefix');

        //Cache::set('string','hello,zhangbin');
        //Cache::set('age',18);

        //调用redis的扩展方法
        //$cache->handler()->DECR($prefix.'age');

        //通过ajax每次10秒的间隔获取服务器时间，返回到浏览器中
        //$cache->handler()->LPush('LStr',date('H:i:s'));
        //$cache->handler()->RPush('LStr',date('Y-m-d H:i:s'));

        //集合的存储
        //$cache->handler()->SAdd('SStr',date('H:i:s'));

        //有序集合
        $cache->handler()->ZAdd('ZSet2','1 Book1 2 Book2 3 Book3');
        $cache->handler()->ZAdd('ZSet3','2 Book1 2 Book2 4 Book4');
        $cache->handler()->ZUnionStore('ZEnd0',2,'ZSet2 ZSet3 WEIGHTS 1 2');
        
        return '程序运行成功...';
    }
    public function acceptCache(){
        return $this->fetch();
    }
    public function showCache(){
        $cache = Cache::init();

        //保留指定范围的队列数据，删除范围之外的所有数据
        $cache->handler()->LTrim('LStr',0,10);
        
        //获取从左到右的队列数据
        $arrLStr = $cache->handler()->LRange('LStr',0,10);
        //获取从右到左的10条队列数据
        //$arrLStr = $cache->handler()->LRange('LStr',-10,-1);
        //返回左边第一个元素值
        //$strFirst = $cache->handler()->LPop('LStr');
        //返回右边第一个元素值
        //$strLast = $cache->handler()->RPop('LStr');
        //$strLast = array_pop($arrLStr);

        //获取列表长度
        $strLen = $cache->handler()->LLen('LStr');
        
        //模板输出队列数据
        $this->assign('arrLStr',$arrLStr);
        $this->assign('strFirst',$strFirst='');
        $this->assign('strLast',$strLast='');

        //集合
        $arrSStr = $cache->handler()->SMembers('SStr');

        //删除指定个数的数据
        //$cache->handler()->SPop('SStr',100);
        $arrSStr = $cache->handler()->SRandMember('SStr',11);
        $this->assign('arrSStr',$arrSStr);

        $strSLen = $cache->handler()->SCard('SStr');
        $this->assign('strSLen',$strSLen);

        //有序集合
        $arrZEnd = $cache->handler()->ZRange('ZEnd0',0,-1,'WithScores');

        $string = date('Y-m-d H:i:s');
        $strCache = Cache::get('string');
        $strCache = Cache::get('age');
        $this->assign('strCache',$strLen);
        $this->assign('string',$string);
        return $this->fetch();
    }

    public function pageFor(){
        set_time_limit(9999);
        $redis = New \Redis();
        $conn = $redis->connect('localhost','6379');
        $pipe = $redis->multi(\Redis::PIPELINE);
        
        $domain = 'http://www.900.com';
        //$url = $domain.'/html/part/20_682.html';
        for($i=3;$i<=6;$i++){
            if($i==1){
                $url = $domain.'/html/part/20.html';
            }else{
                $url = $domain.'/html/part/20_'.$i.'.html';
            }
            $arrUrlData = $this->pageList($url,$domain);
            $pipe->SAdd('SetTest',json_encode($arrUrlData));
        }
        $pipe->exec();
        halt('success');
    }

    public function pageList($url,$domain){
        $content = file_get_contents($url);
        preg_match_all('/<a href="(.*)" title="(.*)">(.*)<\/a>/',$content,$match);
        $arrUrl = array_combine($match[1],$match[3]);
        foreach($arrUrl as $k=>$v){
            $arrUrlData[$domain.$k] = iconv('GBK','UTF-8',$v);
        }
        return ($arrUrlData);
    }

    public function pageShow($url){
        //$url = 'http://www.900.com/html/article/808305.html';
        $content = file_get_contents($url);
        preg_match_all('/<img src="(.*.jpg)"/',$content,$match);
        //halt($match);
        //$fileName = 'https://img6.26ts.com/2019/01-16/o4d2soc1gzr.jpg';
        foreach($match[1] as $fileName){
            $arrFileName = pathinfo($fileName);
            //halt($arrFileName);
            file_put_contents('1/'.$arrFileName['basename'],file_get_contents($fileName));
        }
    }

    /**
     * 找不到gmp的数学函数库
     */
    public function testSimhash(){
        $obj = new \my\Simhash();
        dump($obj);
    }

}
//$objIndex = new Index();
//$objIndex->sendCache();
<?php

//测试连接
//var_dump($conn);

function executeTime(){
	$arrTime = explode(' ',microtime());
	return $arrTime[0]+$arrTime[1];
}

function pipeDemo(){
	$pipe = $redis->multi(Redis::PIPELINE);
	for ($i = 0; $i < 3; $i++) {
	    $key = "key::{$i}";
	    print_r($pipe->set($key, str_pad($i, 2, '0', 0)));
	    echo PHP_EOL;
	    print_r($pipe->get($key));
	    echo PHP_EOL;
	}
	$result = $pipe->exec();
	print_r($result);
}

function noPipeLine(){
	$redis = New Redis();
	$conn = $redis->connect('localhost','6379');
	//var_dump($redis);
	for($i=0;$i<1000000;$i++){
		$redis->SAdd('SetAdd',$i);
		//echo $i;
	}
}

function usePipeLine(){
	$redis = New Redis();
	$conn = $redis->connect('localhost','6379');
	$pipe = $redis->multi(Redis::PIPELINE);
	for($i=0;$i<1000000;$i++){
		$pipe->SAdd('SetAdd',$i);
	}
	$pipe->exec();
}

$beginTime = executeTime();
//var_dump($beginTime);
//noPipeLine();//44秒
//usePipeLine();//2.8秒
$endTime = executeTime();
//var_dump($endTime);

$diffTime = $endTime - $beginTime;
var_dump($diffTime);



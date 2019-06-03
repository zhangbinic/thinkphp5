<?php
//命令行接收数据
$redis = new Redis();
$redis->connect('localhost', 6379);
$redis->subscribe(['order'], function ($redis, $chan, $msg) {
    var_dump($redis);
    var_dump($chan);
    var_dump($msg);
});
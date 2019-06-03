<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// http://tp.php.zhangbin.work/acceptCache
Route::get('/', function () {
    return 'ThinkPHP 5.1.37';
});

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

//实践缓存操作
Route::get('setCache', 'index/setCache');
Route::get('getCache', 'index/getCache');
//ajax缓存练习
Route::get('sendCache', 'index/sendCache');
Route::get('acceptCache', 'index/acceptCache');
Route::get('showCache', 'index/showCache');
//抓取网页信息
Route::get('pageFor','index/pageFor');
Route::get('pageShow','index/pageShow');

return [

];

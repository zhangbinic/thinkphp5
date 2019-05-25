<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace tests;
// php think unit 进行测试
class ExampleTest extends TestCase
{

    public function testBasicExample()
    {
        //$this->visit('/')->see('ThinkPHP');
        $this->assertTrue(true);
    }

    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }
    //是否为假
    public function testIsFalse(){
    	$this->assertFalse(false);
    }
    //2>1
    public function testGreaterThan(){
    	$this->assertGreaterThan(1,2);
    }
    //1<2
    public function testLessThanOrEqual(){
    	$this->assertLessThanOrEqual(2,1);
    }
    //1==1
    public function testEquals(){
    	$this->assertEquals(1,1);
    }
    // is not null
    public function testNotNull(){
    	$this->assertNotNull(true);
    }

}
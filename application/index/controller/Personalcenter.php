<?php
namespace app\index\controller;

use app\common\controller\IndexBase;



class PersonalCenter extends IndexBase 
{
	
	//个人中心页面
    public function index()
    {
		//显示页面
        return $this->fetch();
	}

}

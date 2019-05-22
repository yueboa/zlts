<?php
namespace app\index\controller;

use app\common\controller\IndexBase;


class Mycompany extends IndexBase 
{
	//我的公司页面
    public function index()
    {
		
		$id = $this->member['member_id'];
		if(empty($id)){
			  return $this->error('参数错误');
		}
		$where[] = ['member_id','=',$id];
		$where[] = ['delete','=',0];
		$list = db('company')->where($where)->find();
		$this->assign('data', $list);
        return $this->fetch();
	}

}

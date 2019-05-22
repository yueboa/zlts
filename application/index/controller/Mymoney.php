<?php
namespace app\index\controller;

use app\common\controller\IndexBase;

class Mymoney extends IndexBase 
{
	
	//我的资产页面
    public function index()
    {
		$id = $this->member['member_id'];
		if(empty($id)){
			  return $this->error('参数错误');
		}
		$where[] = ['member_id','=',$id];
		$where[] = ['delete','=',0];
		$list = db('mymoney_log')->where($where)->order('id desc')->select();
		$this->assign('data', $list);
        return $this->fetch();
	}

}

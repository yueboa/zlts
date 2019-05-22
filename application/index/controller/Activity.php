<?php
namespace app\index\controller;

use app\common\controller\IndexBase;

class Activity extends IndexBase 
{
	//活动列表页面
    public function index()
    {
		$id = $this->member['member_id'];
		if(empty($id)){
			  return $this->error('参数错误');
		}
		$where[] = ['member_id','=',$id];
		$where[] = ['delete','=',0];
		$list = db('activity')->where($where)->select();
		$this->assign('data', $list);
        return $this->fetch();
	}

	//活动详情页面
	public function info(){
		$id = input('id');
		if(empty($id)){
			  return $this->error('参数错误');
		}
		$where[] = ['id','=',$id];
		$where[] = ['member_id','=',$this->member['member_id']];
		$where[] = ['delete','=',0];
		$list = db('activity')->where($where)->find();
		$this->assign('data', $list);
		return $this->fetch();
	}
}

<?php
namespace app\common\model;

use think\Model;

class LoginLog extends Model{

	/**
	 * 添加登陆记录
	 * @param array $data [要添加的信息]
	 */
	function addLog($data){

	    model('member')->editUser(['id'=>$data['uid'],'last_login_time'=>$data['addtime']]);

		$this->insert($data);
		return $this->getLastInsID();

	}



	/**
	 * 查找登陆记录
	 * @param  array $where [查询条件]
	 */
	function findLog($where){

		return $this->where($where)->limit(2)->select();

	}



}
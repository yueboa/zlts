<?php
namespace app\common\model;

class Praise extends AdminBase {

	/**
	 * 点赞
	 * @param [type] $data [description]
	 */
	function addPraise($data){
		return $this->insert($data);
	}


	/**
	 * 取消点赞
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function delPraise($data){
		return $this->where($data)->delete();
	}


	/**
	 * 获取点赞信息
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function getPraise($data){
		// dump($data);die;
		return $this->where($data)->find();
		

	}

}
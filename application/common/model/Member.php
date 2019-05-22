<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:40
 */
namespace app\common\model;


class Member extends AdminBase {


    public $slave_table = 'member';

	
	
	public function member_list(){
		$where[] = ['delete','=',0];
		$member = db('member')->where($where)->select();
		return $member;
	}

}
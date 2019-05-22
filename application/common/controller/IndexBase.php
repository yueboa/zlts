<?php
namespace app\common\controller;

use think\Controller;



class IndexBase extends Controller{





	public $member = [];
	/**
     * 检查登录
     */
    function initialize()
    {
		
		
		//登录做好后写入登录的session查询用户信息
		$member_id = 6;
		if(empty($member_id)){
			 return $this->error('请先登录');
		}
		
		$where[] = ['member_id','=',$member_id];
		$where[] = ['delete','=',0];
		$this->member = db('member')->where($where)->find();
		
		if(empty($this->member)){
			 return $this->error('没有此用户');
		}
		
		$this->assign('member',$this->member);
		
    }
	
	function suc($data = [], $httpCode = 200, $code = 0, $msg = 'ok'){

        return apisuc($data, $httpCode, $code, $msg);
    }


    function err($httpCode = 400, $code = 999, $msg = '', $data=[]){
        return apierr($httpCode, $code, $msg, $data);
    }

	


	
}
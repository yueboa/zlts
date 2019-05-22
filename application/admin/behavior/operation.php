<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-22
 * Time: 17:32
 */
namespace app\admin\behavior;
use think\Db;
use think\Session;

class Operation
{
    public function run(){
        $this->action_begin();
    }
    
    public function action_begin(){
		
		$controller = strtolower(request()->controller());
        $action = strtolower(request()->action());
		$adminusername = session('adminusername');
		if(!empty($adminusername)){
			$data['username'] = $adminusername;
		}
		$data['content'] = $controller.'/'.$action;
		$data['ip'] = request()->ip();
		$data['addtime'] = time();
		
		$adminuserid =session('adminuserid');
		if(!empty($adminuserid)){
			$data['uid'] = $adminuserid;
		}
		
		Db::name('admin_log')->insert($data);
     
    }
}
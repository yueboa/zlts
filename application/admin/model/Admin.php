<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\admin\model;

use app\common\model\AdminBase;
use base\Str;
use think\Db;

class Admin extends AdminBase{


    protected $pk='adminid';


    /**
     * 用户登录
     * @param array $data
     * @return bool
     */
    function login($data=null){

        $data = $data ?: input('post.');

        $validate = validate('admin');

        $res = $validate->check($data, null, 'login');

        if( !$res ){
            $this->error = $validate->getError();
            return false;
        }

        //得到管理员
        $admin = $this->getOneData([
            'username'  =>  $data['username']
        ]);


        //管理员是否存在
        if( !$admin ){
            $this->error = lang('admin_not_found');
            return false;
        }


        //得到管理配置文件
        $config = vars('admin');

        //默认锁定时间为1小时
        $config['login_error_lock_time'] = empty($config['login_error_lock_time']) ? 3600 : $config['login_error_lock_time'];

        //此时间之前锁定的会自动解锁
        $lockTime = $_SERVER['REQUEST_TIME'] - $config['login_error_lock_time'];

        //检查锁定
        if($admin['lock_time'] > $lockTime ){
            $this->error = str_replace('{time}', ceil(($admin['lock_time'] - $lockTime)/60), lang('admin_lock_please_try'));
            return false;

        }

        //验证密码
        if( encry_pwd($data['password'], $admin['encry']) != $admin['password'] ){

            //默认登录次数5
            $config['max_login_error_num'] = empty($config['max_login_error_num']) ? 5 : $config['max_login_error_num'];

            //两次登录失败间隔
            $config['login_error_interval'] = empty($config['login_error_interval']) ? 3600 : $config['login_error_interval'];


            //清空登录间隔
            if( ($admin['login_error_time'] + $config['login_error_interval']) < $_SERVER['REQUEST_TIME'] ){
                $admin['login_error_num'] = 0;
            }


            //登录失败数
            $loginErrorNum = $admin['login_error_num'] + 1;

            $updata = [
                'login_error_num'   =>  $loginErrorNum,
                'login_error_time'  =>  $_SERVER['REQUEST_TIME'],
            ];

            //锁定
            if($loginErrorNum == $config['max_login_error_num']){

                $updata['lock_time'] = $_SERVER['REQUEST_TIME'];
                $errorMsg = lang('admin_locked');

            }else{

                $errorMsg = str_replace('{num}', $config['max_login_error_num']-$loginErrorNum,lang('admin_password_error'));

            }

            //密码错误，记录密码登录次数
            $this->update($updata,[
                'adminid'   =>  $admin['adminid']
            ]);


            $this->error = $errorMsg;
            return false;
        }

        //是否禁用
        if($admin['status']){
            $this->error = lang('admin_forbidden');
            return false;
        }


        //得到角色
        $role = model('role')->getOneDataCache($admin['roleid']);

        //角色不存在
        if(!$role){
            $this->error = lang('role_not_found');
            return false;
        }

        //角色被禁用
        if($role['status']){
            $this->error = lang('role_forbidden');
            return false;
        }


        //更新数据
        $this->where([
            'adminid'   =>  $admin['adminid']
        ])->update([
            'last_login_time'   =>  $_SERVER['REQUEST_TIME'],
            'last_login_ip'     =>  request()->ip(),
            'login_success_num'         =>  $admin['login_success_num']+1,
            'lock_time'         =>  null,
            'login_error_time'  =>  null,
        ]);


        //设置登录
        session('adminid', sys_auth($admin['adminid']));
		
        session('adminusername', $admin['username']);
        session('adminuserid', $admin['adminid']);
		$this->add_admin_log();
        return true;

    }


    /**
     * 退出登录
     * @return bool
     */
    function logout(){

        session('adminid', null);

        return true;

    }

	public function add_admin_log(){
		
		$controller = strtolower(request()->controller());
        $action = strtolower(request()->action());
		$adminusername = session('adminusername');
		if(!empty($adminusername)){
			$data['username'] = $adminusername.'登录了系统';
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
	


    /**
     * 修改密码
     * @param null $data
     */
//    function password($aid, $data=null){
//
//        $data = $data ?: input('post.');
//
//        $validate = validate('admin');
//
//        $scene = 'password';
//
//        $res = $validate->check($data, null, $scene);
//
//        if( !$res ){
//            $this->error = $validate->getError();
//            return false;
//        }
//
//
//        //验证当前密码
//        $admin = $this->getOneData($aid);
//        if(encry_pwd($data['oldpassword'], $admin['encry']) != $admin['password']){
//
//            $this->error = '当前密码不正确';
//            return false;
//        }
//
//
//        //生成新密码
//        $updata['encry']  =   get_random();
//        $updata['password'] =   encry_pwd($data['newpassword'], $updata['encry']);
//
//        $this->save($updata, [
//            'aid'   =>  $aid
//        ]);
//
//
//        return true;
//
//    }


}
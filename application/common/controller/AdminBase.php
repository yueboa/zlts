<?php
namespace app\common\controller;




class AdminBase extends Base
{

    private $error = '';  //

    // 验证失败是否抛出异常
//    protected $failException = false;

    protected $admin = null;    //登录管理员的信息
    protected $role = null; //登录的角色
    protected $node = true; //当前节点
    protected $site = null; //当前站点
    protected $isSuperAdmin = false;


    /**
     * 检查登录
     */
    function initialize()
    {

        define('SITEID', 1);

        $isNeedLogin = $this->isNeedLogin();

        if($isNeedLogin){


            //检查登录
            $res = $this->checkLogin();

            if(!$res){
                return $this->error( $this->error, url('admin/login'));
            }

            //检查权限
            if( !$this->checkAuth() ){
                return $this->error( $this->error );
            }

            $this->assign('isSuperAdmin', $this->isSuperAdmin);
            $this->assign('node', $this->node);
            $this->assign('brotherNodes', model('node')->getBrother($this->node['nodeid']));

            $this->site = model('site')->getOneCache(SITEID);


        }



    }


    /**
     * 判断当前节点是否需要登录
     */
    private function isNeedLogin(){

        return !in_array(strtolower($this->request->controller().':'.$this->request->action()), config('no_verify_node'), false);

    }



    /**
     * 检查登录信息
     */
    private function checkLogin(){

        $adminid = session('adminid');

        if(!$adminid || !($adminid = sys_auth($adminid, false))){

            $this->error = lang('please_login');
            return false;
        }

        //得到账号
        $this->admin = model('admin')->getOneData($adminid);

        //账号不存在
        if(!$this->admin){
            $this->error = lang('admin_not_found');
            return false;
        }

        //账号被锁定
        if($this->admin['status']){
            $this->error = lang('admin_forbidden');
            return false;
        }

        //得到角色
        $this->role = model('role')->getOneCache($this->admin['roleid']);


        //角色不存在
        if(!$this->role){
            $this->error = lang('role_not_found');
            return false;
        }

        if($this->role['status']){

            $this->error = lang('role_forbidden');
            return false;

        }


        //是超级管理员或超级角色
        if($this->admin['adminid'] == config('super_admin_id') || $this->role['roleid'] == config('super_role_id')){

            $this->isSuperAdmin = true;

        }

        return true;
    }


    /**
     * 检查权限
     * @return bool
     */
    private function checkAuth(){

        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());

        //只需要登录即可看到的页面
        if(in_array($controller.':'.$action, config('verify_login_node'))){
            return true;
        }


        $this->node = model('node')->getOneData([
            'controller'    =>  $controller,
            'action'    =>  $action
        ]);


        //节点不存在
        if(!$this->node){
            $this->error = lang('node_not_found');
            return false;
        }


        //节点已禁用
        if($this->node['status']){
            $this->error = lang('node_forbidden');
            return false;
        }


        //是超级管理员或超级角色
        if($this->isSuperAdmin){
            return true;
        }

        //当前角色的当前站点权限
        $nodes = empty($this->role['nodes']) ? [] : $this->role['nodes'];

        //没有权限
        if( !in_array($this->node['nodeid'], $nodes, false)){
            $this->error = lang('no_permission');
            return false;
        }

        return true;

    }





    /**
     * 空操作
     */
    function _empty(){

        return $this->error('【 '.$this->request->action().' 】'.lang('action_not_found'));

    }
}
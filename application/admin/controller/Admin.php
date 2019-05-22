<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;

class Admin extends AdminBase
{


    /**
     * 管理员登录
     * @return mixed|void
     */
    public function login()
    {

        if( $this->request->isPost() ){

            $captcha = input('post.captcha');
            if(!captcha_check($captcha)){
                return $this->error('请输入正确的验证码');
            }
            $model = model('admin');
            $res = $model->login();

            //登录失败
            if( !$res ){
                return $this->error($model->getError());
            }


            return $this->success(lang('login_success'), 'index/index', null, 1);

        }

        return $this->fetch();

    }


    /**
     * 退出登录
     */
    function logout(){

        model('admin')->logout();

        return $this->success('退出登录', 'admin/login');

    }


    /**
     * 修改自己密码
     */
    function pwd(){


        return parent::editData($this->admin,null, [
            'submit_before' =>  function($model, &$post, $data){


                //验证字段
                $res = $this->validate($post, 'admin.pwdform');

                if($res !== true){
                    return $this->error($res);
                }

                //验证当前密码
                if(encry_pwd($post['oldpassword'], $data['encry']) != $data['password']){
                    return $this->error(lang('curr_password_error'));
                }

                //生成新密码
                $post['encry'] = get_random();
                $post['password'] = encry_pwd($post['newpassword'], $post['encry']);


            },
            'submit_success'    =>  function($model){

                $model->logout();
                return $this->success(lang('pwd_edit_success'), 'admin/login', null, 1);

            }
        ]);

    }


    /**
     * 修改个人信息
     */
    function info(){


        return parent::editData($this->admin, null, [
            'fetch_before'  =>  function($model){
                $model->setRawFieldData('username',[
                    'disabled'  =>  true,
                ]);
            }
        ]);

    }


    /**
     * 管理员列表
     */
    function index(){


        $data = model('admin')
            ->getAllData(1, '*', 'adminid desc');

        $role = array_column(
            model('role')->getAllData(1, 'roleid,name')['rows'],null, 'roleid'
        );


        $this->assign('data', $data);
        $this->assign('role', $role);


        return $this->fetch();

    }


    /**
     * 添加管理员
     */
    function add(){

        $scene = 'add';

        //初始化模型
        $model = model('admin');

        //初始化字段
        $model->initRawField();


        if(request()->isPost()){

            $post = input('post.');

            //验证字段
            $res = $this->validate($post, 'admin.add');

            if($res !== true){
                return $this->error($res);
            }

            //判断用户名是否存在
            if($model->getOneData([
                'username'  =>  $post['username']
            ])){
                return $this->error('管理员已经存在，请更换！');
            }

            $post = [
                'roleid'    =>  $post['roleid'],
                'username'  =>  $post['username'],
                'password'  =>  $post['password'],
                'encry'  =>  get_random(),
                'realname'  =>  $post['realname'],
                'mobile'  =>  $post['mobile'],
                'create_time'  =>  $_SERVER['REQUEST_TIME'],
                'create_ip'  =>  request()->ip(),
                'status'  =>  $post['status'],

            ];

            //生成新密码
            $post['password'] = encry_pwd($post['password'], $post['encry']);


            $insertId = $model->insert($post);

            if($insertId){

                return $this->success(lang('add_success'), $this->skipUrl);

            }

            return $this->error($model->getError());
        }

        $model->setRawFieldData('roleid', [
            'data'  =>  model('role')->getAllData()['rows']
        ]);

        $this->assign('fields', $model->getFormField($scene));

        return $this->fetch($this->fetchTpl);


    }


    /**
     * 编辑管理员
     * @param $adminid
     */
    function edit($adminid){

        $data = model('admin')->getOneData($adminid);

        unset($data['password']);

        return parent::editData($data,null,[
            'fetch_before'  =>  function($model){
                $model->setRawFieldData('roleid', [
                    'data'  =>  model('role')->getAllData()['rows']
                ]);

            },
            'submit_before' =>  function($model, &$post){

                if(!empty($post['editpassword'])){

                    if($post['editpassword'] != $post['reeditpassword']){
                        return $this->error('两次密码不一致');
                    }

                    $post['encry'] = get_random();
                    $post['password'] = encry_pwd($post['editpassword'], $post['encry']);
                }

                unset($post['editpassword'], $post['reeditpassword']);
            }
        ]);
    }
	
	function del(){
        return parent::delData();

    }
	

}
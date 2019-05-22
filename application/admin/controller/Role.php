<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;

class Role extends AdminBase
{


    /**
     * 添加角色
     */
    function add(){

        $scene = 'add';

        $nodes = model('node')->getAllList();

        //初始化模型
        $model = model('role');

        //初始化字段
        $model->initRawField();


        if(request()->isPost()){

            $post = input('post.');

            $post['nodes'] = empty($post['nodes']) ? [] : $post['nodes'];
            $post['nodes'] = json_encode($post['nodes']);

            $insertId = $model->addData($post, $scene);

            if($insertId){

                return $this->success(lang('add_success'), $this->skipUrl);

            }

            return $this->error($model->getError());
        }


        $this->assign('fields', $model->getFormField($scene));

        $this->assign('nodes', $nodes);

        $this->assign('data', ['nodes'=>[]]);

        return $this->fetch( 'addedit');

    }


    /**
     * 修改角色
     * @param $roleid
     */
    function edit($roleid){

        $scene = 'edit';

        //模型
        $model = model('role');

        //得到数据
        $data = $model->getOneData($roleid);

        if(!$data){
            return $this->error(lang('param_error'));
        }

        $nodes = model('node')->getAllList();

        //初始化字段
        $model->initRawField();


        if(request()->isPost()){

            $post = input('post.');

            //如果是超级管理员
            if(config('super_role_id') == $data['roleid']){
                if($post['status']){
                    return $this->error('超级管理员不能禁用');
                }
            }else{  //其他管理员
                $post['nodes'] = empty($post['nodes']) ? [] : $post['nodes'];
                $post['nodes'] = json_encode($post['nodes'], true);
            }



            //提交数据
            $res = $model->editData($roleid, $post, $scene);

            //提交成功
            if($res){

                $model->getOneCache($roleid, true);
                return $this->success(lang('edit_success'), $this->skipUrl);

            }

            return $this->error($model->getError());
        }



        //设置默认值
        $model->setRawFieldVal($data);

        //分配字段
        $this->assign('fields', $model->getFormField($scene));

        $this->assign('nodes', $nodes);
        $data['nodes'] = json_decode($data['nodes'], true);

        $this->assign('data', $data);

        //渲染模板
        return $this->fetch('addedit');

    }


    function index(){


        $data = model('role')
            ->getAllData(1, '*', 'roleid desc');


        $this->assign('data', $data);

        return $this->fetch();

    }


    /**
     * 删除角色
     * @param $roleid
     */
    function del($roleid){

        //查看角色下是否有管理员
        $admin = model('admin')->getOneData([
            'roleid'    =>  $roleid
        ]);

        if($admin){
            return $this->error('该角色下还有管理员，不能删除');
        }

        $res = model('role')->where(['roleid'  =>  $roleid])->delete();

        if($res){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }


    }

}
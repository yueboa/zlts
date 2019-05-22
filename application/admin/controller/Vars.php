<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Vars extends AdminBase
{


    /**
     * 列表
     * @return mixed
     */
    function index(){

        $data = model('vars')
            ->getAllData(null,'varid,name,intro,seting_tpl,update_time','varid asc');

        $this->assign('data', $data);

        return $this->fetch();

    }


    /**
     * 添加
     * @return mixed|void
     */
    function add(){

        return parent::addData();

    }


    /**
     * 编辑
     * @return mixed|void
     */
    function edit(){

        return parent::addData();

    }


    /**
     * 设置数据
     */
    function set($name){

        $name = strtolower($name);

        $fullName = 'vars'.ucfirst($name);

        $scene = 'set';

        $model = model('vars');

        $data = $model->getOne($name);

        if(!$data){
            return $this->error('数据不存在');
        }

        //如果有特殊处理方法
        if($data['action']){
            return $this->{$data['action']}($data);
        }

        $model->initRawField($fullName);

        if(request()->isPost()){

            $res = $model->set($name);

            if($res){
                $model->getOneCache($name, true);
                return $this->success('修改成功');
            }

            return $this->error($model->getError());
        }


        $model->setRawFieldVal($data['_value']);


        $this->assign('fields', $model->getFormField($scene));

        return $this->fetch('set'.ucfirst($data['seting_tpl']));

    }


    /**
     * 删除变量
     */
    function del(){

        $ids = input('ids');

        $model = model($this->request->controller());

        $delData = $model->getAllData([
            [$model->getPk(),'in',$ids]
        ],'name',null, 9999, true)['rows'];


        $res = $model->delData($ids);

        if($res){

            foreach($delData as $var){
                $model->getOneCache($var['name'], true);
            }

            return $this->success(lang('del_success'), null, null, 1);

        }

        return $this->error($model->getError());

    }


    /**
     * 处理会员设置控制器
     */
    private function member($data){

        if( $this->request->isPost() ){

            $model = model('vars');

            $post = input('post.');

            $post['_level'] = array_column($post['level'], null, 'min');


            foreach ($post['_level'] as $k=>$v){
                if($k === ''){
                    unset($post['_level'][$k]);
                }
            }

            ksort($post['_level']);


            $res = $model->set($data['name'], $post);

            if($res){
                $model->getOneCache($data['name'], true);
                return $this->success('修改成功');
            }

            return $this->error($model->getError());

        }

        $this->assign('data', $data['_value']);

        return $this->fetch('setMember');

    }

}
<?php
namespace app\common\controller;


use think\Controller;


class Base extends Controller
{


    protected $fetchTpl = null;
    protected $skipUrl = -1;




    /**
     * 添加数据
     */
    function addData($scene=null, $callback=null){


        //初始化模型
        $model = model(request()->controller());

        //初始化字段
        $model->initRawField();


        if(request()->isPost()){

            $post = input('post.');

            //处理提交前
            if(!empty($callback['submit_before']) && is_callable($callback['submit_before'])){
                $callback['submit_before']($model, $post);
            }

            $insertId = $model->addData($post, $scene);

            if($insertId){

                //处理提交成功回调
                if(!empty($callback['submit_success']) && is_callable($callback['submit_success'])){
                    $callback['submit_success']($model, $post, $insertId);
                }

                return $this->success(lang('add_success'), $this->skipUrl);

            }

            return $this->error($model->getError());
        }

        //模板渲染前回调
        if(!empty($callback['fetch_before']) && is_callable($callback['fetch_before'])){
            $callback['fetch_before']($model);
        }

        $this->assign('fields', $model->getFormField($scene));

        return $this->fetch($this->fetchTpl);

    }


    /**
     * 编辑数据
     * @param null $id 更新数据的主键ID，或跟新的数据（array）
     * @param null $scene 验证场景
     * @param null $callback 匿名函数数组
     * @return mixed|void
     */
    function editData($id, $scene=null, $callback=null){

        //模型
        $model = model(request()->controller());

        /**
         * 处理ID是数据还是id
         */
        if(is_array($id)){  //如果是原始数据

            $data = $id;
            if( empty($data[$model->getPk()]) ){
                return $this->error(lang('param_error'));
            }
            $id = $data[$model->getPk()];

        }else{  //通过ID得到原始数据

            //得到数据
            $data = $model->getOneData($id);

            if(!$data){
                return $this->error(lang('param_error'));
            }
        }


        //初始化字段
        $model->initRawField();


        if(request()->isPost()){

            $post = input('post.');

            //处理提交前
            if(!empty($callback['submit_before']) && is_callable($callback['submit_before'])){
                $callback['submit_before']($model, $post, $data);
            }

            //提交数据
            $res = $model->editData($id, $post, $scene);

            //提交成功
            if($res){

                //处理提交成功回调
                if(!empty($callback['submit_success']) && is_callable($callback['submit_success'])){
                    $callback['submit_success']($model, $post, $data);
                }

                return $this->success(lang('edit_success'), $this->skipUrl);

            }

            return $this->error($model->getError());
        }


        //模板渲染前回调
        if(!empty($callback['fetch_before']) && is_callable($callback['fetch_before'])){
            $callback['fetch_before']($model, $data);
        }


        //设置默认值
        $model->setRawFieldVal($data);


        //分配字段
        $this->assign('fields', $model->getFormField($scene));

        //渲染模板
        return $this->fetch($this->fetchTpl);

    }


    /**
     * 删除数据
     * @param null $ids
     */
    function delData($ids=null, $callback=[]){

        $ids = $ids ?: input('ids/a');

        $model = model($this->request->controller());

        //处理提交成功回调
        if(!empty($callback['submit_before']) && is_callable($callback['submit_before'])){

            $callback['submit_before']($model, $ids);
        }

        $res = $model->delData($ids);

        if($res){

            //处理提交成功回调
            if(!empty($callback['submit_success']) && is_callable($callback['submit_success'])){
                $callback['submit_success']($model, $ids);
            }

            return $this->success(lang('del_success'), null, null, 1);

        }

        return $this->error($model->getError());

    }



    /**
     * 设置排序
     * @param null $data
     */
    function sortData($post=null, $callback=[]){

        $post = $post ?: input('post.sort');

        $model = model(request()->controller());

        //提交前回调
        if(!empty($callback['submit_before']) && is_callable($callback['submit_before'])){
            $callback['submit_before']($model, $post);
        }


        $res = $model->sortData($post);

        if($res){

            //处理提交成功回调
            if(!empty($callback['submit_success']) && is_callable($callback['submit_success'])){
                $callback['submit_success']($model, $post);
            }

            return $this->success(lang('sort_success'));
        }

        return $this->error($model->getError());

    }



}
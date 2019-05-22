<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Node extends AdminBase
{


    /**
     * 得到所有节点
     */
    function index(){

        $rows = model('node')->getAllList();

        $this->assign('rows', $rows);

        return $this->fetch();

    }




    /**
     * 添加节点
     */
    function add(){


        return parent::addData(null, [
            'fetch_before'  =>  function($model){

                $model->setRawFieldData('pid',[
                    'data'  =>  $model->getAllList(),
                    'value' =>  input('get.pid/d', 0)
                ]);

            },

            'submit_success'  => function($model){
                $model->getAllTree(true);
            },

        ]);


    }


    /**
     * 编辑节点
     * @param $nid
     * @return mixed|void
     */
    function edit($nodeid){

        $callback = [];

        $callback['submit_before'] = function($model, &$post) use($nodeid){

            $post['pid'] = empty($post['pid']) ? 0 : $post['pid'];

            $nodes = $model->getAllList();
            if(in_array( $post['pid'], explode(',', $nodes[$nodeid]['_allchilds'])) ){
                return $this->error(lang('param_error'));
            }

        };

        $callback['submit_success'] = function($model){
            $model->getAllTree(true);
        };


        $callback['fetch_before'] = function($model) use($nodeid){

            $nodes = $model->getAllList();

            $model->setRawFieldData('pid',[
                'data'  =>  $nodes,
                'disabled'  =>  $nodes[$nodeid]['_allchilds'],
            ]);
        };

        return parent::editData($nodeid, null, $callback);

    }


    /**
     * 删除节点
     * @param $ids
     */
    function del(){

        return parent::delData(null,[
            'submit_before' =>  function($model, $ids){

                $ids = implode(",", $ids);
                //避免一下删除多天
                if(!is_numeric($ids) ){
                    return $this->error( lang('param_error'));
                }

                //所有节点
                $nodes = $model->getAllList();

                if(empty($nodes[$ids])){
                    return $this->error( lang('param_error'));
                }

                if($nodes[$ids]['_childs']){
                    return $this->error(lang('have_child_node'));
                }
            },

            'submit_success'    =>  function($model){
                $model->getAllTree(true);
            }
        ]);

    }


    /**
     * 节点排序
     */
    function sort(){

        return parent::sortData(null, [

            'submit_success'    =>  function($model){
                $model->getAllTree(true);
            }
        ]);

    }

}
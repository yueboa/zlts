<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Poster extends AdminBase
{


    /**
     * 得到所有广告
     */
    function index($posid){


        $position = model('position')->getOneData([
            'posid' =>  $posid,
            'siteid'    =>  SITEID,
        ]);

        if(!$position){
            return $this->error(lang('param_error'));
        }

        $data = model('poster')->getAllData([
            'posid' =>  $posid,
            'siteid'    =>  SITEID,
        ], '*', 'status asc,sort asc,posterid asc');


        $this->assign('node_name', '【'.$position['name'].'】'.$this->node['name']);

        $this->assign('data', $data);

        return $this->fetch('index_'.$position['type']);

    }


    /**
     * 添加广告
     * @param $posid
     * @return mixed|void
     */
    function add($posid){

        //检查广告位
        $position = model('position')->getOneData([
            'posid' =>  $posid,
            'siteid'    =>  SITEID,
        ]);

        if(!$position){
            return $this->error(lang('param_error'));
        }

        $this->skipUrl = url('index', 'posid='.$posid );

        return parent::addData('add_'.($position['type']), [
            'submit_success'  =>  function($model) use($posid){
                $model->getPosterByPosid($posid, 1);
            },
            'submit_before' =>  function($model,&$post) use($posid){
                $post['siteid'] =   SITEID;
                $post['posid']  =   $posid;
            }
        ]);

    }


    /**
     * 编辑广告
     * @param $id
     * @return mixed|void
     */
    function edit($posterid){

        $poster = model('poster')->getOneData([
            'posterid'    =>  $posterid,
            'siteid'    =>  SITEID,
        ]);

        if(!$poster){
            return $this->error(lang('param_error'));
        }

        $position = model('position')->getOneData([
            'posid' =>  $poster['posid'],
            'siteid'    =>  SITEID,
        ]);

        if(!$position){
            return $this->error(lang('param_error'));
        }


        $this->skipUrl = url('index', 'posid='.$poster['posid'] );

        return parent::editData($poster, 'edit_'.$position['type'], [
            'submit_success'    =>  function($model) use($position){
                $model->getPosterByPosid($position['posid'], 1);
            }
        ]);

    }


    /**
     * 删除
     */
    function del(){

        return parent::delData(null, [
            'submit_success'    =>  function($model){
                $model->getPosterByPosid(input('get.posid'), 1);
            }
        ]);

    }


    /**
     * 排序
     */
    function sort(){

        return parent::sortData();

    }
}
<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Position extends AdminBase
{


    /**
     * 所有广告位
     */
    function index(){

        $data = model('position')->getAllData([
            'siteid'    =>  SITEID,
        ],'*','sort asc,posid asc');

        $this->assign('data', $data);

        return $this->fetch();

    }


    /**
     * 添加广告位
     */
    function add(){


        return parent::addData(null, [
            'submit_before' =>  function($model,&$post){
                $post['siteid'] = SITEID;
            }
        ]);

    }


    /**
     * 编辑广告位
     * @param $posid
     */
    function edit($posid){

        $this->skipUrl = 'index';

        return parent::editData($posid);

    }


    /**
     * 删除广告位
     */
    function del(){
        return parent::delData();
    }


    /**
     * 广告位排序
     */
    function sort(){

        return parent::sortData();

    }

}
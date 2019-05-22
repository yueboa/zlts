<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Site extends AdminBase
{


    /**
     * 显示所有站点列表
     */
    function index(){

        $data = model('site')
            ->getAllData(1,'*','sort asc,siteid asc');

        $this->assign('data', $data);

        return $this->fetch();

    }


    /**
     * 编辑站点
     * @param null $siteid
     * @return mixed|void
     */
    function edit($siteid=null){

        return parent::editData($siteid, null, [
            'submit_success'    =>  function($model) use($siteid){
                $model->getOneCache($siteid, true);
            }
        ]);

    }


    /**
     * 添加站点
     * @return mixed|void
     */
    function add(){

        return parent::addData();
    }


    /**
     * 删除站点
     */
    function del(){

        return parent::delData(null, [
            'submit_success'    =>  function($model, $ids){
                $ids = is_array($ids) ? $ids : [$ids];

                foreach($ids as $id){
                    $model->getOneCache($id, true);
                }

            }
        ]);

    }


    function sort(){

        return parent::sortData();

    }
}
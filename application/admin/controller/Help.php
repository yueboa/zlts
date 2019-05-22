<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Help extends AdminBase
{


    /**
     * 帮助列表页面
     * @return mixed
     */
    function index(){

        $data = model($this->request->controller())->getAllData(1,'*','sort asc,id desc');

        $this->assign('data', $data);

        return $this->fetch();

    }



    function add(){

        return parent::addData(null, [
            'submit_before' =>  function($model, &$post){
                $post['create_time'] = $_SERVER['REQUEST_TIME'];
            }
        ]);

    }



    function edit($id){

        return parent::editData($id, null, [

            'submit_before' =>  function($model, &$post){
                $post['update_time'] = $_SERVER['REQUEST_TIME'];
            }

        ]);
    }


    function del(){

        return parent::delData();

    }


    function sort(){

        return parent::sortData();
    }

}
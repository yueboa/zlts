<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Article extends AdminBase
{



    function index(){


        $data = model('article')->getAllData(1,'*','sort asc,id desc');

        $this->assign('data', $data);

        return $this->fetch();

    }



    function add(){

        return parent::addData(null, [
            'submit_before' =>  function($model, &$post){
                $post['siteid'] = SITEID;

            }
        ]);

    }



    function edit($id){

        return parent::editData($id);
    }


    function del(){
        return parent::delData();

    }


    function sort(){

        return parent::sortData();
    }

}
<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;

class GoodsCate extends AdminBase{

    //商品列表
    public function index(){


    	$data = model('goods_cate')->getAllList();

    	$this->assign('data',$data);

    	return $this->fetch();
    }



    //修改
    public function edit($cid){


        return parent::editData($cid, null, [
            'submit_success'    =>  function($model){
                $model->getAllList(true);
            },
            'fetch_before'  =>  function($model){

                $model->setRawFieldData('pid',[
                    'data'  =>  $model->getAllList(),
                ]);

            }
        ]);
    	

    }

    //添加
    public function add(){

        return parent::addData( null, [
            'submit_success'    =>  function($model){
                $model->getAllList(true);
            },
            'fetch_before'  =>  function($model){

                $model->setRawFieldData('pid',[
                    'data'  =>  $model->getAllList(),
                ]);
            }
        ]);

    }



    function del(){

        if(input('get.ids/d')<=17){
            return $this->error('默认栏目不能删除');
        }

        return parent::delData(null, [
            'submit_success'    =>  function($model){
                $model->getAllList(true);
            }
        ]);

    }


    function sort(){

        return parent::sortData(null, [
            'submit_success'    =>  function($model){
                $model->getAllList(true);
            }
        ]);

    }


}
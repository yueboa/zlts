<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\admin\model;

use app\common\model\AdminBase;



class Node extends AdminBase{


    protected $pk = 'nodeid';


    /**
     * 得到无限分类列表
     * @param bool $recache
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    function getAllList($recache=false){

        $cacheName = 'nodes_list';

        if($recache || !($data = cache($cacheName))){


            $data = \base\Tree::getList($this->getAll(),$this->getPk(), 0);

            cache($cacheName, $data);
        }

        return $data;

    }


    /**
     * 得到无限分类树形菜单
     * @param bool $recache
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    function getAllTree($recache=false){

        $cacheName = 'nodes_tree';

        if($recache || !($data = cache($cacheName))){

            $data = \base\Tree::getTree($this->getAllList($recache),$this->getPk() );

            cache($cacheName, $data);
        }

        return $data;
    }


    /**
     * 得到所有
     * @return mixed
     * @throws \think\exception\DbException
     */
    function getAll(){

        return parent::getAllData(1, '*', 'sort asc,nodeid asc', 99999, true)['rows'];

    }


    /**
     * 得到制定节点的所有子节点
     * @param $nid
     */
    function getBrother($nodeid){

        $nodes = $this->getAllList();

        //当前节点不存在
        if( empty($nodes[$nodeid])){
            return null;
        }

        //父节点不存在
        if(empty($nodes[$nodes[$nodeid]['pid']])){
            return null;
        }

        $arr = array_filter(explode(',', $nodes[$nodes[$nodeid]['pid']]['_childs']));

        $reData = [];
        foreach ($arr as $v){
            if(!empty($nodes[$v])){
                $reData[$v] = $nodes[$v];
            }

        }

        return $reData;

    }



}
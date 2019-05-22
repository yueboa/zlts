<?php
namespace app\common\model;

use think\Model;

class GoodsCate extends Base {

    protected $pk = 'cid';

    /**
     * 返回缓存的数据
     * @param bool $recache
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
	public function getAllList($recache=false){

	    $cacheName = 'goods_cate';

	    if($recache || !($data = cache($cacheName))){

	        $data = \base\Tree::getList($this->getAll(), 'cid');

	        cache($cacheName, $data);

        }


        return $data;

	}


	function getAllTree($recache=false){


        $cacheName = 'goods_cate_oprs';

        if($recache || !($items = cache($cacheName))){

            $items = \base\Tree::getTree($this->getAllList($recache), 'cid');

            cache($cacheName, $items);

        }


        return $items;

    }


    /**
     * 返回所有列表数据（处理好无限分类）
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
	function getAll(){

	    return $this->order('sort asc,cid asc')->select()->toArray();

    }
}
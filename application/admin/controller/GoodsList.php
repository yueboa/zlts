<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;

class GoodsList extends AdminBase{



    public $table='goods_list';

    //商品列表
    public function index(){


    	return $this->fetch();
    }


	public function add(){

        if (request()->isPost()) {
            $params = input('post.');

            //验证
            $result = $this->validate($params, 'GoodsList');
            if ($result !== true) {
                // 验证失败 输出错误信息
                return $this->error($result);
            }

            //是否上架
            if(isset($params['is_show']) && $params['is_show']==1){
                $params['send_time'] = date('Y-m-d H:i:s');
            }

            $params['imgurl'] = isset($status) ? json_encode($params['imgurl']) : '';
            $params['create_time'] = date('Y-m-d H:i:s');

            $insert =db($this->table)->insert($params);
            if($insert){
                return $this->success(lang('add_success'), 'GoodsList/add');
            }else{
                return $this->error(lang('add_error'));
            }

        }else{
            $cates = model('goodsCate')->getAllList();
            $this->assign('cates',$cates);
            return $this->fetch();
        }

	}

    public function edit(){


        $img = db('article')->where('id=1')->value('images');

        $data['imgurl'] = json_decode($img,true);
        $data['content'] = '1212121321231';
        $this->assign('data', $data);
	    return $this->fetch();
    }
}
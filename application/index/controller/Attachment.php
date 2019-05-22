<?php
namespace app\index\controller;


use Request;

use app\common\controller\AdminBase;

class Attachment extends AdminBase
{

    /**
     * 添加角色
     */
    function upload(){

		if (empty(input('param.path'))) {
			config('default_return_type', 'json');

			if(empty($_FILES['file']['tmp_name'])){
				return $this->error('你提交的图片数据不合法');
			}

			$model = model('attachment');

			$res = $model->upload($_FILES['file']);


			if(!$res){
				return $this->error($model->getError());
			}
			return $res;
			
			
		} else {
            //删除图片
            $path = input('param.path');
			

            if (@unlink('.'.$path)) {
                exit(json_encode(['status' => 1, 'msg' => '删除成功']));
            } else {
                exit(json_encode(['status' => 0, 'msg' => '删除失败']));
            }
        }


    }


}
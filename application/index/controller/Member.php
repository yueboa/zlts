<?php
namespace app\index\controller;

use app\common\controller\IndexBase;


use think\Db;


class Member extends IndexBase 
{
	
	//修改个人信息
    public function edit()
    {
	  if (request()->isPost()) {
            $params = input('post.');
			
			if(empty($params['member_id']) || empty($params['nikename']) || empty($params['tel'])){
				return $this->error('参数错误');
			}
			//上传图片
			$model = model('attachment');
			$res = $model->upload($_FILES['file']);
			if($res){
				$data['img_url'] = $res;
			}
			$data['nikename'] = $params['nikename'];
			$data['tel'] = $params['tel'];
			$data['household'] = $params['household'];
			$where['member_id'] = $params['member_id'];
			$where[] = ['delete','=',0];
			$update =db('member')->where($where)->update($data);

            if($update){
                return $this->success('修改成功','member/edit');
            }else{
                return $this->error('修改失败');
            }
			
        }else{
			//返回页面
			return $this->fetch();
		}
	}

}

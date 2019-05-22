<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\common\model;


use Request;

class Attachment extends Base{


    function upload($file, $dir=null){

        if(empty($file) || !is_array($file)){
            $this->error = '上传数据不合法';
            return false;
        }

        $validate = validate('attachment');

        $res = $validate->check($file, null, 'upload');

        if(!$res){
            $this->error = $validate->getError();
            return false;
        }

	    $file = request()->file('file');
	
		// 移动到框架应用根目录/uploads/ 目录下
		$info = $file->move( './uploads');
		if ($info) {
			// 成功上传后 获取上传信息
		   
			$path = $info->getPath();
			$filename = $info->getFilename();
			$save_name = $info->getSaveName();
			$save_name = str_replace("\\","/",$save_name);
			$url =  '/uploads/' . $save_name;
			
			return $url;
			
		} else {
			// 上传失败获取错误信息
			$this->error = $file->getError();
			return false;
		}


    }

}
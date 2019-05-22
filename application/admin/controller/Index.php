<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Index extends AdminBase
{


    /**
     * 后台首页
     * @return mixed
     */
    public function index()
    {



        $this->assign('admin', $this->admin);
        $this->assign('role', $this->role);
        $this->assign('nodes', model('node')->getAllTree());

        $this->assign('site', $this->site);

        return $this->fetch();

    }


    /**
     * 后台主页
     */
    function main(){


        $mysql_ver = model('admin')->query('select version() as ver');

        $this->assign('admin', $this->admin);

        $this->assign('role', $this->role);
        $this->assign('mysql_ver', $mysql_ver[0]['ver'] );

        return $this->fetch();

    }
    /**
     **  富文本框图片上传
     **/

    public function uploadEditor(){

        $file = request()->file('editormd-image-file');
        $info = $file->validate(['size'=> 1024*1024*2,'ext'=>['jpg', 'png', 'jpeg', 'gif', 'bmp']])->move(ROOT_PATH . 'public/uploads');
        if ($info) {
            // 成功上传后 获取上传信息
            $path = $info->getPath();
            $filename = $info->getFilename();
            //$root = request()->domain();
            $save_name = $info->getSaveName();

            if(__ROOT__){
                $realpath =  __ROOT__.'/uploads/' . $save_name;
            }else{
                $realpath =  '/uploads/' . $save_name;
            }
            exit(json_encode(['error' => 0, 'success' => 1, 'url' => $realpath]));
        } else {
            // 上传失败获取错误信息
            exit(json_encode(['error' => 1, 'success' => 0, 'message' => $file->getError()]));
        }
    }

}
<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Loader;

class AdminLog extends AdminBase
{

		public $table='admin_log';
		public function index(){
        $data = db($this->table)->order(['id'=>'desc'])->paginate(20,false);
        $page = $data->render();
        $this->assign('page', $page);
        $this->assign('data',$data);
        return $this->fetch();
   }
  

}
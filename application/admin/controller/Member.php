<?php
namespace app\admin\controller;


use app\common\controller\AdminBase;
use think\Db;
class Member extends AdminBase
{


 public $table='member';

    //列表
    public function index(){
		$tel = input('tel');
  
		$whereor=[];
		$where[] = ['tel','like',"%$tel%"];
		if(!empty($tel)){
			$whereor[] = ['nikename','like',"%$tel%"];
		}
		//halt($whereor);
		$where[] = ['delete','=',0];
        $data = db($this->table)
			->where($where)
			->whereOr($whereor)
			->order(['member_id'=>'desc'])
			->paginate(10,false,['query' => ['tel'=>$tel]]);
        $page = $data->render();
		$this->assign('page', $page);
        $this->assign('data',$data);

        $this->assign('tel',isset($tel)?$tel:''); 
        return $this->fetch();
   }

    /*
     * 添加
     */
	public function add(){

        if (request()->isPost()) {
            $params = input('post.');	
			
			if(empty($params['nikename']) || empty($params['tel'])){
				return $this->error('参数错误');
			}
            $insert =db($this->table)->insert($params);

            if($insert){
                return $this->success(lang('add_success'), $this->table.'/index');
            }else{
                return $this->error(lang('add_error'));
            }

        }else{
            return $this->fetch();
        }

	}

	/*
	 * 修改
	 */
    public function edit(){
	    if(request()->isPost()){
            $params = input('post.');
			if(empty($params['member_id']) || empty($params['nikename']) || empty($params['tel'])){
				return $this->error('参数错误');
			}
            $update =db($this->table)->update($params);

            if($update){
                return $this->success('修改成功');
            }else{
                return $this->error('修改失败');
            }

        }else{
		
            $id = input('get.id');
			if(empty($id)){
				  return $this->error('参数错误');
			}
            $where[]=['member_id','=',$id];
			$where[]=['delete','=',0];
            $data = db($this->table)->where($where)->find();
            $this->assign('data', $data);
            return $this->fetch();
        }
    }

    /*
     * 删除
     */
    public function dele(){
        $id = input('get.id');
		if(empty($id)){
			  return $this->error('参数错误');
		}
		
        $where[]=['member_id','=',$id];
		$where[]=['delete','=',0];
			//开启事务
		Db::startTrans();
		try {
			Db::name($this->table)->where($where)->setField('delete',1);
			Db::name('activity')->where($where)->setField('delete',1);
			//修改渠道码日志
			Db::name('company')->where($where)->setField('delete',1);
			Db::name('mymoney_log')->where($where)->setField('delete',1);
			Db::commit();
			return $this->success('删除成功');
		} catch (\think\exception\PDOException $e) {
			// 回滚事务
			Db::rollback();
			return $this->error('删除失败');
		} catch (\think\Exception $e) {
			// 回滚事务
			Db::rollback();
			return $this->error('删除失败');
		}
      
    }

}
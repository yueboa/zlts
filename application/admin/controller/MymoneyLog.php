<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

use think\Db;
class MymoneyLog extends AdminBase
{


	public $table='mymoney_log';

    //列表
    public function index(){
		
		$id = input('get.id');
		$where[] = ['member_id','=',$id];
		$where[]=['delete','=',0];
        $data = db($this->table)->where($where)->order(['id'=>'desc'])->paginate(10);
	
        $page = $data->render();
        $this->assign('page', $page);
        $this->assign('data',$data);
        $this->assign('member_id',$id);

        return $this->fetch();
   }

    /*
     * 添加
     */
	public function add(){

        if (request()->isPost()) {
			
            $params = input('post.');
		
			if(empty($params['money']) || !isset($params['status']) || empty($params['member_id'])){
				return $this->error('参数错误');
			}
			// 启动事务
			Db::startTrans();
			try {		
				$where[] = ['member_id','=',$params['member_id']];
				$where[] = ['delete','=',0];
				$mymoneyinfo = Db::name('member')->field('mymoney')->where($where)->find();
				
				if($params['status'] == 0){
					$mymoney=$mymoneyinfo['mymoney']*100+(int)$params['money']*100;
				}
				if($params['status'] == 1){
					
					if($mymoneyinfo['mymoney']*100 >= $params['money']*100){
						$mymoney=$mymoneyinfo['mymoney']*100-(int)$params['money']*100;
						$params['symbol'] ='-';
					}else{
						 return $this->error('账户余额不足');
					}
		
				}
				$mymoney=$mymoney/100;
				$insert =Db::name('member')->where($where)->setField('mymoney',$mymoney);
				$insert =Db::name($this->table)->insert($params);
				
				
			
				// 提交事务
				Db::commit();
			} catch (\think\exception\PDOException $e) {
				// 回滚事务
				Db::rollback();
				$this->error($e->getMessage());
			} catch (\think\Exception $e) {
				// 回滚事务
				Db::rollback();
				$this->error($e->getMessage());
			} 
            if($insert){
                return $this->success(lang('add_success'), $this->table.'/index?id='.$params['member_id']);
            }else{
                return $this->error(lang('add_error'));
            }

        }else{
			$this->assign('member_id',input('get.member_id'));
            return $this->fetch();
        }

	}

	/*
	 * 修改
	 */
    public function edit(){
	    if(request()->isPost()){
            $params = input('post.');
			if(empty($params['id']) || empty($params['money']) || !isset($params['status']) || empty($params['member_id'])){
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
            $where[]=['id','=',$id];
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
        $where[]=['id','=',$id];
        $where[]=['delete','=',0];
        $delete =db($this->table)->where($where)->setField('delete',1);

        if($delete){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }
    }

}
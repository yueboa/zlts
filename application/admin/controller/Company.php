<?php
namespace app\admin\controller;
use app\common\model\Member;
use app\common\controller\AdminBase;

class Company extends AdminBase
{


 public $table='company';

    //列表
    public function index(){
		$name = input('name');
  
		$where[] = ['a.delete','=','0'];
		$whereor=[];
		if(!empty($name)){
			$where[] = ['a.name','like',"%$name%"];
			$whereor[] = ['m.nikename','like',"%$name%"];
		}
        $data = db($this->table)
			->alias('a')
            ->join('member m','a.member_id = m.member_id')
			->field('a.*,m.nikename')
			->where($where)
			->whereOr($whereor)
			->order(['id'=>'desc'])
			->paginate(10,false,['query' => ['name'=>$name]]);
	
        $page = $data->render();
        $this->assign('page', $page);
        $this->assign('data',$data);

        $this->assign('name',isset($name)?$name:''); 
        return $this->fetch();
   }

    /*
     * 添加
     */
	public function add(){

        if (request()->isPost()) {
            $params = input('post.');	
			if(empty($params['member_id']) || empty($params['name'])){
				return $this->error('参数错误');
			}
			$where[] = ['member_id','=',$params['member_id']];
			
			$res =db($this->table)->where($where)->find();
			
			if(!empty($res)){
				return $this->error('一个人只能有一个公司');
			}
			
            $insert =db($this->table)->insert($params);

            if($insert){
                return $this->success(lang('add_success'), $this->table.'/index');
            }else{
                return $this->error(lang('add_error'));
            }

        }else{
			$member = (new Member)->member_list();
			$this->assign('member',$member);
            return $this->fetch();
        }

	}

	/*
	 * 修改
	 */
    public function edit(){
	    if(request()->isPost()){
            $params = input('post.');
			if(empty($params['id']) || empty($params['member_id']) || empty($params['name'])){
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
            $where[]=['id','=',$id];
            $where[]=['delete','=',0];
            $data = db($this->table)->where($where)->find();
			$member = (new Member)->member_list();
			$this->assign('member',$member);
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
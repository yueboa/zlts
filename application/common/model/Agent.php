<?php
namespace app\common\model;

use think\Model;

class Agent extends Model{
	
	/**
	 * 申请代理
	 * @param [type] $data [description]
	 */
	function addAgent($data){

		return $this->data($data)->isUpdate(false)->save();
	}


	/**
	 * 更新代理人信息
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function editAgent($data){
		return $this->data($data)->isUpdate(true)->save();
	}


	/**
	 * 获取代理人信息
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getAgent($id){
		return $this->where('id',$id)->find();
	}


	/**
	 * 获取代理人信息
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	function findAgent($where){
		return $this->where($where)->find();
	}


	/**
	 * 
	 * @param  [type] $score     [description]
	 * @param  [type] $dan_total [description]
	 * @param  [type] $daili_id  [description]
	 * @return [type]            [description]
	 */
	function getScore($score,$dan_total,$daili_id){
		$yiping = model('kuaidi')->where(['daili_id'=>$daili_id,'status'=>4])->count();
		if ($yiping) {
			$score = $score/($yiping);
		}

		return $score;
	}


	/**
	 * 我的团队
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function getMyTeam($id){
		return model('agent')->where('invite_code',$id)->select();

	}


    function getAgents($where,$order,$listRows){
    	$res = $this->where($where)->order($order)->paginate($listRows);
    	// dump($this->getLastSql());
    	return $res;
    }


}

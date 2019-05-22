<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\common\model;


class Vars extends Base{


    protected $pk   = 'varid';


    /**
     * 添加数据
     * @param null $data
     * @return bool
     */
    function set($name, $data=null, $scene='set'){

        $data = $data ?: input('post.');

        $validateName = 'Vars'.ucfirst($name);

        $validate = validate($validateName);

        $res = $validate->check($data, null, $scene);

        if( !$res ){
            $this->error = $validate->getError();
            return false;
        }

        $data = $this->getSubmitData($data, $scene);

        $data = $this->convSubmitData($data);


        $this->update([
            'update_time'    =>  $_SERVER['REQUEST_TIME'],
            'value' =>  json_encode($data['master'], 256)
        ],[
            'name'  =>  $name
        ]);

        return true;

    }


    /**
     * 得到一条数据
     * @param $name
     */
    function getOne($name){

        $data = $this->where([
            'name'  =>  $name
        ])->find();

        if(!$data){
            return null;
        }

        $data['_value'] = json_decode($data['value'], true);

        return $data;

    }


    /**
     * 得到一条缓存
     * @param $name
     * @param bool $recache
     * @return array|mixed|null|\PDOStatement|string|\think\Model
     */
    function getOneCache($name, $recache=false){

        $cacheName = 'Vars'.ucfirst(strtolower($name));

        if($recache || !($data = cache($cacheName))){

            $data = $this->getOne($name);

            $data = $data ? $data['_value'] : null;

            cache($cacheName, $data);
        }

        return $data;
    }

    //添加抽奖设置
    function setLotterySet($name,$data=[]){
        if(empty($data)){
            return false;
        }
        $this->update([
            'update_time'    =>  $_SERVER['REQUEST_TIME'],
            'value' =>  json_encode($data, 256)
        ],[
            'name'  =>  $name
        ]);
        return true;
    }


}
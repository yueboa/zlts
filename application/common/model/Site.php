<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\common\model;


class Site extends Base {

    protected $pk = 'siteid';



    function getOneCache($siteid, $recache=false){

        return parent::getOneDataCache($siteid, $recache, null, function(&$data){


            $data['seting'] = json_decode($data['seting'], true);


            if(!empty($data['seting']['init_imgs'])){
                $data['seting']['init_imgs'] = json_decode($data['seting']['init_imgs'], true);
            }

        });

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\admin\model;

use app\common\model\AdminBase;


class Role extends AdminBase{

    protected $pk   =   'roleid';


    function getOneCache($roleid, $recache = false, $options=null)
    {

        return parent::getOneDataCache($roleid, $recache, $options, function(&$data){

            $data['nodes'] = json_decode($data['nodes'], true);

        });

    }


}
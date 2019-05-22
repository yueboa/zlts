<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Role extends Base{



    protected $rule = [
        'name|角色名'  =>  'require',
    ];



    protected $scene = [

        'add'  =>  ['name'],
        'edit'  =>  [ 'name'],


    ];




}
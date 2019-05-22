<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Node extends Base{



    protected $rule = [
        'name'  =>  'require|length:2,30',
        'controller' =>  'length:3,20',
        'action' =>  'length:3,20',
        'description' =>  'max:255',
    ];



    protected $scene = [
        'add'  =>  ['name','controller', 'action', 'description'],
    ];



    protected $submit = [
        'add'   =>  ['name', 'controller', 'action', 'description'],
    ];



}
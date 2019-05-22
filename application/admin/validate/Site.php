<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Site extends Base{



    protected $rule = [
        'name'  =>  'require',
        'status' =>  'require|in:0,1',
    ];



    protected $scene = [

        'edit'  =>  [ 'name', 'status'],
        'add'  =>  [ 'name', 'status'],

    ];




}
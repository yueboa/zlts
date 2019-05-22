<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Position extends Base{



    protected $rule = [
        'siteid'  =>  'require|number',
        'type' =>  'require|number',
        'name' =>  'require|length:2,30',
    ];

    protected $message  =   [
        'name'   => '请填写广告位名称',
        'type'  => '请选择广告位类型',
    ];


    protected $scene = [

        'add'  =>  ['siteid','type', 'name'],
        'edit'  =>  [ 'name', 'type'],

    ];




}
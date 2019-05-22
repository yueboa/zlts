<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:42
 */
namespace app\common\validate;


class Attachment extends Base {


    protected $rule = [


        'name'  =>  'require',
        'type' =>  'require',
        'tmp_name' =>  'require',
        'size'  =>  'require|number|>:0'



    ];



    protected $scene = [

        'upload'  =>  ['name','type', 'tmp_name', 'size'],


    ];


}
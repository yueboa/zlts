<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Article extends Base{

//siteid,cateid,title,subtitle,description,keyword,thumb,images,create_time,send_time

    protected $rule = [
        'siteid'    =>  'require|number|>:0',
        'cateid'    =>  'require|number|>:0',
        'title'  =>  'require',
        'send_time'     =>  'require|date',
        'content' =>  'require',
    ];



    protected $scene = [

        'add'  =>  ['siteid', 'title', 'content', 'send_time'],

        'edit'  =>  [ 'title', 'content', 'send_time'],


    ];




}
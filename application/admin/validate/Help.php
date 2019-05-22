<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Help extends Base{

//siteid,cateid,title,subtitle,description,keyword,thumb,images,create_time,send_time

    protected $rule = [
        'title'    =>  'require',
        'content' =>  'require',
    ];



    protected $scene = [

        'add'  =>  ['title', 'content'],

    ];




}
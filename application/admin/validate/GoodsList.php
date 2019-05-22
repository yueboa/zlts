<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class GoodsList extends Base{



    protected $rule = [

        'cate_id'  =>  'require|number',
        'goods_title' =>  'require',
        'y_price' =>  'require|number',
        'x_price' =>  'require|number',
        'is_show' =>  'require|number',
        'content' =>  'require',

    ];



    protected $scene = [

        'add'  =>  ['cate_id','goods_title', 'y_price', 'x_price', 'is_show','content'],
        'edit'  =>  ['cate_id','goods_title', 'y_price', 'x_price', 'is_show','content'],

    ];




}
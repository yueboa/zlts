<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class GoodsCate extends Base{



    protected $rule = [

        'pid'  =>  'require|number',

        'catname' =>  'require|length:2,30',
        'imgurl' =>  'require',
        'isshow' =>  'require|in:0,1',

    ];



    protected $scene = [

        'add'  =>  ['pid','catname', 'isshow'],
        'edit'  =>  [ 'pid','catname', 'isshow'],

    ];




}
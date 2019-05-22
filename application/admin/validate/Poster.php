<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Poster extends Base{



    protected $rule = [
        'siteid'  =>  'require|number',
        'posid' =>  'require|number',
        'name' =>  'require|length:2,30',
        'imgurl' =>  'require',
        'thumb' =>  'require',
        'text' =>  'require',
        'flag' =>  'require',
    ];



    protected $scene = [

        'add_0'  =>  ['siteid','posid', 'name', 'imgurl', 'flag'],
        'edit_0'  =>  [ 'name', 'imgurl', 'flag'],

        'add_1'  =>  ['siteid','posid', 'name', 'imgurl', 'thumb','flag'],
        'edit_1'  =>  ['name', 'imgurl', 'thumb','flag'],

        'add_2'  =>  ['siteid','posid', 'name', 'text','flag'],
        'edit_2'  =>  ['name', 'text','flag'],

    ];




}
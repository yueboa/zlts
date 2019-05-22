<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class AgentGroup extends Base{


    protected $rule = [
        'partner_id'    =>  'require|number|>:0',
        'name'    =>  'require',
        'percent'  =>  'require|number|>:0',

    ];



    protected $scene = [

        'add'  =>  ['partner_id','name', 'percent'],

        'edit'  =>  [ 'name', 'percent'],


    ];




}
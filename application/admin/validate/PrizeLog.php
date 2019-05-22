<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class PrizeLog extends Base{


    protected $rule = [
        'pid'    =>  'require|number|>:0', //奖品类型
        'member_name'    =>  'require',            //奖品名称
        'p_num'  =>  'require',               //奖品图片


    ];

    protected  $field = [
        'pid'  => '奖品名称',
        'member_name'   => '中奖人昵称',
        'member_name' => '奖品数量',

        ];



    protected $scene = [

        'add'  =>  ['pid','member_name','member_name'],

        'edit'  =>  ['pid','member_name','member_name'],


    ];




}
<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Prize extends Base{


    protected $rule = [
        'prize_type'    =>  'require|number|>:0', //奖品类型
        'prize_name'    =>  'require',            //奖品名称
        'prize_pic'  =>  'require',               //奖品图片
        'v'  =>  'require',                //中奖率
        'amount'  =>  'require',       //奖品数量
        'radio_style'  =>  'require|number',      //是否允许幸运值提
        'need_luck'  =>  'number|>:0',            //幸运值
//        'multiple_v'  =>  '',               //中奖概率
//        'max_v'  =>  '',                    //最大限制
        'agent_id'  =>  'require|number',         //指定可中会员级别
        'sort'  =>  'number',                     //排序
        'addtime'  =>  'number',                  //
        'edittime'  =>  'number',                 //
        'num'  =>  'number',                      //实物奖品库存



    ];

    protected  $field = [
        'prize_type'  => '奖品类型',
        'prize_name'   => '奖品名称',
        'prize_pic' => '奖品图片',
        'v' => '中奖率',
        'amount' => '奖品数量',
        'radio_style' => '是否允许幸运值提',
        'need_luck' => '幸运值',
//        'multiple_v' => '中奖概率',
//        'max_v' => '最大限制',
        'agent_id' => '指定可中会员级别',
        'sort' => '排序',
        'addtime' => '',
        'edittime' => '邮箱',
        'num' => '实物奖品库存',
        ];



    protected $scene = [

        'add'  =>  ['prize_type','prize_name', 'prize_pic','v', 'amount','radio_style', 'need_luck','multiple_v', 'max_v','agent_id', 'sort','addtime', 'edittime','num','amount_1','amount_2'],

        'edit'  =>  ['prize_type','prize_name', 'prize_pic','v', 'amount','radio_style', 'need_luck','multiple_v', 'max_v','agent_id', 'sort','addtime', 'edittime','num','amount_1','amount_2'],


    ];




}
<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:43
 */
namespace app\admin\validate;

use app\common\validate\Base;

class Admin extends Base{



    protected $rule = [

        'username|管理员名称'  =>  'require|length:5,16',
        'password|密码' =>  'require|length:6,18',
        'repassword|重复密码'   =>  'require|confirm:password',
        'editpassword|密码' =>  'length:6,18',
        'reeditrepassword|重复密码'   =>  'length:6,18',

        'roleid'    =>  'require',

        'realname|真实姓名'  =>  'require|length:2,6',
        'mobile|手机号'    =>  'require|mobile',
        'email|电子邮箱'     =>  'require|email',



        'oldpassword|当前密码' =>  'require|length:6,18',
        'newpassword|新密码'   =>  'require|length:6,18|different:oldpassword',
        'renewpassword|重复新密码'   =>  'require|confirm:newpassword',
    ];



    protected $scene = [

        'add'   =>  [
            'username','roleid','password','repassword','realname','mobile','email'
        ],

        'edit'   =>  [
            'username','roleid','editpassword','reeditpassword','realname','mobile','email'
        ],

        //登录
        'login'  =>  ['username','password'],

        //个人信息
        'info'  =>  ['realname', 'mobile', 'email'],

        //修改密码表单
        'pwdform'  =>  [ 'oldpassword', 'newpassword', 'renewpassword'],

        //修改密码更新
        'pwd'   =>  ['encry'],
    ];



}
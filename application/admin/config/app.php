<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 上午10:26
 */
return [

    //不需要验证的节点
    'no_verify_node'    =>  [
        'admin:login',
        'admin:logout',
        'example:icon',

    ],

    //只验证登录即可的节点
    'verify_login_node' =>  [
        'index:index',
        'index:main'
    ],

    'super_role_id'     =>  1,  //超级角色ID
    'super_admin_id'    =>  1,  //超级管理员ID











    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => env('app_path') .'admin/view/public/'. 'jump.html',

    'dispatch_error_tmpl'    => env('app_path') .'admin/view/public/'. 'jump.html',


];
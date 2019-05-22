<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [



    'list'  =>  [

        'username'  =>  [
            'title' =>  '用户名',
            'type'  =>  'text',
        ],

        'realname'  =>  [
            'title' =>  '真实姓名',
            'type'  =>  'text',
            'placeholder'   =>  '管理员真实姓名',
        ],

        'mobile'    =>  [
            'title' =>  '手机号',
            'type'  =>  'number',
            'placeholder'   =>  '管理员手机号',
        ],

        'status'    =>  [
            'title' =>  '状态',
            'type'  =>  'radio',
            'iskeyval'  =>  1,
            'data'  =>  [
                0   =>  '正常',
                1   =>  '禁用',
            ]
        ],

        'email'     =>  [
            'title' =>  '电子邮箱',
            'type'  =>  'text',
            'placeholder'   =>  '管理员电子邮箱',
        ],
        'roleid'     =>  [
            'title' =>  '所属角色',
            'type'  =>  'select',
            'valkey'    =>  'roleid',
            'strkey'    =>  'name',
        ],
        'password'     =>  [
            'title' =>  '密码',
            'type'  =>  'password',
            'placeholder'   =>  '管理员登录密码',
        ],
        'repassword'     =>  [
            'title' =>  '重复密码',
            'type'  =>  'password',
            'placeholder'   =>  '重复管理员登录密码',
        ],
        'editpassword'     =>  [
            'title' =>  '密码',
            'type'  =>  'password',
            'placeholder'   =>  '不修改请保持为空',
        ],
        'reeditpassword'     =>  [
            'title' =>  '重复密码',
            'type'  =>  'password',
            'placeholder'   =>  '不修改请保持为空',
        ],



        'oldpassword'  =>  [
            'title' =>  '当前密码',
            'type'  =>  'password',
            'placeholder'    =>  '当前的登录密码',
        ],
        'newpassword'  =>  [
            'title' =>  '新密码',
            'type'  =>  'password',
            'placeholder'    =>  '要修改的新密码',
        ],
        'renewpassword' =>  [
            'title' =>  '重复新密码',
            'name'  =>  'renewpassword',
            'type'  =>  'password',
            'placeholder'    =>  '重复新密码',
        ],

    ],

    'form'  =>  [

        'add'   =>  'username,roleid,password,repassword,realname,mobile,email,status',
        'edit'   =>  'username,roleid,editpassword,reeditpassword,realname,mobile,email,status',

        'info'  =>  'username,realname,mobile,email',

        'pwd'  =>  'oldpassword,newpassword,renewpassword',

    ],



    'submit'    =>  [
        'info'  =>  'realname,mobile,email',

        'add'   =>  'username,roleid,password,repassword,realname,mobile,email,status',
        'edit'   =>  'roleid,password,encry,realname,mobile,email,status',

        'pwd'  =>  'password,encry',
    ]





];
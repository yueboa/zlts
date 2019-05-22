<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [

    'list'  =>  [

        'name'  =>  [
            'title' =>  '广告名称',
            'type'  =>  'text',
            'placeholder'    =>  '广告名称',
        ],


        'imgurl'    =>  [
            'title' =>  '图片',
            'type'  =>  'upload',
            'maxnum'    =>  1,
            'multifile' =>  0,

        ],

        'thumb'    =>  [
            'title' =>  '缩略图',
            'type'  =>  'upload',
        ],

        'intro'    =>  [
            'title' =>  '文字描述',
            'type'  =>  'text',
            'placeholder'    =>  '替换文字',
        ],

        'text'   =>  [
            'title' =>  '广告内容',
            'type'  =>  'textarea',

        ],
        'flag'   =>  [
            'title' =>  '链接',
            'type'  =>  'text',
        ],


        'param'   =>  [
            'title' =>  '参数',
            'type'  =>  'text',
            'placeholder'   =>  '需要传递的参数',
        ],

        'status'   =>  [
            'title' =>  '禁用',
            'type'  =>  'radio',
            'iskeyval'  =>  true,
            'value' =>  0,
            'data'  =>  [
                1   =>  '是',
                0 => '否',
            ],

        ],

    ],

    'form'  =>  [

        //单图
        'add_0'  =>  ['name,imgurl,flag,param,status'],
        'edit_0'  =>  ['name,imgurl,flag,param,status'],

        //双图
        'add_1'  =>  ['name,imgurl,thumb,intro,flag,status'],
        'edit_1'  =>  ['name,imgurl,thumb,intro,flag,status'],

        //文字
        'add_2'  =>  ['name,text,intro,flag,status'],
        'edit_2'  =>  ['name,text,intro,flag,status'],

    ],

    'submit'  =>  [

        //单图
        'add_0'  =>  'posid,siteid,name,imgurl,param,intro,flag,status',
        'edit_0'  =>  'name,imgurl,intro,flag,param,status',

        //双图
        'add_1'  =>  'posid,siteid,name,imgurl,thumb,intro,flag,status',
        'edit_1'  =>  'name,imgurl,thumb,intro,flag,status',

        //文字
        'add_2'  =>  'posid,siteid,name,text,intro,flag,status',
        'edit_2'  =>  'name,text,intro,flag,status',


    ],

];
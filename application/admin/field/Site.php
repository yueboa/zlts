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
            'title' =>  'APP名称',
            'type'  =>  'text',
        ],

//        'intro'  =>  [
//            'title' =>  '站点简介',
//            'type'  =>  'textarea',
//            'placeholder'    =>  '站点简介',
//        ],
//
//        'title'  =>  [
//            'title' =>  '站点标题',
//            'type'  =>  'text',
//            'placeholder'    =>  '网站标题',
//        ],
//
//        'keyword'  =>  [
//            'title' =>  '站点关键字',
//            'type'  =>  'text',
//            'placeholder'    =>  '网站关键字',
//        ],
//
//        'description'  =>  [
//            'title' =>  '站点描述',
//            'type'  =>  'textarea',
//            'placeholder'    =>  '网站描述',
//        ],

        'explain'  =>  [
            'title' =>  '关闭原因',
            'type'  =>  'textarea',
            'placeholder'    =>  '网站关闭原因',
        ],

        'status'    =>  [
            'title' =>  '状态',
            'type'  =>  'radio',
            'iskeyval'  =>  true,
            'data'  =>  [
                0   =>  '正常',
                1   =>  '关闭',
            ],
            'value' =>  0,
        ],


        'domain'    =>  [
            'title' =>  '网站域名',
            'type'  =>  'text',
        ],

        'seting__money_name'    =>  [
            'title' =>  '货币单位',
            'type'  =>  'text',
        ],
        'seting__version'    =>  [
            'title' =>  '版本号',
            'type'  =>  'text',
        ],


        'seting__init_img'  =>  [
            'title' =>  '启动图',
            'type'  =>  'upload',
        ],

        'seting__init_imgs' =>  [
            'title' =>  '引导图片',
            'type'  =>  'upload',
            'maxnum'    =>  5,
        ],

        'seting__icp'  =>  [
            'title' =>  '备案号',
            'type'  =>  'text',
        ],
        'seting__qq'  =>  [
            'title' =>  '在线QQ',
            'type'  =>  'text',
        ],
        'seting__tel'  =>  [
            'title' =>  '客服电话',
            'type'  =>  'text',
        ],
        'seting__wechat'  =>  [
            'title' =>  '客服微信',
            'type'  =>  'text',
        ],



    ],


    'form'  =>  [
        'edit'   =>  'name,domain,seting__money_name,seting__version,seting__init_img,seting__init_imgs,seting__icp,seting__qq,seting__tel,seting__wechat,status,explain',

    ],

    'submit'    =>  [
        'edit'  =>  'name,domain,seting__money_name,seting__version,seting__init_img,seting__init_imgs,seting__icp,seting__qq,seting__tel,seting__wechat,status,explain',

    ],

    'convert'   =>  [
        'seting'
    ]


];
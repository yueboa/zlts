<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [

    'list'    =>  [
        'title' =>  [
            'title' =>  '标题',
            'type'  =>  'text',
            'placeholder'    =>  '文章标题',
        ],
        'subtitle'  =>  [
            'title' =>  '副标题',
            'type'  =>  'text',
            'placeholder'    =>  '副标题',
        ],
        'cateid'  =>  [
            'title' =>  '栏目',
            'type'  =>  'text',
            'value'    =>  1,
        ],
        'keywords'  =>  [
            'title' =>  '关键字',
            'type'  =>  'text',
            'placeholder'    =>  '多个用英文逗号分割',
        ],
        'description'   =>  [
            'title' =>  '描述',
            'type'  =>  'textarea',
            'placeholder'    =>  '文章描述',
        ],
        'content'   =>  [
            'title' =>  '内容',
            'type'  =>  'ueditor',
            'placeholder'    =>  '',
        ],
        'thumb' =>  [
            'title' =>  '缩略图',
            'type'  =>  'upload',
            'maximum'    =>  1,
        ],
        'images' =>  [
            'title' =>  '组图列表',
            'type'  =>  'upload',
            'maximum'    =>  10,
            'multifile'    =>  1,
        ],
        'send_time' =>  [
            'title' =>  '发布时间',
            'type'  =>  'date',
//            'min'   =>  '0',
//            'max'   =>  '7',
            'format'    =>  'Y-m-d H:i:s',
            'datetype'  =>  'datetime',
            'value' =>  $_SERVER['REQUEST_TIME']
        ],

        'show_type' =>  [
            'title' =>  '列表样式',
            'type'  =>  'select',
            'iskeyval'  =>  true,
            'value' =>  0,
            'data'  =>  [
                0   =>  '无图',
                1   =>  '一张小图',
                2   =>  '一张大图',
                3   =>  '三张小图',
            ]
        ],

    ],



    'form' =>  [
        'add'   =>  ['title,subtitle,description,content', 'keywords,thumb,images,show_type,send_time'],

        'edit'   =>  ['title,subtitle,description,content', 'keywords,thumb,images,show_type,send_time'],
    ],



    'submit'    =>  [

        'add'   =>  [
            'master'  =>    'siteid,cateid,title,subtitle,description,keywords,thumb,images,create_time,show_type,send_time',
            'slave' =>  'content'
        ],

        'edit'   =>  [
            'master'  =>    'title,keywords,cateid,thumb,images,subtitle,description,show_type,send_time,update_time',
            'slave' =>  'content'
        ],

    ],


];
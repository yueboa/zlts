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
            'title' =>  '广告位名称',
            'type'  =>  'text',
            'placeholder'    =>  '广告位名称',
        ],


        'type'    =>  [
            'title' =>  '广告位类型',
            'type'  =>  'select',
            'iskeyval'  =>  1,
            'data'  =>  [
                0   =>  '单图广告',
                1   =>  '双图广告',
                2   =>  '文字广告',
            ],
            'value' =>  0
        ],

        'intro' =>  [
            'title' =>  '描述',
            'type'  =>  'text',
            'placeholder'   =>  '广告位描述',
        ],

    ],

    'form'  =>  [

        'add'  =>  ['name,type,intro'],
        'edit'  =>  ['name,type,intro'],

    ],

    'submit'  =>  [

        'add'  =>  'siteid,name,type,intro',
        'edit'  =>  'name,type,intro',


    ],

];
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
            'title' =>  '角色名',
            'type'  =>  'text',
        ],

        'intro'  =>  [
            'title' =>  '角色描述',
            'type'  =>  'textarea',
            'placeholder'   =>  '角色描述',
        ],

        'status'    =>  [
            'type'  =>  'radio',
            'title' =>  '状态',
            'iskeyval'  =>  1,
            'data'  =>  [
                0   =>  '启用',
                1   =>  '禁用',
            ]
        ],


    ],

    'form'  =>  [

        'add'   =>  'name,intro,status',
        'edit'  =>  'name,intro,status',

    ],



    'submit'    =>  [
        'add'  =>  'name,status,intro,nodes',
        'edit'  =>  'name,intro,status,nodes',
    ]





];
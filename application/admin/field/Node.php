<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [

    'list'  =>  [
        'pid'   =>  [
            'title' =>  '父节点',
            'type'  =>  'select',
            'before_data'   =>  [[
                'nodeid'   =>  0,
                'name'  =>  '顶级',
            ]],
            'valkey'    =>  'nodeid',
            'strkey'    =>  'name',
            'tree'      =>  true,
        ],
        'name'  =>  [
            'title' =>  '节点名',
            'name'  =>  'name',
            'type'  =>  'text',
            'placeholder'    =>  '节点名称',
        ],
        'controller'    =>  [
            'title' =>  '控制器',
            'name'  =>  'controller',
            'type'  =>  'text',
            'placeholder'    =>  '节点控制器',
        ],
        'action'    =>  [
            'title' =>  '方法',
            'name'  =>  'action',
            'type'  =>  'text',
            'placeholder'    =>  '节点方法',
        ],
        'param' =>  [
            'title' =>  '参数',
            'name'  =>  'action',
            'type'  =>  'text',
        ],
        'icon'    =>  [
            'title' =>  '图标',
            'name'  =>  'icon',
            'type'  =>  'text',
            'placeholder'    =>  '节点方法',
            'notice'    =>  '详细请查看<a href="'.url('example/icon').'" target="_blank">图标大全</a>',
        ],
        'is_show'   =>  [
            'title' =>  '显示',
            'type'  =>  'radio',
            'iskeyval'  =>  true,
            'value' =>  1,
            'data'  =>  [
                1   =>  '是',
                0 => '否',
            ],

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
        'intro' =>  [
            'title' =>  '描述',
            'name'  =>  'intro',
            'type'  =>  'textarea',
            'placeholder'    =>  '节点的描述',
        ],

    ],

    'form'  =>  [
        'add'  =>  ['name,controller,action,param,intro','pid,icon,is_show,status'],
        'edit'  =>  ['name,controller,action,param,intro','pid,icon,is_show,status'],
    ],

    'submit'  =>  [
        'add'  =>  'pid,name,controller,action,param,icon,intro,is_show,status',
        'edit'  =>  'pid,name,controller,action,param,icon,intro,is_show,status',
    ],

];
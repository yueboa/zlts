<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [

    'list'  =>  [

        'pid'  =>  [
            'title' =>  '父栏目',
            'type'  =>  'select',
            'valkey'    =>  'cid',
            'strkey'    =>  'catname',
            'tree'      =>  true,
            'before_data'   =>  [
                [
                    'cid'   =>  0,
                    'catname'   =>  '顶级栏目',
                ]
            ]
        ],


        'imgurl'    =>  [
            'title' =>  '栏目图片',
            'type'  =>  'upload',
        ],


        'catname'    =>  [
            'title' =>  '栏目名',
            'type'  =>  'text',
            'placeholder'    =>  '栏目名称',
        ],



        'isshow'   =>  [
            'title' =>  '显示',
            'type'  =>  'radio',
            'iskeyval'  =>  true,
            'value' =>  1,
            'data'  =>  [
                1   =>  '是',
                0 => '否',
            ],

        ],

    ],

    'form'  =>  [

        //单图
        'add'  =>  ['pid,catname,imgurl,isshow'],
        'edit'  =>  ['pid,catname,imgurl,isshow'],



    ],

    'submit'  =>  [

        //单图
        'add'  =>  'pid,catname,imgurl,isshow',
        'edit'  =>  'pid,catname,imgurl,isshow',



    ],

];
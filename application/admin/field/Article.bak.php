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
        'keyword'  =>  [
            'title' =>  '关键字',
            'type'  =>  'text',
            'placeholder'    =>  '多个用","分割',
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
        'shijian'   =>  [
            'title' =>  '标题',
            'type'  =>  'omnipotent',
            'html'  =>  '{title}-{subtitle}-{name}',
        ],
        'thumb' =>  [
            'title' =>  '缩略图',
            'type'  =>  'upload',
            'maxnum'    =>  1,
        ],
        'images' =>  [
            'title' =>  '缩略图s',
            'type'  =>  'upload',
            'maxnum'    =>  10,
        ],
        'checkbox'  =>  [

            'type'  =>  'checkbox',
            'iskeyval'  =>  1,
            'data'  =>  [
                '是','否','ssss'
            ]
        ]
    ],



    'form' =>  [
        'add'   =>  'shijian,thumb,images,content',
        'edit'   =>  'shijian,thumb,images,content',
    ],



    'submit'    =>  [

        'add'   =>  [
            'master'  =>    ['title','thumb','images', 'subtitle', 'description' ],
            'slave' =>  ['content']
        ],
        'edit'   =>  [
            'master'  =>    ['title','thumb','images', 'subtitle', 'description' ],
            'slave' =>  ['content']
        ],

    ],


];
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

    ],



    'form' =>  [
        'add'   =>  ['title,keywords,description,content'],

        'edit'   =>  ['title,keywords,description,content'],
    ],



    'submit'    =>  [

        'add'   =>  [
            'master'  =>    'title,keywords,description,create_time',
            'slave' =>  'content'
        ],

        'edit'   =>  [
            'master'  =>    'title,keywords,description,update_time',
            'slave' =>  'content'
        ],

    ],


];
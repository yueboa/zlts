<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午8:57
 */
return [

    'list'    =>  [
        'name' =>  [
            'title' =>  '名称',
            'type'  =>  'text',
            'placeholder'    =>  '群组名称',
        ],
        'percent'  =>  [
            'title' =>  '反现比例%',
            'type'  =>  'number',
            'placeholder'    =>  '反现比例%',
            'notice'    =>  '反现比例%',
        ],
    ],



    'form' =>  [
        'add'   =>  ['name,percent'],

        'edit'  =>  ['name,percent'],
    ],



    'submit'    =>  [

        'add'   =>  [
            'master'  =>    'partner_id,name,percent',
            //'slave' =>  'name,percent'
        ],

        'edit'   =>  [
            'master'  =>    'name,percent',
            //'slave' =>  'name,percent'
        ],

    ],


];
<?php
/*
 * 调用生成字段
 */
function form($arg=[]){

    if(empty($arg['type'])){
        return '<!-- 确实type参数 -->';
    }


    $class = '\base\\Form';

    if(method_exists($class, $arg['type'])){
        return $class::{$arg['type']}($arg);
    }

    return '<!--'.$arg['type'].' 不存在-->';

}

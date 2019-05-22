<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;

class Example extends AdminBase
{


    /**
     * 查看所有图标
     */
    function icon(){

        return $this->fetch();

    }



}
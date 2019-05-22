<?php
namespace app\admin\controller;

use think\Controller;

class Error extends Controller
{


    function index(){

        return $this->error('【 '.$this->request->controller().' 】'.lang('action_not_found'));

    }


    function _empty(){

        return $this->error('【 '.$this->request->controller().' 】'.lang('controller_not_found').'；【 '.$this->request->action().' 】'.lang('action_not_found'));

    }


}
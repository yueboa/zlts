<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:39
 */
namespace app\common\model;


class Poster extends Base{

    protected $pk = 'posterid';


    function getPosterByPosid($posid, $recache=false){

        $cacheName = 'poster_'.$posid;

        if($recache || !($posters = cache($cacheName))){

            $posters = $this->where([
                    'posid' =>  $posid,
                    'status'    =>  0,
                ])
                ->order('sort asc,posterid asc')
                ->select();

            cache($cacheName, $posters);
        }


        return $posters;

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/7/10
 * Time: 上午10:18
 */

/**
 * 无限分类树（支持子分类排序）
 * version：1.4
 * author：Veris
 * website：www.mostclan.com
 */
class ClassTree {
    /**
     * 分类排序（降序）
     */
    static public function sort($arr,$cols){
        //子分类排序
        foreach ($arr as $k => &$v) {
            if(!empty($v['sub'])){
                $v['sub']=self::sort($v['sub'],$cols);
            }
            $sort[$k]=$v[$cols];
        }
        if(isset($sort))
            array_multisort($sort,SORT_DESC,$arr);
        return $arr;
    }
    /**
     * 横向分类树
     */
    static public function hTree($arr,$pid=0){
        foreach($arr as $k => $v){
            if($v['pid']==$pid){
                $data[$v['id']]=$v;
                $data[$v['id']]['sub']=self::hTree($arr,$v['id']);
            }
        }
        return isset($data)?$data:array();
    }
    /**
     * 纵向分类树
     */
    static public function vTree($arr,$pid=0){
        foreach($arr as $k => $v){
            if($v['pid']==$pid){
                $data[$v['id']]=$v;
                $data+=self::vTree($arr,$v['id']);
            }
        }
        return isset($data)?$data:array();
    }
}

//===========================Example===========================
$arr=array(
    array('id'=>1,'pid'=>0,'name'=>'河北','sort'=>0),
    array('id'=>10,'pid'=>1,'name'=>'石家庄','sort'=>0),
    array('id'=>13,'pid'=>1,'name'=>'邯郸','sort'=>1),
    array('id'=>4,'pid'=>0,'name'=>'北京','sort'=>2),
    array('id'=>5,'pid'=>4,'name'=>'朝阳','sort'=>0),
    array('id'=>6,'pid'=>10,'name'=>'桥西','sort'=>0),
);
$arr=ClassTree::sort($arr,'sort');
$data=ClassTree::vTree($arr);
$data2=ClassTree::hTree($arr);
echo '<pre>';
print_r($data);
print_r($data2);



function vTree($arr,$pid=0){
    foreach($arr as $k => $v){
        if($v['pid']==$pid){
            $data[$v['id']]=$v;
            $data+=vTree($arr,$v['id']);
        }
    }
    return isset($data)?$data:array();
}

echo '<hr>';


print_r(vTree($arr));
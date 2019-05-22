<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:40
 */
namespace app\common\model;


class Article extends AdminBase {


    public $slave_table = 'article_data';


    function getAll($where=[], $field=null, $order=null, $page_size=20, $page_no=1){


        $data = $this
            ->where($where)
            ->order($order)
            ->field($field)
            ->paginate([
                'page'  =>  $page_no,
                'list_rows' =>  $page_size
            ]);


        return $data->toArray();

    }


    /**
     * 得到单一数据
     * @param $id
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function getOne($id){

        return $this->alias('m')->join('article_data s','m.id=s.id', 'left')->find($id);


    }


    /**
     * 得到首页推荐头条
     */
    function home($num=5,$recache=false){


        $data = $this
            ->field('id,title,subtitle,rec_type')
            ->limit($num)
            ->where([
                [
                    'rec_type','>',0
                ],
                [
                    'status','=',0
                ]
            ])
            ->order('id desc')
            ->select();



        return $data;

    }

    

    function getSimilar($keyword,$id){

        return $this->where([['keywords','like','%'.$keyword.'%'],['id','<>',$id]])->limit(1)->select();

    }


    function editPraise($aid,$type){

        if ($type) {//1:点赞，0：取消
            return $this->where('id','=',$aid)->setInc('like_num');
        }else{
            return $this->where('id','=',$aid)->setDec('like_num');
        }


    }


    function editCommentNum($id){
        return $this->where('id','=',$id)->setInc('comment_num');
    }


}
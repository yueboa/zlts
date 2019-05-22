<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 2018/7/8
 * Time: 下午2:40
 */
namespace app\common\model;

use think\Db;
use think\Model;

class Base extends Model{

    //默认字段
    protected static $rawField = null;

    //附表名
    public $slave_table = null;




    /**
     * 得到原始数据
     * @param null $name
     * @param null $module
     * @return mixed
     */
    function initRawField($name=null, $module=null){

        static $rawField=null;

        if( is_null(self::$rawField) ){

            $module = $module ?: request()->module();

            $name = $name ?: request()->controller();

            $file = env('app_path').$module.'/field/'.ucfirst($name).'.php';

            self::$rawField = is_file($file) ? include $file : [];

        }

        return self::$rawField;

    }


    /**
     * @param $data
     * 设置原始字段的值
     */
    function setRawFieldVal($data){

        //还原转换的数组数据
        if( !empty(self::$rawField['convert']) ){

            foreach (self::$rawField['convert'] as $val){

                if(!empty($data[$val])){

                    $data = array_merge(
                        $data,
                        $this->multArrToOneArr( json_decode($data[$val], true), $val )
                    );

                    unset($data[$val]);
                }
            }

        }


        //循环设置数据
        foreach($data as $key=>$val){

            if(!empty(self::$rawField['list'][$key])){

                self::$rawField['list'][$key]['value'] = $val;
            }
        }

    }


    /**
     * 多维数组转换为下划线链接的一维数组
     * @param $data
     * @param $pre
     * @return array
     */
    private function multArrToOneArr($data, $pre){

        $glue = '__';   //分割符

        $reData = [];   //返回数据

        foreach ($data as $k=>$v){

            $key = $pre.$glue.$k;

            if( is_string($v) ){
                $reData[$key] = $v;
            }else{

                $reData = array_merge($reData, $this->multArrToOneArr($v, $key));
            }

        }

        return $reData;

    }


    /**
     * 设置原始字段数据
     * @param $name
     * @param $val
     */
    function setRawFieldData($name, $param){

        if( !empty(self::$rawField['list'][$name]) ){

            self::$rawField['list'][$name] = array_merge(self::$rawField['list'][$name], $param);

            return true;
        }

        return false;

    }


    /**
     * 根据场景得到当前模型的字段信息
     */
    function getFormField($scene=null){


        //不存在
        if(empty(self::$rawField) || empty(self::$rawField['list'])){
            return [];
        }

        //默认场景
        $scene = $scene ?: request()->action();


        //场景不存在，返回空
        if( empty(self::$rawField['form'][$scene]) ){
            return [];
        }

        //场景字段
        $sceneField = is_string(self::$rawField['form'][$scene])
            ? [self::$rawField['form'][$scene]]
            : self::$rawField['form'][$scene];


        //需返回字段
        $reField = [];


        foreach ($sceneField as $key=>$value){

            $value = is_string($value) ? array_filter(explode(',', $value)) : $value;

            foreach($value as $val){

                if(!empty(self::$rawField['list'][$val])){

                    $reField[$key][$val] = self::$rawField['list'][$val];

                    $reField[$key][$val]['name']  =   $val;

                    //万能字段
                    if($reField[$key][$val]['type'] == 'omnipotent'){

                        //正则替换万能字段
                        preg_match_all('/\{(.*?)\}/', $reField[$key][$val]['html'], $re);


                        //如果匹配到
                        if($re[1]){

                            foreach($re[1] as &$v){
                                if(empty(self::$rawField['list'][$v])){
                                    $v = '{'.$v.'}';
                                }else{
                                    $_v = $v;
                                    $v = self::$rawField['list'][$v];
                                    $v['name'] = $_v;
                                }

                            }
                        }

                        $reField[$key][$val]['data'] = $re;

                    }

                }

            }

        }

        return $reField;


    }


    /**
     * 得到提交数据
     * @param null $data
     * @param null $scene
     * @return array
     */
    function getSubmitData($data=null, $scene=null){

        //得到数据
        $data = $data ?: input('post.');

        //验证场景
        $scene = $scene ?: request()->action();

        //没有指定，直接取键，验证所有数据
        if( empty(self::$rawField['submit'][$scene]) ){
            self::$rawField['submit'][$scene] = array_keys($data);
        }


        //没有主附表
        if( empty(self::$rawField['submit'][$scene]['master']) ){

            self::$rawField['submit'][$scene] = [
                'master'    =>  self::$rawField['submit'][$scene]
            ];

        }

        //返回数据
        $redata = [];

        foreach(self::$rawField['submit'][$scene] as $key=>$val){

            $val = is_string($val) ? explode(',', $val) : $val;
            foreach ($val as $v){

                $v = trim($v);  //去除无用空白

                //如果为空
                if(!$v){
                    continue;
                }

                $redata[$key][$v] = !isset($data[$v]) ? '' : $data[$v];  //没有设置补充为空

            }

        }

        return $redata;
    }


    /**
     * 转换提交数据，必须是master和salve数组
     * @param $data
     */
    function convSubmitData($data){


        self::$rawField['convert'] = empty(self::$rawField['convert']) ? [] : self::$rawField['convert'];

        //根据类型转换
        foreach($data as &$val){

            foreach ($val as $k=>$v){

                if(empty(self::$rawField['list'][$k])){
                    continue;
                }

                //按类型转换
                switch(self::$rawField['list'][$k]['type']){

                    case 'date':
                        $val[$k] = strtotime($v);
                        break;

                    case 'checkbox':    //多选选项，用","连接

                        if($v && is_array($v)){
                            $val[$k] = implode(',', $v);
                        }

                        break;

                    case 'upload':

                        if(
                            !empty(self::$rawField['list'][$k]['multifile'])
                            ){


                            $v = $v ?: [];

                            $tmp = [];
                            foreach ($v as $_k=>$_v){

                                $field_name = empty(self::$rawField['list'][$k]['field_name']) ? 'imgurl' : self::$rawField['list'][$k]['field_name'];

                                $tmp[$_k][ $field_name ] = $_v;


                                //处理多余字段
                                self::$rawField['list'][$k]['ext_field'] = empty(self::$rawField['list'][$k]['ext_field'])
                                    ? []
                                    : self::$rawField['list'][$k]['ext_field'];

                                foreach (self::$rawField['list'][$k]['ext_field'] as $_kk=>$_vv){

                                    $key = 'post.'.$k.'_'.$_kk;

                                    $_val = input($key.'/a');

                                    $tmp[$_k][$_kk] = empty($_val[$_k]) ? '' : $_val[$_k];

                                }

                            }

                            $val[$k] = json_encode($tmp, 256);

                        }

                        break;

                }


                //判断是否有转换，并且根据前缀确定是否转换
                if(self::$rawField['convert']){

                    //切割前缀
                    $keys = explode('__', $k);


                    //需要转换成数组格式，必须切割等于2
                    if( count($keys)>1 && in_array($keys[0], self::$rawField['convert']) ){

                        //第一个元素
                        $first = array_shift($keys);

                        //最后元素
                        $end = array_pop($keys);

                        //反转剩余
                        $keys = array_reverse(array_filter($keys));

                        //当前值
                        $var = [$end => $val[$k] ];

                        //释放原来元素
                        unset($val[$k]);


                        //循环其他建
                        foreach ($keys as $_k){
                            $var = [$_k =>  $var ];
                        }


                        $val[$first] = empty($val[$first]) ? [] : $val[$first];

                        $val[$first] = array_merge_recursive($val[$first], $var);

                    }
                }

            }

            //转换数据
            foreach (self::$rawField['convert'] as $v){
                if(!empty($val[$v])){
                    $val[$v] = json_encode($val[$v], 256);
                }

            }


        }

        return $data;
    }


    /**
     * 公共的添加内容方法
     * @param null $data
     * @param null $model
     * @param string $scene
     * @return bool|int|string
     */
    function addData($post=null, $scene = null){

        $post = $post ?: input('post.');

        //验证器
        $validate = validate($this->name);

        //验证场景
        $scene = $scene ?: request()->action();

        //验证结果
        $res = $validate->check($post, null, $scene);

        if( !$res ){
            $this->error = $validate->getError();
            return false;
        }

        //得到提交字段
        $post = $this->getSubmitData($post, $scene);

        $post = $this->convSubmitData($post);

        //添加主表
        $insertId = $this->insertGetId($post['master']);

        //主表添加成功，添加副本
        if($insertId && !empty($post['slave']) && $this->slave_table){

            $post['slave'][$this->getPk()] = $insertId;

            db($this->slave_table)->insert($post['slave']);
        }

        return $insertId;
    }


    /**
     * 编辑数据
     * @param $id 主键ID
     * @param null $post post数据
     * @param null $scene 验证场景
     * @return bool 默认返回true
     */
    function editData($id, $post=null, $scene=null){

        $post = $post ?: input('post.');

        //验证器
        $validate = validate($this->name);

        //验证场景
        $scene = $scene ?: request()->action();

        //验证结果
        $res = $validate->check($post, null, $scene);

        if( !$res ){
            $this->error = $validate->getError();
            return false;
        }

        //得到提交字段
        $post = $this->getSubmitData($post, $scene);

        $post = $this->convSubmitData($post);

        //添加主表
        $this->where([
            $this->getPk()=>$id
        ])->update($post['master']);

        //主表添加成功，添加副本
        if(!empty($post['slave']) && $this->slave_table){

            $where[ $this->getPk() ] = $id;

            db($this->slave_table)->where($where)->update($post['slave']);
        }

        return true;

    }


    /**
     * 得到一条记录
     * @param $where 可以是主键id或查询条件
     */
    function getOneData($where, $field='*'){

        if( is_numeric($where) ){
            $where  =   [
                'm.'.$this->getPk()   =>  $where
            ];
        }

        $data = $this->alias('m')->where($where)->field($field);

        if($this->slave_table){
            $data = $data->join(
                $this->slave_table.' s',
                'm.'.$this->getPk().'=s.'.$this->getPk()
            );
        }

        $data = $data->find();

        return $data ? $data->toArray() : null;

    }


    /**
     * 得到主键
     * @param $pk
     */
    protected function getOneDataCache($pkVal, $recache=false, $options=null, $callback=null){

        $cacheName = $this->name.'_'.$pkVal;

        if($recache || !($data = cache($cacheName))){

            $data = $this->getOneData($pkVal);

            if(is_callable($callback)){
                $callback($data);
            }

            cache($cacheName, $data, $options);

        }

        return $data;

    }


    /**
     * 根据主键得到缓存
     * @param $pkVal
     * @param $recache
     * @return array|mixed|null
     */
    function getOneCache($pkVal, $recache=false){

        return $this->getOneDataCache($pkVal, $recache);

    }


    /**
     * 得到所有数据
     * @param $where
     * @param string $field
     * @param null $order
     * @param null $listRows
     * @param bool $simple
     * @param array $config
     * @return array
     * @throws \think\exception\DbException
     */
    function getAllData($where=1, $field='*', $order=null, $listRows = null, $simple = false, $config = [], $more=false){


        $data = $this->alias('m')
            ->where($where)
            ->field($field)
            ->order($order);


        if($more && $this->slave_table){
            $data = $data->join(
                $this->slave_table.' s',
                'm.'.$this->getPk().'=s.'.$this->getPk()
            );
        }

        $data = $data->paginate($listRows, $simple, $config);

        $redata = $data->toArray();

        $redata['rows'] = array_column($redata['data'], null, $this->getPk() );

        unset($redata['data']);

        if(!$simple){
            $redata['page_str'] = $data->render();
        }

        return $redata;

    }


    /**
     * 设置排序
     * @param null $data
     * @return bool
     */
    function sortData($data=null){

        $data = $data ?: input('post.sort');

        if(!$data){
            $this->error = lang('param_error');
            return false;
        }

        foreach($data as $k=>$v){
            $this->update([
                'sort'=>$v
            ],[
                $this->getPk()=>$k
            ]);

        }

        return true;

    }


    /**
     * 删除数据
     * @param null $ids
     * @return bool
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    function delData($ids=null){

        $ids = $ids ?: input('ids/a');

        if(!$ids){

            $this->error = lang('param_error');
            return false;
        }

        $res = $this->destroy($ids);

        if($res){

            if($this->slave_table){
                db($this->slave_table)->delete($ids);
            }

            return $res;
        }

        $this->error = lang('del_fail');
        return false;

    }


    /**
     * 转换成现实数据
     * @param $data
     * @return mixed
     */
    function convShowData($data, $convert=[]){

        $convert = $convert ?: (
            empty(self::$rawField['convert']) ? [] : self::$rawField['convert']
        );

        if($data && $convert){

            foreach(self::$rawField['convert'] as $v){

                if(!empty($data[$v])){
                    $data[$v] = json_decode($data[$v], true);
                }

            }
        }


        return $data;

    }
}
<?php
namespace app\common\controller;

use app\common\lib\exception\ApiException;

use think\Controller;
use think\Exception;


class ApiBase extends Controller
{


    // 验证失败是否抛出异常
    protected $failException = true;

    protected $param = [];

    protected $mid = null;
    protected $member = null;

    function initialize()
    {
        // header("Access-Control-Allow-Origin: *");//上线要去掉（解决跨域问题）
        // header('Access-Control-Allow-Headers:x-requested-with,content-type,nosign');
        // 
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,nosign');

        header('Access-Control-Allow-Methods:POST');

        //得到请求参数
        $this->param = request()->param();

        unset($this->param['ver']);

        if(!request()->header('nosign') && config('api.verify_sign')){
            $this->checkSign();
        }else{  //如果不验证签名指定用户登录
            //todo
            $this->param['uid'] =   '';

        }
        

        $Login = array(
            //用户
            'members:editpass','members:editnick','members:edittele','members:memberinfo','members:uploadhead',
            'members:setaccounttocash','members:signin','members:getsign','members:jifen','members:wxupdate',
            'members:bindtao','members:unbindTao','members:unbindtao','members:myfans','members:duiJifen',

            //收藏
            'collections:addcollect','collections:getcollect','collections:cancelcollect',

            //点赞
            'praise:praise',

            //文章评论
            'articlecomments:sendcomment',

            //消息通知
            'messages:getamessage','messages:getmessage',

            //我的足迹
            'foots:getmarks',

            //学校
            'school:addschool','school:getschools',

            //快递订单
            'kuaidi:addkuaidi','kuaidi:kuaididetail','kuaidi:canclekuaidi','kuaidi:editkuaidi','kuaidi:getkuaidis',
            'kuaidi:qiangkuaidi','kuaidi:finishkuaidi','kuaidi:paykuaidi',


            //代理
            'agent:applyagent','agent:getagent','agent:getmyteam',

            //快递订单评论
            'kuaidicomment:addcomment',

            //用户地址
            'address:addaddress','address:editaddress','address:deleteaddress','address:getaddresss','address:setdefault',

            //红包
            'hongbao:gethongbao',

            //红包日志
            'hongbaolog:gethongbaologs',

            //淘宝订单
            'taobaoorder:getorders','taobaoorder:getorder',

            //商品浏览记录
            'tbview:addtbview',

        );


        $controller = substr(request()->controller(),strrpos(request()->controller(),'.'));

        $conAct = strtolower( ltrim($controller,".").':'.request()->action());

        //判断登录
        $header = request()->header();
       
        if (!empty($header['uid'])) {
            $this->mid = sys_auth($header['uid'], false);

            if($this->mid){
                $this->member = model('member')->getBasicInfo($this->mid);
            }
        }else{
            $this->mid = null;
        }

        //检查是否登陆
        if(in_array($conAct, $Login) && !$this->mid){
            throw new ApiException(403, 999, '请登录......！');
        }




    }


    /**
     * 检查签名是否正确
     */
    private function checkSign(){


        $header = request()->header();


        //参数不全
        if(empty($header['app']) || empty($header['timestamp']) || empty($header['sign']) ){

            throw new ApiException( 400, 100, 'missing_verify_args');

        }


        //判断时间戳过去
        if( ($_SERVER['REQUEST_TIME'] - (int)$header['timestamp']) > config('api.request_max_time') ){
        //    throw new ApiException(400, 101, 'request_max_time');
        }

        //得到secret
        $secrets = config('api.secrets');

        //key不存在
        if(empty($secrets[$header['app']])){
            throw new ApiException(400, 102, 'app_invalid');
        }





        //加入其它参数
        $this->param['app'] = $header['app'];
        $this->param['timestamp'] = $header['timestamp'];

        if(array_key_exists('uid', $header)){
            $this->param['uid'] =   $header['uid'];
        }

        unset($this->param['sign']);


        ksort($this->param);

        $sign = strtoupper(md5(http_build_query($this->param).'&secret='.$secrets[$header['app']]));

        $get = input('get.');
        $post = input('post.');

        //验证签名
        if($header['sign'] != $sign){
            throw new ApiException( 400, 103, 'sign_error：'.http_build_query($this->param).'&secret='.$secrets[$header['app']], compact('header', 'get', 'post', 'param'));
        }


    }



    function suc($data = [], $httpCode = 200, $code = 0, $msg = 'ok'){

        return apisuc($data, $httpCode, $code, $msg);
    }


    function err($httpCode = 400, $code = 999, $msg = '', $data=[]){
        return apierr($httpCode, $code, $msg, $data);
    }


}
<?php
namespace app\index\controller;
use app\common\controller\IndexBase;
class Identity extends IndexBase
{

    //实名人证页面
    public function index()
    {
        if (request()->isPost()) {
            $params = input('post.');
            if(empty($params['member_id']) || empty($params['fullname']) || empty($params['idcard'])){
                return $this->error('参数错误');
            }
            //已经认证过的人提示，不能重新认证
            if($this->member['identity_is'] == 1){
                return $this->error('已实名认证');
            }

            $member_id = $this->member['member_id'];
            $where[] = ['delete','=',0];
            $where[]=['member_id','=',$member_id];
            //上传图片
            $model = model('attachment');
            $res = $model->upload($_FILES['file']);
            if($res){
                $data['identity_img'] = $res;
            }else{
                return $this->error('没有获取到身份证图片');
            }
            $data['fullname'] = $params['fullname'];
            $data['idcard'] = $params['idcard'];

            $update =db('member')->where($where)->update($data);
            //提交前进行验证
            $p = [
                'idcard' => $data['idcard'],
                'name'   => $data['fullname'],
                'img'    => $this->base64EncodeImage($data['identity_img'])
            ];
            if(!$this->checkN($p)){
                return $this->error('身份证信息不符');
            }
            if($update){
                return $this->success('提交成功','Identity/index');
            }else{
                return $this->error('提交失败');
            }
        }else{

            $member_id = $this->member['member_id'];
            if(empty($member_id)){
                return $this->error('参数错误');
            }
            $where[]=['member_id','=',$member_id];
            $where[] = ['delete','=',0];
            $member = db('member')->where($where)->find();
            //判断是否已经验证验证后不进入验证页面提示
            if($member['identity_is'] == 1){
                return $this->error('已实名认证');
            }else{
                $this->assign('member', $member);
                return $this->fetch();
            }

        }
    }
    private function checkN($p = null){
        $host = "https://sfzsmrz.market.alicloudapi.com";
        $path = "/v2/id_check";
        $method = "GET";
        $appcode = "81b70175a9484ef8a3e28330002bb78e";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "idcard=".$p['idcard']."&name=".$p['name'];
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
//        dump(curl_exec($curl));
//        exit;
        $res = json_decode(curl_exec($curl),true);
        if(empty($res['data']['description'])){
            return false;
        }
        if($res['data']['description'] == "一致"){
            $host = "https://yixi.market.alicloudapi.com";
            $path = "/ocr/idcard";
            $method = "POST";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
            $querys = "";
            $bodys = "image=".$p['img']."&side=front";
            $url = $host . $path;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$".$host, "https://"))
            {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
            $ret2 = json_decode(curl_exec($curl),true);
            if($ret2['code'] == 200 && $ret2['data']['姓名'] == $p['name'] && $ret2['data']['公民身份号码'] == $p['idcard']){
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }
    private function base64EncodeImage ($image_file) {
        $image_file = $_SERVER['DOCUMENT_ROOT'].$image_file;
        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image =  chunk_split(base64_encode($image_data));
        return $base64_image;
    }
}
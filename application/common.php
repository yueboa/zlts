<?php



/**
 * 助手函数
 */
function vars($name, $recache=false){

    static $vars = [];

    $name = explode('.', $name);

    $key = empty($name[1]) ? '' : $name[1];

    $name = $name[0];

    if($recache || !isset($vars[$name])){
        $vars[$name] = model('vars')->getOneCache($name, $recache);
    }

    if($key){
        return empty($vars[$name][$key]) ? null : $vars[$name][$key];
    }

    return $vars[$name];

}


/*
 * 返回指定长度的随机数
 */
function get_random($length=6,$type=0){

    switch($type) {
        case 1:
            $chars = '0123456789';
            break;
        case 2: //字母
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;

        case 3: //数字和字母
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;

        default:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*()_+-*/=<>?|';
            break;
    }

    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;

}



function encry_pwd($str,$encrypt=''){
    return md5(md5(sha1($encrypt.md5($str).$encrypt)));
}


function replace_rn($str){
    return str_replace(["\r\n","\n"],'',$str);
}


/**
 *
 * @param bool $msec 只返回毫秒
 * @return float
 */
function msec_time($remsec=false) {

    list($msec, $sec) = explode(' ', microtime());

    if($remsec) return round($msec*1000, 0);

    return round(($sec + $msec ) * 1000,0);
}



/**
 * curl类函数
 */
//post方式提交获取数据
function curl_post($url='', $postdata='', $second=30, $options=array()){

    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);

    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    //  curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
    //设置header
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    if(isset($options['cert']) && is_array($options['cert'])){
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT, $options['cert']['cert']);
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY, $options['cert']['key']);
    }

    //post提交方式
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //运行curl
    $data = curl_exec($ch);

    //返回结果
    if($data){
        curl_close($ch);
        return $data;
    } else {
        $error = curl_errno($ch);
        curl_close($ch);
        return $error;
    }

}

//get方式提交获取数据
function curl_get($url='',$postdata='', $options=array()){

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    if($postdata){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    }

    if (!empty($options)){
        curl_setopt_array($ch, $options);
    }
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


/**
 * 字符串加密、解密函数
 * @param	string	$txt		字符串
 * @param	string	$operation	true为加密，false为解密，可选参数，默认为ENCODE，
 * @param	string	$key		密钥：数字、字母、下划线
 * @param	string	$expiry		过期时间
 * @return	string
 */
function sys_auth($string, $operation = true, $key = '', $expiry = 0) {
    $ckey_length = 4;
    $key = md5($key != '' ? $key : ' h u h a n g n e t ');
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? (!$operation ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);

    $string = !$operation ? base64_decode(strtr(substr($string, $ckey_length), '-_', '+/')) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if(!$operation) {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.rtrim(strtr(base64_encode($result), '+/', '-_'), '=');
    }
}



/**
 * 输出xml字符
 * @throws WxPayException
 **/
function arr2xml($arr)
{
    $xml = '<xml>';
    if(is_array($arr) && count($arr) > 0) {

        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
    }
    $xml.='</xml>';

    return $xml;

}

/**
 * 将xml转为array
 * @param string $xml
 * @throws WxPayException
 */
function xml2arr($xml){

    if($xml){
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

    }

    return [];

}



/**
 * 反转义tp的自动转义
 * @param $data
 * @return array|string
 */
function filter_decode($data){

    if(is_array($data)){
        $re = [];
        foreach ($data as $k=>$v){
            $re[$k] = filter_decode($v);
        }

        return $re;
    }elseif(is_string($data)){
        return htmlspecialchars_decode($data);
    }else{
        return $data;
    }

}


/**
 * text中的按换行分割数组
 * @param $str
 * @return array
 */
function rn_explode($str){
    return explode("\n", $str);
}



/**
 * 截取字符串，中文按字数
 * @param $str
 * @param $len
 * @param int $from
 * @param string $suffix
 * @return mixed|string
 */
function strcut($str, $len, $from=0, $suffix='…')
{
    $re = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
        '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
        '$1',$str);
    return $re == $str ? $re : $re.$suffix;
}


function strip_html($var){

    if(is_string($var)){
        return strip_tags($var);
    }elseif(is_array($var)){
        foreach($var as $k=>$v){
            $var[$k] = strip_html($v);
        }
    }

    return $var;

}




function filter_emoji($text, $replaceTo = '?')
{
    $clean_text = "";
    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, $replaceTo, $text);
    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, $replaceTo, $clean_text);
    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, $replaceTo, $clean_text);
    // Match Miscellaneous Symbols
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, $replaceTo, $clean_text);
    // Match Dingbats
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, $replaceTo, $clean_text);
    return $clean_text;
}


function toTree($data,$pid=0){

    static $tree = array();

    foreach ($data as $key => &$value) {

        if ($value['pid'] == $pid) {
            $parant = getParant($data,$pid);
            $value['content'] = $value['content']."//@:".$parant['username'].$parant['content'];
            // $value['son'] = toTree($data,$value['id']);
            $tree[] = $value;
            toTree($data,$value['id']);
        }
    }
    return $tree;
    
}

function getParant($data,$pid){
    foreach ($data as $key => $value) {
        if ($value['id'] == $pid) {
            return $value;
        }
    }
}

function getSon($data,$id){
    static $i = 0;
    static $result = [];
    foreach ($data as $key => $value) {
        if ($value['pid'] == $id) {
            $i += 1;
            $result[] = $value;
            getSon($data,$value['id']);
        }
    }
    return $result;
}


function treeNum($data,$pid = 0){
    static $tree = array();
    foreach ($data as $key => &$value) {
        if ($value['pid'] == 0) {
            $value['num'] = count(getSon($data,$value['id']));
            $tree[] = $value;        
        }

    }

    return $tree;
}



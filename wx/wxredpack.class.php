<?php
/********************************************************
 * @author 李优
 * @date 2015-09-10
 * 单例模式
 * @uses 用new实例化private标记构造函数的类会报错:$danli = new WxRedpack();
 * 正确方法：用双冒号::操作符访问静态方法获取实例:$danli = WxRedpack::getInstance();$danli->test();
 * 复制(克隆)对象将导致一个E_USER_ERROR：$danli_clone = clone $danli; 
********************************************************/

//引入数据库文件
//require_once("../config.php");
//require_once("DbConnection.php");

class WxRedpack {
	//保存类实例的静态成员变量
	private static $_instance;
	
	public static $wechat_config;
	
	private function __construct(){
		//连接数据库
		//$this->db_conn = MongoDbConn::getInstance();
	}
	
	//创建__clone方法防止对象被复制克隆
	public function __clone(){
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}
	
	//单例方法,用于访问实例的公共的静态方法
	public static function getInstance($wechat_config){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self;
		}
		
		self::$wechat_config = $wechat_config;
		
		return self::$_instance;
	}
	
	/****************************************************
     * 获取网页授权的access_token和openid
	 * @author 鹏程
     * @param string $code 
    ****************************************************/
   	public function getWxUserOpenId($code){
		//调用微信用户基本信息接口
       	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.self::$wechat_config['app_id'].'&secret='.self::$wechat_config['app_secret'].'&grant_type=authorization_code&code='.$code;
       	
       	return $this->wxHttpsRequest($url);
   	}
	
	/****************************************************
     * 获取微信用户详细信息
	 * @author 鹏程
     * @param string $access_token 授权的全局token
     * @param string $openid 微信用户的openid
    ****************************************************/
   	public function getWxUserInfo($access_token,$openid){
		//调用微信用户信息接口
       	$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN"';
       	
       	return $this->wxHttpsRequest($url);
   	}

	/****************************************************
	 * 微信提交API方法，返回数组格式
	 * @author 鹏程
	 * @param  $url  调用微信API接口地址
	****************************************************/
	
	public function wxHttpsRequest($url){
		$ch = curl_init(); //开启curl连接
		
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    $output = curl_exec($ch);
		
	    $output = (array)json_decode($output);
	    $output = (array)$output;
		
	    curl_close($ch); //关闭curl连接
		
	    //返回信息
	    return $output;
	}
	
	/*******************************************************
	 * 调用微信红包发送接口
	 * @author 李优
	 * @param  $openid  微信用户openid
	 * @param  $money   提现金额  单位元
	*******************************************************/
	
	public function wxRedpackSendApi($openid = null,$money = null){
		if(empty($openid) || empty($money)){
			throw new Exception("参数错误！");
		}
		
		self::$wechat_config['nonce_str'] 		= $this->wxNonceStr(20); //随机字符串，不长于32位
		self::$wechat_config['openid'] 			= $openid; //接受红包的用户 openid
		self::$wechat_config['total_amount'] 	= $money * 100; //提现金额，单位分
		self::$wechat_config['total_num'] 		= 1; //红包发放人数必须为1
		self::$wechat_config['client_ip'] 		= $_SERVER['SERVER_ADDR']; //调用接口的机器Ip地址
		self::$wechat_config['mch_billno'] 		= $this->wxMchBillno(self::$wechat_config['mch_id']); //商户订单号
		
		//获取签名
		$signature = $this->getWxRedpackSignature(self::$wechat_config,'send');
			
		$xml = "<xml> 
				<sign><![CDATA[".$signature."]]></sign> 
				<mch_billno><![CDATA[".self::$wechat_config['mch_billno']."]]></mch_billno> 
				<mch_id><![CDATA[".self::$wechat_config['mch_id']."]]></mch_id> 
				<wxappid><![CDATA[".self::$wechat_config['app_id']."]]></wxappid> 
				<send_name><![CDATA[".self::$wechat_config['send_name']."]]></send_name> 
				<re_openid><![CDATA[".$openid."]]></re_openid> 
				<total_amount><![CDATA[".self::$wechat_config['total_amount']."]]></total_amount> 
				<total_num><![CDATA[1]]></total_num> 
				<wishing><![CDATA[".self::$wechat_config['wishing']."]]></wishing> 
				<client_ip><![CDATA[".self::$wechat_config['client_ip']."]]></client_ip> 
				<act_name><![CDATA[".self::$wechat_config['act_name']."]]></act_name> 
				<remark><![CDATA[".self::$wechat_config['remark']."]]></remark> 
				<nonce_str><![CDATA[".self::$wechat_config['nonce_str']."]]></nonce_str> 
			</xml>";
		
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack'; //调用微信红包发送接口
		
		//带数据验证证书
		$response = $this->curlPostCA($xml,$url);
		
		if(empty($response)){
			//echo '验证失败';
			//return false;
			throw new Exception("验证失败！");
		}else{
			return $response;
		}
	}
	
	/*******************************************************
	 * 调用微信红包查询接口 -根据商户订单号查询
	 * @author 李优
	 * @param string $mch_billno  商户发放红包的商户订单号
	*******************************************************/
	
	public function wxRedpackQueryApi($mch_billno = null){
		if(empty($mch_billno)){
			throw new Exception("参数错误！");
		}
		
		self::$wechat_config['nonce_str'] 	= $this->wxNonceStr(20); //随机字符串，不长于32位
		self::$wechat_config['mch_billno'] 	= $mch_billno; //商户订单号
		self::$wechat_config['bill_type'] 	= 'MCHT'; //通过商户订单号获取红包信息
		
		//获取签名
		$signature = $this->getWxRedpackSignature(self::$wechat_config,'query');
			
		$xml = "<xml> 
			<sign><![CDATA[".$signature."]]></sign> 
			<mch_billno><![CDATA[".self::$wechat_config['mch_billno']."]]></mch_billno> 
			<mch_id><![CDATA[".self::$wechat_config['mch_id']."]]></mch_id> 
			<appid><![CDATA[".self::$wechat_config['app_id']."]]></appid> 
			<bill_type><![CDATA[".self::$wechat_config['bill_type']."]]></bill_type> 
			<nonce_str><![CDATA[".self::$wechat_config['nonce_str']."]]></nonce_str> 
		</xml>";
		
		//调用微信红包查询接口地址
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo'; 
		
		//带数据验证证书
		$response = $this->curlPostCA($xml,$url);
		
		if(empty($response)){
			//echo '验证失败';
			//return false;
			throw new Exception("验证失败！");
		}else{
			return $response;
		}
	}
	
	/*****************************************************
	 * 生成随机字符串 - 最长为32位字符串
	 * @param  $length - 长度
	 * @param  $encrypt - 是否加密
	 * @author 李优
	*****************************************************/
	public function wxNonceStr($length = 16, $encrypt = false) {
		$string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			
		$str = '';
		for($i=0;$i<$length;$i++){
			$str .= $string[mt_rand(0,strlen($string)-1)];
		}
		
		$randstr = str_shuffle($str);
		
		if($encrypt == true){
			return md5($randstr);
		}else{
			return $randstr;
		}
	}
	
	/*******************************************************
	 * 微信商户订单号 - 最长28位字符串（每个订单号必须唯一） 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。
	 * @param $mch_id - 微信支付分配的商户号
	 * @param $length - 长度
	 * @author 李优
	*******************************************************/
	
	public function wxMchBillno($mch_id = null,$length = 10) {
		if(empty($mch_id)){
			throw new Exception("商户号不能为空！");
		}
		
		$string = "0123456789";
			
		$str = '';
		for($i=0;$i<$length;$i++){
			$str .= $string[mt_rand(0,strlen($string)-1)];
		}
		
		$orderno = str_shuffle($str);
		$date = date('Ymd',time());
		
		$orderno = $mch_id.$date.$orderno;
		
		return $orderno;
		
		/*
		//验证订单号是否唯一
	    $res = $this->db_conn->getDatabase()->merchant_cashs->findOne(array('mch_billno' => $orderno));
		
		if(!empty($res)){
			//重新生成订单号
			$this->wxMchBillno($mch_id);
		}else{
			return $orderno;
		}*/
	}
	
	/*******************************************************
	 * 生成签名  注意非空参数按ASCII码从小到大排序，使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串，然后拼接密钥，md5加密，变大写
	 * @author 李优
	 * @param $data array
	 * @param $type 签名类型(发送红包和查询红包)
	*******************************************************/
	public function getWxRedpackSignature($data,$type){
		if(empty($data) || !is_array($data) || empty($type)){
			throw new Exception("参数错误！");
		}
		
		if($type == 'send'){
			$signstr = "act_name=".$data['act_name']."&client_ip=".$data['client_ip']."&mch_billno=".$data['mch_billno']."&mch_id=".$data['mch_id']."&nonce_str=".$data['nonce_str']."&re_openid=".$data['openid']."&remark=".$data['remark']."&send_name=".$data['send_name']."&total_amount=".$data['total_amount']."&total_num=".$data['total_num']."&wishing=".$data['wishing']."&wxappid=".$data['app_id'];
		}
		
		if($type == 'query'){
			$signstr = "appid=".$data['app_id']."&bill_type=".$data['bill_type']."&mch_billno=".$data['mch_billno']."&mch_id=".$data['mch_id']."&nonce_str=".$data['nonce_str'];
		}
		
		$signMD5 = $signstr."&key=".$data['app_key'];
			
		return strtoupper(md5($signMD5));
	}
	
	/*******************************************************
	 * 带证书请求微信红包接口
	 * @author 李优
	 * @param $second 超时时间
	 * @param $xml 要解析的xml数据
	 * @param $url 请求的微信接口地址
	*******************************************************/
	public function curlPostCA($xml,$url,$second = 30){
		$ch = curl_init();//初始化curl
		
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);//超时时间
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
		curl_setopt($ch, CURLOPT_URL, $url);//设置链接
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		
		//cert 与 key 分别属于两个.pem文件   默认格式为PEM
		curl_setopt($ch,CURLOPT_SSLCERT,self::$wechat_config['apiclient_cert']);
		curl_setopt($ch,CURLOPT_SSLKEY,self::$wechat_config['apiclient_key']);
		curl_setopt($ch,CURLOPT_CAINFO,self::$wechat_config['rootca']); 
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-type: text/xml');//设置HTTP头
		curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);//POST数据
		$response = curl_exec($ch);//接收返回信息
		
		curl_close($ch); //关闭curl链接
		
		if($response){
			return $response;
		}else{
			//如果有错误 在curl_close($ch)关闭之前 打印 curl_errno($ch)的值即可
			return false;
		}
	}
	
}
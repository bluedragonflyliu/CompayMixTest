<?php 
class Myapi
{
	private $corpId = "wxa8d6419df2e03d86";
	private $Secret = '9b0Yq02vDmxT_uJvD_0fGjNx9rlnoVe728-VOJDz0eFn-7lR4go3iNaGGHfDdwV5';
	private $kv 	= null;
	public  $access_token = null;

	public function __construct()
	{
		$this->kv = new SaeKV();
		// 初始化SaeKV对象
		$this->kv->init(); 
		$this->GetToken();
	}
	public function httpRequest( $url, $data=null )
	{	
		$ret = array();
		$ch  = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		if(!empty( $data ))
		{	
			curl_setopt( $ch, CURLOPT_POST,1 );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
		}

		$output = curl_exec( $ch );
		$ret['output'] = $output;
		$ret['error']  = curl_errno($ch);
		curl_close( $ch );
		return $ret;
	}

	private function GetToken()
	{
		

		$begin_time = $this->kv->get( 'begin_time' );

		if (empty($this->access_token) || (time()+30-$begin_time) > 7200) {
			$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . $this->corpId . "&corpsecret=" .$this->Secret;
			$res = $this->httpRequest($url);
			if ($res['error']) 
			{ 
			    print "Error: " . $res['error']; 
			} else { 
			    // Show me the result 
				$result 	  = json_decode($res['output'], true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
				$begin_time	  =	time();
				$expires	  = $result['expires_in'];
				$this->access_token = $result['access_token'];
				$this->kv ->set('begin_time',$begin_time);
				// 更新key-value
				$this->kv->set('access_token', $this->access_token);
				echo ($this->access_token).'<br />';
			} 
			
		} else {
			$this->access_token = $this->kv->get('access_token');
			echo ($this->access_token).'<br />';
		}
	}

}
	
?>
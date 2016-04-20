<?php
//添加腾讯提供的接口文件
include_once "./wx/WXBizMsgCrypt.php";
//设置自己企业号的相关参数
$encodingAesKey	= "wPEAOI0zPjxQDz7GPOJYGQk7p4ShUdwqfQ8XXVpnd8f";
$corpId 		= "wxa8d6419df2e03d86";
$token 			= "8LBBv";
$Secret 		= '9b0Yq02vDmxT_uJvD_0fGjNx9rlnoVe728-VOJDz0eFn-7lR4go3iNaGGHfDdwV5';
//获取待验证的参数
$sVerifyMsgSig 		= $_GET['msg_signature'];
$sVerifyTimeStamp 	= $_GET['timestamp'];
$sVerifyNonce 		= $_GET['nonce'];

if(isset($_GET['echostr'])) {
	$sVerifyEchoStr = $_GET['echostr'];
	verifyinfo();
}else{
	responseMsg($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce,$token,$corpId,$encodingAesKey);
}
function verifyinfo(){
	$wxcpt = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
	if($sVerifyEchoStr){
		$sEchoStr = "";
		$errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
			print($sEchoStr);
		} else {
			print($errCode . "\n\n");
		}
		exit;
	}


function  responseMsg($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce,$token,$corpId,$encodingAesKey){
	$sReqData = $GLOBALS["HTTP_RAW_POST_DATA"];
	$kv = new SaeKV();
	// 初始化SaeKV对象
	$ret = $kv->init(); //访问授权应用的数据

	$kv->set('data',$sReqData);
	$sMsg 	  = "";  //解析之后的明文  
	$wxcpt 	  = new WXBizMsgCrypt($token, $encodingAesKey, $corpId);
	$errCode  = $wxcpt->DecryptMsg($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sReqData, $sMsg);
	$kv->set('msg',$sMsg);
	if ($errCode == 0) {
		 libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($sMsg, 'SimpleXMLElement', LIBXML_NOCDATA);
		
		$reqToUserName 	 = $postObj->FromUserName;
		$reqFromUserName = $postObj->ToUserName;
		$reqMsgType 	 = $postObj->MsgType;
		$reqContent 	 = $postObj->Content;
		$reqMsgId 		 = $postObj->MsgId;
		$reqAgentID 	 = $postObj->AgentID; 
		switch($reqContent){
			case "马云":
			$mycontent="您好，马云！我知道您创建了阿里巴巴！";
			break;
			case "马化腾":
			$mycontent="您好，马化腾！我知道创建了企鹅帝国！";
			break;
			case "史玉柱":
			$mycontent="您好，史玉柱！我知道您创建了巨人网络！";
			break;
			default :
			$mycontent="你是谁啊？！一边凉快去！";
			break;  
		}
		$sRespData ='';
		"<xml>
		<ToUserName><![CDATA[".$reqToUserName."]]></ToUserName>
		<FromUserName><![CDATA[".$reqFromUserName."]]></FromUserName>
		<CreateTime>".time()."</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[".$mycontent."]]></Content>
		</xml>";  
		$sEncryptMsg = ""; //xml格式的密文
		$errCode = $wxcpt->EncryptMsg($sRespData, $sVerifyTimeStamp, $sVerifyNonce, $sEncryptMsg);
		if ($errCode == 0) {
		//file_put_contents('smg_response.txt', $sEncryptMsg); //debug:查看smg  
			print($sEncryptMsg);
		} else {  
			print($errCode . "\n\n");
		}
	} else {
		print($errCode . "\n\n");
	}
}


	
?>
public function responseMsg()
    {
    
    //接收微新传过来的xml消息数据    
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

    //如果接收到了就处理并回复
    if (!empty($postStr)){
        //将接收到的XML字符串写入日志， 用R标记表示接收消息
        $this->logger("R \n".$postStr);
        //将接收的消息处理返回一个对象
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $kv->set('time',time());
        //从消息对象中获取消息的类型 text  image location voice vodeo link 
            $RX_TYPE = trim($postObj->MsgType);
             
            //消息类型分离, 通过RX_TYPE类型作为判断， 每个方法都需要将对象$postObj传入
            switch ($RX_TYPE)
            {
                case "text":
                    $result = $this->receiveText($postObj);     //接收文本消息
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);   //接收图片消息
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);  //接收位置消息
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);   //接收语音消息
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);  //接收视频消息
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);  //接收链接消息
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;   //未知的消息类型
                    break;
        }
        //将响应的消息再次写入日志， 使用T标记响应的消息！
            $this->logger("T \n".$result);
        //输出消息给微新
        echo $result;
    }else {
        //如果没有消息则输出空，并退出
            echo "";
            exit;
        }
    }

  

    //接收文本消息
    private function receiveText($object)
    {
    //从接收到的消息中获取用户输入的文本内容， 作为一个查询的关键字， 使用trim()函数去两边的空格
        $keyword = trim($object->Content);
    
            //自动回复模式
             if (strstr($keyword, "文本")){
             $content = "这是个文本消息";

         } else if (strstr($keyword, "单图文")){

                $content = array();
        $content[] = array("Title"=>"小规模低性能低流量网站设计原则",  "Description"=>"单图文内容", "PicUrl"=>"http://ipalm.sinaapp.com/images/aa.jpg", "Url" =>"http://ipalm.sinaapp.com/images/sample.php");

            } else if (strstr($keyword, "图文") || strstr($keyword, "多图文")){
                $content = array();
                $content[] = array(
                	"Title"		  =>"多图文1标题", 
                	"Description" =>"动手构建站点的时候。", 
                	"PicUrl"	  =>"http://ipalm.sinaapp.com/images/Desert.jpg", 
                	"Url" 		  =>"http://ipalm.sinaapp.com/images/sample.php"
                	);
                $content[] = array(
                	"Title" 	  => "多图文2标题",
                	"Description" => "不要到处去问别人该用什么",
                	"PicUrl"	  => "http://ipalm.sinaapp.com/images/Chrysanthemum.jpg", 
                	"Url" 		  => "http://ipalm.sinaapp.com/images/sample.php"
                	);
                $content[] = array(
                	"Title"		  => "多图文3标题",
                	"Description" => "黄花菜可能都凉了。",
                	"PicUrl"	  => "http://ipalm.sinaapp.com/images/Koala.jpg",
                	"Url"  		  => "http://ipalm.sinaapp.com/images/sample.php"
                	);
            } else if (strstr($keyword, "音乐")){
                $content = array();
                $content = array(
                	"Title"		  => "小歌曲你听听",
                	"Description" => "歌手：不是XXX",
                	"MusicUrl"    => "http://ipalm.sinaapp.com/audios/连丽如_大隋唐_001.mp3",
                	"HQMusicUrl"  => "http://ipalm.sinaapp.com/audios/连丽如_大隋唐_001.mp3"
                	);
            } else {
            	$content = date("Y-m-d H:i:s",time())."\n技术支持 XXX";
            }
            
            if(is_array($content)){
                if (isset($content[0]['PicUrl'])){
                    $result = $this->transmitNews($object, $content);
                }else if (isset($content['MusicUrl'])){
                    $result = $this->transmitMusic($object, $content);
                }
            }else{
                $result = $this->transmitText($object, $content);
            }
     
        $kv = new SaeKV();
        // 初始化SaeKV对象
        $kv->init(); 
       
        
         try {
             $error  = $kv->set('result',$result);
            throw new  Exception ( $error );
         
        } catch ( Exception $e ) {
           $kv->set('error',$error);
        }
        
        return $result;
    }

    //接收图片消息
    private function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }

    //接收位置消息
    private function receiveLocation($object)
    {
        $content = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //接收语音消息
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }

        return $result;
    }

    //接收视频消息
    private function receiveVideo($object)
    {
        $content = array("MediaId"=>$object->MediaId, "Title"=>"this is a test", "Description"=>"pai pai");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }

    //接收链接消息
    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    //回复文本消息
    private function transmitText($object, $content)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    //回复图片消息
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
    <MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复语音消息
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
    <MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复视频消息
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
    <MediaId><![CDATA[%s]]></MediaId>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['Title'], $videoArray['Description']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
	
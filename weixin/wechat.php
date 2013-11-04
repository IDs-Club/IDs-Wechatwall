<?php
header("content-Type: text/html; charset=utf-8");
/*
    File: wechat.php
    Author: 管理员
    Date: 2013.05.14
    Usage: 小九机器人微信接口
 */

class Wechat
{
    static $req_keys = array( "Content", "CreateTime", "FromUserName", "Label", 
            "Location_X", "Location_Y", "MsgType", "PicUrl", "Scale", "ToUserName", "MusicUrl","HQMusicUrl","Event","EventKey");
    public $token;
    public $request = array();

    protected $funcflag = false;
    protected $debug = false;

    public function __construct($token, $debug = false)
    {
        $this->token = $token;
        $this->debug = $debug;
    }

    public function get_msg_type()
    {
        return strtolower($this->request['MsgType']);
    }
	
    public function get_event_type()
    {
        return strtolower($this->request['Event']);
    }
	
	public function get_event_key()
    {
        return strtolower($this->request['EventKey']);
    }
	
		public function get_creattime()
    {
        return strtolower($this->request['CreateTime']);
    }
	
	
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function set_funcflag()
    {
        $this->funcflag = true;
    }

    public function replyText($message)
    {
        $textTpl = <<<eot
<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[%s]]></MsgType>
    <Content><![CDATA[%s]]></Content>
    <FuncFlag>%d</FuncFlag>
</xml>
eot;
        $req = $this->request;
        return sprintf($textTpl, $req['FromUserName'], $req['ToUserName'],
                time(), 'text', $message, $this->funcflag ? 1 : 0);

    }
    
 public function replyNews($arr_item)
    {
        $itemTpl = <<<eot
        <item>
            <Title><![CDATA[%s]]></Title>
            <Discription><![CDATA[%s]]></Discription>
            <PicUrl><![CDATA[%s]]></PicUrl> 
            <Url><![CDATA[%s]]></Url>
        </item>

eot;
        $real_arr_item = $arr_item;
        if (isset($arr_item['title']))
            $real_arr_item = array($arr_item); 

        $nr = count($real_arr_item);
        $item_str = "";
        foreach ($real_arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['title'], $item['description'],
                    $item['pic'], $item['url']);

        $time = time();
        $fun = $this->funcflag ? 1 : 0;

        return <<<eot
<xml>
    <ToUserName><![CDATA[{$this->request['FromUserName']}]]></ToUserName>
    <FromUserName><![CDATA[{$this->request['ToUserName']}]]></FromUserName>
    <CreateTime>{$time}</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <Content><![CDATA[]]></Content>
    <ArticleCount>{$nr}</ArticleCount>
    <Articles>
$item_str
    </Articles>
    <FuncFlag>{$fun}</FuncFlag>
</xml> 
eot;
    }
    public function replyMusic($arr_item)
    {
        $itemTpl = <<<eot
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <MusicUrl><![CDATA[%s]]></MusicUrl> 
            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>      

eot;
        $real_arr_item = $arr_item;
        if (isset($arr_item['title']))
            $real_arr_item = array($arr_item); 
      $item_str = "";
        foreach ($real_arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['title'], $item['description'],
            $item['murl'], $item['hqurl']);

        $time = time();
        $fun = $this->funcflag ? 1 : 0;

        return <<<eot
<xml>
    <ToUserName><![CDATA[{$this->request['FromUserName']}]]></ToUserName>
    <FromUserName><![CDATA[{$this->request['ToUserName']}]]></FromUserName>
    <CreateTime>{$time}</CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    <Music>
{$item_str}
    </Music>
    <FuncFlag>{$fun}</FuncFlag>
</xml> 
eot;
    }

    public function reply($callback)
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                
           
        if ($this->debug)
          //     file_put_contents("request.txt", $postStr);

        if(empty($postStr) || !$this->checkSignature())
            die("该程序是微信接口程序,请在公众平台配置本页地址为url后测试!");

        $this->request = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

        $arg = call_user_func($callback, $this->request, $this);

        if (!is_array($arg))
        {
         $ret = $this->replyText($arg);
        }      
        elseif(array_key_exists("murl",$arg))
        {
            $ret = $this->replyMusic($arg);
        }else{
        
         $ret = $this->replyNews($arg);
        }

        if ($this->debug)
            file_put_contents("response.txt", $ret);
        echo $ret;
    }

	private function checkSignature()
	{
        $args = array("signature", "timestamp", "nonce");
        foreach ($args as $arg)
            if (!isset($_GET[$arg]))
                return false;

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$tmpArr = array($this->token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
public function biaoqing($content)
    {
	    if(strstr($content,"/:")){
        if(preg_match("/\/::\)/",$content)){

        $content = "笑话";
          
        }
        elseif(preg_match("/\/::~/",$content)){

        $content = "撇嘴";

        }
        elseif(preg_match("/\/::B/",$content)){

        $content = "色";

        }
        elseif(preg_match("/\/:,@f/",$content)){

        $content = "奋斗";

        }
        elseif(preg_match("/\/:heart/",$content)){

        $content = "爱心";

        }
        elseif(preg_match("/\/:showlove/",$content)){

        $content = "嘴唇";

        }
        elseif(preg_match("/\/:cake/",$content)){

        $content = "蛋糕";

        }
        elseif(preg_match("/\/:gift/",$content)){

        $content = "礼物";

        }
        elseif(preg_match("/\/:handclap/",$content)){

        $content = "鼓掌";

        }
        elseif(preg_match("/\/::\*/",$content)){

        $content = "亲亲";

        }
        elseif(preg_match("/\/:rose/",$content)){

        $content = "玫瑰";

        }
        elseif(preg_match("/\/:kiss/",$content)){

        $content = "献吻";

        }
        elseif(preg_match("/\/:love/",$content)){

        $content = "爱情";

        }
        elseif(preg_match("/\/:ok/",$content)){

        $content = "OK";

        }
        elseif(preg_match("/\/:lvu/",$content)){

        $content = "爱你";

        }
        elseif(preg_match("/\/:jj/",$content)){

        $content = "勾引";

        }
        elseif(preg_match("/\/:@\)/",$content)){

        $content = "抱拳";

        }
        elseif(preg_match("/\/:share/",$content)){

        $content = "握手";

        }
        elseif(preg_match("/\/:hug/",$content)){

        $content = "拥抱";

        }
        elseif(preg_match("/\/::\-O/",$content)){

        $content = "哈欠";

        }
        elseif(preg_match("/\/:xx/",$content)){

        $content = "敲打";

        }
        elseif(preg_match("/\/:\-\-b/",$content)){

        $content = "冷汗";

        }
        elseif(preg_match("/\/::X/",$content)){

        $content = "闭嘴";

        }
        elseif(preg_match("/\/:no/",$content)){

        $content = "NO";

        }
        elseif(preg_match("/\/::@/",$content)){

        $content = "发怒";

        }
        elseif(preg_match("/\/::\(/",$content)){

        $content = "难过";

        }
        elseif(preg_match("/\/::Q/",$content)){

        $content = "抓狂";

        }
        elseif(preg_match("/\/::T/",$content)){

        $content = "吐";

        }
        elseif(preg_match("/\/::d/",$content)){

        $content = "白眼";

        }
        elseif(preg_match("/\/::!/",$content)){

        $content = "惊恐";

        }
        elseif(preg_match("/\/::L/",$content)){

        $content = "流汗";

        }
        elseif(preg_match("/\/::\-S/",$content)){

        $content = "咒骂";

        }
        elseif(preg_match("/\/:,@@/",$content)){

        $content = "晕";

        }
        elseif(preg_match("/\/::8/",$content)){

        $content = "疯了";

        }
        elseif(preg_match("/\/:,@!/",$content)){

        $content = "衰";

        }
        elseif(preg_match("/\/:!!!/",$content)){

        $content = "骷髅";

        }
        elseif(preg_match("/\/:dig/",$content)){

        $content = "抠鼻";

        }
        elseif(preg_match("/\/:pd/",$content)){

        $content = "菜刀";

        }
        elseif(preg_match("/\/:pig/",$content)){

        $content = "猪头";

        }
        elseif(preg_match("/\/:fade/",$content)){

        $content = "凋谢";

        }
        elseif(preg_match("/\/:break/",$content)){

        $content = "心碎";

        }
        elseif(preg_match("/\/:li/",$content)){

        $content = "闪电";

        }
        elseif(preg_match("/\/:bome/",$content)){

        $content = "炸弹";

        }
        elseif(preg_match("/\/:kn/",$content)){

        $content = "刀";

        }
        elseif(preg_match("/\/:shit/",$content)){

        $content = "便便";

        }
        elseif(preg_match("/\/::\+/",$content)){

        $content = "酷";

        }
        elseif(preg_match("/\/:,@o/",$content)){

        $content = "傲慢";

        }
        elseif(preg_match("/\/:X-\)/",$content)){

        $content = "阴险";

        }
        elseif(preg_match("/\/:v/",$content)){

        $content = "胜利";

        }
        elseif(preg_match("/\/:turn/",$content)){

        $content = "回头";

        }
        elseif(preg_match("/\/:ladybug/",$content)){

        $content = "瓢虫";

        }
        elseif(preg_match("/\/:,@x/",$content)){

        $content = "嘘";

        }
        elseif(preg_match("/\/::,@/",$content)){

        $content = "悠闲";

        }
        elseif(preg_match("/\/:8-\)/",$content)){

        $content = "得意";

        }
        elseif(preg_match("/\/:#-0/",$content)){

        $content = "激动";

        }
        elseif(preg_match("/\/:kotow/",$content)){

        $content = "磕头";

        }
        elseif(preg_match("/\/:@x/",$content)){

        $content = "吓";

        }
        elseif(preg_match("/\/:8\*/",$content)){

        $content = "可怜";

        }
        elseif(preg_match("/\/:P-\(/",$content)){

        $content = "委屈";

        }
        elseif(preg_match("/\/:B-\)/",$content)){

        $content = "坏笑";

        }
        elseif(preg_match("/\/:&-\(/",$content)){

        $content = "糗大了";

        }
        elseif(preg_match("/\/:\?/",$content)){

        $content = "疑问";

        }
        elseif(preg_match("/\/::$/",$content)){

        $content = "害羞";

        }
        elseif(preg_match("/\/::P/",$content)){

        $content = "调皮";

        }
        elseif(preg_match("/\/::D/",$content)){

        $content = "呲牙";

        }
        elseif(preg_match("/\/::O/",$content)){

        $content = "惊讶";

        }
        elseif(preg_match("/\/:,@-D/",$content)){

        $content = "愉快";

        }
        elseif(preg_match("/\/:,@P/",$content)){

        $content = "偷笑";

        }
        elseif(preg_match("/\/::</",$content)){

        $content = "流泪";

        }
        elseif(preg_match("/\/:weak/",$content)){

        $content = "弱";

        }
        elseif(preg_match("/\/:<@/",$content)){

        $content = "左哼哼";

        }
        elseif(preg_match("/\/:@>/",$content)){

        $content = "右哼哼";
          
        }
        elseif(preg_match("/\/:wipe/",$content)){

        $content = "擦汗";

        }
        elseif(preg_match("/\/:@@/",$content)){

        $content = "拳头";

        }
        elseif(preg_match("/\/:bad/",$content)){

        $content = "差劲";

        }
        elseif(preg_match("/\/:shake/",$content)){

        $content = "发抖";

        }
        elseif(preg_match("/\/:moon/",$content)){

        $content = "月亮";

        }
        elseif(preg_match("/\/::Z/",$content)){

        $content = "睡";

        }
        elseif(preg_match("/\/:bye/",$content)){

        $content = "再见";

        }
        elseif(preg_match("/\/:beer/",$content)){

        $content = "啤酒";

        }
        elseif(preg_match("/\/::g/",$content)){

        $content = "饥饿";

        }
        elseif(preg_match("/\/:eat/",$content)){

        $content = "吃饭";

        }
        elseif(preg_match("/\/:coffee/",$content)){
        
        $content = "咖啡";

        }
        elseif(preg_match("/\/:sun/",$content)){

        $content = "太阳";

        }
        elseif(preg_match("/\/:hiphot/",$content)){

        $content = "街舞";

        }
        elseif(preg_match("/\/:footb/",$content)){

        $content = "足球";

        }
        elseif(preg_match("/\/:oo/",$content)){

        $content = "乒乓";

        }
        elseif(preg_match("/\/:basketb/",$content)){

        $content = "篮球";

        }
        elseif(preg_match("/\/:jump/",$content)){

        $content = "跳跳";

        }
        elseif(preg_match("/\/:circle/",$content)){

        $content = "转圈";

        }
        elseif(preg_match("/\/:skip/",$content)){

        $content = "跳绳";

        }
        elseif(preg_match("/\/:<&/",$content)){

        $content = "左太极";

        }
        elseif(preg_match("/\/:&>/",$content)){

        $content = "右太极";

        }
        elseif(preg_match("/\/:strong/",$content)){

        $content = "强";

        }
        elseif(preg_match("/\/::>/",$content)){

        $content = "憨笑";

        }
        elseif(preg_match("/\/:<L>/",$content)){

        $content = "飞吻";

        }
        elseif(preg_match("/\/::-\|/",$content)){

        $content = "尴尬";

        }
        elseif(preg_match("/\/:oY/",$content)){

        $content = "投降";

        }
        elseif(preg_match("/\/:>-\|/",$content)){

        $content = "鄙视";

        }
        elseif(preg_match("/\/::\|/",$content)){

        $content = "发呆";

        }
        elseif(preg_match("/\/:\<W\>/",$content)){

        $content = "西瓜";

        }
        elseif(preg_match("/\/:\|\-\)/",$content)){

        $content = "困";

        }
        elseif(preg_match("/\/:/",$content)){

        $content = "怄火";

        }
		}
        
      
	return $content;
    }
}
 function media($content) //多媒体转换
    {
		if(strstr($content,'murl')){//音乐
			$a=array();
			foreach (explode('#',$content) as $content)
			{
				list($k,$v)=explode('|',$content);
				$a[$k]=$v;
			}
			$content = $a;
		}              
		elseif(strstr($content,'pic'))//多图文回复
		{
			$a=array();
			$b=array();
			$c=array();
			$n=0;
			$contents = $content;
			foreach (explode('@t',$content) as $b[$n])
			{
			    if(strstr($contents,'@t'))
				{
				$b[$n] = str_replace("itle","title",$b[$n]);
				$b[$n] = str_replace("ttitle","title",$b[$n]);
				}
				
				foreach (explode('#',$b[$n]) as $content)
				{
					list($k,$v)=explode('|',$content);
					$a[$k]=$v;
					$d.= $k;
				}
			$c[$n] = $a;
			$n++;
			
			}
			$content = $c ;
		}
		return $content;
	}

function curlpost($curlPost,$url) //curl post 函数
{
	$ch = curl_init();//初始化curl  
	curl_setopt($ch,CURLOPT_URL,$url);//抓取指定网页  
	curl_setopt($ch, CURLOPT_HEADER, 0);//设置header  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上  
	curl_setopt($ch, CURLOPT_POST, 1);//post提交方式  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);  
	$data = curl_exec($ch);//运行curl  
	curl_close($ch);  
	return $data;
}

function xiaojo($key,$from,$to) //小九接口函数，该函数可通用于其他程序
{
	global $yourdb,$yourpw;
	$key=urlencode($key);
	$yourdb=urlencode($yourdb);
	$from=urlencode($from);
	$to=urlencode($to);
    $post="chat=".$key."&db=".$yourdb."&pw=".$yourpw."&from=".$from."&to=".$to;
 	$api = "http://www.xiaojo.com/api5.php";
    $replys = curlpost($post,$api);
    $reply = media(urldecode( $replys));//多媒体转换
  	return $reply;
}
function get_utf8_string($content) 
{    
	//  将一些字符转化成utf8格式   
	$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
	return  mb_convert_encoding($content, 'utf-8', $encoding);
}

?>
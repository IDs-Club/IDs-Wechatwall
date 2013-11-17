<?php
@header("Content-type: text/html; charset=utf-8");
 
define("TOKEN", "wall"); //配置API
define("Web_ROOT",'http://ids-wxwall.ap01.aws.af.cm'); //代码当前目录域名
$weixin_name = 'IDs澳洲互联网俱乐部';//这里可以配置你的微信公众账号名字，你也可以改下面的源码
$wxh = 'idsclub';//微信帐号（wall前台显示）
$weixin_wxq = Web_ROOT.'/wall/';

	/*链接数据库*/
      $services_json = json_decode(getenv('VCAP_SERVICES'),true);
      $mysql_config = $services_json['mysql-5.1'][0]['credentials'];
	$dbname = $mysql_config['name'];//数据库的名称
      $host = $mysql_config['hostname'];
      $user = $mysql_config['user'];
      $pwd = $mysql_config['password'];
 
       /*接着调用mysql_connect()连接服务器*/
        $link = @mysql_connect($host,$user,$pwd,true);
       if(!$link) {
                   die("Connect Server Failed: " . mysql_error($link));
                  }
       /*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
       if(!mysql_select_db($dbname,$link)) {
                   die("Select Database Failed: " . mysql_error($link));
                  }
		mysql_query("SET NAMES UTF8");
//以上连接数据库

$q_str="SELECT * FROM  `weixin_topic` where `if_set` = '1' order by `id` desc limit 1";
$t_query=mysql_query($q_str,$link) or die(mysql_error());
$topic=mysql_fetch_array($t_query);
$huati=$topic['topic'];
?>
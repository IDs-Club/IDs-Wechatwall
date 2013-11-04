<?php


require "config.php";
require "include/WeiXin.php";

$weiXin = new WeiXin($G_CONFIG['weiXin']);
$lastMsg = $weiXin->getLatestMsgs();
print_r($lastMsg);
$file = $lastMsg[0]['fakeid'].'.jpg'; 
if (is_readable($file) == false) { 
$weiXin->getPicture($lastMsg[0]['fakeid']);
}
if($lastMsg[0][type] == '1'){
$messageid = $lastMsg[0]['id'];
$fakeid = $lastMsg[0]['fakeid'];
$nicheng = $lastMsg[0]['nick_name'];
$content = $lastMsg[0]['content'];
$nicheng = strip_tags($nicheng);
$content = strip_tags($content);
$content = @str_replace(array('"','\'','゛','&nbsp;'), array('','','',''), $content);
$nicheng = @str_replace(array('"','\'','゛','&nbsp;'), array('','','',''), $nicheng);
$imgurl = Web_ROOT.'/moni/'.$fakeid.'.jpg';
$result = mysql_query("SELECT * FROM  `weixin_wall` WHERE  `fakeid` = '$fakeid'");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$sql = "INSERT INTO `weixin_wall` (`id`,`messageid`,`fakeid`,`num`,`content`,`nickname`,`avatar`,`ret`,`status`) VALUES (NULL,'$messageid','$fakeid ','-1','$content','$nicheng','$imgurl','0','0')";
mysql_query($sql);
}

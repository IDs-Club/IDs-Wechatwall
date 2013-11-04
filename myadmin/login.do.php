<?php
header("Content-type: text/html; charset=utf-8");
include("db.php");
$posts =$_POST;

foreach ($posts as $k => $v){
	$posts[$k] = trim($v);
}
$pwd = $posts["userpwd"];
$username = $posts["username"];

$sql="SELECT * FROM  `weixin_admin` WHERE  `user` = '{$username}' AND  `pwd` =  '{$pwd}'";
$query=mysql_query($sql,$link) or die(mysql_error());
$userinfo=mysql_fetch_row($query);

if(!empty($userinfo)){
	session_start();
	$_SESSION['admin'] = true;
	$str=<<<eot
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='main.php'", 1);  
</script> 
eot;
echo "$str"	;
} else {
 echo "用户或密码错误";
 echo '<a href="index.php">点击这里返回</a>';
 	$str=<<<eot
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='index.php'", 3000);  
</script> 
eot;
echo "$str"	;
 }
 ?>
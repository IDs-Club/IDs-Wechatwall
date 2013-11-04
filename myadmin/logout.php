<?php
header("Content-type: text/html; charset=utf-8");
session_start();
unset($_SESSION['admin']);
$str="你已经退出登陆";
$str.='<a href="index.php">点击这里返回</a>';
 	$str.=<<<eot
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='index.php'", 3000);  
</script> 
eot;
die($str);
?>
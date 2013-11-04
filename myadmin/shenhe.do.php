<?php
@header("Content-type: text/html; charset=utf-8");
include("db.php");
if(isset($_GET['do'])){
	$do = $_GET['do'];
	$cid = $_GET['cid'];
}else{
	die("invild action");
}

switch($do){
	case "del":
		DoDelete();
  echo "<script>location.href='shenhe.php';</script>";
		break;
  
		case "shenhe":
		DoShenhe();	
  echo "<script>location.href='shenhe.php';</script>";
 		break;
  
  		case "del_all":
		DoDel_all();	
  echo "<script>alert('操作成功，你的微信墙已经焕然一新哦！');location.href='shenhe.php';</script>";
 		break;
}


function DoShenhe(){
$cid = $_GET['cid'];
$sql_num="SELECT * FROM  `weixin_wall_num` ";
$query_num=mysql_query($sql_num);
$q=mysql_fetch_row($query_num);
$num=$q[0];
$sql1="UPDATE  `weixin_wall` SET  `ret` =  '1',`num` = '$num',`status` =  '0' WHERE  `id` = '$cid'";
$query1=mysql_query($sql1);
$sql_num="UPDATE `weixin_wall_num` SET `num` = `num`+1";
$query_num=mysql_query($sql_num);
}

function DoDelete(){
$cid = $_GET['cid'];
$sql_del="delete FROM  `weixin_wall` where `id` = '$cid' ";
mysql_query($sql_del);
}

function DoDel_all(){
mysql_query("TRUNCATE TABLE weixin_wall");
mysql_query("UPDATE `weixin_wall_num` SET `num` = 1");
}
?>
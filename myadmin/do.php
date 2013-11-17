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
		doDelete();
		break;
		case "shenhe":
		Do_shenhe();	
 		break;
}
function doDelete(){
  mysql_query("delete from weixin_wall WHERE `id` = '$cid'");
echo "<script>location.href='shenhe.php';</script>";
}

?>

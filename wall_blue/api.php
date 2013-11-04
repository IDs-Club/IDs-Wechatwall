<?php

@header("Content-type: text/html; charset=utf-8");
 
include("db.php");

$lastid=$_REQUEST['lastid'];
$num=$lastid+1;
//$sql1="SELECT * FROM  `msg` order by `mid` desc limit 3";
$sql1="SELECT * FROM  `weixin_wall` where `num` = '$num' limit 1 ";
$query1=mysql_query($sql1,$link) or die(mysql_error());

$q=mysql_fetch_row($query1);
if($q==''){
$num=$lastid+2;
$sql1="SELECT * FROM  `weixin_wall` where `num` = '$num' limit 1 ";
$query1=mysql_query($sql1,$link) or die(mysql_error());
$q=mysql_fetch_row($query1);
}
if($q==''){
$num=$lastid+3;
$sql1="SELECT * FROM  `weixin_wall` where `num` = '$num' limit 1 ";
$query1=mysql_query($sql1,$link) or die(mysql_error());
$q=mysql_fetch_row($query1);
}
if($q==''){
$num=$lastid+4;
$sql1="SELECT * FROM  `weixin_wall` where `num` = '$num' limit 1 ";
$query1=mysql_query($sql1,$link) or die(mysql_error());
$q=mysql_fetch_row($query1);
}
if($q==''){
$num=$lastid+5;
$sql1="SELECT * FROM  `weixin_wall` where `num` = '$num' limit 1 ";
$query1=mysql_query($sql1,$link) or die(mysql_error());
$q=mysql_fetch_row($query1);
}
$id=$q[0];
$fakeid=$q[2];
$num=$q[3];
$content=$q[4];
$nickname=$q[5];
$avatar=$q[6];
$ret=$q[7];
if($q[3]){
@$msg=array(data=>array(array("id"=>$id,"fakeid"=>$fakeid,"num"=>$num,"content"=>$content,"nickname"=>$nickname,"avatar"=>$avatar)),ret=>1);
echo $msg=json_encode($msg);
}
if(!$q[3]){
@$msg=array(data=>array(),ret=>0);
echo $msg=json_encode($msg);
}


?>
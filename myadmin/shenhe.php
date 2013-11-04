<?php
@header("Content-type: text/html; charset=utf-8");
$admin=false;
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
	echo "你已经成功登陆";
} else {
$_SESSION['admin'] = false;
$str="你还没登陆，无权访问";
$str.='<a href="index.php">点击这里返回</a>';
 	$str.=<<<eot
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='index.php'", 3000);  
</script> 
eot;
die($str);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信墙后台</title>
<meta name="description" content="微信墙后台">  
<meta name="keywords" content="微信墙后台"> 
<link rel="stylesheet" href="themes/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/main.css" type="text/css" media="screen" />
<script type="text/javascript" src="themes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="themes/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="themes/js/facebox.js"></script>
<script type="text/javascript" src="themes/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="themes/js/jquery.datePicker.js"></script>
<script type="text/javascript" src="themes/js/jquery.date.js"></script>
<script type="text/javascript" src="themes/js/faceboxpage.js"></script>
</head>
<body>
<style>
.content-box{ width:823px;}
</style>
<style>
.content-box{ width:900px;}
</style>
<?php include "head.php";?>
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>审核后台</h3>
		<ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">未审核</a></li>
          <!-- href must be unique and match the id of target div -->
          <li><a href="#tab2">已审核</a></li>
        </ul>
        <div class="clear"></div>

      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
		<div class="notification attention png_bg"> <a href="#" class="close"><img src="themes/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
             <?php
		   include("db.php");
		   $sql1="SELECT count(*) FROM  `weixin_wall` where `ret` = 0 and `id`>1   ";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			while($q=mysql_fetch_row($query1)){
			?>

			<div> 您还有<span style="color:#F00; font-weight:bold"><?=$q[0]?></span>条内容需要审核 </div>
          </div>
			<?php } ?>
		
          <table class="table">
		   <thead>
		    <tr>
		    <th>序号</th>
			<th>昵称</th>
			<th>内容</th>
			<th>审核</th>
			<th>操作</th>
			</tr>
		   </thead>
		   <?php
		   include("db.php");
		   
			$Page_size=30; //设置每页显示多少条

			$result=mysql_query("SELECT * FROM `weixin_wall` where `ret` = 0 and `id`>1 "); 
			$count = mysql_num_rows($result); 
			$page_count = ceil($count/$Page_size); 


			$init=1; 
			$page_len=7; 
			$max_p=$page_count; 
			$pages=$page_count; 


			if(empty($_GET['page'])||$_GET['page']<0){ 
			$page=1; 
			}else { 
			$page=$_GET['page']; 
			} 
            $offset=$Page_size*($page-1); 
			
		   $sql1="SELECT * FROM  `weixin_wall` where `ret` = 0 and `id`>1  limit $offset,$Page_size";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			while($q=mysql_fetch_row($query1)){
			?>
		    <tbody> 
			<form method="POST" name="shenhe">
			<tr>
				<th><?=$q[0]?></th>
				<th><?=$q[5]?></th>
				<th><?=$q[4]?></th>
				<th><a href="shenhe.do.php?pass=<?=$q[0]?>"><img src="themes/images/icons/tick_circle.png" title="审核" alt="审核"></a></th>
              <th><a href="shenhe.do.php?do=shenhe&cid=<?php echo $q[0];?>"><?php echo"<b>[上墙]</b>";?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:if(confirm('确定删除吗？将无法恢复！')){location.href='shenhe.do.php?do=del&cid=<?php echo $q[0];?>'}"><?php echo"[删除]";?></a></th>
			</tr>
			<?php }
$page_len = ($page_len%2)?$page_len:$pagelen+1; 
$pageoffset = ($page_len-1)/2; 

$key='<div>'; 
$key.="<span>当前在第".$page."页 共".$pages."页</span> "; 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a> "; 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a>"; 
}else { 
$key.="第一页 ";
$key.="上一页"; 
} 
if($pages>$page_len){ 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{

if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <span>'.$i.'</span>'; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a>"; //最后一页 
}else { 
$key.="下一页 ";
$key.="最后一页"; 
} 
$key.='</div>'; 
echo $key;
			?>
			
			<script type="text/javascript">
</script>

		    </tbody>
			</table>
            </form>
            
            
            
        </div>
		<div class="tab-content" id="tab2">
		<div class="notification success png_bg"> <a href="#" class="close"><img src="themes/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
             <?php
		   include("db.php");
		   $sql1="SELECT count(*) FROM  `weixin_wall` where `ret` = 1 ";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			while($q=mysql_fetch_row($query1)){
			?>

			<div> 您已经审核通过<span style="color:#F00; font-weight:bold"><?=$q[0]?></span>条内容 </div>
          </div>
<?php } ?>
		<table class="table">
		   <thead>
		    <tr>
		    <th>序号</th>
			<th>昵称</th>
			<th>内容</th>
			</tr>
		   </thead>
		   <?php
		   include("db.php");
		   $sql1="SELECT * FROM  `weixin_wall` where `ret` = 1 order by num ";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			while($q=mysql_fetch_row($query1)){
			?>
		    <tbody>
			<tr>
				<th><?=$q[3]?></th>
				<th><?=$q[5]?></th>
				<th><?=$q[4]?></th>
			</tr>
			<?php } ?>
		    </tbody>
			</table>
			<div>
              <a href="../wall" target="_blank" class="button">点击查看微信墙</a>
            </div>
		</div>
		
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <!-- Start Notifications -->

<script>
	leftModou.leftCur("#shenhe");
	leftModou.leftCur("#up");
</script>


<!-- End Notifications -->

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>

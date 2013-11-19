<?php
@header("Content-type: text/html; charset=utf-8");
$admin=false;
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
	include("db.php");
	if ($_POST) 
	{
		$topic_val = $_POST['topic_val'];
		$tid = $_POST['cid'];
		$old_t = $_POST['old_topic'];
		if ($topic_val != $old_t) 
		{
			mysql_query("UPDATE `weixin_topic` SET `topic` = '$topic_val' WHERE id = $tid");
			mysql_query("TRUNCATE TABLE weixin_wall");
			mysql_query("UPDATE `weixin_wall_num` SET `num` = 1");
		}	
	}
	else if (isset($_GET['do'])) 
	{
		$do = $_GET['do'] == 'unactive' ? 0 : 1 ;
		$tid = $_GET['cid'];
		mysql_query("UPDATE `weixin_topic` SET `if_set` = '$do' WHERE id = $tid");
	}
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
        <h3>话题</h3>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <table class="table">
		   <thead>
		    <tr>
			<th>话题</th>
			<th>操作</th>
			</tr>
		   </thead>
		   <?php
			$qt=mysql_query("SELECT * FROM `weixin_topic` where `id` = 1"); 
			$topic=mysql_fetch_row($qt);
			?>
		    <tbody> 
			<form method="POST" name="topic_change">
				<input type="hidden" name="cid" value="<?php echo $topic[0]; ?>">
				<input type="hidden" name="old_topic" value="<?php echo $topic[1]; ?>">
			<tr>
				<td><input type="text" id="topic_val" name="topic_val" value="<?=$topic[1]?>"></td>
              	<td><a href="topic.php?do=<?php echo $topic[2] == 1 ? "unactive" : "active";?>&cid=<?php echo $topic[0];?>"><?php echo sprintf("<b>%s</b>",$topic[2] == 1 ? "unactive" : "active");?></a></td>
			</tr>
		    </tbody>
		    <tfoot>
		    	<tr>
		    		<td colspan="2"><button type="submit" class="button">修改话题</button></td>
		    	</tr>
		    </tfoot>
			</table>
            </form>
  		</div>	
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <!-- Start Notifications -->

<script>
	leftModou.leftCur("#topic");
	leftModou.leftCur("#up");
</script>


<!-- End Notifications -->

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>

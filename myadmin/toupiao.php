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
        <h3>高级设置</h3>
		<ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">个性化设置</a></li>
          <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>

      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
	  
        <div class="tab-content default-tab" id="tab1">
		<form method="post" enctype="multipart/form-data">
            <fieldset>
            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
              <p><a href="javascript:if(confirm('确定清空所有微信墙数据吗？将无法恢复！')){location.href='shenhe.do.php?do=del_all'}"><b>一键清空微信墙内容（危险操作！）</b></a></p>

            </fieldset>
           其它功能待上线。
              
           </form>
            <div class="clear"></div>
            <!-- End .clear -->
			
        </div>
		<div class="tab-content" id="tab2">

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

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>

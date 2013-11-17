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
        <h3>微信墙后台主页</h3>
		<ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">关于微信墙</a></li>
          <!-- href must be unique and match the id of target div -->
          <li><a href="#tab2">关于CoolWB</a></li>
        </ul>
        <div class="clear"></div>

        <ul class="content-box-tabs">
          
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          
            
            
            
            
            <div class="AboutR">
            	<!--div class="AboutRT">到微信公众平台设置接口</div-->
                <div class="AboutRB">
					<p><span style="color:#009900; font-size:3em">为什么使用微信墙？</span></p>
                    <p style="font-size:1.2em">1、不需要向微信官方申请，可以直接自由使用；
					<p style="font-size:1.2em">2、具有较好的私密性，不会造成微博那样被刷屏的负面影响；
					<p style="font-size:1.2em">3、可以自由定制墙体界面、文字，达到更好的使用效果；
					<p style="font-size:1.2em">4、可以增加微信公众号的粉丝数量。（CoolWB.COM）</p>
                </div>
            </div>
        </div>
		<div class="tab-content" id="tab2">
		<p>酷文博，为互联网IT人才充电！（http://coolwb.com）</p>
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

</div>
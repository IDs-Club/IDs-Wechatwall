<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信上墙|微信墙|微信大屏幕</title>
<script type="text/javascript" src="js/jquery.js"></script>
<link rel="stylesheet" href="css/wxwall.css" type="text/css">
</head>

<body>
<div class="main">
    <div class="top" onclick="viewExplan();"><div class="k">微信添加微信号：<strong><?php include"../config.php"; echo $coolwb_wxh;?></strong> <br>发送<?php include"../config.php"; echo $huati."+";?>您想说的话即可上墙！</div></div>
	<div class="wall">
		<div class="left"></div>
		<div class="center">
			<div class="list">
				<ul id="list"></ul>
			</div>
			<div class="footer"></div>
		</div>
		<div class="right"></div>
	</div>
	<div class="mone" id="mone" onclick="viewOneHide();"></div>
	<div id="explan" style="display:none" onclick="viewExplan();"><p><b style="font-size:50px;">上墙方法：</b><br />1.微信添加微信号：<?php include"../config.php"; echo $coolwb_wxh;?><br />2.发送<?php include"../config.php"; echo $huati;?>+您想说的话即可上墙！</p></div>
</div>
<script type="text/javascript">
var len=3;
var cur=0;//当前位置
var mtime;
var data=new Array();
data[0]=new Array('0','http://pgywxy-data.stor.sinaapp.com/601777775head.jpg','izcq','欢迎来到微信互动墙，积极发言哦！');


//data[1]=new Array('2','http://pgywxy-data.stor.sinaapp.com/601777775head.jpg','izcq2','#izcq#测试888~');
//data[2]=new Array('3','http://pgywxy-data.stor.sinaapp.com/601777775head.jpg','izcq2','#izcq#测试999~');

//var word_id='96';
var lastid='0';
var vep=true;//查看上墙说明
var vone=false;//查看单条

function viewOneHide(){
	vone=false;
	$("#mone").hide();
}
function viewOne(cid,t)
{
	if(vone==false)
	{
		vone=true;
		var str=t.innerHTML;
		$("#mone").html(str);
		$("#mone").fadeIn(700);
	}else
	{
		vone=false;
		$("#mone").hide();
	}
}
function viewExplan()
{
	if(vep==false)
	{
		vep=true;
		$("#explan").fadeIn(700);
		//clearInterval(mtime);
	}else
	{
		vep=false;
		$("#explan").hide();
		//mtime=setInterval(messageAdd,5000);
	}
}
function messageAdd()
{
	if(cur==len)
	{
		messageData();
		return false;
	}
	var str='<li id=li'+cur+' onclick="viewOne('+cur+',this);"><div class=m1><div class=m2><div class="pic"><img src="'+data[cur][1]+'" width="100" height="100" /></div><div class="c f2"><span>'+data[cur][2]+'：</span>'+data[cur][3]+'</div></div></div></li>';
	$("#list").prepend(str);
	$("#li"+cur).slideDown(800);
	cur++;
	messageData();
}
function messageData()
{
	var url='api.php';
	$.getJSON(url,{lastid:lastid},function(d) {
		//alert(d);return;
		if(d['ret']==1)
		{
			$.each(d['data'], function(i,v){
				data.push(new Array(v['num'],v['avatar'],v['nickname'],v['content']));
				lastid=v['num'];
				len++;
			});
		}else{
				//	alert('木有新消息..每5秒ajax一次');
					window.setTimeout('messageData();', 2000);
		}	
	});
}
window.onload=function()
{
		messageAdd();
	mtime=setInterval(messageAdd,8000);
	}
</script>
	<!--<li>
		<div class="l"></div>
		<div class="r">
			<span></span>
					</div>
	</li>-->
</body>
</html>
var len=3;
var cur=0;//当前位置
var mtime;
var data=new Array();
data[0]=new Array('0','http://pgywxy-data.stor.sinaapp.com/601777775head.jpg','izcq','欢迎来到微信上墙，源码获取地址：http://coolwb.com/5602.html');


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
	var str='<li id=li'+cur+' onclick="viewOne('+cur+',this);"><div class=m1><div class=m2><div class="pic"><img src="'+data[cur][1]+'" width="100" height="100" /></div><div class="c f2"><span>'+data[cur][2]+'：</span>'+data[cur][3]+'<div class="num">'+data[cur][0]+'#</div></div></div></div></li>';
	$("#list").prepend(str);
	$("#li"+cur).slideDown(800);
	cur++;
	messageData();
}
function messageData()
{
	var url='../api.php';
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
					window.setTimeout('messageData();', 3000);
		}	
	});
}
window.onload=function()
{
		messageAdd();
	mtime=setInterval(messageAdd,3000);
	}
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>CoolWB微信墙程序</title>
<link rel="stylesheet" type="text/css" href="./css/main.css" />
<style type="text/css">
  .demo{width:700px; margin: 30px 100px auto; text-align:left; background: #1570A6; border: 5px solid #1570A6; border-radius: 10px; height: 100px;}
#roll{height:32px; line-height:32px; margin-bottom:10px; font-size:24px; color:#f30}
.btn{width: 100px;height: 30px;line-height: 26px;border: 1px solid lightGrey;cursor: pointer;font-size: 20px;font-family: 'Microsoft Yahei';border-radius: 5px;}
#stop{display:none}
#result{margin-top:20px; line-height:24px; font-size:24px; text-align:center;color:white}
  #roll p {
    float: left;
    margin-left: 10px;
    width: 563px;
    overflow: hidden;
    color: #fff;
  }
  #roll img {
    float: left;
  }
</style>
<script type="text/javascript" src="./js/jquery.js"></script>
 <script type="text/javascript">

$(function(){
	var _gogo;
	var start_btn = $("#start");
	var stop_btn = $("#stop");
	
	start_btn.click(function(){
		$.getJSON('data.php',function(json){
			if(json){
				//var obj = eval(json);//通过eval() 函数可以将JSON字符串转化为对象
				var len = json.length;
				_gogo = setInterval(function(){
					var num = Math.floor(Math.random()*len);
					//var id = obj[num]['id'];
					var id = json[num].id;
					var v = json[num].nickname;
                  var avatar = json[num].avatar;
                  var content = json[num].content;
                  $("#roll").html(avatar+v+content);
                  $("#name").html(v);
                    $("#mid").val(id); 
				},100);
				stop_btn.show();
				start_btn.hide();
			}else{
				$("#roll").html('系统找不到数据源，请先导入数据。');
			}
		});
		//_gogo = setInterval(show_number,100);
	});
		
	stop_btn.click(function(){
		clearInterval(_gogo);
		var mid = $("#mid").val();
		$.post("data.php?action=ok",{id:mid},function(msg){
			if(msg==1){
				var mobile = $("#name").html();
              
              $("#result").append(mobile+"、");
			}
			stop_btn.hide();
			start_btn.show();
		});
	});

});


</script>
</head>

<body>

<div id="main">
  <h2 class="top_title"><a href="http://coolwb.com/5602.html" target="_blank">CoolWB微信墙滚动抽奖</a></h2>
  <div class="demo">
    <div id="roll"></div><div style="display:none;" id="name"></div><input type="hidden" id="mid" value="">
    <p style="margin-top:100px; text-align:center;"><input type="button" class="btn" id="start" value="开始"> <input type="button" class="btn" id="stop" value="停止"></p>
    
    <div id="result"><P style="color:red;font-weight:blod;">中奖名单</P><br/></div>
  </div>
</div>
</body>
</html>
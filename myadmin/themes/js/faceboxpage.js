// JavaScript Document
$(function(){$('.nav-top-item').live({click:function(){
			//alert("fefe");
			//$('.nav-top-item').removeClass("current");
			$(this).addClass("current");
		}
	})
});
$(function(){$('.prc').bind({click:function(){
			var div = $(this).attr("href");
			$(".tab-content").hide();
			$(div).show();
		}
	})
});
$(function(){$('.bqcontentC').bind({click:function(){
			var cont = $(this).children("img").attr("title");
			$("#AutoMsg").append(cont);
		}
	})
});
$(function(){$('.tlf').bind({click:function(){
			var wxid = $("#id").val();
			var tid = $(this).attr("tid");
			var id = $(this).attr("id");
			$.post("http://www.wei90.com/index.php/Tool/IndexDo", { id: wxid,tid:tid },function(res){
				//alert(res);
				divEx(tid,res.status)
				
			},'json');
			//$(this).removeClass("tlfon");
			
		}
	})
});


function divEx(id,status){
	if(status ==1){
		$("#m"+id).attr("checked",false);
	}else{
		
		$("#m"+id).attr("checked","checked");
	}
}
function medal(mid,id,iid){
	$.post("http://www.wei90.com/index.php/Item/AjaxMedal", {id:id,mid:mid,iid:iid },function(res){
			if(res.status == 1){
				$("#d"+mid).html('[已颁奖]');		
			}
	}, "json");
}
function changeDiv(id,v){
	if(v == 1){
		$("#"+id).attr("rel","");
	}else{
		$("#"+id).attr("rel","1");
	}
}
$(function(){$('.tplli').live({click:function(){
			var tpl = $(this).next().attr('id');
			var type = $(this).next().attr('class');
			var id = $('#pcid').val();
			$('.tplli').removeClass('tpllCn');
			$(this).addClass('tpllCn');
			$(this).next().attr("checked","checked");
			$.post("http://www.wei90.com/"+"index.php/Manage/Pclas/setTplD", {tpl:tpl,type:type,id:id},function(data){
				$(".mccenterB").html(data);
			},"json");
		}
	})
});




function biaq(){
	var dis = $(".bqcontent").css("display");
	if(dis == "none"){
		$(".bqcontent").slideDown(100)
	}else{
		$(".bqcontent").slideUp(100)
	}
}
$(function(){$('.bqcontent').bind({
		mouseenter:function(){
},mouseleave:function(){
			$(this).slideUp(100)
		}
	})
});

$(function(){$('[name=checkIn]:checkbox').live({click:function(){
			var c = $(this).attr("checked");
			
			var id = $(this).attr('id');
			var cont = $(this).val();
			var div = "<div class=\"notification success png_bg br"+id+"\">"+
                	"<a href=\"javascript:;\" class=\"close\" cur ='checkIn' id=\""+id+"\">"+
					"<img src=\"/themes/images/icons/cross_grey_small.png\" title=\"Close this notification\" alt=\"close\" /></a>"+
      				"<div>"+cont+"</div>"+
   				"</div>";
			var ids = $("#dtw").val()+id+","
			if(c =='checked'){
				$("#dtw").val(ids);
				$("#dtwL").append(div);
			}else{
				var dtw = $("#dtw").val();
				var strs=dtw.split(",");
				var newarr=kill(id,strs)
				$("#dtw").val(newarr.join(','))
				$(".br"+id).remove();
			}
		}
	})
});

$(function(){$('[name=checkInT]:checkbox').live({click:function(){
			var c = $(this).attr("checked");
			var id = $(this).attr('id');
			var cont = $(this).val();
			var div = "<div class=\"notification success png_bg  tr"+id+"\">"+
                	"<a href=\"javascript:;\" class=\"close\" cur='checkInT' id=\""+id+"\">"+
					"<img src=\"/wsf/manage/themes/images/icons/cross_grey_small.png\" title=\"Close this notification\" alt=\"close\" /></a>"+
      				"<div>"+cont+"</div>"+
   				"</div>";
			var ids = $("#tjyd").val()+id+","
			if(c =='checked'){
				$("#tjyd").val(ids);
				$("#tjydL").append(div);
			}else{
				var dtw = $("#tjyd").val();
				var strs=dtw.split(",");
				var newarr=kill(id,strs)
				$("#tjyd").val(newarr.join(','))
				$(".tr"+id).remove();
			}
		}
	})
});

$(function(){$('.close').live({click:function(){
			var id = $(this).attr("id");
			//var cur= $(this).attr("cur");
			var comm = $(this).parent().parent().attr("id")
			//$(".tr"+id).remove();
			if(comm=='dtwL'){
				var dtw = $("#dtw").val();
				var strs=dtw.split(",");
				var newarr=kill(id,strs)
				$("#dtw").val(newarr.join(','))
				//$(".br"+id).remove();
				$("#dtwL").children(".tr"+id).remove();
			}else{
				var dtw = $("#tjyd").val();
				var strs=dtw.split(",");
				var newarr=kill(id,strs)
				$("#tjyd").val(newarr.join(','))
				$("#tjydL").children(".tr"+id).remove();
				//$("#tjydL .tr"+id).remove();
				//$(".ctr"+id).remove();
			}
			
		}
	})
});
$(function(){$('.closeT').live({click:function(){
			var id = $(this).attr("id");
			var cur= $(this).attr("cur");
			if(cur=='checkIn'){
				var dtw = $("#dtw").val();
				var strs=dtw.split(",");
				var newarr=kill(id,strs)
				$("#dtw").val(newarr.join(','))
				$(".br"+id).fadeOut(300);
			}else{
				var tjyd = $("#tjyd").val();
				var strs=tjyd.split(",");
				var newarr=kill(id,strs)
				$("#tjyd").val(newarr.join(','))
				$(".tr"+id).fadeOut(300);
			}
			
		}
	})
});

function kill(num,oldArr){
	var arr=[];
	if(!(oldArr instanceof Array)){return undefined;}
	for(var i=0,n=oldArr.length,code;i<n;i++){
		code=oldArr[i];
		if(code!=num)arr.push(code);
	}
	return arr;
}


//w	= widht
//h = height
//c = content 内容
//p = path 跳转路径
var leftModou = {  
 leftCur:function(id){
 	$(id).addClass("current");
}};

$(function(){$('.tlf').bind({
		mouseenter:function(){
			if($(this).attr('rel') == 1){
			}else{
				//$(this).addClass("tlfon");
				//$(this).children(".appInfoF").css("background-color","#d5ffce ");
			}
			
			$(this).css("z-index","100000")
			
			$(this).children(".appInfoF").show();
},mouseleave:function(){
			if($(this).attr('rel') == 1){
			}else{
				//$(this).removeClass("tlfon")
				//$(this).children(".appInfoF").css("background-color","#81d174 ");
			}
			$(this).css("z-index","99999")
			
			$(this).children(".appInfoF").hide();
		}
	})
});
$(function(){$('#divNo').live({click:function(){
			var vsion = $('.footc');
			document.cookie = "clear ="+vsion.attr("id");
			$(".footcA").hide();
			$(".footcC").hide();
			$(this).attr("id","divYes");
			$(this).html("打开");
			
		}
	})
});
$(function(){$('#divYes').live({click:function(){
			$(".footcA").show();
			$(".footcC").show();
			$(this).attr("id","divNo");
			$(this).html("关闭");
			
		}
	})
});

$(function(){$('.indexDown').bind({
		mouseenter:function(){
			 $(this).animate({ 
				marginTop: "-170px"
			  }, 200 );

},mouseleave:function(){
			$(this).animate({ 
				marginTop: "-200px"
			  }, 200 );
		}
	})
});

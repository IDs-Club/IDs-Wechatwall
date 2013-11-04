/**
 * 横向柱形图
 * 
 * @author 	纵横(lrenwang)
 * @email	lrenwang@qq.com
 * @blog	blog.lrenwang.com
 * @qq		3142442
 * @version 1.2
 * 兼容 IE7 FireFox
 */
var bar = function (id,title,data){
	//展示的id
	this.id = '';

	//标题
	this.title = '';

	//数据
	this.data = '';

	//宽
	this.width = 3000;
	
	//背景图片位置
	this.bgimg = 'themes/images/plan.gif';
	
	//动画速度
	this.speed = 5000;

	//投票总数
	var num_all = 0;
	this.show = function (){
		//添加一个table对象
		$("#"+this.id).append("<table width='"+this.width+"' cellpadding=0 cellspacing=6 border=0 style='font-size:12px;' ></table>")

		$("#"+this.id+" table").append("<tr><td colspan=3 align='center' ><span style='font:900 14px ;color:#444'>"+this.title+"</span></td></tr>")

		//计算总数
		$(this.data).each(function(i,n){
			num_all += parseInt(n[1]);
		})

		var that = this;

		//起始
		var s_img = [0,-52,-104,-156,-208];
		//中间点起始坐标
		var c_img = [-312,-339,-367,-395,-420];
		//结束
		var e_img = [-26,-78,-130,-182,-234];
		var that = this;
		var div;
		$(this.data).each(function(i,n){
			
			//计算比例
			var bili = (n[1]*100/num_all).toFixed(2);
			
			//计算图片长度, *0.96是为了给前后图片留空间 izcq
			var img = parseFloat(bili)*0.96;
	
			if(img>0)
			{
				div = "<div style='width:3px;height:16px;background:url("+that.bgimg+") 0px "+s_img[i]+"px ;float:left;'></div><div fag='"+img+"' style='width:0%;height:16px;background:url("+that.bgimg+") 0 "+c_img[i]+"px repeat-x ;float:left;'></div><div style='width:3px;height:16px;background:url("+that.bgimg+") 0px "+e_img[i]+"px ;float:left;'></div>";
			}
			else
			{
				div='';
			}
			$("#"+that.id+" table").append("<tr><td width='30%' align='right' >"+n[0]+"：</td><td width='60%' bgcolor='#fffae2' >"+div+"</td><td width='10%' nowrap >"+n[1]+"("+bili+"%)</td></tr>")
		})
		
		this.play();
	}

	this.play = function (){
		var that = this;		
		$("#"+this.id+" div").each(function(i,n){
			if($(n).attr('fag'))
			{
				$(n).animate( { width: $(n).attr('fag')+'%'}, that.speed )
			}
		})
	}
}
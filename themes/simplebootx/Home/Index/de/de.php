
<!--<tc_include file="../../themes/simplebootx/Public/nav" />-->
<!--<tc_include file="../themes/simplebootx/Public:navbar_fluid" />-->
<?php 
include("../../themes/simplebootx/Public/nav.html");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from www.zhongxiangtimes.cn/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Feb 2020 01:31:18 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>   北京优游互动网络科技有限公司</title>
<meta name="keywords" content="优游互动|zhongxiangtimes.cn" />
<meta name="description" content="优游互动最好玩的游戏平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="favicon.ico" type="image/x-icon" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="static/css/bootstrap-customize.css">
<link rel="stylesheet" type="text/css" href="static/css/style.css">
<link rel="stylesheet" type="text/css" href="static/css/pages.css">
<script type="text/javascript" src="static/js/html5.js"></script>
<script type="text/javascript" src="static/js/jquery.1.9.1.js"></script>
<script type="text/javascript" src="static/js/bootstrap.js"></script>
<script type="text/javascript" src="static/js/respond.src.js"></script>
<script type="text/javascript" src="static/js/base.js"></script>
<script type="text/javascript" src="static/js/main.js"></script>
<script type="text/javascript" src="static/js/jquery.superslide.2.1.1.js"></script>
<script type="text/javascript">
	var _M = 'default',_C = 'index',_A = 'index';</script>

</head>

<body>

<div id="header">


	<script language="javascript"> //加入收藏夹，兼容多种浏览器
     function AddFavorite(sURL, sTitle){   
	      try{window.external.addFavorite(sURL, sTitle);}    
		  catch (e){ try{window.sidebar.addPanel(sTitle, sURL, "");}       
		  catch (e){alert("加入收藏失败，请使用Ctrl+D进行添加");}    
		 }
	 }
    function SetHome(url){
        if (document.all) {
			   document.body.style.behavior='url(#default#homepage)';
               document.body.setHomePage(url);
        }else{
            alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
        }
    }
</script>
 
<!--<div class="a">-->
<!--	<div class="container">-->
<!--		<div class="tops">-->
<!--			<div class="pull-right">-->
<!--				<a href="login.html" id="login" class="l">登录</a>-->
<!--				<i class="i"></i>-->
<!--				<a href="reg.html" id="reg" class="l">注册</a>-->
<!--			</div>-->
<!--			<a href="javascript:void(0);" onclick="return SetHome('index.html','优游互动')" target="_blank" class="l">设为首页</a>-->
<!--			<i class="i"></i>-->
<!--			<a href="javascript:void(0);" onclick="return AddFavorite('index.html','优游互动')" id="topfav" class="l">加入收藏</a>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->


	<script>
$(function(){
    //菜单
    $('#_nav').find('li').each(function(){
        var tmpm = $(this).attr('m'),
            tmpc = $(this).attr('c'),
            tmpa = $(this).attr('a');
        if(_M == tmpm && _C == tmpc && _A == tmpa) {
            $(this).find(".i").addClass('on');
        }
    });
});	
</script>

<!--<div class="b">-->
<!--	<div class="container">-->
<!--		<div class="pull-right">-->
<!--			<div class="menu">-->
<!--				<ul id="_nav">-->
<!--					<li m="default" c="index" a="index"><a href="index-2.html" class="i ihome">首页</a></li>-->
<!--					<li m="default" c="game" a="index"><a href="game.html" class="i igame">游戏大厅</a></li>-->
<!--					<li m="pay" c="index" a="index"><a href="pay.html" class="i ipay">充值中心</a></li>-->
<!--					<li m="passport" c="index" a="index"><a href="login.html" class="i iuser">用户中心</a></li>-->
<!--					<li m="default" c="kefu" a="index"><a href="kefu.html" class="i ikefu">客服中心</a></li>-->
<!--					<li><a href="contentc9f8.html?id=456" class="i">纠纷处理</a></li>-->
<!--					<li><a href="jh.html" class="i">家长监护</a></li>-->
<!--				</ul>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="logo" style="padding-top:10px;"><a href="index-2.html"><img src="static/picture/logo.png" alt=""></a></div>-->
<!--	</div>-->
<!--</div>-->
</div>



<div id="main">
	
<script>
$(function(){
    $('#indexlogins').click(function(){
        var username = $('#member_username').val();
        var password = $('#password').val();
        if(!username) {
            alert('请输入用户名和密码！');
			//$('#tip').html("请输入用户名");
            return false;
        }
		if(!password){
			alert('请输入密码');
			//$('#tip').html("请输入密码");
            return false;
		}
		
		$.post(
			'login.html',
			{'action':'ajax_login_ok','reurl':'index','post_mode':'withtml5','member_username':username,'member_password':password},
			function(data){
				if(data.status==1){
					window.location.href=data.text;
				}else{
					alert(data.text);
					//$('#tip').html(data.text);
					return false;
				}
			},
			'json'
		);
		
        return true;
    });	
});	
</script>	
<div class="container">
	<div class="ex">
			<div class="login">
			<div class="hd"></div>
			<div class="ct">
				<div class="form">
					<div id="err_msg"></div>
					<div class="p">
						<input type="text" id="member_username" name="member_username" class="ico1" placeholder="账号">
					</div>
					<div class="ht15"></div>
					<div class="p">
						<input type="password" id="password" name="member_password" class="ico2" placeholder="6-16位密码，区分大小写">
					</div>
					<div class="ht15"></div>
					<div class="p">
						<p>
							<span class="pull-right">
								<a href="userca79.html?action=forget" target="_blank">忘记密码？</a>
							</span>
						</p>
					</div>
					<div class="ht20"></div>
					<div class="p">
						<p class="text-center">
							<a href="javascript:;" id="indexlogins" class="bt">登  录</a>
						</p>
					</div>
					<div class="ht25"></div>
					<div class="p">
						<p class="text-center"><a href="reg.html">还没有账号？马上注册</a></p>
					</div>
				</div>
			</div>
		</div>
		
		</div>
</div>

<div class="ui-banner">
	<div id="carousel-home" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner" role="listbox">
	   
		<div class="item active">
		  <a href="#" target="_blank"><div class="img" style="background-image: url(static/images/20190321094334_nmrsub.jpg)"></div></a>
		</div>
	  	  </div>
	</div>
</div>	<div class="container">
		<div class="ht30"></div>
		<div class="ui-home">
			<div class="l">
	<div class="ui-head1">
		<p><label for="">精品游戏</label></p>
	</div>
	<div class="ui-gamelist style1" id="tjgame">
		<ul>
				<li>
		<div class="i">
			<div class="img simg" style="width:472px;height:283px;background: url(static/images/20190321094827_kglnue.jpg);"><img src="#" alt=""><p>类型：角色扮演</p></div>
		<div class="txt">
			<p><span class="pull-right"><a href="login.html?action=play&amp;game_id=100&amp;server_id=1" class="bt">开始游戏</a><a href="login.html?action=play&amp;game_id=100&amp;server_id=1" class="bt">进入官网</a></span>仙谕游戏</p>
		<div class="clearfix"></div></div>
		</div>
		</li>
				<li>
		<div class="i">
			<div class="img simg" style="width:472px;height:283px;background: url(static/images/20190321094851_ntwttw.jpg);"><img src="#" alt=""><p>类型：角色扮演</p></div>
		<div class="txt">
			<p><span class="pull-right"><a href="login.html?action=play&amp;game_id=99&amp;server_id=3" class="bt">开始游戏</a><a href="login.html?action=play&amp;game_id=99&amp;server_id=3" class="bt">进入官网</a></span>仙谕游戏</p>
		<div class="clearfix"></div></div>
		</div>
		</li>
				</ul>
		<div class="clearfix"></div>
	</div>
	<div class="ht30"></div>
	<div class="ui-head1">
		<p><label for="">热门游戏</label></p><a style="float:right; margin:-20px 0 0 0; color:#ff7200; position: relative;" href="game.html">MORE&gt;&gt;</a>
	</div>
	<div class="ui-gamelist style2" id="hotgame">
		<ul>
				<li>
		<div class="i">
			<div class="img"><img src="static/picture/20190321095020_mfkeau.png" width="305px" height="437px" alt=""></div>
			<div class="txt"><p><span class="pull-right"><a href="login.html?action=play&amp;game_id=100&amp;server_id=1" target="_blank" class="bt">进入新区</a></span><span class="link"><b>仙谕游戏</b><br><a href="login.html?action=play&amp;game_id=100&amp;server_id=1">进入官网</a><span class="wh20"></span>|<span class="wh20"></span><a href="pay.html">充值</a></span></p>
			</div>
		</div>
		</li>
				<li>
		<div class="i">
			<div class="img"><img src="static/picture/20190321095103_pvtayh.png" width="305px" height="437px" alt=""></div>
			<div class="txt"><p><span class="pull-right"><a href="login.html?action=play&amp;game_id=99&amp;server_id=3" target="_blank" class="bt">进入新区</a></span><span class="link"><b>仙谕游戏</b><br><a href="login.html?action=play&amp;game_id=99&amp;server_id=3">进入官网</a><span class="wh20"></span>|<span class="wh20"></span><a href="pay.html">充值</a></span></p>
			</div>
		</div>
		</li>
				<li>
		<div class="i">
			<div class="img"><img src="static/picture/20190321095258_xxyyqg.png" width="305px" height="437px" alt=""></div>
			<div class="txt"><p><span class="pull-right"><a href="login.html?action=play&amp;game_id=97&amp;server_id=" target="_blank" class="bt">进入新区</a></span><span class="link"><b>仙谕游戏</b><br><a href="login.html?action=play&amp;game_id=97&amp;server_id=">进入官网</a><span class="wh20"></span>|<span class="wh20"></span><a href="pay.html">充值</a></span></p>
			</div>
		</div>
		</li>
				</ul>
	</div>
</div>			<div class="r">
	<div class="ui-head1">
		<p><label for="">开服列表</label></p><a style="float:right; margin:-25px -3px 0 0; color:#ff7200; position: relative;" href="http://game.6399yx.com/kaifu">MORE&gt;&gt;</a>
	</div>
	<div class="ui-openlist">
	<table>
	<tbody>
	 
	<tr style="color: #f7d291;" class="">
		<td><span class="t1">03-20 14:00</span></td>
		<td><b>仙谕游戏</b><span class="i1">03-20 14:00</span></td>
		<td>双线一服<span class="i1"><a href="login.html?action=play&amp;game_id=99&amp;server_id=3" target="_blank" class="bt">进入</a></span></td>
	</tr>
	 
	<tr style="color: #f7d291;" class="">
		<td><span class="t1">03-20 14:00</span></td>
		<td><b>仙谕游戏</b><span class="i1">03-20 14:00</span></td>
		<td>双线一服<span class="i1"><a href="login.html?action=play&amp;game_id=100&amp;server_id=2" target="_blank" class="bt">进入</a></span></td>
	</tr>
	 
	<tr style="color: #f7d291;" class="">
		<td><span class="t1">03-20 14:00</span></td>
		<td><b>仙谕游戏</b><span class="i1">03-20 14:00</span></td>
		<td>双线一服<span class="i1"><a href="login.html?action=play&amp;game_id=100&amp;server_id=1" target="_blank" class="bt">进入</a></span></td>
	</tr>
		</tbody>
	</table>
	</div>
	<div class="ht05"></div>
	<div class="ui-head1">
		<p><label for="">常见问题</label></p><a style="float:right; margin:-25px -3px 0 0; color:#ff7200; position: relative;" href="news.html">MORE&gt;&gt;</a>
	</div>
	<div class="ui-homenews">
		<div class="cont">
			<ul>
						<li>
				<p><a href="contentc9f8.html?id=456" target="_blank">交易纠纷处理</a></p>
			</li>
						<li>
				<p><a href="content3a9f.html?id=6" target="_blank">各种常用浏览器清理缓存方法</a></p>
			</li>
						<li>
				<p><a href="contentd61c.html?id=5" target="_blank">如何防止游戏加载不成功和黑屏现象</a></p>
			</li>
						<li>
				<p><a href="contentdcfd.html?id=4" target="_blank">常见网络异常问题FAQ</a></p>
			</li>
						</ul>
		</div>
	</div>
	<div class="ht20"></div>
	<div class="ui-head1">
		<p><label for="">快速通道</label></p>
	</div>
	<div class="ui-fastenter">
		<ul>
			<li>
				<a target="_blank" href="reg.html" class="i">
					<i class="ico1"></i>
					免费注册
				</a>
			</li>
			<li>
				<a target="_blank" href="userca79.html?action=forget" class="i">
					<i class="ico2"></i>
					找回密码
				</a>
			</li>
			<li>
				<a target="_blank" href="login.html?action=setuser" class="i">
					<i class="ico3"></i>
					完善资料
				</a>
			</li>
			<li>
				<a target="_blank" href="login.html?action=setpass" class="i">
					<i class="ico4"></i>
					修改密码
				</a>
			</li>
			<li>
				<a target="_blank" href="pay.html" class="i">
					<i class="ico5"></i>
					游戏充值
				</a>
			</li>
			<li>
				<a target="_blank" href="kefu.html" class="i">
					<i class="ico6"></i>
					在线客服
				</a>
			</li>
		</ul>
	</div>
</div>			<div class="clearfix"></div>
		</div>
	</div>
	<div id="flinks" style="width:1240px;height:50px;margin:auto;overflow:hidden;">
	<div class="sy_recgame_title">
		  <div class="sy_recgame_title_a f_l"><span style="color:rgb(255,93,19);font-size:16px;">友情链接</span></div>
		  <div style="float:right;margin:-20px 0 0 0;"><a href="javascript:;" style="color:rgb(255,93,19) ;" title="更多" onclick="" class="another" id="linkmore"></a></div>
		  <div class="clear"></div>
	</div>        
	<style type="text/css">
		.ul_flink li{float:left;}
		.raidergame_con_x a {display:inline-block; padding:0 15px 10px 0;}
		#linkmore{display:inline-block;width:14px;height:14px;background:url(static/images/kry.jpg) 0 -360px no-repeat;}
		#linkmore:hover{background-position:0 -620px;-webkit-animation:rotate 400ms ease;-moz-animation:rotate 400ms ease;}
		#linkmore.other{background-position:0 -560px;}
	</style>
	<div class="sy_raidergame_con">            
		<div class="raidergame_con_x">
			<ul class="ul_flink">
						</ul>
		</div>
	</div>   
</div></div>

<!--<div id="footer">-->
<!--      <div class="b">-->
<!--        <div class="container">-->
<!--          <div class="ht30"></div>-->
<!--          <div class="link"><img src="static/picture/logo.png" alt="">-->
<!--            <div class="ct">-->
<!--              <p>-->
<!--                <a href="about_us.html" target="_blank">关于我们</a>-->
<!--                &nbsp;-->
<!--                |-->
<!--                &nbsp;<strong></strong>-->
<!--                <a href="about_usdcf7.html?type=5" target="_blank">联系我们</a>-->
<!--                &nbsp;-->
<!--                | -->
<!--                &nbsp;-->
<!--                <a href="kefu.html" target="_blank">客服中心</a>-->
<!--                &nbsp;-->
<!--                |-->
<!--                &nbsp;-->
<!--                <a href="jh.html" target="_blank">家长监护</a>-->
<!--              </p>-->
<!--              <p>抵制不良网页游戏，拒绝盗版游戏，注意自我保护，谨防受骗上当。适度游戏益脑，沉迷游戏伤身。合理安排时间，享受健康生活。</p>-->
<!--			  <p class="banquan">-->
<!--				Copyright © 2019    北京优游互动网络科技有限公司旗下游戏平台 版权所有-->
<!--				<br>-->
<!--				<a href="http://www.miitbeian.gov.cn/" target="_blank" style="color:#878787;">京ICP备19013428号</a> &nbsp; &nbsp; &nbsp;   地址： 北京市丰台区西罗园二区14号楼二层011室-->
<!--				<br> 抵制不良游戏，拒绝盗版游戏。 注意自我保护，谨防受骗上当。 适度游戏益脑，沉迷游戏伤身。 合理安排时间，享受健康生活。-->
<!--			  </p>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="ht30"></div>-->
<!--        </div>-->
<!--      </div>-->
<!--</div>-->
</body>
<!-- Mirrored from www.zhongxiangtimes.cn/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Feb 2020 01:32:05 GMT -->
</html>
<tc_include file="Public:footer" />
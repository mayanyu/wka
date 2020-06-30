<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo ($site_name); ?> <?php echo L('ADMIN_CENTER');?></title>
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta name="robots" content="noindex,nofollow">
		<link href="/admin/themes/simplebootx/Public/assets/css/admin_login.css?time=1" rel="stylesheet" />
		<style>
			*{
				font-family: "KaiTi" !important;
			}
			html{
				background-color: #FFFFFF;
			}
			.wrap{
				margin-top: 10%;
				width: 340px;
			}
			#login_btn_wraper{
				text-align: center;
			}
			#login_btn_wraper .tips_success{
				color:#fff;
			}
			#login_btn_wraper .tips_error{
				color:#DFC05D;
			}
			#login_btn_wraper .btn{
				background: #FDE84F !important;
			}
			#login_btn_wraper button:focus{outline:none;}
			.login ul{
				border: 1px solid #d3d4d4;
				box-shadow: none;
			}
			.login li{
				border: 0px;
				border-bottom: 1px solid #d3d4d4;
			}
			.login-title{
				margin: 0 0 20px;
				font-size: 26px;
				font-family: '微软雅黑' !important;
				font-weight: normal;
				text-align: center;
			}
			
			.login-background{
				position: fixed;
				top: 0px;
				left: 0px;
				right: 0px;
				bottom: 0px;
				z-index: -1;
				background: url(/public/assets/images/adminbg.jpg) center top no-repeat;
				background-size: 100%;
				
			}
			
			.bgWarp {
			background: rgba(255,255,255,0.6);
			padding: 50px;
			width: 260px;
			}
			
			.adminFooter {
				border-top: 1px solid #ccc;
				padding: 30px;
				color: #333;
				text-align: center;
				background: #fff;
				font-family: "微软雅黑" !important;
				font-size: 13px;
				position: fixed;
				left: 0;
				bottom:0;
				width: 100%;
			}
			
		</style>
		<script>
			if (window.parent !== window.self) {
					document.write = '';
					window.parent.location.href = window.self.location.href;
					setTimeout(function () {
							document.body.innerHTML = '';
					}, 0);
			}
		</script>
		
	</head>
<body>
	<div class="login-background"></div>
	<div class="wrap">
	<div class="bgWarp">
		<h1 class="login-title">后台管理</h1>
		<form method="post" name="login" action="<?php echo U('public/dologin');?>" autoComplete="off" class="js-ajax-form">
			<div class="login">
				<ul>
					<li>
						<input class="input" id="js-admin-name" required name="username" type="text" placeholder="<?php echo L('USERNAME_OR_EMAIL');?>" title="<?php echo L('USERNAME_OR_EMAIL');?>" value="<?php echo ($_COOKIE['admin_username']); ?>"/>
					</li>
					<li>
						<input class="input" id="admin_pwd" type="password" required name="password" placeholder="<?php echo L('PASSWORD');?>" title="<?php echo L('PASSWORD');?>" />
					</li>
					<li class="verifycode-wrapper">
						<?php echo sp_verifycode_img('length=4&font_size=20&width=248&height=42&use_noise=1&use_curve=0','style="cursor: pointer;" title="点击获取"');?>
					</li>
					<li>
						<input class="input" type="text" name="verify" placeholder="<?php echo L('ENTER_VERIFY_CODE');?>" />
					</li>
				</ul>
				<div id="login_btn_wraper">
					<button type="submit" name="submit" class="btn js-ajax-submit" data-loadingmsg="<?php echo L('LOADING');?>"><?php echo L('LOGIN');?></button>
				</div>
			</div>
		</form>
	</div>
	
	
	
	
	</div>


<script>
var GV = {
	DIMAUB: "",
	JS_ROOT: "/public/js/",//js版本号
	TOKEN : ''	//token ajax全局
};
</script>
<script src="/public/js/wind.js"></script>
<script src="/public/js/jquery.js"></script>
<script type="text/javascript" src="/public/js/common.js"></script>
<script>
;(function(){
	document.getElementById('js-admin-name').focus();
})();
</script>
</body>
</html>
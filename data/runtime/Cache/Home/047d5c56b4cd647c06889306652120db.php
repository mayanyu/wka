<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="description" content="">
  
  <link rel="stylesheet" href="/public/assets/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="/public/assets/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/public/assets/animate.css">
  <link rel="stylesheet" href="/public/assets/hover/css/hover-min.css">
  <link rel="stylesheet" href="/public/assets/src/css/main.css">
  <link rel="icon" href="/public/static/favicon.ico">
  
  <title><?php echo ($title); ?> - <?php echo ($site_name); ?></title>
  <style>
  </style>
  </head>

<nav class="navbar navbar-expand-md">
		<div class="wid800" style="display: block;">
				<ul class="list-group sidebar-nav">
						<?php if(!$user): ?><li class="list-group-item"> <a class="alink" href="#" data-toggle="modal" data-target="#registerModal"> 注册 </a></li>
								<li class="list-group-item"> <a class="alink" href="#" data-toggle="modal" data-target="#loginModal"> 登录 </a></li>
								<?php else: ?>
								<li class="list-group-item"> <a href="./index.php?m=Personal&a=index"><?php echo ($user['user_nicename']); ?></a></li>
								<li class="list-group-item"> <a href="./<?php echo ($user['id']); ?>">我的直播</a></li>
								<li class="list-group-item"> <a href="#" onclick="Login.logout()">退出登录</a> </li><?php endif; ?>
				</ul>
				<div class="hTxt"><a href="/index.php?g=home&m=index&a=live"><img src="/public/images/img01.png" alt="" /></a></div>
				
		</div>
		
		<div class="bgNav">
		<ul class="list-group sidebar-nav">
						<li class="list-group-item"> <a href="/">首页 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=home&m=index&a=live"> 在线直播 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=home&m=index&a=record"> 精彩回放 </a></li>
						<li class="list-group-item"><a href="/index.php?g=home&m=index&a=de">优游互动</a></li>

						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=25"> 直播公约 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=26"> 直播服务协议 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=27"> 直播承诺书</a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=28"> 纠纷处理</a></li>
						<li class="list-group-item"> <a href="/admin/"> 后台监管</a></li>
				</ul>
		</div>
</nav>
<!-- 登录 -->
<div class="modal fade" id="loginModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- 模态框头部 -->
			<div class="modal-header">
				<h4 class="modal-title">用户登录</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- 模态框主体 -->
			<div class="modal-body">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							账号
						</span>
					</div>
					<input id="login-username" type="text" class="form-control" placeholder="请输入用户名">
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							密码
						</span>
					</div>
					<input id="login-password" type="password" class="form-control" placeholder="请输入密码">
				</div>

				<div class="input-group">
					<p>登录即表示您同意<em><a style="color: #da5537;" href="./index.php?m=page&a=agreement" target="_blank">《用户协议》</a></em></p>
				</div>
			</div>

			<!-- 模态框底部 -->
			<div class="modal-footer">
				<button type="button" class="form-control btn btn-primary" onclick="Login.dologin()" style='color:#FFFF99;font-weight:800;'>
					登录
				</button>
			</div>
		</div>
	</div>
</div>

<!-- 注册 -->
<div class="modal fade" id="registerModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- 模态框头部 -->
			<div class="modal-header">
				<h4 class="modal-title">用户注册</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- 模态框主体 -->
			<div class="modal-body">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							用户名
						</span>
					</div>
					<input id="reg-username" type="text" class="form-control" placeholder="请输入用户名">
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							密码
						</span>
					</div>
					<input id="reg-password1" type="password" class="form-control" placeholder="请输入密码">
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							确认密码
						</span>
					</div>
					<input id="reg-password2" type="password" class="form-control" placeholder="请输入密码">
				</div>
              
              
              
               <div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							真实姓名
						</span>
					</div>
					<input id="reg-username1" type="text" class="form-control" placeholder="请输入真实姓名">
				</div>
              <div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							手机号
						</span>
					</div>
					<input id="reg-username2" type="text" class="form-control" placeholder="请输入手机号">
				</div>
              <div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">
							身份证号
						</span>
					</div>
					<input id="reg-username3" type="text" class="form-control" placeholder="请输入身份证号">
				</div>
              
              
              
              

				<div class="input-group">
					<p>注册即表示您同意<em><a style="color: #da5537;" href="./index.php?m=page&a=agreement" target="_blank">《用户协议》</a></em></p>
				</div>
			</div>

			<!-- 模态框底部 -->
			<div class="modal-footer">
				<button type="button" class="form-control btn btn-primary" onclick="Login.doreg()">
					注册
				</button>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
body,html {
	height: 100%;
	min-height: 100%;
}

</style>
<body class="home-index">
<div class="jumbotron"> </div>
<script src="/public/assets/js/jquery3.3.1.min.js"></script> 
<script src="/public/assets/js/popper.min.js"></script> 
<script src="/public/assets/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
<script src="/public/assets/vue/vue.js"></script> 
<script src="/public/assets/js/jquery.cookie.js"></script> 
<script src="/public/assets/js/holder.min.js"></script> 
<script src="/public/home/js/login.js"></script> 
<script src="/public/assets/src/js/main.js"></script>
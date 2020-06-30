<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<html lang="en">
	<head>
	<link type="text/css" rel="stylesheet" href="/public/home/css/common.css"/>
		<title>北京京耀星辉文化传播有限公司-跳转提示</title>
		<!doctype html>
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
  <link rel="stylesheet" href="/public/css/main.css">
  <link rel="icon" href="/public/static/favicon.ico">
  
  <title><?php echo ($title); ?> - <?php echo ($site_name); ?></title>
  
  <style>
	  .sidebar-nav{
		  position: fixed;
		  max-width: 100px;
		  top: 200px;
		  right: 30px;
	  }
  </style>
  </head>
		<style type="text/css">
		*{ padding: 0; margin: 0; }
		body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
		.system-message{ padding: 24px 48px;text-align: center; }
		.system-message h1{ font-size: 20px; font-weight: normal; line-height: 60px;text-align: center;}
		.system-message .jump{ margin-top:-40px;text-align:center}
		.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px;margin-top:-40px}
		.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
		</style>
	</head>
<body class="body-white">
	<!doctype html>
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

	<div class="system-message">
	<?php if(isset($message)): ?><h1>尚未登录</h1> 
	<p class="success"><?php echo($message); ?></p>
	<?php else: ?>
	<!-- <h1>尚未登录</h1> -->
	<p class="error" style="text-align:center"><img src="/public/home/images/Nologon.gif"></p><?php endif; ?>
	<p class="detail"></p>
	<p class="jump">
	<a id="href" href="<?php echo($jumpUrl); ?>"></a><?php echo($error); ?><b id="wait"><?php echo($waitSecond); ?></b>
	</p>
	</div>
	<script type="text/javascript">
	(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		
		};
	}, 1000);
	})();
	</script>

</body>
</html>
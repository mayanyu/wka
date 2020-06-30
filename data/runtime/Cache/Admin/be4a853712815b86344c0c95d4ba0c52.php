<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
		
		*{
			font-family: "KaiTi" !important;
		}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo U('Userauth/index');?>">认证申请</a></li>
			<li class="active"><a >添加</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Userauth/adding');?>">
		 
			<fieldset>
				<div class="control-group">
					<label class="control-label">会员ID</label>
					<div class="controls">
						<input type="text" name="uid" value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">真实姓名</label>
					<div class="controls">
						<input type="text" name="real_name" value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">手机号码</label>
					<div class="controls">
						<input type="text" name="mobile"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">银行卡号</label>
					<div class="controls">
						<input type="text" name="card_no"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">开户银行</label>
					<div class="controls">
						<input type="text" name="bank_name"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">开户地</label>
					<div class="controls">
							<input type="hidden" name="accounts_province"  value="">
							<input type="hidden" name="accounts_city"  value="">
						<input type="text" name="accounts"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">支行名称</label>
					<div class="controls">
						<input type="text" name="sub_branch"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">证件类型</label>
					<div class="controls">
						<input type="text" name="cer_type"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">证件号</label>
					<div class="controls">
						<input type="text" name="cer_no"  value="">
						<span class="form-required">*</span>
					</div>
				</div>
			
		
				<div class="control-group">
					<label class="control-label">审核状态</label>
					<div class="controls">
						<label class="radio inline" for="status_2"><input type="radio" name="status" value="2" id="status_2">失败</label>
						<label class="radio inline" for="status_0"><input type="radio" name="status" value="0" id="status_0">处理中</label>
						<label class="radio inline" for="status_1"><input type="radio" name="status" value="1" id="status_1">成功</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">失败原因</label>
					<div class="controls">
						 <textarea name="reason" rows="2" cols="20" id="reason" class="inputtext" style="height: 100px; width: 500px;"></textarea>
						<span class="form-required">*</span>
					</div>
				</div>

			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('EDIT');?></button>
				<a class="btn" href="<?php echo U('Userauth/index');?>"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script type="text/javascript" src="/public/js/content_addtop.js"></script>
</body>
</html>
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
<style>
	.controls img{
     max-width:200px;
 }
</style>
</head>
<body style="padding: 15px;">
	<form action="/index.php?g=User&m=indexadmin&a=upload_thumb&id=<?php echo ($id); ?>" method="post" enctype="multipart/form-data">
		<?php if($userinfo['avatar'] != ''): ?><img src="<?php echo ($userinfo['avatar']); ?>" id="thumb_preview" width="135" style="cursor: hand" />
			<?php else: ?>
			<img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb_preview" width="135" style="cursor: hand" /><?php endif; ?>
	    <input type="file" name="file" id="file">
		<br>
		<br>
	    <input type="submit" name="submit" value="上传">
		<br>
		<p><?php echo ($msg); ?></p>
		<br>
		<a href="/index.php?g=User&m=indexadmin&a=edit&id=<?php echo ($id); ?>">返回用户信息页</a> | <a href="javascript:location.reload()">重新加载</a>
		
	</form>
	<script>
		function reback(){
			var _url_ = "/index.php?g=User&m=indexadmin&a=edit&id=<?php echo ($id); ?>";
		}
		
	</script>
	<script>
		(function() {
			$("#file").on("click", function() {
				let imgPreviewElement = document.getElementById("thumb_preview");
				let inputElement = document.getElementById("file");
				inputElement.addEventListener("change", (e) => {
					imgPreviewElement.src = URL.createObjectURL(e.target.files[0]);
				}, false);
			});
		})()
	</script>
</body>
</html>
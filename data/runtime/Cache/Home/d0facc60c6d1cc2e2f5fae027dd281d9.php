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
		<div class="container" style="display: block;">
				<div class="logo"><a href="/"><img src="/public/images/logo.png" alt="" /></a></div>
				<ul class="list-group sidebar-nav">
						<li class="list-group-item"> <a href="/"> 首页 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=home&m=index&a=live"> 在线直播 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=home&m=index&a=record"> 精彩回放 </a></li>
						<li class="list-group-item"><a href="/index.php?g=home&m=index&a=de">优游互动</a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=25"> 直播公约 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=26"> 直播服务协议 </a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=27"> 直播承诺书</a></li>
						<li class="list-group-item"> <a href="/index.php?g=portal&m=page&a=news&id=28"> 纠纷处理</a></li>
						<li class="list-group-item"> <a href="/admin/"> 后台监管</a></li>
						<?php if(!$user): ?><li class="list-group-item"> <a class="alink" href="#" data-toggle="modal" data-target="#registerModal"> 注册 </a></li>
								<li class="list-group-item"> <a class="alink" href="#" data-toggle="modal" data-target="#loginModal"> 登录 </a> </li>
								<?php else: ?>
								<li class="list-group-item">
										<div id="nickname" style="display: none;"><?php echo ($user['user_nicename']); ?></div>
										<a href="./index.php?m=Personal&a=index"><?php echo ($user['user_nicename']); ?></a></li>
								<li class="list-group-item"> <a href="./<?php echo ($user['id']); ?>">我的直播</a></li>
								<li class="list-group-item"> <a href="#" onclick="Login.logout()">退出登录</a> </li><?php endif; ?>
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


<script src="/public/jsdev/flv.js"></script>

<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.2/skins/default/aliplayer-min.css" />
<script type="text/javascript" charset="utf-8"
    src="https://g.alicdn.com/de/prismplayer/2.8.2/aliplayer-min.js"></script>



<body class="home-show">
    <link rel="stylesheet" type="text/css" href="/public/home/show/css/show.css" />
    <link rel="stylesheet" type="text/css" href="/public/assets/src/css/show.css" />
<div class="bgBlue">
    <div class="container show-content">
        <div class="row">
            <div class="col-md-6 left">

                <div class="mainContainer" style="margin-top:80px">
                    <div>
                        <div id="streamURL">
                            <div class="url-input" style="display: none">
                                <label for="sURL">Stream URL:</label>
                                <input id="sURL" type="text" value="<?php echo ($pull); ?>" />
                                <button onClick="switch_mds()">Switch to MediaDataSource</button>
                            </div>
                            <div class="options" style="display: none">
                                <input type="checkbox" id="isLive" onChange="saveSettings()" />
                                <label for="isLive" checked>isLive</label>
                                <input type="checkbox" id="withCredentials" onChange="saveSettings()" />
                                <label for="withCredentials">withCredentials</label>
                                <input type="checkbox" id="hasAudio" onChange="saveSettings()" checked />
                                <label for="hasAudio">hasAudio</label>
                                <input type="checkbox" id="hasVideo" onChange="saveSettings()" checked />
                                <label for="hasVideo">hasVideo</label>
                            </div>
                        </div>
                        <div id="mediaSourceURL" class="hidden" style="display:none">
                            <div class="url-input">
                                <label for="msURL">MediaDataSource JsonURL:</label>
                                <input id="msURL" type="text" value="http://127.0.0.1/flv/7182741.json" />
                                <button onClick="switch_url()">Switch to URL</button>
                            </div>
                        </div>
                    </div>
                    <div class="video-container">
                        <div>
                            <video name="videoElement" class="centeredVideo" controls autoplay
                                style="    height: 600px; display: none;">
                                您的浏览器不支持
                            </video>

                            <div class="h5info" style="
 position: absolute;
 left: 50%;
 top: 50%;
 margin-top: -25px;
 margin-left: -75px;
 background-color: #3e3c3cb8;
 color: #fff;
 font-size: 30px;
">主播未上线</div>



                            <div class="prism-player" id="player-con"></div>

                           

                        </div>
                    </div>
                    <div class="controls" style="display: none">
                        <button onClick="flv_load()">Load</button>
                        <button onClick="flv_start()">Start</button>
                        <button onClick="flv_pause()">Pause</button>
                        <button onClick="flv_destroy()">Destroy</button>
                        <input style="width:100px" type="text" name="seekpoint" />
                        <button onClick="flv_seekto()">SeekTo</button>
                    </div>
                    <textarea name="logcatbox" class="logcatBox" rows="10" readonly style="display: none"></textarea>
                </div>




            </div>

            <div class="col-md-6">
                <!--主播信息-->
                <div class="author">
                    <div class="media">
                        <img src="<?php echo ($anchorinfo["avatar"]); ?>" class="img-fluid" />
                        <div class="media-body">
                            <h5><?php echo ($anchorinfo["user_nicename"]); ?></h5>
                            <p>ID：<?php echo ($anchorinfo["id"]); ?></p>
                            <a class="btn btn-primary BTN-add-attention" href="javascript:void(0)">+关注</a>
                        </div>
                    </div>
                </div>

                <!--信息通知-->
                <div class="chart-area">
                    <!-- 信息通知 -->
                    <div class="SR-area-chat" id="LF-area-chat">
                        <div class="chat-msg" id="LF-chat-msg">
                            <!-- 礼物记录 -->
                            <div class="MR-msg">
                                <div class="msg-gift player-main" id="msg_gift">
                                    <div class="MR-chat">
                                        <div class="boarder">
                                            <ul class="clearfix">

                                            </ul>
                                        </div>
                                        <div class="scroller"></div>
                                    </div>
                                    <div class="hjPopbox"></div>
                                </div>
                                <span class="MR-sound-toggle hide">声效开</span>
                                <div class="MR-sound-tip hide"></div>
                            </div>
                            <!-- 聊天记录 -->
                            <div id="LF-chat-msg-area" class="MR-msg">
                                <div class="msg-chat">
                                    <div class="MR-chat">
                                        <div class="boarder">
                                            <ul class="clearfix">
                                                <li style="color:#333; padding: 10px 10px 0;"><span class="fake-name" style="color:#ff0000; font-weight: bold; font-size: 18px; display: block; margin-bottom: 5px;">直播间消息：</span>直播内容包含任何低俗、暴露和涉黄内容，账号会被封禁；安全部门会24小时巡查哦～</li>
                                                
                                                
                                            </ul>
                                        </div>
                                        <!-- <div class="scroller"></div> -->
                                        <span class="ICON-lock-screen hide"></span>
                                    </div>
                                </div>
                                <div class="MR-msg-notice clearfix hide">
                                    <span class="title">弹幕</span>
                                    <div class="msg-content"></div>
                                </div>
                            </div>

                        </div>
                        <div class="chat-talk" id="LF-chat-talk">
                            <div class="MR-talk">
                                <span class="send-btn">发送</span>
                                <div class="speaker">
                                    <input type="text" value="想对主播说点什么？" />
                                    <cite>30</cite>
                                </div>
                                <div class="emoticon-toggle-panel">
                                </div>
                            </div>
                            <!-- 喇叭 -->
                            <div class="MR-horn">
                                <div class="toggle"></div>
                                <div class="selector M-bubble hide">
                                    <div class="arrow-right"></div>
                                    <span class="closed"></span>
                                    <div class="detail">
                                        <div class="btn gold hide" data-gid="" data-num="0">
                                            <p class="name">金喇叭<span class="num"></span></p>
                                            <p class="price"><i class="ICON-coins">200</i></p>
                                        </div>
                                        <div class="btn site" data-gid="" data-num="0">
                                            <p class="name">弹幕<span class="num"></span></p>
                                            <p class="price"><i class="ICON-coins"><?php echo ($getConfigPri['barrage_fee']); ?></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dialog hide">
                                    <h4 class="gold"><i></i></h4>
                                    <div class="detail">
                                        <textarea>请输入...</textarea>
                                        <div class="opt clearfix">
                                            <span></span>
                                            <span class="num" style="display: none;">，本次免费</span>
                                            <input type="button" value="发送" class="horn-send" />
                                        </div>
                                        <span class="closed"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 礼物 -->
                        <div class="chat-gift" id="LF-chat-gift">
                            <div class="MR-gift">
                                <div class="gift-panel">
                                    <ul class="gift-tab">
                                        <li data-index="0" class="on">热门<i class="dot-new"></i></li>
                                        <!-- <li data-index="1">豪华</li>
                                    <li data-index="2">特殊</li>
                                    <li data-index="3">专属</li>
                                    <li data-index="4">我的包裹<i class="dot-tip hide"></i></li> -->
                                    </ul>
                                    <div class="gift-con">
                                        <div class="gift-group">

                                            <div class="gift-wrap">
                                                <div class="M-arrow-scroll">
                                                    <span class="left-arrow hide"></span>
                                                    <span class="right-arrow"></span>
                                                    <div class="con">
                                                        <div class="scroll">
                                                            <ul class="clearfix">
                                                                <?php if(is_array($giftinfo)): $i = 0; $__LIST__ = $giftinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="gift " data-locked="0"
                                                                        data-title="<?php echo ($v['giftname']); ?>"
                                                                        data-name="<?php echo ($v['giftname']); ?>"
                                                                        data-id="<?php echo ($v['id']); ?>"
                                                                        data-price="<?php echo ($v['needcoin']); ?>">
                                                                        <div class="gift-pic">
                                                                            <img src="<?php echo ($v['gifticon']); ?>" />
                                                                        </div>
                                                                        <?php if($v['type'] == '1'): ?><div class="gift-lian">
                                                                                连
                                                                            </div><?php endif; ?>
                                                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="MR-gift-tip hide">
                                                <div class="tip-content">
                                                    <img class="tip-img" src="">
                                                    <div class="gift-tip-con">
                                                        <span class="gift-tip-name"></span>
                                                        <span class="gift-tip-price"></span>
                                                    </div>
                                                    <div class="gift-tip-desc"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gift-footer clearfix">
                                            <!-- 星星 -->
                                            <div class="MR-free-gift hide">
                                                <div class="MR-star">
                                                    <div class="progress"></div>
                                                    <div class="icon"></div>
                                                    <div class="count">
                                                        40
                                                    </div>
                                                </div>
                                                <ul class="freegift-more clrearfix">
                                                    <li class="more-btn star-0">
                                                        <div class="icon"></div>
                                                    </li>
                                                    <li class="more-btn star-1">
                                                        <div class="icon"></div>
                                                    </li>
                                                    <li class="more-btn star-10">
                                                        <div class="icon"></div>
                                                        <div class="bg">
                                                            <div class="tips ">
                                                                星动
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- 点歌 -->
                                            <div class="MR-app MR-app-content hide">
                                                <div class="MR-app-item M-app-UI-enable">
                                                    <span class="icon app-icon-song"></span>
                                                    <span class="title">点歌</span>
                                                </div>
                                            </div>
                                            <!-- 礼物赠送数量 -->
                                            <div class="MR-moregift">
                                                <a class="send-btn" href="javascript:void(0);">赠送</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 头条 -->
                        <div class="MR-big-gift">
                            <div class="out-boxer" style="opacity: 1; top: 0px;">
                                <div class="high-boxer" style="margin-left: -149.5px;">
                                    <a href="/room/67656" target="_blank">
                                        <cite class="photoer"><img
                                                src="http://static.youku.com/ddshow/img/avatar/80/33.jpg" /></cite>
                                        <cite class="desc">
                                            <span class="user" title="榴莲的小狮子">榴莲的小狮子</span>
                                            <span class="txt">送给</span>
                                            <span class="name" title="大大元气满满">大大元气满满</span>心心相印
                                        </cite>
                                        <span class="gift-pic"><img
                                                src="http://static.youku.com/ddshow/img/lfgift/xxxy5_80_80.png" /></span>
                                        <cite class="desc gift-num">x188</cite>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
			
			
		
			
			
			
			
        </div>



    </div>
	</div>
    </div>
</body>


<script>
    var checkBoxFields = ['isLive', 'withCredentials', 'hasAudio', 'hasVideo'];
    var streamURL, mediaSourceURL;

    function flv_load() {
        console.log('isSupported: ' + flvjs.isSupported());
        if (mediaSourceURL.className === '') {
            var url = document.getElementById('msURL').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function (e) {
                var mediaDataSource = JSON.parse(xhr.response);
                flv_load_mds(mediaDataSource);
            }
            xhr.send();
        } else {
            var i;
            var mediaDataSource = {
                type: 'flv'
            };
            for (i = 0; i < checkBoxFields.length; i++) {
                var field = checkBoxFields[i];
                /** @type {HTMLInputElement} */
                var checkbox = document.getElementById(field);
                mediaDataSource[field] = checkbox.checked;
            }
            mediaDataSource['url'] = document.getElementById('sURL').value;
            console.log('MediaDataSource', mediaDataSource);
            flv_load_mds(mediaDataSource);
        }
    }

    function flv_load_mds(mediaDataSource) {
        var element = document.getElementsByName('videoElement')[0];
        if (typeof player !== "undefined") {
            if (player != null) {
                player.unload();
                player.detachMediaElement();
                player.destroy();
                player = null;
            }
        }
        player = flvjs.createPlayer(mediaDataSource, {
            enableWorker: false,
            lazyLoadMaxDuration: 3 * 60,
            seekType: 'range',
        });
        player.attachMediaElement(element);
        player.load();
    }

    function flv_start() {
        player.play();
    }

    function flv_pause() {
        player.pause();
    }

    function flv_destroy() {
        player.pause();
        player.unload();
        player.detachMediaElement();
        player.destroy();
        player = null;
    }

    function flv_seekto() {
        var input = document.getElementsByName('seekpoint')[0];
        player.currentTime = parseFloat(input.value);
    }

    function switch_url() {
        streamURL.className = '';
        mediaSourceURL.className = 'hidden';
        saveSettings();
    }

    function switch_mds() {
        streamURL.className = 'hidden';
        mediaSourceURL.className = '';
        saveSettings();
    }

    function ls_get(key, def) {
        try {
            var ret = localStorage.getItem('flvjs_demo.' + key);
            if (ret === null) {
                ret = def;
            }
            return ret;
        } catch (e) { }
        return def;
    }

    function ls_set(key, value) {
        try {
            localStorage.setItem('flvjs_demo.' + key, value);
        } catch (e) { }
    }

    function saveSettings() {
        if (mediaSourceURL.className === '') {
            ls_set('inputMode', 'MediaDataSource');
        } else {
            ls_set('inputMode', 'StreamURL');
        }
        var i;
        for (i = 0; i < checkBoxFields.length; i++) {
            var field = checkBoxFields[i];
            /** @type {HTMLInputElement} */
            var checkbox = document.getElementById(field);
            ls_set(field, checkbox.checked ? '1' : '0');
        }
        var msURL = document.getElementById('msURL');
        var sURL = document.getElementById('sURL');
        ls_set('msURL', msURL.value);
        ls_set('sURL', sURL.value);
        console.log('save');
    }

    function loadSettings() {
        var i;
        for (i = 0; i < checkBoxFields.length; i++) {
            var field = checkBoxFields[i];
            /** @type {HTMLInputElement} */
            var checkbox = document.getElementById(field);
            var c = ls_get(field, checkbox.checked ? '1' : '0');
            checkbox.checked = c === '1' ? true : false;
        }

        var msURL = document.getElementById('msURL');
        var sURL = document.getElementById('sURL');
        msURL.value = ls_get('msURL', msURL.value);
        sURL.value = ls_get('sURL', sURL.value);
        if (ls_get('inputMode', 'StreamURL') === 'StreamURL') {
            switch_url();
        } else {
            switch_mds();
        }
    }

    function showVersion() {
        var version = flvjs.version;
        document.title = document.title + " (v" + version + ")";
    }

    var logcatbox = document.getElementsByName('logcatbox')[0];
    flvjs.LoggingControl.addLogListener(function (type, str) {

        if (str.indexOf('Received Initialization Segment') > 0) {
            console.log('start live')
            
            $('.video-box').hide();
            $('.centeredVideo').show();
            flv_start();
        }

        // if(str.indexOf('MediaSource onSourceEnded')> 0)
        // logcatbox.value = logcatbox.value + str + '\n';
        // logcatbox.scrollTop = logcatbox.scrollHeight;


    });


    function IEVersion() {
        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串  
        var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器  
        var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器  
        var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
        if (isIE) {
            var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
            reIE.test(userAgent);
            var fIEVersion = parseFloat(RegExp["$1"]);
            if (fIEVersion == 7) {
                return 7;
            } else if (fIEVersion == 8) {
                return 8;
            } else if (fIEVersion == 9) {
                return 9;
            } else if (fIEVersion == 10) {
                return 10;
            } else {
                return 6;//IE版本<=7
            }
        } else if (isEdge) {
            return 'edge';//edge
        } else if (isIE11) {
            return 11; //IE11  
        } else {
            return -1;//不是ie浏览器
        }
    }


    function flashChecker() {
        var hasFlash = 0; //是否安装了flash
        var flashVersion = 0; //flash版本
        if (document.all) {
            var swf = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
            if (swf) {
                hasFlash = 1;
                VSwf = swf.GetVariable("$version");
                flashVersion = parseInt(VSwf.split(" ")[1].split(",")[0]);
            }
        } else {
            if (navigator.plugins && navigator.plugins.length > 0) {
                var swf = navigator.plugins["Shockwave Flash"];
                if (swf) {
                    hasFlash = 1;
                    var words = swf.description.split(" ");
                    for (var i = 0; i < words.length; ++i) {
                        if (isNaN(parseInt(words[i]))) continue;
                        flashVersion = parseInt(words[i]);
                    }
                }
            }
        }
        return { f: hasFlash, v: flashVersion };
    }
    var fls = flashChecker();



    document.addEventListener('DOMContentLoaded', function () {


        console.log('asd','<?php echo ($pull); ?>')
         var pull_url = '<?php echo ($pull); ?>'
        if('<?php echo ($pull); ?>' == ''){
            console.log('主播还未上播，稍等片刻');
            $("#loading").html("<img src='public/images/yun_img04.gif' width='250' >"+"<br>"+"<br>"+"主播还未上播，稍等片刻");
            $('.centeredVideo').hide();
            return;
        }else{
            console.log('已开播');
        }
        console.log('ie', IEVersion())

        if (fls.f == 0) {
         var player=new Aliplayer({"id":"player-con","source":pull_url,"width":"100%","height":"350px","autoplay":true,"isLive":true,"rePlay":false,"playsinline":true,"preload":true,"controlBarVisibility":"hover","useH5Prism":true,"skinLayout":[{"name":"bigPlayButton","align":"blabs","x":30,"y":80},{"name":"errorDisplay","align":"tlabs","x":0,"y":0},{"name":"infoDisplay"},{"name":"controlBar","align":"blabs","x":0,"y":0,"children":[{"name":"liveDisplay","align":"tlabs","x":15,"y":6},{"name":"fullScreenButton","align":"tr","x":10,"y":10},{"name":"volume","align":"tr","x":5,"y":10}]}]},function(player){console.log("The player is created")});

        } else {
            console.log('flash')
            $('.video-box').hide();
            $('.centeredVideo').hide();
            
            var player = new Aliplayer({
                "id": "player-con",
                "source": "<?php echo ($pull); ?>",
                "width": "100%",
                "height": "350px",
                "autoplay": true,
                "isLive": true,
                "rePlay": false,
                "showBuffer": true,
                "snapshot": false,
                "showBarTime": 5000,
                "useFlashPrism": true,
                "skinLayout": [
                    {
                        "name": "bigPlayButton",
                        "align": "blabs",
                        "x": 30,
                        "y": 80
                    },
                    {
                        "name": "errorDisplay",
                        "align": "tlabs",
                        "x": 0,
                        "y": 0
                    },
                    {
                        "name": "infoDisplay"
                    },
                    {
                        "name": "controlBar",
                        "align": "blabs",
                        "x": 0,
                        "y": 0,
                        "children": [
                            {
                                "name": "liveDisplay",
                                "align": "tlabs",
                                "x": 15,
                                "y": 25
                            },
                            {
                                "name": "fullScreenButton",
                                "align": "tr",
                                "x": 10,
                                "y": 25
                            },
                            {
                                "name": "volume",
                                "align": "tr",
                                "x": 10,
                                "y": 25
                            }
                        ]
                    }
                ]
            }, function (player) {
                console.log("The player is created");
            }
            );


        }

        // flv_start();
    });
</script>


<script>


    console.log(fls);
</script>

<style>
    .main {
        margin: 40px;
        margin-left: 13%;
    }
</style>





<script>
    
		var _DATA = {};
		_DATA.config = <?php echo ($configj); ?>;
		_DATA.anchor = <?php echo ($anchorinfoj); ?>;
		_DATA.live = <?php echo ($liveinfoj); ?>;
		_DATA.gift = <?php echo ($giftinfoj); ?>;
		_DATA.user = <?php echo ($userinfo); ?>;
		var charge_interval = null;
		var giftQueue = new Array();
		var giftPlayState = 0;
		var carQueue = new Array();
		var carPlayState = 0;
	</script>
	
	<script src="/public/js/jquery.js"></script>
	<script src="/public/js/md5.js"></script>
	<!-- <script src="/public/home/js/Ku6SubField.js"></script> -->
	<!-- <script src="/public/home/js/swfobject-2.3.js"></script> -->
	<script src="/public/home/js/event.js"></script> 
	<script src="/public/home/js/socket.io.js"></script> 
	<!-- <script>var socket = new io("<?php echo ($configpri['chatserver']); ?>");</script> -->
	<script src="/public/home/js/eventListen.js"></script> 
	<script src="/public/swf/jwplayer.js"></script>  
	
	<script src="/public/home/show/js/chat.js"></script>
	
	<script type="text/javascript" src="/public/home/js/common.js"></script>

	<script type="text/javascript">
		liveType.checkLive();
	</script>
	
	<script>
		var pull = "<?php echo ($pull); ?>";
		var user = false;
		//pull = "http://playertest.longtailvideo.com/adaptive/bipbop/gear4/prog_index.m3u8";
	</script>
	<?php if($user): ?><script type="text/javascript">
			user = true;
		</script><?php endif; ?>
	<script src="/public/assets/js/jquery3.3.1.min.js"></script>
	<!---->
	<?php if($pull): ?><!-- <script src="/public/assets/src/js/show.js"></script> -->
	<?php else: ?>
	<script>
        $(".centeredVideo").hide();
        $("#loading").html("<img src='public/images/yun_img04.gif'  width='250'>"+"<br>"+"<br>"+"主播还未上播，稍等片刻");
        $(".video-box").show();
		$("#loading").show();
	</script><?php endif; ?>
	
	<script>
	
	</script>
<!--<div class="videoImg">

<video poster="/public/images/video.jpg" style="width:100%" preload="none" onClick="this.play()" controls>
				<source src="/public/video/123.mp4" type="video/mp4" />
			</video>
</div>-->
<div class="btmBanner"><img src="/public/images/banner_img.png" alt="" /></div>
<div class="footer text-center">
		<div class="container">
				<div class="footer-row l1"> <a href="/">首页</a> <a href="/admin/">后台监管</a> <a href="/index.php?g=portal&m=page&a=news&id=25"> 直播公约 </a>
				<a href="/de/index.html">优游互动</a>
				<a href="/index.php?g=portal&m=page&a=news&id=26"> 直播服务协议 </a> <a href="/index.php?g=portal&m=page&a=news&id=27"> 直播承诺书 </a> <a href="/index.php?g=portal&m=page&a=news&id=28"> 纠纷处理 </a></div>
				<div class="footer-row l3">
						<p><?php echo ($copyright); ?> <span> | </span> <a href="http://www.beian.miit.gov.cn"><?php echo ($site_icp); ?></a> <span> | </span><?php echo ($site_telephone); ?><span> | 公司地址：北京市朝阳区霞光里15号楼11层1单元1208</span> </p>
				</div>
				<div id="footer-row l1" style="margin-top:15px;">
						<ul class="fImg">
								<li><a href="http://jbts.mct.gov.cn/"><img src="/public/images/f_img01.jpg" alt="" /></a></li>
								<li><a href="http://www.bjjubao.net/"><img src="/public/images/f_img02.jpg" alt="" /> </a></li>
								<li><a href="http://www.bjjubao.org/"><img src="/public/images/f_img03.jpg" alt="" /></a></li>
						</ul>
				</div>
				
				<!--<div id="footer-row l1" style="margin-top:15px;"> <a href="http://jbts.mct.gov.cn/">12318全国文化市场举报网站</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://report.12377.cn:13225/toreportinputNormal_anis.do">北京互联网违法和不良信息举报 </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.bjjubao.org/">网上有害信息举报专区</a> </div>--> 
		</div>
</div>
<script src="/public/assets/js/jquery3.3.1.min.js"></script> 
<script src="/public/assets/js/popper.min.js"></script> 
<script src="/public/assets/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
<script src="/public/assets/vue/vue.js"></script> 
<script src="/public/assets/js/jquery.cookie.js"></script> 
<script src="/public/assets/js/holder.min.js"></script> 
<script src="/public/home/js/login.js"></script> 
<script src="/public/assets/src/js/main.js"></script>
</body></html>
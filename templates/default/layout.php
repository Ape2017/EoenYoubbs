<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
ob_start();echo '
<!doctype html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>',$title,'</title>';
	if(isset($meta_kws) && $meta_kws){
		echo '<meta name="keywords" content="',$meta_kws,'," />';
	}
	if(isset($meta_des) && $meta_des){
		echo '<meta name="description" content="',$meta_des,'" />';
	}echo '
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link href="/static/layui/css/layui.css" rel="stylesheet" type="text/css" />
	<link href="/static/default/style.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.webfont.youziku.com/webfonts/nomal/99475/29785/58e4bf26f629db0f383d2716.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="',$options['jquery_lib'],'" type="text/javascript"></script>
	<script src="/static/js/jquery.contip.js" type="text/javascript"></script>
	<script src="/static/js/jquery.lazylinepainter-1.5.1.min.js" type="text/javascript"></script>
	<script src="/static/layui/layui.js" type="text/javascript"></script>
</head>
<body>
<div class="header-wrap">
    <div class="header">
        <div class="logo"><a href="/" name="top">',htmlspecialchars($options['name']),'</a></div>
		<div class="scbox">
			<form action="/search/?p=" role="search" method="get" id="searchform">
				<i></i><input class="search-input" type="text" maxlength="30" name="q" id="q">
			</form>
		</div>
        <div class="banner">';
		if($cur_user){ 
			echo '
			<a href="/notifications" title="通知" class="notifications">';
				if($cur_user['notic']){
					$notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;
					echo'<i>',$notic_n,'</i>';
				}echo'通知
			</a>
			<a href="/usermessage/" title="私信" class="usermessage">';
				if($msg_count > 0){
					echo'<i>'.$msg_count.'</i>';
				}echo'私信
			</a>
			<a href="/follow/nodes" title="关注的话题" class="fonodes">关注的话题</a>
			<a href="/follow/user" title="关注的好友" class="fouser">关注的好友</a>
			<a href="/favorites" title="收藏的帖子" class="favorites">收藏的帖子</a>
			<a href="/logout" title="退出" class="logout">退出</a>';
		}else{
			echo '
			<a href="javascript:" title="登录" class="login">登录</a>';
			if(!$options['close_register']){
				echo '<a href="javascript:" title="注册" class="sigin">注册</a>';
			}
		}echo ' 
		</div>
        <div class="c"></div>
    </div>
</div>';
			include($pagefile);echo '
        <div class="c"></div>
    </div>
    <div class="c"></div>
</div></div>';
echo'<script>
	var Words ="%3Cdiv%20class%3D%22footer-wrap%22%3E%0A%09%09%3Cdiv%20class%3D%22footer%22%3E%0A%09%09%09%3Cdiv%20class%3D%22sep10%22%3E%3C/div%3E%0A%09%09%09%3Cdiv%20class%3D%22sep10%22%3E%3C/div%3E%0A%09%09%09Lovingly%20made%20by%20%3Ca%20href%3D%22https%3A//github.com/eoen/EoenYoubbs%22%20target%3D%22_blank%22%3EEOEN%3C/a%3E%3Cdiv%20class%3D%22sep5%22%3E%3C/div%3E%0A%09%09%09Proudly%20Powered%20by%20%3Ca%20href%3D%22https%3A//www.youbbs.org/%22%20target%3D%22_blank%22%3EYouBBS%3C/a%3E%3Cdiv%20class%3D%22footericp%22%3E"
	function OutWord(){
 		var NewWords;
 		NewWords = unescape(Words);
    	document.write(NewWords);
	} 
	OutWord();
</script>';
if($options['icp']){
	echo '<div class="sep5"></div><a href="http://www.miibeian.gov.cn/" target="_blank" rel="nofollow">',$options['icp'],'</a>';
}
if($options['show_debug']){
	$mtime = explode(' ', microtime());
	$totaltime = number_format(($mtime[1] + $mtime[0] - $starttime), 6);
	echo '<div class="sep5"></div>Processed in ',$totaltime,' second(s), ',$DBS->querycount,' queries';
}echo'
</div></div>';
if($options['analytics_code']){
    echo $options['analytics_code'];
}
if($cur_user){
	echo'
	<div id="new-post" style="display:none;">
		<div class="new-post-min">
			<div class="new-post-min-avatar">
				<a href="/user/',$cur_user['id'],'" alt="',$cur_user['name'],'"><img src="/avatar/large/',$cur_user['avatar'],'.png" /></a>
			</div>
			<div class="new-post-min-form">
				<span class="triang"></span>
				<p class="user-names-min">',$cur_user['name'],'</p>
				<div class="user-min-form">
					<form action="/newpost/2" method="post">
						<input type="hidden" name="formhash" value="',$formhash,'" />
						<input type="hidden" name="select_cid" value="2" />
						<input type="text" name="title" class="new-title" placeholder="标题"/>
						<textarea id="id-content" name="content" class="new-content" placeholder="这里可以直接粘贴优酷、腾讯视频地址或者网易音乐链接"></textarea>
						<input type="submit" value="立即发布" name="submit" class="newpostbtn" />
					</form>
					<span><a href="/newpost/2"><i></i>高级模式</a>(可以选择节点、添加标签、上传文件)</span>
				</div>
			</div>
		</div>
	</div>';
	echo"
	<script>
		layui.use('layer', function(){
			$('.new-post').on('click', function(){
				layer.close(layer.index);
				layer.open({
					type: 1,
					title: false,
					shade: [0.5, '#333'],
					area: ['550px', '300px'],
					content: $('#new-post')
				});
			});
		});
	</script>";
}else{
	echo"
	<script>
	layui.use('layer', function(){
		$('.login').on('click', function(){
			layer.close(layer.index);
			layer.open({
				type: 1,
				title: '登 录',
				shadeClose: true,
				shade: [0.5, '#333'],
				area: ['400px', '456px'], 
				content: $('#login')
			});
		});
		$('.sigin').on('click', function(){
			layer.close(layer.index);
			layer.open({
				type: 1,
				title: '注 册',
				shadeClose: true,
				shade: [0.5, '#333'],
				area: ['400px', '470px'], 
				content: $('#sigin')
			});
		});
	});
	</script>";
	echo'
	<div id="login" style="display:none;">
		<div class="form-login-box">
			<form action="/login" method="post">
				<input type="hidden" name="formhash" value="',$formhash,'" />
				<ul>
					<li><input type="text" name="name" class="nameform" value="',htmlspecialchars($name),'" placeholder="用户名"/></li>
					<li><input type="password" name="pw" class="pawdform" value="" placeholder="密码"/></li>
					<li><input type="text" name="seccode" class="seccodeform" value="" placeholder="验证码"/><img src="/seccode.php" align="absmiddle" /></li>
					<li><input type="submit" value="立即登录" name="submit" class="textbtnform" id="txtinbut"/>
				</ul>
			</form>';
			if(($options['wb_key'] && $options['wb_secret']) || ($options['qq_appid'] && $options['qq_appkey'])){
				echo'<div class="layer-box-wbqq">';
				if($options['wb_key'] && $options['wb_secret']){
					echo'<span class="layerwb"><a href="/wblogin" title="新浪微博登陆" rel="nofollow"><i></i></a></span>';
				}
				if($options['qq_appid'] && $options['qq_appkey']){
					echo'<span class="layerwx"><a href="/qqlogin" title="腾讯QQ登录" rel="nofollow"><i></i></a></span>';
				}
				echo'</div>';
			}echo'
		</div>';
		if($options['close_register'] || $options['close']){
			echo '<p class="lbtn">网站暂时停止注册 <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
		}else{
			echo '<p class="lbtn">还没有账户？<a href="javascript:" class="sigin">现在注册</a> <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
		}echo'
	</div>
	<div id="sigin" style="display:none;">
		<div class="form-login-box">
			<form action="/sigin" method="post">
				<input type="hidden" name="formhash" value="',$formhash,'" />
				<ul>
					<li><input type="text" name="name" class="nameform" value="',htmlspecialchars($name),'" placeholder="用户名"/></li>
					<li><input type="password" name="pw" class="pawdform" value="" placeholder="设置密码"/></li>
					<li><input type="password" name="pw2" class="pawdform" value="" placeholder="确认密码"/></li>
					<li><input type="text" name="seccode" class="seccodeform" value="" placeholder="验证码"/><img src="/seccode.php" align="absmiddle" /></li>
					<li><input type="submit" value="立即注册" name="submit" class="textbtnform" id="txtinbut"/>
				</ul>
			</form>
		</div>';
		if($options['close_register'] || $options['close']){
			echo '<p class="lbtn">网站暂时停止注册 <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
		}else{
			echo '<p class="lbtn">已有账户？<a href="javascript:" class="login">现在登录</a> <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
		}echo'
	</div>';
}
echo '
<script src="/static/js/jquery.lazyload.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function() {
    $(".main-box img").lazyload({
        placeholder : "/static/grey.gif",
        effect : "fadeIn"
    });
});
$(document).ready(function(){
	$("#close").click(function(){
		$("#closes").remove();
	});
});
$(window).scroll( function (){   
var  h_num=$(window).scrollTop();   
     if (h_num>1300){   
        $( ".ufo" ).addClass( "sio" );       
    } else {   
        $( ".ufo" ).removeClass( "sio" );            
    }              
});  
</script>
</body>
</html>';
$_output = ob_get_contents();
ob_end_clean();
echo $_output;

?>

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
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link href="/static/layui/css/layui.css" rel="stylesheet" type="text/css" />
	<link href="/static/default/style_ios.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.webfont.youziku.com/webfonts/nomal/99475/29785/58e4bf26f629db0f383d2716.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<script src="',$options['jquery_lib'],'" type="text/javascript"></script>
	<script src="/static/layui/layui.js" type="text/javascript"></script>
</head>
<body>
	<div class="main-wrap">
		<div class="main">
			<div class="main-content">';
				include($pagefile);echo '
			</div>
			<div class="c"></div>
		</div>
		<div class="c"></div>
	</div>
	<div class="footer-wrap">
		<div class="footer-menu">';
			if(isset($site_infos)){
				echo '<a href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>';
			}else{
				echo '<a href="javascript:history.go(-1)"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
			}echo '
			<a href="javascript:" class="btn-nav"><img src="/static/default/img/heart.png"/></a>';
			if(isset($site_infos)){
				echo '<a href="javascript:location.reload()"><i class="fa fa-refresh" aria-hidden="true"></i></a>';
			}else{
				echo '<a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>';
			}echo '
		</div>
	</div>';
	if($options['ad_web_bot']){
		echo $options['ad_web_bot'];
	}
	if($options['analytics_code']){
		echo $options['analytics_code'];
	}echo "
	<script type='text/javascript'>
		layui.use(['layer', 'element', 'util'], function () {
			var element = layui.element(), layer = layui.layer, $ = layui.jquery, util = layui.util; 
			var side = $('.my-side');
			$('.btn-nav').on('click', function(){
				if(localStorage.log == 1){
					localStorage.log = 0;
					navHide(50);
				}else{
					localStorage.log = 1;
					navShow(50);
				}
			});
			function navHide(t){
				side.animate({'bottom':-200});
			}
			function navShow(t){
				side.animate({'bottom':50});
			}
		});
		$('.photo').on('click', function(){
			layer.photos({
				photos: '.photos'
				,anim: 5 
			}); 
		});
		$(document).ready(function(){
			$('#close').click(function(){
				$('#closes').remove();
			});
		});
	</script>
</body>
</html>";
if($cur_user){
	if(isset($cid)){
		$post_in_cid = $cid;
	}else{
		if(isset($t_obj)){
			$post_in_cid = $t_obj['cid'];
		}else{
			$post_in_cid = 2;
		}
	}
	$notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;
	echo '
	<div class="layui-side my-side">
		<div class="layui-side-scroll">
			<ul class="ios-layui-nav">
				<li><a href="/notifications"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
					if($notic_n > 0){
						echo'<span>',$notic_n,'</span>';
					}echo'<b>系统通知</b>
				</li>
				<li><a href="/usermessage/"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>';
					if($msg_count > 0){
						echo'<span>',$msg_count,'</span>';
					}echo'<b>私信通知</b>
				</li>
				<li><a href="/favorites"><i class="fa fa-star-o" aria-hidden="true"></i></a><b>收藏夹</b></li>
				<li><a href="/user/',$cur_user['id'],'"><i class="fa fa-user-o" aria-hidden="true"></i></a><b>个人中心</b></li>
				<li><a href="/newpost/',$post_in_cid,'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><b>发布帖子</b></li>
				<li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a><b>退出登录</b></li>
			</ul>
		</div>
	</div>';
	}else{
		echo '
		<div class="layui-side my-side">
			<div class="layui-side-scroll">
				<ul class="ios-layui-nav">
					<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i></a><b>登录</b></li>
					<li><a href="/sigin"><i class="fa fa-user-plus" aria-hidden="true"></i></a><b>注册</b></li>
				</ul>
			</div>
		</div>';
	}
$_output = ob_get_contents();
ob_end_clean();
echo $_output;
?>

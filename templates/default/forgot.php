<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
echo'
<div class="main-wrap login-main-bg">
	<p class="gohome"><a href="/"><i></i>返回首页</a></p>
	<div class="login-main-content">
		<div class="lohin-logo"><a href="/" name="top">',htmlspecialchars($options['name']),'</a></div>';
		foreach($errors as $error){
			echo '<div id="closes" class="login-errors">',$error,' <span id="close"><i class="fa fa-times"></i></span></div>';
		}echo'
		<form action="',$_SERVER["REQUEST_URI"],'" method="post">
			<ul>
				<li><input type="text" name="name" class="nameform" value="',htmlspecialchars($name),'" placeholder="用户名"/></li>
				<li><input type="text" name="email" class="pawdform" value="" placeholder="设置页填写的邮箱"/></li>
				<li><input type="submit" value="',$title,'" name="submit" class="textbtnform" id="txtinbut"/>
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
		}
		if($url_path == 'login'){
			if($options['close_register'] || $options['close']){
				echo '<p class="lbtn">网站暂时停止注册 <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
			}else{
				echo '<p class="lbtn">还没有账户？<a href="/sigin">现在注册</a> <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
			}
		}else{
			echo '<p class="lbtn">已有账户？<a href="/login">现在登录</a> <span>忘记密码？<a href="/forgot">马上找回</a></span></p>';
		}echo'
	</div>
    <div class="main">
        <div class="main-content">';
echo'
<script>
$(document).ready(function(){
  $("#close").click(function(){
    $("#closes").remove();
  });
});
</script>';
?>
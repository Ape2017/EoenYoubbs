<?php
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied');
echo '
<div class="ios-setting-bottom">
<div class="ios-setting-avatar">
	<form action="',$_SERVER["REQUEST_URI"],'#2" enctype="multipart/form-data" method="post">
		<input type="hidden" name="action" value="avatar" />
		<input type="hidden" name="MAX_FILE_SIZE" value="300000" />';
		if($tip2){
			echo '<div class="reedos">',$tip2,'</div>';
		}echo'
		<div class="ios-avatar">
			<img src="/avatar/large/',$cur_user['avatar'],'.png?',$av_time,'" />
		</div>
		<p><input name="avatar" type="file" class="file"/>
		<span class="upload"><i class="fa fa-camera" aria-hidden="true"></i></span></p>
		<p><input type="submit" value="更新头像" name="submit"/></p>
	</form>
</div>
<div class="ios-setting-info">
	<form method="post" action="',$_SERVER["REQUEST_URI"],'#1">
		<input type="hidden" name="action" value="info"/>';
		if($tip1){
			echo '<div class="reedos">',$tip1,'</div>';
		}echo'
		<div class="ios-info">
			<p><span>昵称</span><input class="slb" disabled="disabled" name="username" type="text" value="',$cur_user['name'],'"></p>
			<p><span>邮件</span><input type="text" class="slb" name="email" placeholder="找回密码用～" value="',htmlspecialchars(stripslashes($cur_user['email'])),'" /></p>
			<p><span>签名</span><input type="text" class="slb" placeholder="个性签名30字以内～" maxlength="30" name="url" value="',htmlspecialchars(stripslashes($cur_user['url'])),'" /></p>
		</div>
		<p><input type="submit" value="更新信息" name="submit"/></p>
	</form>
</div>';
if($cur_user['password']){
	echo'<div class="ios-setting-passwd">
		<form method="post" action="',$_SERVER["REQUEST_URI"],'#3">
		<input type="hidden" name="action" value="chpw" />';
		if($tip3){
			echo '<div class="reedos">',$tip1,'</div>';
		}echo'
		<div class="ios-info">
			<p><span>原密码</span><input type="password" class="slb" name="password_current" value="" /></p>
			<p><span>新密码</span><input type="password" class="slb" name="password_new" value="" /></p>
			<p><span>确认密码</span><input type="password" class="slb" name="password_again" value="" /></p>
		</div>
		<p><input type="submit" value="更改密码" name="submit"/></p>
		</form>
	</div>';
}else{
	echo'<div class="ios-setting-passwd post-page-list">
		<form method="post" action="',$_SERVER["REQUEST_URI"],'#3">
		<input type="hidden" name="action" value="chpw" />';
		if($tip3){
			echo '<div class="reedos">',$tip1,'</div>';
		}echo'
		<div class="ios-info">
			<p><span>原密码</span><input type="password" class="slb" name="password_new" value="" /></p>
			<p><span>新密码</span><input type="password" class="slb" name="password_again" value="" /></p>
		</div>
		<p><input type="submit" value="设置登录密码" name="submit"/></p>
		</form>
	</div>';
}echo'</div>';

?>
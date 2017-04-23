<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

foreach($errors as $error){
    echo '<div id="closes" class="errortipc"><i class="fa fa-info-circle"></i> ',$error,' <span id="close"><i class="fa fa-times"></i></span></div>';
}
echo '
<div class="post-page-list">
<div class="ios-sigin-bg">
	<div class="ios-sigin-title"><h2>',htmlspecialchars($options['name']),'</h2></div>
	<div class="ios-sigin-nav-',$url_path,'">
		<a href="/login">登 录</a>
		<b></b>
		<a href="/sigin">注 册</a>
	</div>

</div>
<div class="main-box ios-sigin-form">
<form action="',$_SERVER["REQUEST_URI"],'" method="post">
<input type="hidden" name="formhash" value="',$formhash,'" />
<p><label><input type="text" name="name" class="name sl wb70" value="',htmlspecialchars(@$name),'" placeholder="用户名" /></label></p>
<p><label><input type="password" name="pw" class="pw sl wb70" value="" placeholder="密码"/></label></p>';

if($url_path == 'sigin'){
    if(@$regip){
        echo '<p class="red">一个ip最小注册间隔时间是 ',$options['reg_ip_space'],' 秒，请稍后再来注册。</p>';
    }else{
        echo '<p><label><input type="password" name="pw2" class="pw2 sl wb70" value="" placeholder="确认密码" /></label></p>';
        echo '<p><label><input type="text" name="seccode" class="seccode sl wb50" value="" placeholder="验证码"/></label> <img src="/seccode.php" align="absmiddle" /></p>';
    }
}else{
    echo '<p><label><input type="text" name="seccode" class="seccode sl wb50" value="" placeholder="验证码" /></label> <img src="/seccode.php" align="absmiddle" /></p>';
}

echo '<p><input type="submit" value="  ',$title,'  " name="submit" class="textbtn" /> </p>';
if($url_path == 'login'){
    if($options['close_register'] || $options['close']){
        echo '<p class="grey fs12">&nbsp;&nbsp;<i class="fa fa-ban"></i> 网站暂时停止注册';
    }
}
echo '</p>
</form>
</div>';
if(($options['wb_key'] && $options['wb_secret']) || ($options['qq_appid'] && $options['qq_appkey'])){
echo '<div class="main-box ios-main-box-wei">';
	if($options['wb_key'] && $options['wb_secret']){
        echo '<a href="/wblogin" class="weibo" rel="nofollow"><i class="fa fa-weibo"></i></a>';
	}
	if($options['qq_appid'] && $options['qq_appkey']){
        echo '<a href="/qqlogin" class="qq" rel="nofollow"><i class="fa fa-qq"></i></a>';
    }
    echo'<div class="c"></div>
    </div>';
}
echo'</div>
<script>
$(document).ready(function(){
  $("#close").click(function(){
    $("#closes").remove();
  });
});
</script>';

?>

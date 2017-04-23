<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
		<div class="new-post-page">
			<div class="new-post-page-form">
				<form action="',$_SERVER["REQUEST_URI"],'" method="post" class="layui-form">
					<input type="hidden" name="formhash" value="',$formhash,'" />
					<p><input type="text" name="title" value="',htmlspecialchars($p_title),'" class="newtitle" placeholder="请填写标题"/></p>
					<p><input type="text" name="tags" value="',htmlspecialchars($p_tags),'" class="newtags" placeholder="选填标签，最多5个（标签用英文逗号或者空格隔开）"/>
					<select name="select_cid" class="new-control">';
					foreach($main_nodes_arr as $n_id=>$n_name){
							if($cid == $n_id){
								$sl_str = ' selected="selected"';
							}else{
								$sl_str = '';
							}
							echo '<option value="',$n_id,'"',$sl_str,'>',$n_name,'</option>';
						}
					echo '</select></p>
					<p><textarea id="id-content" name="content" class="newtext" placeholder="输入正文（正文可以直接粘贴优酷、腾讯视频地址或者网易音乐链接）">',htmlspecialchars($p_content),'</textarea></p>';
					if(!$options['close_upload']){
						include(CURRENT_DIR . '/templates/default/upload.php');
					}echo'
					<p><input type="submit" value=" 发布帖子 " name="submit" class="newtextbtn" /></p>
				</form>
			</div>
		</div>';
		
echo"<script>
layui.use(['form'], function(){
	var form = layui.form()
	,layer = layui.layer;
});
</script>";echo'
<div class="main-content">';
?>

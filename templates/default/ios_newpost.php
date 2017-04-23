<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<form action="',$_SERVER["REQUEST_URI"],'" method="post" class="layui-form">
<input type="hidden" name="formhash" value="',$formhash,'" />
<div class="ios-newpost">
	<div class="ios-newpost-title">
		<span class="zshu" id="num">剩余可输入',$options['article_content_max_len'],'字</span><button type="submit" name="submit" class="fabu" /><i class="fa fa-paper-plane-o" aria-hidden="true"></i> 发布</button>
	</div>';
	if($tip){
		echo '<div id="closes" class="redbox"><i class="fa fa-info-circle"></i> ',$tip,'<span id="close"><i class="fa fa-times"></i></span></div>';
	}echo'
	<div class="ios-newpost-bt">
		<p class="title-bt"><input type="text" name="title" value="',htmlspecialchars($p_title),'" class="titsll" placeholder="请输入标题，',$options['article_title_max_len'],'字以内～"/></p>
	</div>
	<div class="ios-newpost-topic">
		<p class="new-pic">
			<select name="select_cid" class="form-control">';
			foreach($main_nodes_arr as $n_id=>$n_name){
					if($cid == $n_id){
						$sl_str = ' selected="selected"';
					}else{
						$sl_str = '';
					}
					echo '<option value="',$n_id,'"',$sl_str,'>',$n_name,'</option>';
				}
			echo '</select>
		</p>';
		if(!$options['close_upload']){
			include(CURRENT_DIR . '/templates/default/upload.php');
		}echo'
	</div>
	<div class="ios-newpost-textarea">
		<p class="textar">
			<textarea id="id-content" name="content" class="textmll" placeholder="正文可以直接粘贴YouTube、优酷、土豆、腾讯视频地址和网易音乐链接">',htmlspecialchars($p_content),'</textarea>
		</p>
	</div>
</div>
</form>';

echo"<script>
layui.use(['form'], function(){
	var form = layui.form()
	,layer = layui.layer;
});
$(function(){
   $('#id-content').on('keyup',function(){
       var txtval = $('#id-content').val().length;
       console.log(txtval);
      var str = parseInt(",$options['article_content_max_len'],"-txtval);
      console.log(str);
        if(str > 0 ){
          $('#num').html('剩余可输入'+str+'字');
      }else{
          $('#num').html('剩余可输入0字');
          $('#id-content').val($('#id-content').val().substring(0,",$options['article_content_max_len'],")); //这里意思是当里面的文字小于等于0的时候，那么字数不能再增加，只能是600个字
        }
        //console.log($('#num_txt').html(str));
    });
})
</script>";

?>

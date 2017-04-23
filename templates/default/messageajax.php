<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="ios-message-ajaxpage">
	<div class="ios-message-main">
		<div class="ios-message-title">
			<h2>',$c_obj['name'],' <span>(',$total_msg,')</span></h2>
			<p>
				<a href="/user/',$c_obj['id'],'" class="home" target="_top"><i></i>去Ta主页</a>
				<a id="btnFollow" href="javascript:;" data-id="'.$c_obj['id'].'"><i></i>关注Ta</a>
			</p>
		</div>
		<div class="ios-message-centent">';
			if($messagedb){
				foreach($messagedb as $message){ 
					if($message['FromUID'] == $cur_uid){ // 如果是我发的
						echo'
						<div class="ios-message-avatar-right">
							<a href="/user/',$cur_user['avatar'],'" target="_top"><img src="/avatar/normal/',$cur_user['avatar'],'.png"></a>
							<span class="time">',$message['AddTime'],'</span>
							<p class="centee">',$message['Content'],'</p>
							<span class="del"><a href="/messageajax/'.$cid.'?act=del&tid=',$message['ID'],'" title="删除"><i></i></a></span>
						</div>';
					}else{
						echo'
						<div class="ios-message-avatar-left">
							<a href="/user/',$message['FromUID'],'" target="_top"><img src="/avatar/normal/',$message['avatar'],'.png"></a>
							<span class="time">',$message['AddTime'],'</span><span class="read">',$message['Title'],'</span>
							<p class="centee">',$message['Content'],'</p>
						</div>';
					}
				}
			}echo'
		</div>
		<div class="ios-message-form">
			<form action="',$_SERVER["REQUEST_URI"],'" method="post">
				<input type="hidden" name="formhash" value="',$formhash,'" />';
				if($tip){
					echo '<div id="closes" class="closebox">',$tip,'<span id="close"><i class="fa fa-times"></i></span></div>';
				}echo'
				<textarea id="id-content" name="content">',htmlspecialchars($p_content),'</textarea>
				<input type="submit" value=" 发送私信 " name="submit" class="textbtn" />
			</form>
		</div>

	</div>
</div>
<style type="text/css">
.header-wrap,.footer-wrap {display: none;}
.layui-tab-brief > .layui-tab-title .layui-this {color: #333;}
</style>
<script type="text/javascript">
$(document).ready(function(){
    var target=$("#btnFollow");
    $.ajax({
        type: "GET",
        url: "/follow/user?act=isfo&id="+target.attr("data-id"),
        success: function(msg){
            if(msg == 1){
                target.text("已关注");
            }
       }
    });
    
    target.click(function(){
        if(target.text() == "关注Ta"){
            $.ajax({
                type: "GET",
                url: "/follow/user?act=add&id="+target.attr("data-id"),
                success: function(msg){
                    if(msg == 1){
                        target.text("已关注");
                    }
               }
            });
        }else{
            $.ajax({
                type: "GET",
                url: "/follow/user?act=del&id="+target.attr("data-id"),
                success: function(msg){
                    if(msg == 1){
                        target.text("关注Ta");
                    }
               }
            });
        }
    });
});
</script>';

?>

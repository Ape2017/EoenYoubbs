<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="ios-bg-margin"></div>
<div class="ios-member-bg">
	<div class="ios-member-avatar"><img src="/avatar/large/',$m_obj['avatar'],'.png" alt="',$m_obj['name'],'" />';
		if($cur_user && $cur_user['flag']>=99){
			echo'<a href="/admin-setuser-',$m_obj['id'],'" title="设置"><i></i></a>';
		}echo'
	</div>
	<div class="ios-member-name">
		<h2>',$m_obj['name'],'</h2>
		<p>',$m_obj['url'],'</p>
	</div>';
	if($cur_user && $m_obj['id']!=$cur_user['id']){
		echo'<div class="ios-member-gzbtn">
				<a id="btnFollow" href="javascript:;" data-id="'.$m_obj['id'].'">关注TA</a>
				<a href="javascript:" class="message msm">发私信</a>
			</div>';
	}echo'
	<div class="ios-member-reolies">
		<p><span>发 帖</span>',$m_obj['articles'],'</p>
		<b></b>
		<p><span>评 论</span>',$m_obj['replies'],'</p>
		<b></b>
		<p><span>活 跃</span>',$m_obj['logintime'],'</p>
	</div>
</div>
<div class="main-wrap">
    <div class="main ios-posi-main">
        <div class="main-content">
			<div class="main-home-box-list">';
			if($m_obj['articles']){
				foreach($articledb as $article){
					echo '
					<div class="home-box-topic">
						<div class="home-box-topic-avatar"><a href="/user/',$m_obj['id'],'">
							<img src="/avatar/large/',$m_obj['avatar'],'.png" alt="',$m_obj['name'],'" />
						</a></div>
						<div class="home-box-bgmore">
							<span class="triangle"></span><span class="triang"></span>
							<div class="home-box-topic-text">
								<div class="box-user-name">
									<p><a href="/user/',$m_obj['id'],'">',$m_obj['name'],'</a><span>',$article['addtime'],'</span></p>
								</div>
								<div class="box-text-center">
									<h2><a href="/topics/',$article['id'],'">',$article['title'],'</a></h2>
									<p>',$article['content'],'</p>
								</div>
								<div class="box-footer">
									<p class="tages"><a href="/nodes/',$article['cid'],'"># ',$article['cname'],'</a></p>
									<p class="comin">
										<span>阅读 ',$article['views'],'</span>
										<span>评论 ',$article['comments'],'</span>
									</p>
								</div>
							</div>
						</div>
					</div>';
				}
			}else{
				echo '<div class="ios-notifications"><p>该用户还没有发布过帖子</p></div>';
			}echo'
			</div>
		</div>
		<div class="main-sider">
			<div class="sider-box">
				<div class="sider-box-title">留言信息</div>
				<div class="sider-box-content">';
					if($cur_user && $m_obj['id']!=$cur_user['id']){
						echo'
						<div class="member-textarea-box">
							<form action="',$_SERVER["REQUEST_URI"],'#new-comment" method="post">
								<input type="hidden" name="formhash" value="',$formhash,'" />
								<input type="hidden" name="did" value="',$cur_user['id'],'" />
								<p class="formtext-member">
									<textarea id="id-content" name="content" placeholder="快给小伙伴留个言吧 :)"></textarea>
									<input type="submit" value="留言" name="submit" class="submitbtn" />
									<span class="zshu" id="num">剩余可输入200字</span>
								</p>';
								if($tip){
									echo '<p class="red">',$tip,'</p>';
								}echo'
							</form>
						</div>';
					}
					if($leavindb){
						foreach($leavindb as $leaving){
							echo '
							<div class="member-leaving">
								<div class="member-leaving-avatar"><a href="/user/',$leaving['did'],'">
									<img src="/avatar/large/',$leaving['avatar'],'.png" alt="',$leaving['name'],'" /></a>
								</div>
								<div class="member-leaving-texts">
									<p class="nme"><a href="/user/',$leaving['did'],'">',$leaving['name'],'</a><span>',$leaving['addtime'],'</p>
									<p class="cnt">',$leaving['content'],'</p>
								</div>
							</div>';
						}
					}else{
						echo'Ta还没有收到留言信息';
					}echo'
				</duv>
				<div class="c"></div>
			</div>
		</div>
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
        if(target.text() == "关注TA"){
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
                        target.text("关注TA");
                    }
               }
            });
        }
    });
});
</script>';
echo "
<script type='text/javascript'>
$(function(){
   $('#id-content').on('keyup',function(){
       var txtval = $('#id-content').val().length;
       console.log(txtval);
      var str = parseInt(200-txtval);
      console.log(str);
        if(str > 0 ){
          $('#num').html('剩余可输入'+str+'字');
      }else{
          $('#num').html('剩余可输入0字');
          $('#id-content').val($('#id-content').val().substring(0,200)); 
        }
        //console.log($('#num_txt').html(str));
    });
});
layui.use('layer', function(){
	$('.message').on('click', function(){
		layer.close(layer.index);
		layer.open({
			type: 1,
			title: '发送私信给 ",$m_obj['name'],"',
			offset: '200px',
			shadeClose: true,
			shade: [0.5, '#333'],
			area: ['400px', '265px'], 
			content: $('#newmessage')
		});
	});
});
$(function(){
   $('#msg-content').on('keyup',function(){
       var txtval = $('#msg-content').val().length;
       console.log(txtval);
      var str = parseInt(200-txtval);
      console.log(str);
        if(str > 0 ){
          $('#msg').html('剩余可输入'+str+'字');
      }else{
          $('#msg').html('剩余可输入0字');
          $('#msg-content').val($('#msg-content').val().substring(0,200)); 
        }
    });
});
</script>";
echo'
<div id="newmessage" style="display:none;">
	<div class="new-message-form-layui">
		<form action="/messageajax/'.$m_obj['id'].'" method="post">
			<input type="hidden" name="formhash" value="',$formhash,'" />
			<textarea id="msg-content" name="content">',htmlspecialchars($p_content),'</textarea>
			<input type="submit" value=" 发送私信 " name="submit" class="newmsgbtn" />
			<span class="zshu" id="msg">剩余可输入200字</span>
		</form>
	</div>
</div>';

?>

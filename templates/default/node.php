<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="ios-bg-margin"></div>
<div class="ios-nodes-bg">
	<div class="ios-nodes-main">
		<div class="ios-nodes-imgs">
			<img src="/static/default/img/node.png">
			<p>',$c_obj['name'],'<span>',$c_obj['articles'],'个帖子</span></span>';
			if($c_obj['about']){
				echo '<span class="sme">',$c_obj['about'],'</span>';
			}echo'
			</p>';
			if ($cur_user && $cur_user['flag'] >= 99) {
				echo'<span class="edit"><a href="/admin-node-',$c_obj['id'],'#edit" title="编辑话题"><i></i></a></span>';
			}echo'
		</div>
		<div class="ios-nodes-btn">';
			if($cur_user && $cur_user['flag']>=5){
				echo ' <button id="btnFollow" data-id="'.$c_obj['id'].'" class="btnflow">关注话题</button>';
			}echo'
		</div>
	</div>
</div>
<div class="main-wrap">
    <div class="main ios-posi-main">
        <div class="main-content">
			<div class="main-home-box-list">';
				if($articledb){
					foreach($articledb as $article){
					echo '
					<div class="home-box-topic">
						<div class="home-box-topic-avatar"><a href="/user/',$article['uid'],'">';
							if(!$is_spider){
								echo '<img src="/avatar/large/',$article['uavatar'],'.png" alt="',$article['author'],'" />';
							}echo '</a>
						</div>
						<div class="home-box-bgmore">
							<span class="triangle"></span><span class="triang"></span>
							<div class="home-box-topic-text">
								<div class="box-user-name">
									<p><a href="/user/',$article['uid'],'">',$article['author'],'</a><span>',$article['addtime'],'</span></p>
								</div>
								<div class="box-text-center">
									<h2><a href="/topics/',$article['id'],'">',$article['title'],'</a></h2>
									<p>',$article['content'],'</p>
								</div>
								<div class="box-footer">
									<p class="tages">';
									if($article['comments']){
										echo '',$article['edittime'],' <a href="/user/',$article['ruid'],'">',$article['rauthor'],'</a>发表了评论';
									}echo'</p>
									<p class="comin">
										<span>阅读 ',$article['views'],'</span>
										<span>评论 ',$article['comments'],'</span>
									</p>
								</div>
							</div>
						</div>
					</div>';
					}
					if($c_obj['articles'] > $options['list_shownum']){ 
						echo '<div class="pagination">';
						if($page>1){
							echo '<a href="/nodes/',$cid,'/',$page-1,'" class="float-left"><i class="fa fa-angle-double-left"></i> 上一页</a>';
						}
						echo '<div class="pagediv">';
						$begin = $page-4;
						$begin = $begin >=1 ? $begin : 1;
						$end = $page+4;
						$end = $end <= $taltol_page ? $end : $taltol_page;
						if($begin > 1){
							echo '<a href="/nodes/',$cid,'/1" class="float-left">1</a>';
							echo '<a class="float-left">...</a>';
						}
						for($i=$begin;$i<=$end;$i++){
							if($i != $page){
								echo '<a href="/nodes/',$cid,'/',$i,'" class="float-left">',$i,'</a>';
							}else{
								echo '<a class="float-left pagecurrent">',$i,'</a>';
							}
						}
						if($end < $taltol_page){
							echo '<a class="float-left">...</a>';
							echo '<a href="/nodes/',$cid,'/',$taltol_page,'" class="float-left">',$taltol_page,'</a>';
						}
						echo '</div>';
						if($page<$taltol_page){
							echo '<a href="/nodes/',$cid,'/',$page+1,'" class="float-right">下一页 <i class="fa fa-angle-double-right"></i></a>';
						}
						echo '<div class="c"></div>
						</div>';
					}
				}else{
					echo '
					<div class="ios-notifications">
						<p>这个话题还没有被人开发过，还等什么？ <a href="/newpost/'.$c_obj['id'].'">赶快来一发！</a></p>
					</div>';
				}echo'
			</div>
		</div>
		<div class="main-sider">
			<div class="sider-box">
				<div class="sider-box-title">'.$c_obj['follow'].' 人关注该话题</div>
				<div class="sider-box-content">
					<div class="ios-slider-box-follw">';
				foreach($leavindb as $leaving){
					echo '<a href="/user/',$leaving['UserID'],'" title="',$leaving['name'],'"><img src="/avatar/large/',$leaving['avatar'],'.png" alt="',$leaving['name'],'" /></a>';
				}echo'</div>
				</div>
				<div class="c"></div>
			</div>
		</div>
<script type="text/javascript">
$(document).ready(function(){
    var target=$("#btnFollow");
    $.ajax({
        type: "GET",
        url: "/follow/nodes?act=isfo&id="+target.attr("data-id"),
        success: function(msg){
            if(msg == 1){
                target.text("取消关注");
            }
       }
    });
    target.click(function(){
        if(target.text() == "关注话题"){
            $.ajax({
                type: "GET",
                url: "/follow/nodes?act=add&id="+target.attr("data-id"),
                success: function(msg){
                    if(msg == 1){
                        target.text("取消关注");
                    }
               }
            });
        }else{
            $.ajax({
                type: "GET",
                url: "/follow/nodes?act=del&id="+target.attr("data-id"),
                success: function(msg){
                    if(msg == 1){
                        target.text("关注话题");
                    }
               }
            });
        }
    });
});
</script>';
?>

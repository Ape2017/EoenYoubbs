<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content">
<div class="main-box">
	<div class="main-box-content">
		<div class="main-box-content-avatar">
			<a href="/user/',$t_obj['uid'],'"><img src="/avatar/large/',$t_obj['uavatar'],'.png" alt="',$t_obj['author'],'" /></a>
		</div>
		<div class="main-box-content-user">
			<p class="tuser"><a href="/user/',$t_obj['uid'],'">',$t_obj['author'],'</a><span>作者</span></p>
			<p class="tadds"><a href="/nodes/',$c_obj['id'],'"><i class="fa fa-bookmark-o" aria-hidden="true"></i> ',$c_obj['name'],'</a><b>·</b>',$t_obj['addtime'],'';
			if($cur_user && $cur_user['flag']>4){
				if($in_favorites){
					echo '<b>·</b><a href="/favorites?act=del&id=',$t_obj['id'],'" class="off">取消收藏</a>';
				}else{
					echo '<b>·</b><a href="/favorites?act=add&id=',$t_obj['id'],'" class="no">添加收藏</a>';
				}
			}
			if($cur_user && $cur_user['flag']>4){
				if($cur_user['flag']>=99){
					echo '<b>·</b><a href="/admin-edit-post-',$t_obj['id'],'">编辑帖子</a>';
				}
			}
			echo'</p>
		</div>
		<div class="main-box-content-text">
			<h2>',$t_obj['title'],'</h2>
			<p>',$t_obj['content'],'</p>';
			if($t_obj['tags']){
				echo '<div class="topic-tags">标签 : ',$t_obj['tags'],'</div>';
			}echo '
		</div>
	</div>
	<div class="main-box-comments">
		<div class="title">
			评论 ',$t_obj['comments'],'
			<a href="#id-content">立即评论</a>
		</div>
		<div class="home-box-list">';
		if($t_obj['comments']){
			$count_n = ($page-1)*$options['commentlist_num'];
			foreach($commentdb as $comment){
			$count_n += 1;
			echo '
				<div class="commont-item">
					<div class="commont-avatar">
						<a href="/user/',$comment['uid'],'"><img src="/avatar/large/',$comment['avatar'],'.png" alt="',$comment['author'],'" /></a>
					</div>
					<div class="ios-comment-name">
						<a href="/user/',$comment['uid'],'" class="user">',$comment['author'],'</a>
						<span>',$count_n,'楼<b>·</b>',$comment['addtime'],'</span>
					</div>
					<div class="ios-auydhjs">';
					if($cur_user && $cur_user['flag']>=99){
							echo '<a href="/admin-edit-comment-',$comment['id'],'" class="edit">修改</a>';
						}
						if(!$t_obj['closecomment'] && $cur_user && $cur_user['flag']>4 && $cur_user['name'] != $comment['author']){
							echo '<a href="#new-comment" onclick="replyto(\'',$comment['author'],'\');" class="reply">回复</a>'; 
						}
					echo '</div>
					<div class="ios-commont-content">
						<p>',$comment['content'],'</p>
					</div>';
			echo ' <div class="c"></div>
				</div>';
			}
			if($t_obj['comments'] > $options['commentlist_num']){ 
				echo '<div class="pagination">';
				if($page>1){
				echo '<a href="/topics/',$tid,'/',$page-1,'" class="float-left">&laquo; 上一页</a>';
				}
				if($page<$taltol_page){
				echo '<a href="/topics/',$tid,'/',$page+1,'" class="float-right">下一页 &raquo;</a>';
				}
				echo'</div>';
			}
		}else{
			echo '<p class="ncoms">目前尚无评论</p>';
		}echo '
		</div>
		<div class="main-box-closecomment">';
		if($t_obj['closecomment']){
			echo '<p class="ncoms">该帖评论已关闭</p>';
		}else{
			if($cur_user && $cur_user['flag']>4){
				echo '
				<form action="',$_SERVER["REQUEST_URI"],'#new-comment" method="post">
				<input type="hidden" name="formhash" value="',$formhash,'" />
				<p class="formtext">
					<img src="/avatar/large/',$cur_user['avatar'],'.png">
					<textarea id="id-content" name="content" placeholder="发表评论...">',htmlspecialchars($c_content),'</textarea>
					<input type="submit" value="发 布" name="submit" class="submitbtn" />
				</p>';
				if($tip){
					echo '<p class="red">',$tip,'</p>';
				}echo'
				</form>';
			}else{
				echo '<p class="ncoms">请 <a href="javascript:" class="login">登录</a> 后发表评论</p>';
			}
		}echo '
		</div>
	</div>
</div>';
echo'</div>
<div class="main-sider">
	<div class="sider-box">
		<div class="post-user">
			<div class="post-avatar"><a href="/user/',$t_obj['uid'],'">
				<img src="/avatar/large/',$t_obj['uavatar'],'.png" alt="',$t_obj['uavatar'],'" /></a>
				<span><a href="/user/',$t_obj['uid'],'">',$t_obj['author'],'</a><b>作者</b></span>
				<p>',$m_obj['url'],'</p>
			</div>
			<div class="post-uname">
				<span class="fts">发帖<b>',$m_obj['articles'],'</b></span>
				<span class="hts">评论<b>',$m_obj['replies'],'</b></span>';
				if($cur_user && $t_obj['uid']!=$cur_user['id']){
					echo'<span class="gzbtn"><a id="btnFollow" href="javascript:;" data-id="'.$t_obj['uid'].'">关注Ta</a></span>';
				}echo'
			</div>
		</div>
	</div>
	<div class="sider-box">
		<div class="post-favorit">
			<span class="triangle"></span><span class="triang"></span>
			<p class="ydsl">评论<b>',$t_obj['comments'],'</b></p>
			<p class="plsl">收藏<b>',$t_obj['favorites'],'</b></p>
		</div>
	</div>';
	if($t_obj['relative_topics']){
	echo'
	<div class="sider-box">
		<div class="sider-box-title">相关帖子</div>
		<div class="sider-box-content">
		<ul class="rel_list">';
		foreach($t_obj['relative_topics'] as $rel_t_obj){
			echo '<li><a href="/topics/',$rel_t_obj['id'],'" title="',$rel_t_obj['title'],'">',$rel_t_obj['title'],'</a></li>';
		}echo'
		</ul>
		<div class="c"></div>
		</div>
	</div>';
	}
	if(isset($t_obj) && $t_obj['relative_tags']){
		echo '
		<div class="sider-box">
			<div class="sider-box-title">相关标签</div>
			<div class="sider-box-content">
			<div class="btn">',$t_obj['relative_tags'],'</div>
			<div class="c"></div>
			</div>
		</div>';
	}
	if(isset($newest_nodes) && $newest_nodes){
		echo '
		<div class="sider-box">
			<div class="sider-box-title">热门话题</div>
			<div class="sider-box-content">
			<div class="btn">';
		foreach( $newest_nodes as $k=>$v ){
			echo '<a href="/',$k,'">',$v,'</a>';
		}
		echo '    </div>
			<div class="c"></div>
			</div>
		</div>';
	}echo'
</div>
<script type="text/javascript">
function replyto(somebd){
    var con = document.getElementById("id-content").value;
    document.getElementsByTagName(\'textarea\')[0].focus();
    document.getElementById("id-content").value = " @"+somebd+" " + con;
}

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

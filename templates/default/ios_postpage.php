<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
// 
echo '
<div class="main-box">
<div class="topic-title">
    <div class="topic-title-main">
		<div class="detail-avatar">
			<a href="/user/',$t_obj['uid'],'"><img src="/avatar/normal/',$t_obj['uavatar'],'.png" alt="',$t_obj['author'],'" /></a>
			<a href="/user/',$t_obj['uid'],'" class="ios-name">',$t_obj['author'],'</a><span>作者</span>
		</div>';
		if($cur_user && $cur_user['flag']>4){
			echo '<div class="ios-favorites">';
			if($in_favorites){
				echo '<a href="/favorites?act=del&id=',$t_obj['id'],'" class="off">取消收藏</a>';
			}else{
				echo '<a href="/favorites?act=add&id=',$t_obj['id'],'" class="no">添加收藏</a>';
			}echo '</div>';
		}
        echo '<div class="topic-title-date">
        ',$t_obj['addtime'],'<b>·</b>阅读 ',$t_obj['views'],'';
		if($t_obj['favorites']){
			echo '<b>·</b>收藏 ',$t_obj['favorites'],'';
		}
		echo '<b>·</b><i class="fa fa-bookmark-o" aria-hidden="true"></i> <a href="/nodes/',$c_obj['id'],'">',$c_obj['name'],'</a>';
		if($cur_user && $cur_user['flag']>4){
			if($cur_user['flag']>=99){
				echo '<b>·</b><a href="/admin-edit-post-',$t_obj['id'],'">编辑话题</a>';
			}
		}
echo '        </div>
    </div>
    <div class="c"></div>
</div>
<div class="topic-content">
<h1>',$t_obj['title'],'</h1>
<p class="photos">',$t_obj['content'],'</p>';

if($t_obj['tags']){
    echo '<div class="topic-tags">标签 : ',$t_obj['tags'],'</div>';
}

if($t_obj['relative_topics']){
    echo '<div class="has_adv"><h3>相关帖子：</h3>';
    echo '<ul class="rel_list">';
    foreach($t_obj['relative_topics'] as $rel_t_obj){
        echo '<li><a href="/topics/',$rel_t_obj['id'],'" title="',$rel_t_obj['title'],'">',$rel_t_obj['title'],'</a></li>';
    }
    echo '<div class="c"></div></ul><div class="c"></div></div>';
}

echo '</div>

</div>
<!-- post main content end -->';

if($t_obj['comments']){
echo '
<div class="title">
    评论 ',$t_obj['comments'],'</span>
</div>
<div class="main-box home-box-list">';

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
echo '<div class="c"></div>
</div>';
}

echo '
    
</div>
<!-- comment list end -->

<script type="text/javascript">
function replyto(somebd){
    var con = document.getElementById("id-content").value;
    document.getElementsByTagName(\'textarea\')[0].focus();
    document.getElementById("id-content").value = " @"+somebd+" " + con;
}
</script>';

}else{
    echo '<div class="no-comment">还没有人参与过评论</div>';
}

if($t_obj['closecomment']){
    echo '<div class="no-comment">该帖评论已关闭</div>';
}else{

if($cur_user && $cur_user['flag']>4){

echo '<a name="new-comment"></a>
<div class="ios-main-box-testarea">';
if($tip){
    echo '<p class="red">',$tip,'</p>';
}
echo '    <form action="',$_SERVER["REQUEST_URI"],'#new-comment" method="post">
<input type="hidden" name="formhash" value="',$formhash,'" />
    <textarea id="id-content" name="content" placeholder="请写下你的评论..." class="comment-text mll wb92">',htmlspecialchars($c_content),'</textarea>
    <input type="submit" value="发 表" name="submit" class="textbtn wb100" />
    </form>
	<a href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
</div>
<!-- new comment end -->';

}else{
    echo '<div class="ios-no-comment"><div class="no-comment-text"><a href="/login" rel="nofollow">登录</a> 后才能发表评论</div></div>';
}

}


?>

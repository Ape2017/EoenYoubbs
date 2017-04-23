<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="ios-member-bg">
	<div class="ios-member-avatar"><img src="/avatar/large/',$m_obj['avatar'],'.png" alt="',$m_obj['name'],'" />';
	if($cur_user && $cur_user['flag']>=99){
		echo'<a href="/admin-setuser-',$m_obj['id'],'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>';
	}
	echo'<div class="ios-member-name">
		<h2>',$m_obj['name'],'</h2>
		<p>',$m_obj['url'],'</p>
	</div>
	<div class="ios-member-reolies">
		<p>',$m_obj['articles'],'<span>发 帖</span></p>
		<b></b>
		<p>',$m_obj['replies'],'<span>评 论</span></p>
		<b></b>
		<p class="logintime">',$m_obj['logintime'],'<span>活 跃</span></p>
	</div></div>
</div>

<div class="main-box">';
if($m_obj['articles']){
echo '
<div class="main-box home-box-list">';
foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar-time"><span>',$article['addtime'],'</span></div>
    <div class="item-content count',$article['comments'],'">
        <h1><a href="/topics/',$article['id'],'">',$article['title'],'</a></h1>
		<p class="photos">',$article['content'],'</p>
        <span class="item-date"><a href="/nodes/',$article['cid'],'"><i class="fa fa-bookmark-o" aria-hidden="true"></i> ',$article['cname'],'</a></span>
	</div>    
	<div class="item-count">
		<span>阅读 ',$article['views'],'</span>
		<span>评论 ',$article['comments'],'</span>
	</div>
	<div class="c"></div>
</div>';
}

echo '</div>
<style type="text/css">
.main-content {
    padding-bottom: 30px;
}
</style>';
}


?>

<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-box home-box-list">';
if(@$articledb){

foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/user/',$article['uid'],'"><img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" /></a></div>
    <div class="item-content count',$article['comments'],'">
		<div class="ios-topicname"><a href="/user/',$article['uid'],'">',$article['author'],'</a><span>',$article['addtime'],'</span></div>
        <h1><a href="/notic/',$article['id'],'">',$article['title'],'</a></h1>
        <span class="item-date"><a href="/nodes/',$article['cid'],'"><i class="fa fa-bookmark-o" aria-hidden="true"></i> ',$article['cname'],'</a></span>
    </div>
	<div class="item-count">
		<span>阅读 ',$article['views'],'</span>
		<span>评论 ',$article['comments'],'</span>
	</div>
	<div class="c"></div>
</div>';

}

}else{
    echo '<div class="ios-notifications"><img src="/static/default/img/notifica.png" /><p>你还没有收到信息通知～</p></div>';
}

echo '</div>';

?>

<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-box home-box-list">';
if($articledb){

foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/user/',$article['uid'],'"><img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" /></a></div>
    <div class="item-content count',$article['comments'],'">
		<div class="ios-topicname"><a href="/user/',$article['uid'],'">',$article['author'],'</a><span>',$article['addtime'],'</span></div>
        <h1><a href="/topics/',$article['id'],'">',$article['title'],'</a></h1>
		<p class="photos">',$article['content'],'</p>
        <span class="item-date"><i class="fa fa-bookmark-o" aria-hidden="true"></i> <a href="/nodes/',$article['cid'],'">',$article['cname'],'</a>
    </div>
	<div class="item-count">
		<span><a href="/favorites?act=del&id=',$article['id'],'">取消收藏</a></span>
	</div>';
echo '    <div class="c"></div>
</div>';

}


if($user_fav['articles'] > $options['list_shownum']){ 
echo '<div class="pagination">';
if($page>1){
echo '<a href="/favorites?page=',$page-1,'" class="float-left">&laquo; 上一页</a>';
}
if($page<$taltol_page){
echo '<a href="/favorites?page=',$page+1,'" class="float-right">下一页 &raquo;</a>';
}
echo '<div class="c"></div>
</div>';
}


}else{
    echo '<div class="ios-notifications"><img src="/static/default/img/favorites.png" /><p>你还没有收藏过帖子～</p></div>';
}

echo '</div>';

?>

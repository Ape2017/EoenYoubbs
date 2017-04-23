<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '<div class="main-box home-box-list">';
foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/user/',$article['uid'],'">
    <img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" />
    </a></div>
    <div class="item-content count',$article['comments'],'">
		<div class="ios-topicname"><a href="/user/',$article['uid'],'">',$article['author'],'</a><span>',showtime($article['addtime']),'</span></div>
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
if(count($articledb) == $options['home_shownum']){ 

// 处理正确的页数
$table_status = $DBS->fetch_one_array("SHOW TABLE STATUS LIKE 'yunbbs_articles'");
$taltol_article = $table_status['Auto_increment'] -1;
$taltol_page = ceil($taltol_article/$options['list_shownum']);

echo '<div class="pagination">';

echo '<div class="pagediv">';
$page=1;
$begin = $page-4;
$begin = $begin >=1 ? $begin : 1;
$end = $page+4;
$end = $end <= $taltol_page ? $end : $taltol_page;

if($begin > 1)
{
	echo '<a href="/page/1" class="float-left">1</a>';
	echo '<a class="float-left">...</a>';
}
for($i=$begin;$i<=$end;$i++){
	
	if($i != $page){
		echo '<a href="/page/',$i,'" class="float-left">',$i,'</a>';
	}else{
		echo '<a class="float-left pagecurrent">',$i,'</a>';
	}
}
if($end < $taltol_page)
{
	echo '<a class="float-left">...</a>';
	echo '<a href="/page/',$taltol_page,'" class="float-left">',$taltol_page,'</a>';
}
echo '<a href="/page/2" class="float-right">下一页 &raquo;</a>';
echo '</div>';

echo '<div class="c"></div>
</div>';
}
echo '</div>';



?>


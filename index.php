<?php
define('IN_SAESPOT', 1);
define('CURRENT_DIR', pathinfo(__FILE__, PATHINFO_DIRNAME));

include(CURRENT_DIR . '/config.php');
include(CURRENT_DIR . '/common.php');

// 获取最近文章列表 $articledb
$articledb = $cache->get('home_articledb');

if($articledb === FALSE){
    $query_sql = "SELECT a.id,a.cid,a.uid,a.ruid,a.title,a.tags,a.content,a.addtime,a.edittime,a.comments,a.views,a.isred,a.top,c.name as cname,u.avatar as uavatar,u.name as author,ru.name as rauthor
        FROM yunbbs_articles a  
        LEFT JOIN yunbbs_categories c ON c.id=a.cid
        LEFT JOIN yunbbs_users u ON a.uid=u.id
        LEFT JOIN yunbbs_users ru ON a.ruid=ru.id
        WHERE `cid` > '1'
        ORDER BY `top` DESC ,`edittime` DESC LIMIT ".$options['home_shownum'];
	
    $query = $DBS->query($query_sql);
    $articledb = array();
    while ($article = $DBS->fetch_array($query)) {
        // 格式化内容
        if($article['isred'] == '1' && $article['top'] == '1'){
             $article['title'] = "<span class='topspanred'>".$article['title']."</span><span class=\"label label-warning\">置顶</span><span class=\"label label-success\">推荐</span>";
         }elseif($article['isred'] == '1'){
             $article['title'] = "<span class='topspan'>".$article['title']."</span><span class=\"label label-success\">推荐</span>";
         }elseif($article['top'] == '1'){
             $article['title'] = "<span class='topspanred'>".$article['title']."</span><span class=\"label label-warning\">置顶</span>";
         }	
        $artid = $article['id'];
		$article['content'] = set_content(mb_strlen($article['content'], 'utf-8') > 100 ? mb_substr($article['content'], 0, 100, 'utf-8').'<p class="topic-more"><a href="/topics/'.$artid.'">阅读全部<i></i></a></p>' : $article['content'], 1);
        $articledb[] = $article;
    }
    unset($article);
    $DBS->free_result($query);

    // set to cache
    $cache->set('home_articledb', $articledb);
}

//话题关注者
$quero = "SELECT a.id,a.articleid,a.uid,a.addtime,a.content,u.name,u.avatar,c.title
    FROM yunbbs_comments a 
    LEFT JOIN yunbbs_users u ON a.uid=u.id
    LEFT JOIN yunbbs_articles c ON a.articleid=c.id
    ORDER BY a.id DESC LIMIT 0 , 6";
$leavin = $DBS->query($quero);
$leavindb=array();
while ($leaving = $DBS->fetch_array($leavin)) {
	// 格式化内容
	$leavindb[] = $leaving;
}
unset($leaving);
$DBS->free_result($leavin);

//20个热门用户
$queuse = "SELECT id,name,avatar,articles FROM yunbbs_users ORDER BY articles DESC LIMIT 0 , 20";
$newuse = $DBS->query($queuse);
$newuserdb=array();
while ($newuser = $DBS->fetch_array($newuse)) {
	// 格式化内容
	$newuserdb[] = $newuser;
}
unset($newuser);
$DBS->free_result($newuse);



// 页面变量
$title = $options['name'];

$site_infos = get_site_infos($DBS);
$newest_nodes = get_newest_nodes();
if(count($newest_nodes)==$options['newest_node_num']){
    $bot_nodes = get_bot_nodes();
}

$links = get_links();
$meta_kws = htmlspecialchars(mb_substr($options['name'], 0, 6, 'utf-8'));
if($options['site_des']){
    $meta_des = htmlspecialchars(mb_substr($options['site_des'], 0, 150, 'utf-8'));
}

$pagefile = CURRENT_DIR . '/templates/default/'.$tpl.'home.php';

include(CURRENT_DIR . '/templates/default/'.$tpl.'layout.php');

?>

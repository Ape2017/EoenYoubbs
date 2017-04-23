<?php
define('IN_SAESPOT', 1);
define('CURRENT_DIR', pathinfo(__FILE__, PATHINFO_DIRNAME));

include(CURRENT_DIR . '/config.php');
include(CURRENT_DIR . '/common.php');

$g_mid = $_GET['mid'];
// mid 可能id或用户名，用户注册时要限制名字不能为全数字
if(preg_match('/^[a-zA-Z0-9\x80-\xff]{1,20}$/i', $g_mid)){
    $mid = intval($g_mid);
    if($mid){
        $query = "SELECT id,name,flag,avatar,url,articles,replies,regtime,logintime,about FROM yunbbs_users WHERE id='$mid'";
    }else{
        $query = "SELECT id,name,flag,avatar,url,articles,replies,regtime,logintime,about FROM yunbbs_users WHERE name='$g_mid'";
    }
}else{
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
    include(CURRENT_DIR . '/404.html');
    exit;
    
}

$m_obj = $DBS->fetch_one_array($query);
if($m_obj){
    if(!$mid){
        // 可以重定向到网址 /member/id 为了减少请求，下面用 $canonical 来让SEO感觉友好
        //header('location: /member/'.$m_obj['id']);
        //exit;
        $mid = $m_obj['id'];
    }
    if($m_obj['flag'] == 0){
        if(!$cur_user || ($cur_user && $cur_user['flag']<99)){
            //header("content-Type: text/html; charset=UTF-8");
            //exit('该用户已被禁用');
        }
    }
    $openid_user = $DBS->fetch_one_array("SELECT name FROM yunbbs_qqweibo WHERE uid='".$mid."'");
    $weibo_user = $DBS->fetch_one_array("SELECT `openid` FROM `yunbbs_weibo` WHERE `uid`='".$mid."'");
}else{
    exit('404');
}

$m_obj['regtime'] = showtime($m_obj['regtime']);
$m_obj['logintime'] = showtime($m_obj['logintime']);

// 获取用户最近文章列表
if($m_obj['articles']){
    
    $query_sql = "SELECT a.id,a.cid,a.ruid,a.title,a.content,a.addtime,a.edittime,a.views,a.comments,c.name as cname,ru.name as rauthor
        FROM yunbbs_articles a 
        LEFT JOIN yunbbs_categories c ON c.id=a.cid
        LEFT JOIN yunbbs_users ru ON a.ruid=ru.id
        WHERE a.uid='".$mid."' ORDER BY id DESC LIMIT 10";
    $query = $DBS->query($query_sql);
    $articledb=array();
    while ($article = $DBS->fetch_array($query)) {
        // 格式化内容
        $article['addtime'] = showtime($article['addtime']);
        $article['edittime'] = showtime($article['edittime']);
		$artid = $article['id'];
		$article['content'] = set_content(mb_strlen($article['content'], 'utf-8') > 200 ? mb_substr($article['content'], 0, 200, 'utf-8').'<p class="topic-more"><a href="/topics/'.$artid.'">阅读全部<i></i></a></p>' : $article['content'], 1);
        $articledb[] = $article;
    }
    unset($article);
    $DBS->free_result($query);

}

// 处理提交评论
$tip = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_SERVER['HTTP_REFERER']) || $_POST['formhash'] != formhash() || preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) !== preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])) {
    	exit('403: unknown referer.');
    }
    
    $c_content = addslashes(trim($_POST['content']));
    @$c_did = addslashes(trim($_POST['did']));
    if(($timestamp - $cur_user['lastreplytime']) > $options['comment_post_space']){
        $c_con_len = mb_strlen($c_content,'utf-8');
        if($c_con_len>=4 && $c_con_len<=200){
            
            $c_content = htmlspecialchars($c_content);
            $DBS->query("INSERT INTO youbbs_leaving (id,pid,did,addtime,content) VALUES (null,$g_mid,$c_did , $timestamp,'$c_content')");
            
            $c_content = '';
            header('location: /user/'.$g_mid);
            exit;
			
        }else{
            $tip = '留言内容字数'.$c_con_len.' 太少或太多 (4 - 200)';
        }
    }else{
        $tip = '留言最小间隔时间是'.$options['comment_post_space'].'秒';
    }
}else{
    $c_content = '';
}


//获取评论
$quero = "SELECT a.id,a.pid,a.did,a.content,a.addtime,u.name,u.avatar
    FROM youbbs_leaving a 
    LEFT JOIN yunbbs_users u ON a.did=u.id
    WHERE a.pid='$g_mid' ORDER BY a.addtime DESC";
$leavin = $DBS->query($quero);
$leavindb=array();
while ($leaving = $DBS->fetch_array($leavin)) {
	// 格式化内容
	$leaving['addtime'] = showtime($leaving['addtime']);
	$leaving['content'] = set_content($leaving['content'], 1);
	$leavindb[] = $leaving;
}
unset($leaving);
$DBS->free_result($leavin);

// 用户最近回复文章列表不能获取
// 若想实现则在users 表里添加一列来保存最近回复文章的id


// 页面变量
$title = '会员: '.$m_obj['name'];
$newest_nodes = get_newest_nodes();
$canonical = '/member/'.$m_obj['id'];
$meta_kws = $m_obj['name'];
$meta_des = $m_obj['name'].' - '.htmlspecialchars(mb_substr($m_obj['about'], 0, 150, 'utf-8'));

$pagefile = CURRENT_DIR . '/templates/default/'.$tpl.'member.php';

include(CURRENT_DIR . '/templates/default/'.$tpl.'layout.php');

?>

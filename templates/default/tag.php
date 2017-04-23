<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content">
			<div class="main-home-box-list">';
				foreach($articledb as $article){
					echo '
					<div class="home-box-topic">
						<div class="home-box-topic-avatar"><a href="/user/',$article['uid'],'">
							<img src="/avatar/large/',$article['uavatar'],'.png" alt="',$article['author'],'" /></a>
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
				if($tag_obj['articles'] > $options['list_shownum']){ 
				echo '<div class="pagination">';
				if($page>1){
				echo '<a href="/tag/',$tag,'/',$page-1,'" class="float-left">&laquo; 上一页</a>';
				}
				if($page<$taltol_page){
				echo '<a href="/tag/',$tag,'/',$page+1,'" class="float-right">下一页 &raquo;</a>';
				}
				echo '<div class="c"></div>
				</div>';
				}
				echo'
			</div>
		</div>
		<div class="main-sider">';
		//个人中心
		if($cur_user && $cur_user['flag']>=5){
			echo'
			<div class="sider-box">
				<div class="slider-user-info">
					<div class="slider-user-bg">
						<a href="/user/',$cur_user['id'],'" alt="',$cur_user['name'],'">
						<img src="/avatar/large/',$cur_user['avatar'],'.png" /></a>
						<span class="set"><a href="/setting" title="设置"><i></i></a></span>
					</div>
					<div class="slider-user-names">
						<h2><a href="/user/',$cur_user['id'],'" alt="',$cur_user['name'],'">',$cur_user['name'],'</a></h2>
						<p>发帖 ',$cur_user['articles'],'<b>/</b>评论 ',$cur_user['replies'],'</p>
					</div>
						<button class="new-post"><i></i>发表动态</button>
				</div>
			</div>';
		}
		//最近添加的话题
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
	</div>';
?>

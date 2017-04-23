<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
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
									<p class="tages"><a href="/nodes/',$article['cid'],'"># ',$article['cname'],'</a></p>
									<p class="comin">
										<a href="/favorites?act=del&id=',$article['id'],'">取消收藏</a>
									</p>
								</div>
							</div>
						</div>
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
				echo '<div class="ios-notifications"><p>你还没有收藏过任何帖子～</p></div>';
			}echo'
			</div>
		</div>
		<div class="main-sider">
			<div class="sider-box">
				<div class="sider-box-title">我收藏了 ',$user_fav['articles'],' 个帖子</div>
				<div class="sider-box-content">
					<ul class="rel_list">';
					if($articledb){
						foreach($articledb as $article){
							echo '<li><a href="/topics/',$article['id'],'">',$article['title'],'</a></li>';
						}
					}
					echo '    
					</ul>
				</div>
				<div class="c"></div>
			</div>
		</div>';
?>

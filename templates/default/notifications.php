<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content">
			<div class="home-box-list">';
				if($articledb){
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
				}else{
					echo '
					<div class="ios-notifications">
						<p>您还没有收到过任何通知</p>
					</div>';
				}echo'
			</div>
		</div>
		<div class="main-sider">
			<div class="sider-box">';
				$notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;echo'
				<div class="sider-box-title">',$notic_n,' 条未读帖子</div>
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
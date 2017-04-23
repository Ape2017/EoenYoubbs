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
					if($total_follow > $options['list_shownum']){ 
						echo '<div class="pagination">';
						if($page>1){
						echo '<a href="/follow/user?page=',$page-1,'" class="float-left"><i class="fa fa-angle-double-left"></i> 上一页</a>';
						}
						echo '<div class="pagediv">';
						$begin = $page-4;
						$begin = $begin >=1 ? $begin : 1;
						$end = $page+4;
						$end = $end <= $total_page ? $end : $total_page;
						if($begin > 1){
							echo '<a href="/follow/user?page=1" class="float-left">1</a>';
							echo '<a class="float-left">...</a>';
						}
						for($i=$begin;$i<=$end;$i++){
							if($i != $page){
								echo '<a href="/follow/user?page=',$i,'" class="float-left">',$i,'</a>';
							}else{
								echo '<a class="float-left pagecurrent">',$i,'</a>';
							}
						}
						if($end < $total_page){
							echo '<a class="float-left">...</a>';
							echo '<a href="/follow/user?page=',$total_page,'" class="float-left">',$total_page,'</a>';
						}
						echo '</div>';
						if($page<$total_page){
						echo '<a href="/follow/user?page=',$page+1,'" class="float-right">下一页 <i class="fa fa-angle-double-right"></i></a>';
						}
						echo '<div class="c"></div>
						</div>';
					}
				}else{
					echo '
					<div class="ios-notifications">
						<p>您还没有关注过任何一个话题 或者 关注的话题下没有帖子</p>
					</div>';
				}echo'
			</div>
		</div>
		<div class="main-sider">
			<div class="sider-box">
				<div class="sider-box-title">我关注了 ',$nod_obj['fnod'],' 个话题</div>
				<div class="sider-box-content">
					<div class="btn">';
					foreach($leavindb as $leaving){
						echo '<a href="/nodes/',$leaving['ObjID'],'">',$leaving['name'],'</a>';
					}
					echo '    
					</div>
				</div>
				<div class="c"></div>
			</div>
		</div>';

?>


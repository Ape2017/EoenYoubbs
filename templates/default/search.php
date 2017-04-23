<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content">
			<div class="main-home-box-list">';
				if($taltol_article > 0){
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
					if($taltol_article > $options['list_shownum']){ 
						$pageurl='/search/?q='.$keyword.'&page=';
						echo '<div class="pagination">';
						if($page>1){
							echo '<a href="',$pageurl,$page-1,'" class="float-left"><i class="fa fa-angle-double-left"></i> 上一页</a>';
						}
						echo '<div class="pagediv">';
						$begin = $page-4;
						$begin = $begin >=1 ? $begin : 1;
						$end = $page+4;
						$end = $end <= $taltol_page ? $end : $taltol_page;

						if($begin > 1){
							echo '<a href="',$pageurl,1,'" class="float-left">1</a>';
							echo '<a class="float-left">...</a>';
						}
						for($i=$begin;$i<=$end;$i++){
							if($i != $page){
								echo '<a href="',$pageurl,$i,'" class="float-left">',$i,'</a>';
							}else{
								echo '<a class="float-left pagecurrent">',$i,'</a>';
							}
						}
						if($end < $taltol_page)
						{
							echo '<a class="float-left">...</a>';
							echo '<a href="',$pageurl,$taltol_page,'" class="float-left">',$taltol_page,'</a>';
						}
						echo '</div>';
						if($page<$taltol_page){
						echo '<a href="',$pageurl,$page+1,'" class="float-right">下一页 <i class="fa fa-angle-double-right"></i></a>';
						}
						echo '<div class="c"></div></div>';
					}
				}else{
					echo '<div class="ios-notifications"><p>没有找到关于 <span class="red">'.$keyword.'</span> 的信息，建议换个关键词试试～</p></div>';
				}echo'
				</div>
			</div>
			<div class="main-sider">
				<div class="sider-box">
					<div class="sider-box-title">关于 <span class="red">'.$keyword.'</span> 的搜索结果</div>
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

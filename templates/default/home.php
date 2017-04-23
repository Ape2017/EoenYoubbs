<?php
if (!defined('IN_SAESPOT')) {
    exit('error: 403 Access Denied');
}
echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content">
			<div class="main-home-box-list">';
			foreach ($articledb as $article) {
				echo '
				<div class="home-box-topic">
					<div class="home-box-topic-avatar"><a href="/user/', $article['uid'], '">
						<img src="/avatar/large/', $article['uavatar'], '.png" alt="', $article['author'], '" /></a>
					</div>
					<div class="home-box-bgmore">
						<span class="triangle"></span><span class="triang"></span>
						<div class="home-box-topic-text">
							<div class="box-user-name">
								<p><a href="/user/', $article['uid'], '">', $article['author'], '</a><span>', showtime($article['addtime']), '</span></p>
							</div>
							<div class="box-text-center">
								<h2><a href="/topics/', $article['id'], '">', $article['title'], '</a></h2>
								<p>', $article['content'], '</p>
							</div>
							<div class="box-footer">
								<p class="tages"><a href="/nodes/', $article['cid'], '"># ', $article['cname'], '</a></p>
								<p class="comin">
									<span>阅读 ', $article['views'], '</span>
									<span>评论 ', $article['comments'], '</span>
								</p>
							</div>
						</div>
					</div>
				</div>';
			}
			if (count($articledb) == $options['home_shownum']) {
				// 处理正确的页数
				$table_status = $DBS->fetch_one_array("SHOW TABLE STATUS LIKE 'yunbbs_articles'");
				$taltol_article = $table_status['Auto_increment'] - 1;
				$taltol_page = ceil($taltol_article / $options['list_shownum']);
				echo '<div class="pagination">';
				echo '<div class="pagediv">';
				$page = 1;
				$begin = $page - 4;
				$begin = $begin >= 1 ? $begin : 1;
				$end = $page + 4;
				$end = $end <= $taltol_page ? $end : $taltol_page;
				if ($begin > 1) {
					echo '<a href="/page/1" class="float-left">1</a>';
					echo '<a class="float-left">...</a>';
				}
				for ($i = $begin; $i <= $end; $i++) {
					if ($i != $page) {
						echo '<a href="/page/', $i, '" class="float-left">', $i, '</a>';
					} else {
						echo '<a class="float-left pagecurrent">', $i, '</a>';
					}
				}
				if ($end < $taltol_page) {
					echo '<a class="float-left">...</a>';
					echo '<a href="/page/', $taltol_page, '" class="float-left">', $taltol_page, '</a>';
				}
				echo '<a href="/page/2" class="float-right">下一页 &raquo;</a>';
				echo '</div>';
				echo '<div class="c"></div>
					</div>';
			}
			echo '
			</div>
		</div>
		<div class="main-sider">';
		//个人中心
		if ($cur_user && $cur_user['flag'] >= 5) {
			echo '
				<div class="sider-box">
					<div class="slider-user-info">
						<div class="slider-user-bg">
							<a href="/user/', $cur_user['id'], '" alt="', $cur_user['name'], '">
							<img src="/avatar/large/', $cur_user['avatar'], '.png" /></a>
							<span class="set"><a href="/setting" title="设置"><i></i></a></span>
						</div>
						<div class="slider-user-names">
							<h2><a href="/user/', $cur_user['id'], '" alt="', $cur_user['name'], '">', $cur_user['name'], '</a></h2>
							<p>发帖 ', $cur_user['articles'], '<b>/</b>评论 ', $cur_user['replies'], '</p>
						</div>
							<button class="new-post"><i></i>发表动态</button>
					</div>
				</div>';
		}
		//广告窗口
		if ($options['ad_sider_top']) {
			echo '
				<div class="sider-box">
					<div class="sider-box-title">广而告之</div>
					<div class="sider-box-content">', $options['ad_sider_top'], '
					<div class="c"></div>
					</div>
				</div>';
		}
		//6条最新评论
		if ($leavindb) {
			echo '
				<div class="sider-box">
					<div class="sider-box-title">最新评论</div>
					<div class="sider-box-content">
						<div class="home-slider-new-comments">';
			foreach ($leavindb as $leaving) {
				echo '<div class="msa-sd">
										<p class="slider-comments-user">
											<img src="/avatar/large/', $leaving['avatar'], '.png" />
											<a href="/user/', $leaving['uid'], '">', $leaving['name'], ' <span>', showtime($leaving['addtime']), '</span></a>
										</p>
										<h2><span>在：</span><a href="topics/', $leaving['articleid'], '">', $leaving['title'], '</a></h2>
										<p class="contentsnew"><span>说：</span>', $leaving['content'], '</p>
									</div>';
			}
			echo '
						</div>
					</div>
					<div class="c"></div>
				</div>';
		}
		//最新注册的20个用户
		if ($newuserdb) {
			echo '
				<div class="sider-box">
					<div class="sider-box-title">热门用户</div>
					<div class="sider-box-content">
						<div class="ios-slider-box-follw">';
			foreach ($newuserdb as $newuser) {
				echo '<a href="/user/', $newuser['id'], '" title="', $newuser['name'], '"><img src="/avatar/large/', $newuser['avatar'], '.png" alt="', $newuser['name'], '" /></a>';
			}
			echo '</div>
					</div>
					<div class="c"></div>
				</div>';
		}
		//管理员面板
		if (isset($site_infos)) {
			if ($cur_user && $cur_user['flag'] >= 99) {
				echo '
				<div class="sider-box">
					<div class="sider-box-title">管理中心</div>
					<div class="sider-box-content">
					<div class="btn">
					<a href="/admin-node">分类管理</a><a href="/admin-setting">网站设置</a><a href="/admin-user-list">用户管理</a><a href="/admin-link-list">链接管理</a>
					</div>
					<div class="c"></div>
					</div>
				</div>';
			}
		}
		//最近添加的话题
		if (isset($newest_nodes) && $newest_nodes) {
			echo '
				<div class="sider-box">
					<div class="sider-box-title">热门话题</div>
					<div class="sider-box-content">
					<div class="btn">';
			foreach ($newest_nodes as $k => $v) {
				echo '<a href="/', $k, '">', $v, '</a>';
			}
			echo '    </div>
					<div class="c"></div>
					</div>
				</div>';
		}
		//友情链接
		if (isset($links) && $links) {
			echo '
				<div class="sider-box">
					<div class="sider-box-title">合作链接</div>
					<div class="sider-box-content">
					<ul class="rel_list links-list">';
			foreach ($links as $k => $v) {
				echo '<li><a href="', $v, '" title="', $k, '" target="_blank">', $k, '</a></li>';
			}
			echo '</ul>
					<div class="c"></div>
					</div>
				</div>';
		}
		echo '
		</div>';
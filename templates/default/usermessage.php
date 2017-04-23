<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-wrap">
    <div class="main">
        <div class="main-content userajax">
			<div class="layui-tab layui-tab-brief" lay-filter="top-tab" lay-allowClose="true" style="margin: 0;">';
				if(!$messagedb){
					echo'<div class="ios-notifications">
						<p>还没有收到过 或者 还没有发出过私信</p>
					</div>';
				}else{
					echo'<ul class="layui-tab-title"></ul>';
				}echo'
                <div class="layui-tab-content"></div>
            </div>
		</div>
		<div class="main-sider">
			<div class="sider-box">
				<div class="sider-box-title">私信列表</div>
					<div class="layui-side-scroll">
						<ul class="layui-nav layui-nav-tree" lay-filter="left-nav" style="border-radius: 0;"></ul>
					</div>
				<div class="c"></div>
			</div>
		</div>';
echo"
<script type='text/javascript'>
	layui.config({
		base: '../static/js/usermessage/'
	});
	layui.use(['cms'], function() {
		var cms = layui.cms('left-nav', 'top-tab');
		cms.addNav([";
			if($messagedb){
				foreach($messagedb as $message){
					
					if($message['FromUID'] == $cur_uid){// 如果是我发的
						echo"{id: ",$message['ToUID'],", pid: 0, node: '",$message['ToUName'],"', avtid: '",$cur_user['avatar'],"', cass: '",$message['Title'],"', url: '/messageajax/",$message['ToUID'],"'},";
					}else{
						echo"{id: ",$message['FromUID'],", pid: 0, node: '",$message['FromUName'],"', avtid: '",$message['avatar'],"', cass: '",$message['Title'],"', url: '/messageajax/",$message['FromUID'],"'},";
					}
				}
			}echo"
		], 0, 'id', 'pid', 'node', 'avtid', 'cass', 'url');

		cms.bind(60 + 41 + 20 + 44); //头部高度 + 顶部切换卡标题高度 + 顶部切换卡内容padding + 底部高度
		cms.clickLI(0);
	});
</script>";
		
?>

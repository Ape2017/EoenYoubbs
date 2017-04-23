<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="main-box home-box-list">';
if($messagedb){
	foreach($messagedb as $message){
	echo '
	<div class="post-list">
		<div class="item-avatar">';
			if($message['FromUID'] == $cur_uid){ // 如果是我发的
				echo'<a href="/user/',$cur_user['avatar'],'"><img src="/avatar/normal/',$cur_user['avatar'],'.png"></a>';
			}else{
				echo'<a href="/user/',$message['FromUID'],'"><img src="/avatar/normal/',$message['avatar'],'.png"></a>';
			}echo'
		</div>
		<div class="item-content">
			<div class="ios-topicname">';
				if($message['FromUID'] == $cur_uid){ // 如果是我发的
					echo'<a href="/user/',$message['ToUID'],'">',$message['ToUName'],'</a><span>',$message['AddTime'],'</span>';
				}else{
					echo'<a href="/user/',$message['FromUID'],'">',$message['FromUName'],'</a><span>',$message['AddTime'],'</span>';
				}echo'
			</div>
			<h1>';
				if($message['FromUID'] == $cur_uid){// 如果是我发的
					echo'<a href="/messageajax/'.$message['ToUID'].'#message">',$message['Content'],'</a>';
				}else{
					echo'<a href="/messageajax/'.$message['FromUID'].'#message">',$message['Content'],'</a>';
				}echo'
			</h1>
			<span class="item-date">',$message['Title'],'</span>
		</div>
		<div class="item-count">';
			if($message['FromUID'] == $cur_uid){// 如果是我发的
				echo'<span><a href="/usermessage/?act=del&id=',$message['ID'],'"><i class="fa fa-trash-o" aria-hidden="true"></i> 删除</a></span>';
			}else{
				echo'<span><a href="/messageajax/',$message['FromUID'],'#newmsg"><i class="fa fa-comments-o" aria-hidden="true"></i> 回复</a></span>';
			}echo'
		</div>
		<div class="c"></div>
	</div>';
	}
}else{
    echo '<div class="ios-notifications"><img src="/static/default/img/notifica.png" /><p>你还没有收到过私信～</p></div>';
}

echo '</div>';

?>

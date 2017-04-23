<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="float-left grey fs12">';
if($options['ext_list']){
    echo '<span class="upload-info">支持：',$options['ext_list'],'</span>';
}
echo '<input id="filetoupload" type="file" name="filetoupload">
<span class="upload"><i></i> 上传附件</span>
<input type="hidden" value="" id="id_imgurl">
<span id="upload-prompt" style="display:none;color:#999">附件上传中，请稍候！</span>
</div>

<!-- ajaxfileupload -->
<script type="text/javascript" src="/static/js/jquery.upload-1.0.2.min.js"></script>
<script type="text/javascript">
$("#filetoupload").change(function() {
    $("#upload-prompt").text("附件上传中，请稍候！");
    $("#upload-prompt").show();
    if($(this).val()){
        $(this).upload("/upload-',$img_max_w,'", function(res) {
            if(res.status == 200){
                $("#upload-prompt").text(res.msg);
                var con = document.getElementById("id-content").value;
                document.getElementsByTagName("textarea")[0].focus();
                document.getElementById("id-content").value = con + "\n"+res.url+"\n";
                document.getElementsByName("filetoupload")[0].value="";
            }else{
                alert(res.msg);
            }
        }, "json");
    }
});
</script>
<!-- /ajaxfileupload -->
<div class="c"></div>
';
?>
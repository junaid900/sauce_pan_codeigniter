<?php $this->load->view('admin/header2')?>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
<!--以下两行加载秀米的ueditor插件的脚本和CSS，请编辑您的UEditor网页加入他们-->
<!--您也可以下载这两个文件并根据您的需要改动相关的内容，当然，改动后您必须将新文件存放到您的服务器上了-->
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" href="http://xiumi.us/connect/ue/v5/xiumi-ue-v5.css">
<style type="text/css">
	.logo40{vertical-align: middle;}
	.tn-footer{font-size: 0.9em;}
	html, body{font-size:12px;}
</style>


<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_setting_email.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost" style="width:calc(100% - 200px);margin-left:200px;margin-top:100px;">
		<tr>
			<td align="right">Parameters</td>
			<td>
				<div style="float:left;border:1px solid #ccc;width:720px;padding:10px 10px 10px 10px;">
					<?php 
					$parameter=$emailinfo['email_parameter'];
					if($parameter!=""){
						$parameter=unserialize($parameter);
					}else{
						$parameter=array();
					}
					if(!empty($parameter)){
						for($i=0;$i<count($parameter);$i++){
							echo '<div style="float:left;width:180px;line-height:30px;">'.$parameter[$i].'</div>';
						}
					}
					?>
					
				</div>
			</td>
		</tr>
		
		<tr>
			<td align="right">From</td>
			<td>
				<input type="text" name="email_from" value="<?php echo $emailinfo['email_from'];?>"/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right">Sender</td>
			<td>
				<input type="text" name="email_sender" value="<?php echo $emailinfo['email_sender'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">Reply to </td>
			<td><input type="text" name="email_replyto" id="email_replyto" value="<?php echo $emailinfo['email_replyto'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">To </td>
			<td><input type="text" name="email_to" id="email_to" value="<?php echo $emailinfo['email_to'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">CC </td>
			<td>
				<input type="text" name="email_cc" id="email_cc" value="<?php echo $emailinfo['email_cc'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">BCC </td>
			<td>
				<input type="text" name="email_bcc" id="email_bcc" value="<?php echo $emailinfo['email_bcc'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">Subject (English)</td>
			<td>
				<input type="text" style="width:700px;" name="email_subject_en" value="<?php echo $emailinfo['email_subject_en'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">Subject (中文)</td>
			<td>
				<input type="text" style="width:700px;" name="email_subject_fr" value="<?php echo $emailinfo['email_subject_fr'];?>"/>
			</td>
		</tr>
		
		<tr>
			<td align="right" width="150">Content (English)</td>
		    <td align="left">
		    	<div style="float:left;width:800px;">
		    		<script id="email_content_en" type="text/plain" style="width:800px;height:300px;"><?php echo $emailinfo['email_content_en']?></script>
					<script type="text/javascript">
						var email_content_en = UE.getEditor('email_content_en');
					</script>
		    	</div>
		    	<div class="tipsgroupbox"><div class="request">*</div></div>
		    </td>
	    </tr>
	    <tr>
			<td align="right" width="150">Content (中文)</td>
		    <td align="left">
		    	<div style="float:left;width:800px;">
		    		<script id="email_content_fr" type="text/plain" style="width:800px;height:300px;"><?php echo $emailinfo['email_content_fr']?></script>
					<script type="text/javascript">
						var email_content_fr = UE.getEditor('email_content_fr');
					</script>
		    	</div>
		    	<div class="tipsgroupbox"><div class="request">*</div></div>
		    </td>
	    </tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_emailinfo(<?php echo $emailinfo['email_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">

//1、window.location.href(设置或获取整个 URL 为字符串)
var jsurl_fullurl = window.location.href;
//返回：http://i.cnblogs.com/EditPosts.aspx?opt=1

//2、window.location.protocol(设置或获取 URL 的协议部分)
var jsurl_protocol = window.location.protocol;
//返回：http:

//3、window.location.host(设置或获取 URL 的主机部分)
var jsurl_host = window.location.host;
//返回：i.cnblogs.com

var jsurl_sp = jsurl_fullurl.split(jsurl_host);

var jsurl_sp2 = jsurl_sp[1];
jsurl_sp2 = jsurl_sp2.split('/');
if(jsurl_sp2[1] != 'admins' && jsurl_sp2[1] != 'index.php'){
	var project_name = jsurl_sp2[1]+'/';
}else{
	var project_name = '';
}
var jsurl_baseurl = jsurl_protocol+'//'+jsurl_host+'/'+project_name;






//邮件信息---保存
function tosave_emailinfo(email_id){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_emailinfo('+email_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.addClass('gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>Saving...</span>');
		
		//邮件信息
		var email_from = $('input[name="email_from"]').val();
		var email_sender = $('input[name="email_sender"]').val();
		var email_replyto = $('input[name="email_replyto"]').val();
		var email_to = $('input[name="email_to"]').val();
		var email_cc = $('input[name="email_cc"]').val();
		var email_bcc = $('input[name="email_bcc"]').val();
		var email_subject_en = $('input[name="email_subject_en"]').val();
		var email_subject_fr = $('input[name="email_subject_fr"]').val();
		
		var email_content_en = UE.getEditor('email_content_en').getContent();
		var email_content_fr = UE.getEditor('email_content_fr').getContent();
		
		var ispass=1;
		
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/email/edit_email/'+email_id, {
				//返回url
				backurl: backurl,
				//邮件信息
				email_from: email_from,
				email_sender: email_sender,
				email_replyto: email_replyto,
				email_to: email_to,
				email_cc: email_cc,
				email_bcc: email_bcc,
				email_subject_en: email_subject_en,
				email_subject_fr: email_subject_fr,
				email_content_en: email_content_en,
				email_content_fr: email_content_fr
				
			},function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>Save Success</span>');
				location.href = obj.backurl;
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html('Save');
			isajaxsaveing = 0;//ajax正在保存中 --- 释放
		}
	}
}

</script>
<?php $this->load->view('admin/footer')?>
<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
<script type="text/javascript">
//用户信息---保存
function tosave_personalinfo(uid, user_type){
	
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_personalinfo('+uid+', '+user_type+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
		
		var ispass=1;
		//用户信息
		var user_firstname = $('input[name="user_firstname"]').val();
		var user_lastname = $('input[name="user_lastname"]').val();
		var user_phone = $('input[name="user_phone"]').val();
		var user_email = $('input[name="user_email"]').val();
		var user_company_name = $('input[name="user_company_name"]').val();
		
		if(ispass == 1){
			var postOBJ = new Object();
			postOBJ.backurl = backurl;
			
			postOBJ.user_firstname = user_firstname;
			postOBJ.user_lastname = user_lastname;
			postOBJ.user_phone = user_phone;
			postOBJ.user_email = user_email;
			postOBJ.user_company_name = user_company_name;
			
			$.post(baseurl+'index.php/admins/user/edit_user_personal/'+uid, postOBJ, function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
				location.href = obj.backurl;
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html(L['cy_save']);
			isajaxsaveing = 0;//ajax正在保存中 --- 释放
		}
		
		
	}
}
</script>
<form method="post">
	<table class="gksel_normal_tabpost">
			<tr>
				<td align="right"><?php if($this->langtype=="_ch"){echo '微信头像';}else{echo 'Wechat Avatar';}?></td>
				<td>
					<?php 
						echo '<img style="float:left;max-width:80px;max-height:80px;" src="'.$userinfo['wechat_avatar'].'" />';
					?>
				</td>
			</tr>
			<tr>
				<td align="right"><?php if($this->langtype=="_ch"){echo '微信昵称';}else{echo 'Wechat Nickname';}?></td>
				<td>
					<?php echo userTextDecode($userinfo['wechat_nickname'])?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="float:left;width:100%;border-top:1px solid #EFEFEF;margin:10px 0px;"></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_firstname')?></td>
				<td align="left">
					<input type="text" name="user_firstname" value="<?php echo $userinfo['user_firstname']?>"/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_lastname')?></td>
				<td align="left">
					<input type="text" name="user_lastname" value="<?php echo $userinfo['user_lastname']?>"/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '公司名称';}else{echo 'Company Name';}?></td>
				<td align="left">
					<input type="text" name="user_company_name" value="<?php echo $userinfo['user_company_name']?>"/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
				<td align="left">
					<input type="text" name="user_phone" value="<?php echo $userinfo['user_phone']?>"/>
					<div class="tipsgroupbox"><div class="request"></div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
				<td align="left">
					<input type="text" name="user_email" value="<?php echo $userinfo['user_email']?>"/>
					<div class="tipsgroupbox"><div class="request"></div></div>
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_personalinfo(<?php echo $userinfo['uid']?>, <?php echo $userinfo['user_type']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
$(document).ready(function(){
	var button_gksel1 = $('#img1_gksel_choose'), interval;
	if(button_gksel1.length>0){
		new AjaxUpload(button_gksel1,{
			action: baseurl+'index.php/welcome/uplogo', 
			name: 'logo',onSubmit : function(file, ext){
				if (ext && /^(jpg|png|gif)$/.test(ext)){
					button_gksel1.text('上传中');
					this.disable();
					interval = window.setInterval(function(){
						var text = button_gksel1.text();
						if (text.length < 13){
							button_gksel1.text(text + '.');					
						} else {
							button_gksel1.text('上传中');				
						}
					}, 200);
				} else {
					$('#img1_gksel_error').html('上传失败');
					return false;
				}
			},
			onComplete: function(file, response){
				button_gksel1.text('上传图片');						
				window.clearInterval(interval);
				this.enable();
				if(response=='false'){
					$('#img1_gksel_error').html('上传失败');
				}else{
					var pic = eval("("+response+")");
					$('#img1_gksel_show').html('<img style="float:left;max-width:400px;max-height:400px;" src="'+baseurl+pic.logo+'" />');
					$('#img1_gksel').attr('value',pic.logo);
					$('#img1_gksel_error').html('');
				}	
			}
		});
	}
})
</script>
<?php $this->load->view('admin/footer')?>
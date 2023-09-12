<?php $this->load->view('admin/header')?>
<script type='text/javascript' src='<?php echo base_url()?>themes/default/js/fileuploader.js'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<script type="text/javascript">
	//用户信息---添加
	function toadd_userinfo(user_type){
		
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_userinfo('+user_type+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			var ispass=1;
			if(user_type == 1){//用户
				//用户信息
				var user_nickname = $('input[name="user_nickname"]').val();
				var user_sex = $('select[name="user_sex"]').val();
				var user_phone = $('input[name="user_phone"]').val();
				var user_email = $('input[name="user_email"]').val();
				var password = $('input[name="password"]').val();
				
				//验证姓名
				if(isNull.test(user_nickname)){ispass=0;$('input[name="user_nickname"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '用户名不能为空';}else{echo 'Username cannot be empty';}?>'));}else{$('input[name="user_nickname"]').next().find('.requestbox').remove();}
				//验证手机号码
				if(isNull.test(user_phone)){ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '手机号码不能为空';}else{echo 'Phone cannot be empty';}?>'));}else{if(isPhone(user_phone)){$('input[name="user_phone"]').next().find('.requestbox').remove();}else{ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '手机号码格式错误';}else{echo 'Phone format error';}?>'));}}
				//验证密码
				if(isNull.test(password)){ispass=0;$('input[name="password"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '密码不能为空';}else{echo 'Password cannot be empty';}?>'));}else{$('input[name="password"]').next().find('.requestbox').remove();}
				if(isNull.test(user_email)){
					ispass=0;
					$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '邮箱不能为空';}else{echo 'Email cannot be empty';}?>'));
				}else{
					if(isEmail(user_email)){
						$('input[name="user_email"]').next().find('.requestbox').remove();
					}else{
						ispass=0;
						$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '邮箱格式错误';}else{echo 'Email format error';}?>'));
					}
				}
				
				if(ispass == 1){
					$.post(baseurl+'index.php/admins/user/add_user_personal/'+user_type, {
						//返回url
						backurl: backurl,
						//用户信息
						user_nickname: user_nickname,
						user_sex: user_sex,
						user_phone: user_phone,
						user_email: user_email,
						password: password
					},function (data){
						if(data == 'phoneexists'){
							$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '手机号码已经存在';}else{echo 'Phone exists';}?>'));
							
							actionsubmit_button.attr('class', 'gksel_btn_action_on');
							actionsubmit_button.html(L['cy_save']);
							isajaxsaveing = 0;//ajax正在保存中 --- 释放
						}else{
							var obj = eval( "(" + data + ")" );
							actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
							location.href = obj.backurl;
						}
					})
				}else{
					actionsubmit_button.attr('class', 'gksel_btn_action_on');
					actionsubmit_button.html(L['cy_save']);
					isajaxsaveing = 0;//ajax正在保存中 --- 释放
				}
			}else if(user_type == 2){//商户
				//公司信息
				var user_company_name = $('input[name="user_company_name"]').val();
				var company_title = $('input[name="company_title"]').val();
				var company_email = $('input[name="company_email"]').val();
				var company_address = $('input[name="company_address"]').val();
				var company_phone = $('input[name="company_phone"]').val();
				var img1_gksel = $('input[name="img1_gksel"]').val();
				//用户信息
				var user_nickname = $('input[name="user_nickname"]').val();
				var user_realname = $('input[name="user_realname"]').val();
				var user_phone = $('input[name="user_phone"]').val();
				var user_email = $('input[name="user_email"]').val();
				var password = $('input[name="password"]').val();
				
				//验证姓名
				if(isNull.test(user_company_name)){ispass=0;$('input[name="user_company_name"]').next().append(ajax_returnrequiredorerror_BOX('公司名称不能为空'));}else{$('input[name="user_company_name"]').next().find('.requestbox').remove();}
				if(isNull.test(company_title)){ispass=0;$('input[name="company_title"]').next().append(ajax_returnrequiredorerror_BOX('公司职位不能为空'));}else{$('input[name="company_title"]').next().find('.requestbox').remove();}
				if(isNull.test(company_email)){
					ispass=0;
					$('input[name="company_email"]').next().append(ajax_returnrequiredorerror_BOX('公司邮箱不能为空'));
				}else{
					if(isEmail(company_email)){
						$('input[name="company_email"]').next().find('.requestbox').remove();
					}else{
						ispass=0;
						$('input[name="company_email"]').next().append(ajax_returnrequiredorerror_BOX('公司邮箱格式错误'));
					}
				}
				if(isNull.test(company_address)){ispass=0;$('input[name="company_address"]').next().append(ajax_returnrequiredorerror_BOX('公司地址不能为空'));}else{$('input[name="company_address"]').next().find('.requestbox').remove();}
				if(isNull.test(company_phone)){ispass=0;$('input[name="company_phone"]').next().append(ajax_returnrequiredorerror_BOX('公司电话不能为空'));}else{$('input[name="company_phone"]').next().find('.requestbox').remove();}
				
				//验证姓名
				if(isNull.test(user_realname)){ispass=0;$('input[name="user_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="user_realname"]').next().find('.requestbox').remove();}
				//验证手机号码
				if(isNull.test(user_phone)){ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(user_phone)){$('input[name="user_phone"]').next().find('.requestbox').remove();}else{ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}}
				//验证密码
				if(isNull.test(password)){ispass=0;$('input[name="password"]').next().append(ajax_returnrequiredorerror_BOX('密码不能为空'));}else{$('input[name="password"]').next().find('.requestbox').remove();}
				if(isNull.test(user_email)){
					ispass=0;
					$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));
				}else{
					if(isEmail(user_email)){
						$('input[name="user_email"]').next().find('.requestbox').remove();
					}else{
						ispass=0;
						$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));
					}
				}
				
				if(ispass == 1){
					$.post(baseurl+'index.php/admins/user/add_user/'+user_type, {
						//返回url
						backurl: backurl,
						//用户信息
						user_nickname: user_nickname,
						user_realname: user_realname,
						user_sex: 0,
						user_phone: user_phone,
						user_email: user_email,
						password: password,
						//公司信息
						user_company_name: user_company_name,
						company_title: company_title,
						company_email: company_email,
						company_address: company_address,
						company_phone: company_phone,
						img1_gksel: img1_gksel
					},function (data){
						var obj = eval( "(" + data + ")" );
						actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
						location.href = obj.backurl;
					})
				}else{
					actionsubmit_button.attr('class', 'gksel_btn_action_on');
					actionsubmit_button.html(L['cy_save']);
					isajaxsaveing = 0;//ajax正在保存中 --- 释放
				}
			}else if(user_type == 3){//内容提供者
				//用户信息
				var user_nickname = $('input[name="user_nickname"]').val();
				var user_realname = $('input[name="user_realname"]').val();
				var user_phone = $('input[name="user_phone"]').val();
				var user_email = $('input[name="user_email"]').val();
				var password = $('input[name="password"]').val();
				
				//验证姓名
				if(isNull.test(user_realname)){ispass=0;$('input[name="user_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="user_realname"]').next().find('.requestbox').remove();}
				//验证手机号码
				if(isNull.test(user_phone)){ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(user_phone)){$('input[name="user_phone"]').next().find('.requestbox').remove();}else{ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}}
				//验证密码
				if(isNull.test(password)){ispass=0;$('input[name="password"]').next().append(ajax_returnrequiredorerror_BOX('密码不能为空'));}else{$('input[name="password"]').next().find('.requestbox').remove();}
				if(isNull.test(user_email)){
					ispass=0;
					$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));
				}else{
					if(isEmail(user_email)){
						$('input[name="user_email"]').next().find('.requestbox').remove();
					}else{
						ispass=0;
						$('input[name="user_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));
					}
				}
				
				if(ispass == 1){
					$.post(baseurl+'index.php/admins/user/add_user/'+user_type, {
						//返回url
						backurl: backurl,
						//用户信息
						user_nickname: user_nickname,
						user_realname: user_realname,
						user_sex: 0,
						user_phone: user_phone,
						user_email: user_email,
						password: password
					},function (data){
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
	}
</script>
<form method="post">
	<table class="gksel_normal_tabpost">
		<?php if($user_type == 1){?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_nickname')?></td>
				<td align="left">
					<input type="text" name="user_nickname" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr style="display:none;">
				<td align="right" width="150"><?php echo lang('dz_user_realname')?></td>
				<td align="left">
					<input type="text" name="user_realname" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr style="display:none;">
				<td align="right" width="150"><?php echo lang('dz_user_sex')?></td>
				<td align="left">
					<select name="user_sex" class="select_usersex">
						<option value="0"><?php echo lang('dz_user_sex_unknown')?></option>
						<option value="1"><?php echo lang('dz_user_sex_male')?></option>
						<option value="2"><?php echo lang('dz_user_sex_female')?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
				<td align="left">
					<input type="text" name="user_phone" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right"><?php echo lang('dz_user_password')?></td>
				<td align="left">
					<input type="text" onfocus="this.type='password'" name="password" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
				<td align="left">
					<input type="text" name="user_email" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr style="display:none;">
				<td align="right" width="150"><?php echo lang('dz_user_profile')?></td>
				<td align="left">
					<textarea name="user_profile"></textarea>
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
		<?php }else if($user_type == 2){?>
			<tr class="thead">
				<td align="right" width="150"><?php echo lang('dz_company_information')?></td>
				<td align="left">
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td align="right"><?php echo lang('dz_company_businesslicense')?></td>
				<td>
					<div class="img_gksel_show" id="img1_gksel_show">
						<?php 
							$img1_gksel = '';
						?>
					</div>
					<div class="img_gksel_choose" id="img1_gksel_choose">上传图片</div>
					<div style="float:left;"><input type="hidden" id="img1_gksel" name="img1_gksel" value="<?php echo $img1_gksel;?>"/></div>
					<div style="float:left;margin-left:5px;margin-top:5px;"><font class="fonterror" id="img1_gksel_error"><font style="color:gray;">仅支持 Jpg, Png, Gif 格式</font></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_company_name')?></td>
				<td align="left">
					<input type="text" name="user_company_name" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_company_title')?></td>
				<td align="left">
					<input type="text" name="company_title"/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_company_email')?></td>
				<td align="left">
					<input type="text" name="company_email" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_company_address')?></td>
				<td align="left">
					<input type="text" name="company_address" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_company_tel')?></td>
				<td align="left">
					<input type="text" name="company_phone" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr class="thead">
				<td align="right" width="150">注册人信息</td>
				<td align="left">
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_nickname')?></td>
				<td align="left">
					<input type="text" name="user_nickname" value=""/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_realname')?></td>
				<td align="left">
					<input type="text" name="user_realname" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
				<td align="left">
					<input type="text" name="user_phone" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right"><?php echo lang('dz_user_password')?></td>
				<td align="left">
					<input type="text" onfocus="this.type='password'" name="password" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
				<td align="left">
					<input type="text" name="user_email" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
		<?php }else if($user_type == 3){?>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_nickname')?></td>
				<td align="left">
					<input type="text" name="user_nickname" value=""/>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_realname')?></td>
				<td align="left">
					<input type="text" name="user_realname" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
				<td align="left">
					<input type="text" name="user_phone" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right"><?php echo lang('dz_user_password')?></td>
				<td align="left">
					<input type="text" onfocus="this.type='password'" name="password" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr>
				<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
				<td align="left">
					<input type="text" name="user_email" value=""/>
					<div class="tipsgroupbox"><div class="request">*</div></div>
				</td>
			</tr>
			<tr><td colspan="2"></td></tr>
		<?php }?>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_userinfo(<?php echo $user_type?>)"><?php echo lang('cy_save')?></div>
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
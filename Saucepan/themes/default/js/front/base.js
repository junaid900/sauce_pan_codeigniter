	
	//注册用户
	$(document).ready(function(){
		$('#Registerpost_form').find('input').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
			var aa = event.which;
			if(aa == 13){
				tocheckRegisterpost();
				document.onkeydown=null;        //这里需要将onkeydown置空，不然默认一直是188
			}
		});
	});
	//注册用户
	function tocheckRegisterpost(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tocheckRegisterpost()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_registering']+'...</span></div>');

			//用户信息
			var nickname = $('input[name="nickname"]').val();//昵称
			var phone = $('input[name="phone"]').val();//手机号码
			var email = $('input[name="email"]').val();//邮箱
			var password = $('input[name="password"]').val();//密码
			var cpassword = $('input[name="cpassword"]').val();//重复密码
			var sms_code = $('input[name="sms_code"]').val();//验证码
			
			var user_type = 1;//注册类型
			var ispass=1;
			//验证手机号码
			if(isNull.test(nickname)){
				ispass=0;
				$('.nickname_error').show();
			}else{
				$('.nickname_error').hide();
			}
			//验证手机号码
			if(isNull.test(phone)){
				ispass=0;
				$('.phone_error').show();
				$('.phone_formaterror').hide();
				$('.phone_hasregistered').hide();
			}else{
				if(isPhone(phone)==false){
					ispass=0;
					$('.phone_error').hide();
					$('.phone_formaterror').show();
					$('.phone_hasregistered').hide();
				}else{
					$('.phone_error').hide();
					$('.phone_formaterror').hide();
					$('.phone_hasregistered').hide();
				}
			}
			//验证邮箱
			if(isNull.test(email)){
				ispass=0;
				$('.email_error').show();
				$('.email_formaterror').hide();
			}else{
				if(isEmail(email)==false){
					ispass=0;
					$('.email_error').hide();
					$('.email_formaterror').show();
				}else{
					$('.email_error').hide();
					$('.email_formaterror').hide();
				}
			}

			//验证密码
			if(isNull.test(password)){
				ispass=0;
				$('.password_error').show();
			}else{
				$('.password_error').hide();
			}
			
			//验证重复密码
			if(isNull.test(cpassword)){
				ispass=0;
				$('.cpassword_error').show();
			}else{
				$('.cpassword_error').hide();
			}
			if(ispass == 1){
				//验证两次密码输入是否一致
				if(password != cpassword){
					ispass=0;
					$('.register_notmatches_error').show();
				}else{
					$('.register_notmatches_error').hide();
				}
			}else{
				$('.register_notmatches_error').hide();
			}
			//验证验证码
			if(isNull.test(sms_code)){
				ispass=0;
				$('.sms_code_error').show();
			}else{
				$('.sms_code_error').hide();
			}

			$('.email_hasregistered').hide();
			$('.sms_code_formaterror').hide();
			
			
			if(ispass == 1){
				$.post(baseurl+'index.php/account/checkphoneisexists',{phone:phone},function (data){
					if(data=='no'){
						$('input[name="phone"]').next().find('.requestbox').remove();
						$.post(baseurl+'index.php/account/register',{nickname:nickname, email:email, phone:phone, password:password, sms_code: sms_code},function (data){
							if(data == 'codeerror'){
								$('.sms_code_formaterror').show();

								actionsubmit_button.attr('class', 'gksel_btn_action_on');
								actionsubmit_button.html('注册');
								isajaxsaveing = 0;//ajax正在保存中 --- 释放
							}else{
								actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>注册成功</span></div>');
//								isajaxsaveing = 0;//ajax正在保存中 --- 释放
								setTimeout("toreditecturl('"+baseurl+"index.php/account/tologin')",100);//0.1秒后自动跳转到首页
							}
						})
					}else{

						$('.phone_hasregistered').show();
						
						actionsubmit_button.attr('class', 'gksel_btn_action_on');
						actionsubmit_button.html('注册');
						isajaxsaveing = 0;//ajax正在保存中 --- 释放
					}
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('注册');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//登录用户
	$(document).ready(function(){
		$('#Loginpost_form').find('input').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
			var aa = event.which;
			if(aa == 13){
				tocheckLoginpost();
				document.onkeydown=null;        //这里需要将onkeydown置空，不然默认一直是188
			}
		});
	});
	//登录用户
	function tocheckLoginpost(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tocheckLoginpost()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_logining']+'...</span></div>');

			//用户信息
			var phone=$('input[name="login_phone"]').val();//手机号码
			var password=$('input[name="login_password"]').val();//密码
			var ispass=1;
			//验证手机号码
			if(isNull.test(phone)){
				ispass=0;
				$('input[name="login_phone"]').next().find('.requestbox').remove();
				$('input[name="login_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));
			}else{
				if(isPhone(phone)==false){
					ispass=0;
					$('input[name="login_phone"]').next().find('.requestbox').remove();
					$('input[name="login_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));
				}else{
					$('input[name="login_phone"]').next().find('.requestbox').remove();
				}
			}
			//验证密码
			if(isNull.test(password)){
				ispass=0;
				$('input[name="login_password"]').next().find('.requestbox').remove();
				$('input[name="login_password"]').next().append(ajax_returnrequiredorerror_BOX('密码不能为空'));
			}else{
				$('input[name="login_password"]').next().find('.requestbox').remove();
			}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/account/checkphoneisexists',{phone:phone},function (data){
					if(data=='yes'){
						$('input[name="login_phone"]').next().find('.requestbox').remove();
						$.post(baseurl+'index.php/account/login',{phone:phone, password:password},function (data){
							if(data == 'yes'){
								actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_loginsuccess']+'</span></div>');
//								isajaxsaveing = 0;//ajax正在保存中 --- 释放
								setTimeout("toreditecturl('"+baseurl+"index.php/member/order_list')",100);//0.1秒后自动跳转到首页
							}else{
								$('input[name="login_password"]').next().append(ajax_returnrequiredorerror_BOX('用户名或密码错误'));
								actionsubmit_button.attr('class', 'gksel_btn_action_on');
								actionsubmit_button.html(L['cy_login']);
								isajaxsaveing = 0;//ajax正在保存中 --- 释放
							}
						})
					}else{
						$('input[name="login_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码没有注册'));
						actionsubmit_button.attr('class', 'gksel_btn_action_on');
						actionsubmit_button.html(L['cy_login']);
						isajaxsaveing = 0;//ajax正在保存中 --- 释放
					}
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_login']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	//忘记密码
	$(document).ready(function(){
		$('#Forgetpost_form').find('input').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
			var aa = event.which;
			if(aa == 13){
				tocheckForgetpost();
				document.onkeydown=null;        //这里需要将onkeydown置空，不然默认一直是188
			}
		});
	});
	//忘记密码
	function tocheckForgetpost(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tocheckForgetpost()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>找回中...</span></div>');

			//用户信息
			var phone = $('input[name="phone"]').val();
			var sms_code = $('input[name="sms_code"]').val();//验证码
			
			var ispass = 1;
			if(isNull.test(phone)){
				ispass=0;
				$('input[name="forgetpassword_phone"]').next().find('.requestbox').remove();
				$('input[name="forgetpassword_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));
			}else{
				$('input[name="forgetpassword_phone"]').next().find('.requestbox').remove();
			}
			//验证验证码
			if(isNull.test(sms_code)){
				ispass=0;
				$('.sms_code_error').show();
			}else{
				$('.sms_code_error').hide();
			}
			
			$('.sms_code_formaterror').hide();
			
			if(ispass == 1){
				$.post(baseurl+'index.php/account/checkquestioncurrent',{phone:phone, sms_code: sms_code},function (data){
					if(data == 'codeerror'){
						$('.sms_code_formaterror').show();

						actionsubmit_button.attr('class', 'gksel_btn_action_on');
						actionsubmit_button.html(L['cy_forgetpassword']);
						isajaxsaveing = 0;//ajax正在保存中 --- 释放
					}else{
						var obj = eval( "(" + data + ")" );
						actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>发送成功</span></div>');
//						isajaxsaveing = 0;//ajax正在保存中 --- 释放
						location.href = baseurl+'index.php/account/toresetpassword/'+obj.uid+'/'+obj.randkey;
					}
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_forgetpassword']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	//重置密码
	function tocheckResetpost(uid){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tocheckResetpost('+uid+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>重置中...</span></div>');

			//用户信息
			var password=$('input[name="reset_password"]').val();//密码
			var cpassword=$('input[name="reset_cpassword"]').val();
			var ispass=1;
			//验证密码
			if(isNull.test(password)){
				ispass=0;
				$('input[name="reset_password"]').next().find('.requestbox').remove();
				$('input[name="reset_password"]').next().append(ajax_returnrequiredorerror_BOX('密码不能为空'));
			}else{
				$('input[name="reset_password"]').next().find('.requestbox').remove();
			}
			//验证重复密码
			if(isNull.test(cpassword)){
				ispass=0;
				$('input[name="reset_cpassword"]').next().find('.requestbox').remove();
				$('input[name="reset_cpassword"]').next().append(ajax_returnrequiredorerror_BOX('重复密码不能为空'));
			}else{
				//再判断两次密码是否一致
				if(password == cpassword){
					$('input[name="reset_cpassword"]').next().find('.requestbox').remove();
				}else{
					ispass=0;
					$('input[name="reset_cpassword"]').next().find('.requestbox').remove();
					$('input[name="reset_cpassword"]').next().append(ajax_returnrequiredorerror_BOX('两次密码输入不一致'));
				}
			}
			
			if(ispass == 1){
				actionsubmit_button.html('<div style="width:80px;margin:0 auto;"><img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>重置成功</span></div>');
				$.post(baseurl+'index.php/account/resetpassword/'+uid,{password:password},function (data){
					setTimeout("toreditecturl('"+baseurl+"index.php/account/tologin')",100);//0.1秒后自动跳转到登录页面
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('重置密码');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
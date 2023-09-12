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
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//邮件信息
			var email_from = $('input[name="email_from"]').val();
			var email_sender = $('input[name="email_sender"]').val();
			var email_replyto = $('input[name="email_replyto"]').val();
			var email_to = $('input[name="email_to"]').val();
			var email_cc = $('input[name="email_cc"]').val();
			var email_bcc = $('input[name="email_bcc"]').val();
			var email_subject_en = $('input[name="email_subject_en"]').val();
			var email_subject_ch = $('input[name="email_subject_ch"]').val();
			
			var email_content_en = CKEDITOR.instances.email_content_en.getData();
			var email_content_ch = CKEDITOR.instances.email_content_ch.getData();
			
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
					email_subject_ch: email_subject_ch,
					email_content_en: email_content_en,
					email_content_ch: email_content_ch
					
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
	//邮件信息---设置
	function tosave_emailsetting(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_emailsetting()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			
			var smtp_server = $('input[name="smtp_server"]').val();
			var smtp_serverport = $('input[name="smtp_serverport"]').val();
			var smtp_usermail = $('input[name="smtp_usermail"]').val();
			var smtp_user = $('input[name="smtp_user"]').val();
			var smtp_pass = $('input[name="smtp_pass"]').val();
			
			var email_type_arr = $('input[name="email_type"]');
			var email_type = '';
			if(email_type_arr.length>0){
				for(var i = 0; i < email_type_arr.length; i++){
					if(email_type_arr[i].checked == true){
						email_type = email_type_arr[i].value;
					}
				}
			}
			var ispass=1;
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/email/setting_email', {
					email_type: email_type,
					smtp_server: smtp_server,
					smtp_serverport: smtp_serverport,
					smtp_usermail: smtp_usermail,
					smtp_user: smtp_user,
					smtp_pass: smtp_pass
				},function (data){
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
					location.href = baseurl + 'index.php/admins/email/tosetting_email';
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//改变发邮件方式
	function tochangeemailtype(email_type){
		if(email_type == 'mail'){
			$('.smtp_area').hide();
		}else{
			$('.smtp_area').show();
		}
	}
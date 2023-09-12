	var isNull = /^[\s' ']*$/;
	function isEmail(email){
		var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email);
		if(isEmail!=true){
			return false;
		}else{
			return true;
		}
	}
	//判断是否为手机号码格式
	/** 
    * 检查字符串是否为合法手机号码 
    * @param {String} 字符串 
    * @return {bool} 是否为合法手机号码 
    */  
    function isPhone(aPhone) {  
    	var bValidate = RegExp(/^(0|86|17951)?(11[0-9]|12[0-9]|13[0-9]|14[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9]|19[0-9])[0-9]{8}$/).test(aPhone);  
        if (bValidate) {
            return true;  
        }  
        else  
            return false;  
    }
	//删除提示框 ---- 关闭
	function toclose_deletebox(){
		$('.gksel_delete_box_bg, .gksel_delete_box').fadeOut(800);
	}
	var del_url = '';
	var del_loading = 0;
	
	//删除用户地址
	function todel_address(uid, id, name){
		var title = '您确定要删除地址<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/member/del_address/"+uid+"/"+id);
		todel(title, subtitle);
	}
	
	//删除信息
	function todel(title, subtitle){
		$('.gksel_delete_content .title').html(title);
		$('.gksel_delete_content .subtitle').html(subtitle);
		$('.gksel_delete_box_bg, .gksel_delete_box').fadeIn(800);
	}
	//删除信息 --- 处理方法
	function del(){
		if(del_loading == 0){
			del_loading = 1;
			$('.gksel_delete_content .title').html('&nbsp;');
			$('.gksel_delete_content .subtitle').html('<div style="float:left;width:100%;text-align:center;"><img src="'+baseurl+'themes/default/images/indicator.gif"/></div>');
			del_url=decodeURI(del_url);
			$.post(del_url,function (data){
				location.href = currenturl;
			});
		}
	}
	
	
	//ajax 返回必填或格式错误的提示框
	function ajax_returnrequiredorerror_BOX(content){
		return '<div class="requestbox"><div class="sanjiao"><img style="width:6px;" src="'+baseurl+'themes/default/images/sanjiaoxing.png"/></div><div class="content">'+content+'</div></div>';
	}
	
	//省市县三级联动
	$(document).ready(function(){
		$('#provinceID').change(function(){
			var province_id = $(this).val();
			if(province_id!=0){
				$.post(baseurl+'index.php/welcome/getcity/'+province_id,function(data){
					$('#cityID').html(data);
					$('#areaID').html('<option value=0>选择区域</option>');
				});
			}
		})
		$('#cityID').change(function(){
			var color_id = $(this).val();
			if(color_id!=0){
				$.post(baseurl+'index.php/welcome/getarea/'+color_id,function(data){
					$('#areaID').html(data);
				});
			}
		})
	})
	
	
	
	var isajaxsaveing = 0;//是否ajax正在保存中
	var actionsubmit_button = '';//具体点击的按钮
	
	//用户信息---保存
	function tosave_userinfo(uid, user_type){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_userinfo('+uid+', '+user_type+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//用户信息
			var user_nickname = $('input[name="user_nickname"]').val();
			var user_realname = $('input[name="user_realname"]').val();
			var user_sex = $('select[name="user_sex"]').val();
			var user_email = $('input[name="user_email"]').val();
			var user_profile = $('textarea[name="user_profile"]').val();
			//公司信息
			var company_name = $('input[name="company_name"]').val();
			var company_title = $('input[name="company_title"]').val();
			var company_email = $('input[name="company_email"]').val();
			var company_address = $('input[name="company_address"]').val();
			var company_phone = $('input[name="company_phone"]').val();
			
			var ispass=1;
			//验证姓名
			if(user_type == 1 || user_type == 3){
				if(isNull.test(user_realname)){ispass=0;$('input[name="user_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="user_realname"]').next().find('.requestbox').remove();}
			}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/member/edit_information/'+uid, {
					//返回url
					backurl: backurl,
					//用户信息
					user_nickname: user_nickname,
					user_realname: user_realname,
					user_sex: user_sex,
					user_email: user_email,
					user_profile: user_profile,
					//公司信息
					company_name: company_name,
					company_title: company_title,
					company_email: company_email,
					company_address: company_address,
					company_phone: company_phone
					
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//					isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	//用户地址信息---添加
	function toadd_useraddressinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_useraddressinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//用户信息
			var address_realname = $('input[name="address_realname"]').val();
			var address_phone = $('input[name="address_phone"]').val();
			var address_email = $('input[name="address_email"]').val();
			var provinceID = $('select[name="provinceID"]').val();
			var cityID = $('select[name="cityID"]').val();
			var areaID = $('select[name="areaID"]').val();
			var address_street_address = $('input[name="address_street_address"]').val();
			var address_zip_code = $('input[name="address_zip_code"]').val();
			var ispass=1;
			//验证姓名
			if(isNull.test(address_realname)){ispass=0;$('input[name="address_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="address_realname"]').next().find('.requestbox').remove();}
			//验证联系人手机号码
			if(isNull.test(address_phone)){ispass = 0;$('input[name="address_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(address_phone)==false){ispass = 0;$('input[name="address_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}else{$('input[name="address_phone"]').next().find('.requestbox').remove();}}
			if(isNull.test(address_email)){ispass = 0;$('input[name="address_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));}else{if(isEmail(address_email)==false){ispass = 0;$('input[name="address_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));}else{$('input[name="address_email"]').next().find('.requestbox').remove();}}
			if(isNull.test(provinceID) || provinceID == 0){ispass=0;$('select[name="provinceID"]').next().append(ajax_returnrequiredorerror_BOX('省份不能为空'));}else{$('select[name="provinceID"]').next().find('.requestbox').remove();}
			if(isNull.test(cityID) || cityID == 0){ispass=0;$('select[name="cityID"]').next().append(ajax_returnrequiredorerror_BOX('城市不能为空'));}else{$('select[name="cityID"]').next().find('.requestbox').remove();}
			if(isNull.test(areaID) || areaID == 0){ispass=0;$('select[name="areaID"]').next().append(ajax_returnrequiredorerror_BOX('区域不能为空'));}else{$('select[name="areaID"]').next().find('.requestbox').remove();}
			if(isNull.test(address_street_address)){ispass=0;$('input[name="address_street_address"]').next().append(ajax_returnrequiredorerror_BOX('详细地址不能为空'));}else{$('input[name="address_street_address"]').next().find('.requestbox').remove();}
			if(isNull.test(address_zip_code)){ispass=0;$('input[name="address_zip_code"]').next().append(ajax_returnrequiredorerror_BOX('邮编不能为空'));}else{$('input[name="address_zip_code"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/member/add_address', {
					//用户信息
					address_realname: address_realname,
					address_phone: address_phone,
					address_email: address_email,
					provinceID: provinceID,
					cityID: cityID,
					areaID: areaID,
					address_street_address: address_street_address,
					address_zip_code: address_zip_code
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//					isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	//用户地址信息---保存
	function tosave_useraddressinfo(address_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_useraddressinfo('+address_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//用户信息
			var address_realname = $('input[name="address_realname"]').val();
			var address_phone = $('input[name="address_phone"]').val();
			var address_email = $('input[name="address_email"]').val();
			var provinceID = $('select[name="provinceID"]').val();
			var cityID = $('select[name="cityID"]').val();
			var areaID = $('select[name="areaID"]').val();
			var address_street_address = $('input[name="address_street_address"]').val();
			var address_zip_code = $('input[name="address_zip_code"]').val();
			var ispass=1;
			//验证姓名
			if(isNull.test(address_realname)){ispass=0;$('input[name="address_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="address_realname"]').next().find('.requestbox').remove();}
			//验证联系人手机号码
			if(isNull.test(address_phone)){ispass = 0;$('input[name="address_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(address_phone)==false){ispass = 0;$('input[name="address_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}else{$('input[name="address_phone"]').next().find('.requestbox').remove();}}
			if(isNull.test(address_email)){ispass = 0;$('input[name="address_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));}else{if(isEmail(address_email)==false){ispass = 0;$('input[name="address_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));}else{$('input[name="address_email"]').next().find('.requestbox').remove();}}
			if(isNull.test(provinceID) || provinceID == 0){ispass=0;$('select[name="provinceID"]').next().append(ajax_returnrequiredorerror_BOX('省份不能为空'));}else{$('select[name="provinceID"]').next().find('.requestbox').remove();}
			if(isNull.test(cityID) || cityID == 0){ispass=0;$('select[name="cityID"]').next().append(ajax_returnrequiredorerror_BOX('城市不能为空'));}else{$('select[name="cityID"]').next().find('.requestbox').remove();}
			if(isNull.test(areaID) || areaID == 0){ispass=0;$('select[name="areaID"]').next().append(ajax_returnrequiredorerror_BOX('区域不能为空'));}else{$('select[name="areaID"]').next().find('.requestbox').remove();}
			if(isNull.test(address_street_address)){ispass=0;$('input[name="address_street_address"]').next().append(ajax_returnrequiredorerror_BOX('详细地址不能为空'));}else{$('input[name="address_street_address"]').next().find('.requestbox').remove();}
			if(isNull.test(address_zip_code)){ispass=0;$('input[name="address_zip_code"]').next().append(ajax_returnrequiredorerror_BOX('邮编不能为空'));}else{$('input[name="address_zip_code"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/member/edit_address/'+address_id, {
					//用户信息
					address_realname: address_realname,
					address_phone: address_phone,
					address_email: address_email,
					provinceID: provinceID,
					cityID: cityID,
					areaID: areaID,
					address_street_address: address_street_address,
					address_zip_code: address_zip_code
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//					isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	
	
	
	/***********************(未完成)*********************************/
	//用户信息 密码---修改  
	function tochange_password(uid){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tochange_password('+uid+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中</span>');
			
			//用户信息
			var user_oldpassword = $('input[name="user_oldpassword"]').val();
			var user_newpassword = $('input[name="user_newpassword"]').val();
			var user_cpassword = $('input[name="user_cpassword"]').val();
			
			var ispass=1;
			
			if(isNull.test(user_oldpassword)){ispass=0;$('input[name="user_oldpassword"]').next().append(ajax_returnrequiredorerror_BOX('原密码不得为空'));}else{$('input[name="user_oldpassword"]').next().find('.requestbox').remove();}
			if(isNull.test(user_newpassword)){ispass=0;$('input[name="user_newpassword"]').next().append(ajax_returnrequiredorerror_BOX('新密码不得为空'));}else{$('input[name="user_newpassword"]').next().find('.requestbox').remove();}
			if(isNull.test(user_cpassword)){ispass=0;$('input[name="user_cpassword"]').next().append(ajax_returnrequiredorerror_BOX('确认密码不得为空'));}else{$('input[name="user_cpassword"]').next().find('.requestbox').remove();}
			//form validate
			if(ispass == 1){
				if(user_newpassword != user_cpassword){
					ispass=0;
					$('input[name="user_newpassword"]').next().append(ajax_returnrequiredorerror_BOX('两次密码不一致'));
					$('input[name="user_cpassword"]').next().append(ajax_returnrequiredorerror_BOX('两次密码不一致'));
				}else{
					$('input[name="user_cpassword"]').next().find('.requestbox').remove();
					$('input[name="user_newpassword"]').next().find('.requestbox').remove();
				}
			}
			
			
			if(ispass == 1){
				$.post(baseurl+'index.php/member/change_password/'+uid, {
					//返回url
					backurl: backurl,
					//用户信息
					user_oldpassword: user_oldpassword,
					user_newpassword: user_newpassword,
					user_cpassword: user_cpassword,
				},function (data){
					var obj = eval( "(" + data + ")" );
					alert(data);
					if(obj.status == 1){
						actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//						isajaxsaveing = 0;//ajax正在保存中 --- 释放
						location.href = obj.backurl;
					}else if(obj.status == 2){
						$('input[name="user_oldpassword"]').next().append(ajax_returnrequiredorerror_BOX('原密码错误'));
						actionsubmit_button.attr('class', 'gksel_btn_action_on');
						actionsubmit_button.html('保存');
						isajaxsaveing = 1;//ajax正在保存中 --- 释放
					}
					
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	//删除地址
	function todel_address(id, name){
		var title = '您确定要删除该<font style="color:red;">【'+name+'】</font>地址吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/member/del_address/"+id);
		todel(title, subtitle);
	}
	//用户地址信息---添加
	function toadd_useraddressinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_useraddressinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
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
					//返回url
					backurl: backurl,
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
	function tosave_useraddressinfo(uid, address_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_useraddressinfo('+uid+', '+address_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
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
				$.post(baseurl+'index.php/member/edit_address/'+uid+'/'+address_id, {
					//返回url
					backurl: backurl,
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
	function tosave_userprofileinfo(){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_userprofileinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//----定义的字段------START
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'user_realname';
				GETOBJ[GETOBJ_num]['field_realname'] = 'user_realname';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['dz_user_realname'];
				
				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'user_phone';
				GETOBJ[GETOBJ_num]['field_realname'] = 'user_phone';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['dz_user_phone'];

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'user_email';
				GETOBJ[GETOBJ_num]['field_realname'] = 'user_email';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = L['dz_user_email'];
			//----定义的字段------END
				
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
			//----定义多语言的字段------END
			
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/wechat/account/edit_myprofile', postOBJ, function (data){
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
	
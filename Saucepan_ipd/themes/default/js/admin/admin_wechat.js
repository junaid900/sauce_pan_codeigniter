	//删除自动回复
	function todel_autoreply(id, name){
		var title = '您确定要删除自动回复<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/wechat/del_autoreply/"+id);
		todel(title, subtitle);
	}	
	//自动回复---添加
	function toadd_autoreplyinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_autoreplyinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			var autoreply_content = $('textarea[name="autoreply_content"]').val();
			var autoreply_pic = $('input[name="autoreply_pic"]').val();
			var autoreply_news = $('input[name="autoreply_news"]').val();
			var autoreply_name = $('input[name="autoreply_name"]').val();
			var autoreply_type = 1;
			var autoreply_type_arr = $('input[name="autoreply_type"]');
			if(autoreply_type_arr.length > 0){
				for(var i = 0; i < autoreply_type_arr.length; i++){
					if(autoreply_type_arr[i].checked == true){
						autoreply_type = autoreply_type_arr[i].value;
					}
				}
			}
			var ispass=1;
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/wechat/add_autoreply', {
					//返回url
					backurl: backurl,
					autoreply_type: autoreply_type,
					autoreply_pic: autoreply_pic,
					autoreply_news: autoreply_news,
					autoreply_name: autoreply_name,
					autoreply_content: autoreply_content
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
	//自动回复---保存
	function tosave_autoreplyinfo(autoreply_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_autoreplyinfo('+autoreply_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			var autoreply_content = $('textarea[name="autoreply_content"]').val();
			var autoreply_pic = $('input[name="autoreply_pic"]').val();
			var autoreply_news = $('input[name="autoreply_news"]').val();
			var autoreply_name = $('input[name="autoreply_name"]').val();
			var autoreply_type = 1;
			var autoreply_type_arr = $('input[name="autoreply_type"]');
			if(autoreply_type_arr.length > 0){
				for(var i = 0; i < autoreply_type_arr.length; i++){
					if(autoreply_type_arr[i].checked == true){
						autoreply_type = autoreply_type_arr[i].value;
					}
				}
			}
			var ispass=1;
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/wechat/edit_autoreply/'+autoreply_id, {
					//返回url
					backurl: backurl,
					autoreply_type: autoreply_type,
					autoreply_pic: autoreply_pic,
					autoreply_news: autoreply_news,
					autoreply_name: autoreply_name,
					autoreply_content: autoreply_content
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
	
	
	//微信菜单---保存
	function tosave_wechatmenuinfo(wechatmenu_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_wechatmenuinfo('+wechatmenu_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			var wechatmenu_content = $('textarea[name="wechatmenu_content"]').val();
			var wechatmenu_pic = $('input[name="wechatmenu_pic"]').val();
			var wechatmenu_news = $('input[name="wechatmenu_news"]').val();
			var wechatmenu_name = $('input[name="wechatmenu_name"]').val();
			var wechatmenu_url = $('input[name="wechatmenu_url"]').val();
			var wechatmenu_type = 1;
			var wechatmenu_type_arr = $('input[name="wechatmenu_type"]');
			if(wechatmenu_type_arr.length > 0){
				for(var i = 0; i < wechatmenu_type_arr.length; i++){
					if(wechatmenu_type_arr[i].checked == true){
						wechatmenu_type = wechatmenu_type_arr[i].value;
					}
				}
			}
			
			var status = 1;
			var status_arr = $('input[name="status"]');
			if(status_arr.length > 0){
				for(var i = 0; i < status_arr.length; i++){
					if(status_arr[i].checked == true){
						status = status_arr[i].value;
					}
				}
			}
			
			var ispass=1;
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/wechat/edit_wechatmenu/'+wechatmenu_id, {
					//返回url
					backurl: backurl,
					wechatmenu_type: wechatmenu_type,
					wechatmenu_pic: wechatmenu_pic,
					wechatmenu_news: wechatmenu_news,
					wechatmenu_name: wechatmenu_name,
					wechatmenu_url: wechatmenu_url,
					status: status,
					wechatmenu_content: wechatmenu_content
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

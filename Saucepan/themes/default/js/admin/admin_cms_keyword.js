	//删除关键字
	function todel_keyword(id, name){
		var title = '您确定要删除关键字<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/cms/del_keyword/"+id);
		todel(title, subtitle);
	}
	
	//关键字信息---添加
	function toadd_keywordinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_keywordinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//关键字信息
			var keyword_name_en = $('input[name="keyword_name_en"]').val();
			var keyword_name_ch = $('input[name="keyword_name_ch"]').val();
			
			var ispass=1;
			//验证关键字名称
			if(isNull.test(keyword_name_en)){ispass=0;$('input[name="keyword_name_en"]').next().append(ajax_returnrequiredorerror_BOX('关键字名称不能为空'));}else{$('input[name="keyword_name_en"]').next().find('.requestbox').remove();}
			if(isNull.test(keyword_name_ch)){ispass=0;$('input[name="keyword_name_ch"]').next().append(ajax_returnrequiredorerror_BOX('关键字名称不能为空'));}else{$('input[name="keyword_name_ch"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_keyword', {
					//返回url
					backurl: backurl,
					//关键字信息
					keyword_name_en: keyword_name_en
					, keyword_name_ch: keyword_name_ch
					
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


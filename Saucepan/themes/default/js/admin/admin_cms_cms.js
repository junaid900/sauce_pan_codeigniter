	//删除兑换产品
	function todel_cms(id, name){
		var title = '您确定要删除商品<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/cms/del_cms/"+id);
		todel(title, subtitle);
	}
	//兑换产品信息---添加
	function toadd_cmsinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_cmsinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//兑换产品信息
			var cms_name_en = $('input[name="cms_name_en"]').val();
			var cms_name_ch = $('input[name="cms_name_ch"]').val();
			
			var cms_description_en = CKEDITOR.instances.cms_description_en.getData();
			var cms_description_ch = CKEDITOR.instances.cms_description_ch.getData();
			
			var ispass=1;
			if(isNull.test(cms_name_en)){ispass=0;$('input[name="cms_name_en"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_en"]').next().find('.requestbox').remove();}
			if(isNull.test(cms_name_ch)){ispass=0;$('input[name="cms_name_ch"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_ch"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_cms', {
					//返回url
					backurl: backurl,
					//商品信息
					cms_name_en: cms_name_en,
					cms_name_ch: cms_name_ch,
					
					cms_description_en: cms_description_en,
					cms_description_ch: cms_description_ch					
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
	//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//兑换产品信息---保存
	function tosave_cmsinfo(cms_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_cmsinfo('+cms_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//兑换产品信息
			var cms_name_en = $('input[name="cms_name_en"]').val();
			var cms_name_ch = $('input[name="cms_name_ch"]').val();
			
			var cms_description_en = CKEDITOR.instances.cms_description_en.getData();
			var cms_description_ch = CKEDITOR.instances.cms_description_ch.getData();
			
			var ispass=1;
			if(isNull.test(cms_name_en)){ispass=0;$('input[name="cms_name_en"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_en"]').next().find('.requestbox').remove();}
			if(isNull.test(cms_name_ch)){ispass=0;$('input[name="cms_name_ch"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_ch"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/edit_cms/'+cms_id, {
					//返回url
					backurl: backurl,
					//商品信息
					cms_name_en: cms_name_en,
					cms_name_ch: cms_name_ch,
					
					cms_description_en: cms_description_en,
					cms_description_ch: cms_description_ch
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
	//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	
	//banner信息---添加
	function toadd_bannerinfo(parent){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_bannerinfo('+parent+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//信息
			var img1_gksel = $('input[name="img1_gksel"]').val();
			var img2_gksel = $('input[name="img2_gksel"]').val();
			var img3_gksel = $('input[name="img3_gksel"]').val();
			var img4_gksel = $('input[name="img4_gksel"]').val();
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("var cms_name"+lancodelist[lc]['langtype']+" = '"+$('input[name="cms_name'+lancodelist[lc]['langtype']+'"]').val()+"'");
				eval("var cms_description"+lancodelist[lc]['langtype']+" = '"+$('textarea[name="cms_description'+lancodelist[lc]['langtype']+'"]').val()+"'");
			}
			
			var ispass=1;
			
			var postOBJ = new Object();
			postOBJ.img1_gksel = img1_gksel;
			postOBJ.img2_gksel = img2_gksel;
			postOBJ.img3_gksel = img3_gksel;
			postOBJ.img4_gksel = img4_gksel;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("postOBJ.cms_name"+lancodelist[lc]['langtype']+" = '" + eval("cms_name"+lancodelist[lc]['langtype'])+"'");
				eval("postOBJ.cms_description"+lancodelist[lc]['langtype']+" = '" + eval("cms_description"+lancodelist[lc]['langtype'])+"'");
			}
			
			
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_sub_banner/'+parent, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	//banner信息---添加
	function toadd_bannerinfo_third(parent, second_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_bannerinfo_third('+parent+', '+second_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			//----定义的字段------START
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'img1_gksel';
				GETOBJ[GETOBJ_num]['field_realname'] = 'pic_1';
				GETOBJ[GETOBJ_num]['field_type'] = "image";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = 'Logo';
				
				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_realname'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '链接';
			//----定义的字段------END
			
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
				var GETLANGOBJ_num = 0;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_name';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = 'Name';
				
				
				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_profile';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "textarea";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '描述';
			//----定义多语言的字段------END
				
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_third_banner/'+parent+'/'+second_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//banner信息---添加
	function tosave_bannerinfo_third(parent, second_id, cms_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_bannerinfo_third('+parent+', '+second_id+', '+cms_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>'+L['cy_saving']+'...</span>');
			
			
			//----定义的字段------START
				var GETOBJ = [];
				var GETOBJ_num = 0;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'img1_gksel';
				GETOBJ[GETOBJ_num]['field_realname'] = 'pic_1';
				GETOBJ[GETOBJ_num]['field_type'] = "image";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = 'Logo';
				
				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_realname'] = 'cms_link';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '链接';

				GETOBJ_num = GETOBJ_num + 1;
				GETOBJ[GETOBJ_num] = new Array();
				GETOBJ[GETOBJ_num]['field_name'] = 'shorturl';
				GETOBJ[GETOBJ_num]['field_realname'] = 'shorturl';
				GETOBJ[GETOBJ_num]['field_type'] = "input";
				GETOBJ[GETOBJ_num]['field_CMNAME'] = '短网址';
			//----定义的字段------END
			
			//----定义多语言的字段------START
				var GETLANGOBJ = new Array();
				var GETLANGOBJ_num = 0;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_name';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = 'Name';

				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_profile';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "textarea";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '';

				GETLANGOBJ_num = GETLANGOBJ_num + 1;
				GETLANGOBJ[GETLANGOBJ_num] = new Array();
				GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'cms_description';
				GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "ueditor";
				GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '描述';
			//----定义多语言的字段------END
				
			var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
			var postOBJ = returnOBJ.postOBJ;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
			postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
			postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
			postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;
			if(returnOBJ.ispass == 1){
				$.post(baseurl+'index.php/admins/cms/edit_third_banner/'+parent+'/'+second_id+'/'+cms_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>'+L['cy_save_success']+'</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html(L['cy_save']);
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
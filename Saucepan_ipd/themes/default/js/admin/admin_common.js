	var isNull = /^[\s' ']*$/;
	function isEmail(email){
//		var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email);
//		if(isEmail!=true){
//			return false;
//		}else{
//			return true;
//		}
		return true;
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
        }else{
        	return false; 
        }
    }
    function isIntval(value){
		var isIntval = /^[0-9]*[1-9][0-9]*$/.test(value);
		if(isIntval!=true){
			return false;
		}else{
			return true;
		}
	}
	//删除提示框 ---- 关闭
	function toclose_deletebox(){
		$('.gksel_delete_box_bg, .gksel_delete_box').fadeOut(800);
	}
	var del_url = '';
	var del_loading = 0;
	
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
	
	//省市县三级联动
	$(document).ready(function(){
		$('#provinceID').change(function(){
			var province_id = $(this).val();
			$('.cityID_loading').show();
			$('.areaID_loading').show();
			if(province_id!=0){
				$.post(baseurl+'index.php/welcome/getcity/'+province_id,function(data){
					$('.cityID_loading').hide();
					$('.areaID_loading').hide();
					$('#cityID').html(data);
					if(langtype == '_ch'){
						$('#areaID').html('<option value="0">选择相关路口</option>');
					}else{
						$('#areaID').html('<option value="0">Select Cross Road</option>');
					}
				});
			}
		})
		$('#cityID').change(function(){
			var city_id = $(this).val();
			if(city_id!=0){
				$.post(baseurl+'index.php/welcome/getarea/'+city_id,function(data){
					$('#areaID').html(data);
				});
			}
		})
	})
	//
	$(document).ready(function(){
		$('.menugroup').click(function(){
			var group_id = $(this).attr('group_id');
			if($('#groupsublist_'+group_id).css('display') == 'none'){
				$('ul[group_id = "'+group_id+'"]').find('a.notactive').css({'background':'#1f2427'});
				
				$('#groupsublist_'+group_id).animate({'height':'show'}, 800, function (){
					
					
					
					$('ul[group_id = "'+group_id+'"]').find('.arr_do').hide();
					$('ul[group_id = "'+group_id+'"]').find('.arr_up').show();
				});
			}else{
				$('#groupsublist_'+group_id).animate({'height':'hide'}, 800, function (){
					
					$('ul[group_id = "'+group_id+'"]').find('a.notactive').css({'background':'#252d2f'});
					$('ul[group_id = "'+group_id+'"]').find('.arr_do').show();
					$('ul[group_id = "'+group_id+'"]').find('.arr_up').hide();
				});
			}
		});
	})
	
	//ajax 返回必填或格式错误的提示框
	function ajax_returnrequiredorerror_BOX(content){
		return '<div class="requestbox"><div class="sanjiao">&nbsp;</div><div class="content">'+content+'</div></div>';
	}
	
	
	var isajaxsaveing = 0;//是否ajax正在保存中
	var actionsubmit_button = '';//具体点击的按钮
	

	function getlancodelist(){
		var tArray = new Array();  //先声明一维
		
		tArray[0] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		tArray[0]['langtype'] = '_en';
		tArray[0]['langfolder'] = 'english';
		tArray[0]['langname'] = 'English';

		tArray[1] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		tArray[1]['langtype'] = '_ch';
		tArray[1]['langfolder'] = 'chinese';
		tArray[1]['langname'] = '简体中文';

//		tArray[0] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
//		tArray[0]['langtype'] = '_ch';
//		tArray[0]['langfolder'] = 'chinese';
//		tArray[0]['langname'] = '简体中文';
		
		return tArray;
	}
	
	/*替换内容*/
	function replace_content(reparr, content) {
		if(reparr.length > 0){
			for(var i = 0; i < reparr.length; i++){
				content = content.replace(reparr[i]['name'], reparr[i]['value'])
			}
		}
	    return content;
	}
	//默认替换内容
	function defaultreparr(){
		var reparr = new Array();  //先声明一维
		reparr[0] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[0]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[0]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		
		reparr[1] = new Array();  //替换换行
		reparr[1]['name'] = /[\r]/g;
		reparr[1]['value'] = "<br />";
		
		reparr[2] = new Array();  //替换回车
		reparr[2]['name'] = /[\n]/g;
		reparr[2]['value'] = "<br />";
		
		reparr[3] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[3]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[3]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		
		reparr[4] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[4]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[4]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		
		reparr[5] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[5]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[5]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值

		reparr[6] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[6]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[6]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值

		reparr[7] = new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；
		reparr[7]['name'] = "'";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		reparr[7]['value'] = "{sign_douhao}";    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
		
		
		return reparr;
	}
	//检查js表单错误内容
	function checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ){
		//----定义字段变量------START
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				var field_name = '';
				if(GETOBJ[gl]['field_type'] == 'ckeditor'){
					field_name = eval("CKEDITOR.instances."+GETOBJ[gl]['field_name']+".getData()");
					field_name = replace_content(defaultreparr(), field_name);
				}else if(GETOBJ[gl]['field_type'] == 'radio'){
					field_name = $('input[name="'+GETOBJ[gl]['field_name']+'"]');
					for(var i = 0; i < field_name.length; i++){
						if(field_name[i].checked == true){
							field_name = field_name[i].value;
							break;
						}
					}
				}else if(GETOBJ[gl]['field_type'] == 'checkboxradio'){
					field_name_val = '';
					field_name = $('input[name="'+GETOBJ[gl]['field_name']+'"]');
					for(var i = 0; i < field_name.length; i++){
						if(field_name[i].checked == true){
							field_name_val = field_name[i].value;
							break;
						}
					}
					if(field_name_val == ''){
						if($('input[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue') != '' && $('input[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue') != undefined){
							field_name_val = $('input[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue');
						}
					}
					field_name = field_name_val;
				}else if(GETOBJ[gl]['field_type'] == 'checkbox'){
					var checkbox_value = [];
					field_name = $('input[name="'+GETOBJ[gl]['field_name']+'[]"]');
					for(var i = 0; i < field_name.length; i++){
						if(field_name[i].checked == true){
							checkbox_value.push(field_name[i].value);
						}
					}
					field_name = checkbox_value;
				}else if(GETOBJ[gl]['field_type'] == 'image' || GETOBJ[gl]['field_type'] == 'file'){// image, file
					field_name = $('input[name="'+GETOBJ[gl]['field_name']+'"]').val();
					field_name = replace_content(defaultreparr(), field_name);
				}else{// input, select
					field_name = $(GETOBJ[gl]['field_type']+'[name="'+GETOBJ[gl]['field_name']+'"]').val();
					field_name = replace_content(defaultreparr(), field_name);
					if(field_name == ''){
						if($(GETOBJ[gl]['field_type']+'[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue') != '' && $(GETOBJ[gl]['field_type']+'[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue') != undefined){
							field_name = $(GETOBJ[gl]['field_type']+'[name="'+GETOBJ[gl]['field_name']+'"]').attr('defaultvalue');
						}
					}
				}
				eval("var "+GETOBJ[gl]['field_name']+" = '"+field_name+"';");
			}
		}
		if(GETLANGOBJ.length > 0){
			for(var gl = 0; gl < GETLANGOBJ.length; gl ++){
				var field_name = '';
				for(var lc = 0; lc < lancodelist.length; lc++){
					if(GETLANGOBJ[gl]['field_type'] == 'ckeditor'){
						field_name = eval("CKEDITOR.instances."+GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype']+".getData()");
						field_name = replace_content(defaultreparr(), field_name);
					}else if(GETLANGOBJ[gl]['field_type'] == 'ueditor'){
						field_name = eval(GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype']+".getContent()");
						field_name = replace_content(defaultreparr(), field_name);
					}else{// input, select
						field_name = $(GETLANGOBJ[gl]['field_type']+'[name="'+GETLANGOBJ[gl]['field_name']+''+lancodelist[lc]['langtype']+'"]').val();
						field_name = replace_content(defaultreparr(), field_name);
					}
					eval("var "+GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype']+" = '"+field_name+"';");
				}
			}
		}
		//----定义字段变量------END
		//----检查是否为空或格式错误------START
		var ispass=1;
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				if(GETOBJ[gl]['field_type'] == 'ckeditor'){
					var THISDOCUOBJ = $('textarea[name="'+GETOBJ[gl]['field_name']+'"]').parent();
					//先判断是否为必填参数
					if(THISDOCUOBJ.next().find('.request').text() == '*'){
						if(isNull.test(eval(GETOBJ[gl]['field_name']))){
							ispass=0;
							THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETOBJ[gl]['field_CMNAME']+L['cy_error_empty']));
						}else{
							THISDOCUOBJ.next().find('.requestbox').remove();
						}
					}
				}else if(GETOBJ[gl]['field_type'] == 'radio'){
					//不需要做判断
				}else if(GETOBJ[gl]['field_type'] == 'checkboxradio'){
					//不需要做判断
				}else if(GETOBJ[gl]['field_type'] == 'checkbox'){
					//不需要做判断
				}else if(GETOBJ[gl]['field_type'] == 'image' || GETOBJ[gl]['field_type'] == 'file'){//image, file
					var THISDOCUOBJ = $('input[name="'+GETOBJ[gl]['field_name']+'"]');
					//先判断是否为必填参数
					if(THISDOCUOBJ.next().find('.request').text() == '*'){
						if(isNull.test(eval(""+GETOBJ[gl]['field_name']))){
							ispass=0;
							THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETOBJ[gl]['field_CMNAME']+L['cy_error_empty']));
						}else{
							THISDOCUOBJ.next().find('.requestbox').remove();
						}
					}
				}else{//input, image, file, select
					var THISDOCUOBJ = $(GETOBJ[gl]['field_type']+'[name="'+GETOBJ[gl]['field_name']+'"]');
					//先判断是否为必填参数
					if(THISDOCUOBJ.next().find('.request').text() == '*'){
						if(isNull.test(eval(""+GETOBJ[gl]['field_name']))){
							ispass=0;
							THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETOBJ[gl]['field_CMNAME']+L['cy_error_empty']));
						}else{
							THISDOCUOBJ.next().find('.requestbox').remove();
						}
					}
					if(eval(""+GETOBJ[gl]['field_name']) != ''){
						//判断是否为手机号码格式
						if(THISDOCUOBJ.next().find('.format_phone').length > 0){
							if(!isPhone(THISDOCUOBJ.val())){
								ispass=0;
								THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETOBJ[gl]['field_CMNAME']+L['cy_error_format']));
							}
						}
					}
					if(eval(""+GETOBJ[gl]['field_name']) != ''){
						//判断是否为邮箱格式
						if(THISDOCUOBJ.next().find('.format_email').length > 0){
							if(!isEmail(THISDOCUOBJ.val())){
								ispass=0;
								THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETOBJ[gl]['field_CMNAME']+L['cy_error_format']));
							}
						}
					}
				}
			}
		}
		if(GETLANGOBJ.length > 0){
			for(var gl = 0; gl < GETLANGOBJ.length; gl ++){
				for(var lc = 0; lc < lancodelist.length; lc++){
					if(GETLANGOBJ[gl]['field_type'] == 'ckeditor'){
						var THISDOCUOBJ = $('textarea[name="'+GETLANGOBJ[gl]['field_name']+''+lancodelist[lc]['langtype']+'"]').parent();
						//先判断是否为必填参数
						if(THISDOCUOBJ.next().find('.request').text() == '*'){
							if(isNull.test(eval(GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype']))){
								ispass=0;
								THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETLANGOBJ[gl]['field_CMNAME']+L['cy_error_empty']));
							}else{
								THISDOCUOBJ.next().find('.requestbox').remove();
							}
						}
					}else if(GETLANGOBJ[gl]['field_type'] == 'ueditor'){
						
					}else{// input, select
						var THISDOCUOBJ = $(GETLANGOBJ[gl]['field_type']+'[name="'+GETLANGOBJ[gl]['field_name']+''+lancodelist[lc]['langtype']+'"]');
						//先判断是否为必填参数
						if(THISDOCUOBJ.next().find('.request').text() == '*'){
							if(isNull.test(eval(GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype']))){
								ispass=0;
								THISDOCUOBJ.next().append(ajax_returnrequiredorerror_BOX(GETLANGOBJ[gl]['field_CMNAME']+L['cy_error_empty']));
							}else{
								THISDOCUOBJ.next().find('.requestbox').remove();
							}
						}
					}
				}
			}
		}
		//----检查是否为空或格式错误------END
		var postOBJ = new Object();
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				eval("postOBJ."+GETOBJ[gl]['field_name']+" = '" + eval(GETOBJ[gl]['field_name'])+"'");
			}
		}
		if(GETLANGOBJ.length > 0){
			for(var gl = 0; gl < GETLANGOBJ.length; gl ++){
				for(var lc = 0; lc < lancodelist.length; lc++){
					eval("postOBJ."+GETLANGOBJ[gl]['field_name']+""+lancodelist[lc]['langtype']+" = '" + eval(GETLANGOBJ[gl]['field_name']+lancodelist[lc]['langtype'])+"'");
				}
			}
		}
		
		
		var GETOBJ_arr = [];
		var GETOBJ_type_arr = [];
		var GETOBJ_realname_arr = [];
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				GETOBJ_arr.push(GETOBJ[gl]['field_name']);
			}
		}
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				GETOBJ_type_arr.push(GETOBJ[gl]['field_type']);
			}
		}
		if(GETOBJ.length > 0){
			for(var gl = 0; gl < GETOBJ.length; gl ++){
				GETOBJ_realname_arr.push(GETOBJ[gl]['field_realname']);
			}
		}
		var GETLANGOBJ_arr = [];
		if(GETLANGOBJ.length > 0){
			for(var gl = 0; gl < GETLANGOBJ.length; gl ++){
				GETLANGOBJ_arr.push(GETLANGOBJ[gl]['field_name']);
			}
		}
		var returnOBJ = new Object();
		returnOBJ.ispass = ispass;
		returnOBJ.postOBJ = postOBJ;
		returnOBJ.GETOBJ_arr = GETOBJ_arr;
		returnOBJ.GETOBJ_type_arr = GETOBJ_type_arr;
		returnOBJ.GETOBJ_realname_arr = GETOBJ_realname_arr;
		returnOBJ.GETLANGOBJ_arr = GETLANGOBJ_arr;
		return returnOBJ;
	}
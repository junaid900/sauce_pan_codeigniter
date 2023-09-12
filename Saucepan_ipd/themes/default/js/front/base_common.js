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
        }else {
        	return false;
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

	
	
	
	
	
	
	//关闭提示
	function toclose_noticebox(){
		$('.gksel_notice_box').fadeOut(800);
	}
	
	//显示提示
	function toshow_notice(title){
		$('.gksel_notice_box').find('.title').html(title);
		$('.gksel_notice_box').fadeIn(800);
		
		setTimeout("toclose_noticebox()", 1000 );
	}

	
	
	
	
	function toreditecturl(url){
		if(url!=""){
			location.href=url;	
		}
	}
	function toopennewurl(url){
		if(url!=""){
			window.open(url);
		}
	}
	function toshowtest(){
		$('#menu_control_01').hide();
		$('#menu_control_02').show();
		$('#menu_mobile_logo').parent().parent().hide();
		$('#mobile_menu, #mobile_menubg').animate({height:"show"},300,function (data){
			$("body,html").animate({
    			scrollTop:0 //让body的scrollTop等于pos的top，就实现了滚动
    		},1000);
		});
	}
	function tohidetest(){
		$('#menu_control_01').show();
		$('#menu_control_02').hide();
		$('#menu_mobile_logo').parent().parent().show();
		$('#mobile_menu, #mobile_menubg').animate({height:"hide"},300,function (data){

		});
	}
	function autowidth_header(allbody_width,allbody_height){
		if(allbody_width<890){
			 $('.header_list_two').show();
			 $('.header_list_one').hide();

		}else{
			 $('.header_list_two').hide();
			 $('.header_list_one').show();

			 tohidetest();
		}
	}
	function autowidth_commonfooter(allbody_width,allbody_height){
		
	}
	
	var isajaxsaveing = 0;//是否ajax正在保存中
	var actionsubmit_button = '';//具体点击的按钮	
	//ajax 返回必填或格式错误的提示框
	function ajax_returnrequiredorerror_BOX(content){
		return '<div class="requestbox"><div class="sanjiao">&nbsp;</div><div class="content">'+content+'</div></div>';
	}
	
	
	
	
	
	/**
	 2  ** 加法函数，用来得到精确的加法结果
	 3  ** 说明：javascript的加法结果会有误差，在两个浮点数相加的时候会比较明显。这个函数返回较为精确的加法结果。
	 4  ** 调用：accAdd(arg1,arg2)
	 5  ** 返回值：arg1加上arg2的精确结果
	 6  **/
	function accAdd(arg1, arg2) {
		var r1, r2, m, c;
		try {
			r1 = arg1.toString().split(".")[1].length;
		}
		catch (e) {
			r1 = 0;
		}
		try {
			r2 = arg2.toString().split(".")[1].length;
		}
		catch (e) {
			r2 = 0;
		}
		c = Math.abs(r1 - r2);
		m = Math.pow(10, Math.max(r1, r2));
		if (c > 0) {
			var cm = Math.pow(10, c);
			if (r1 > r2) {
				arg1 = Number(arg1.toString().replace(".", ""));
				arg2 = Number(arg2.toString().replace(".", "")) * cm;
			} else {
				arg1 = Number(arg1.toString().replace(".", "")) * cm;
				arg2 = Number(arg2.toString().replace(".", ""));
			}
		} else {
			arg1 = Number(arg1.toString().replace(".", ""));
			arg2 = Number(arg2.toString().replace(".", ""));
		}
		return (arg1 + arg2) / m;
	}
	 /**
	 2  ** 减法函数，用来得到精确的减法结果
	 3  ** 说明：javascript的减法结果会有误差，在两个浮点数相减的时候会比较明显。这个函数返回较为精确的减法结果。
	 4  ** 调用：accSub(arg1,arg2)
	 5  ** 返回值：arg1加上arg2的精确结果
	 6  **/
	function accSub(arg1, arg2) {
		var r1, r2, m, n;
		try {
			r1 = arg1.toString().split(".")[1].length;
		}
		catch (e) {
			r1 = 0;
		}
		try {
			r2 = arg2.toString().split(".")[1].length;
		}
		catch (e) {
			r2 = 0;
		}
		m = Math.pow(10, Math.max(r1, r2)); //last modify by deeka //动态控制精度长度
		n = (r1 >= r2) ? r1 : r2;
		return ((arg1 * m - arg2 * m) / m).toFixed(n);
	}
	
	/**
	 2  ** 乘法函数，用来得到精确的乘法结果
	 3  ** 说明：javascript的乘法结果会有误差，在两个浮点数相乘的时候会比较明显。这个函数返回较为精确的乘法结果。
	 4  ** 调用：accMul(arg1,arg2)
	 5  ** 返回值：arg1乘以 arg2的精确结果
	 6  **/
	function accMul(arg1, arg2) {
		var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
		try {
			m += s1.split(".")[1].length;
		}
		catch (e) {
		}
		try {
			m += s2.split(".")[1].length;
		}
		catch (e) {
		}
		return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);
	}
	
	/** 
	 2  ** 除法函数，用来得到精确的除法结果
	 3  ** 说明：javascript的除法结果会有误差，在两个浮点数相除的时候会比较明显。这个函数返回较为精确的除法结果。
	 4  ** 调用：accDiv(arg1,arg2)
	 5  ** 返回值：arg1除以arg2的精确结果
	 6  **/
	function accDiv(arg1, arg2) {
		var t1 = 0, t2 = 0, r1, r2;
		try {
			t1 = arg1.toString().split(".")[1].length;
		}
		catch (e) {
		}
		try {
			t2 = arg2.toString().split(".")[1].length;
		}
		catch (e) {
		}
		with (Math) {
			r1 = Number(arg1.toString().replace(".", ""));
			r2 = Number(arg2.toString().replace(".", ""));
			return (r1 / r2) * pow(10, t2 - t1);
		}
	}

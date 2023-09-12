$(document).ready(function (){
	$('.btnCode_forgetpassword').click(function (){
		if($(".btnCode").attr("disabled") == 'disabled'){
			
		}else{
			GetForgetpasswordCode();
		}
	})
	
	$('.btnCode_register').click(function (){
		if($(".btnCode").attr("disabled") == 'disabled'){
			
		}else{
			GetRegisterCode();
		}
	})
})

var count = 60;
var thiscurrentcode = '';//正确的手机短信验证码
//执行获取验证码的操作 -- 注册
function GetRegisterCode() {
	var phone=$('input[name="register_phone"]').val();
	
	$.post(baseurl+'index.php/account/togetphonecode_register',{phone:phone},function (data){
		if(data=='phoneerror'){
			//手机号码格式不正确
			$('input[name="register_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式不正确'));
		}else if(data=='hasexists'){
			//该手机号码已被注册
			$('input[name="register_phone"]').next().append(ajax_returnrequiredorerror_BOX('该手机号码已被注册'));
		}else{
			$('input[name="register_phone"]').next().find('.requestbox').remove();
			thiscurrentcode = data;//正确的手机短信验证码
			alert(thiscurrentcode);
			GetCodeNumber();
		}
	})
}
//执行获取验证码的操作 -- 忘记密码
function GetForgetpasswordCode() {
	var phone=$('input[name="forgetpassword_phone"]').val();
	$.post(baseurl+'index.php/account/togetphonecode_forgetpassword',{phone:phone},function (data){
		if(data=='phoneerror'){
			//手机号码格式不正确
			$('input[name="forgetpassword_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式不正确'));
		}else if(data=='notexists'){
			//该手机号码没有注册
			$('input[name="forgetpassword_phone"]').next().append(ajax_returnrequiredorerror_BOX('该手机号码没有注册'));
		}else{
			$('input[name="forgetpassword_phone"]').next().find('.requestbox').remove();
			thiscurrentcode = data;//正确的手机短信验证码
			alert(thiscurrentcode);
			GetCodeNumber();
		}
	})
}
function GetCodeNumber() {
    $(".btnCode").attr("disabled", "disabled");
    $(".btnCode").html(count + "s重新获取");
    $(".btnCode").css("background","#CCCCCC");
    count--;
    if (count > 0) {
        setTimeout(GetCodeNumber, 1000);
    }
    else {
        $(".btnCode").html("重新获取验证码");
        $(".btnCode").removeAttr("disabled");
        $(".btnCode").css("background","#F86400");
        count = 60;
    }
}
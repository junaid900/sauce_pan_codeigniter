// SetCookie("token", setoken);//建立cookie存token
	// setoken= getCookie("token");//获取cookie中的token
	// delCookie("token");
	//写cookies函数 
   function SetCookie(name, value) //两个参数，一个是cookie的名子，一个是值 
   {
	var Days = 7; //此 cookie 将被保存 7 天 
	var exp = new Date(); //new Date("December 31, 9998"); 
	exp.setTime(exp.getTime() + Days*24*60*60*1000);//+10000
	document.cookie = name + "=" + escape(value) //+ ";expires=" + exp.toGMTString();
   }
	function getCookie(name) //取cookies函数
	{
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if(arr != null) return unescape(arr[2]);
	return null;
   }
  function delCookie(name) //删除cookie 
  {
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval = getCookie(name);
	if(cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
   }
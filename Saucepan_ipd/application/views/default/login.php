<?php $this->load->view('default/home_header')?>
<style>
	.card {
	    font-size: 1em;
	    background-color: #fff;
	    color: #2b2b2b;
	    list-style: none;
	    box-shadow: 1px 1px 1px hsla(0,0%,63%,.3);
	    width: calc(100% - 30px);
	        margin-left: 15px;
			margin-top:50px;
	}
	.card-head {
	    background-color: #fff;
	}
	.card-footer, .card-head {
	    color: #000;
	}
	a {
	    color: #17aaf5;
	    text-decoration: none;
	}
	.button.weChatLoginButtonm {
	    background: #2ac201 url(/assets/img/shared/openIdProviders/wechat-white.svg) 20px 10px no-repeat;
	    color: #fff;
	    font-size: 15px!important;
	    background-size: 30px 30px;
	    height: 50px!important;
	    border: none;
	    text-align: left!important;
	    padding-left: 60px!important;
	}
	.button.fullWidth {
	    width: 100%;
	}
	.button.medium {
	    font-size: 13px;
	    padding: 0 20px;
	    min-height: 42px;
	}
	.button.large, .button.medium {
	    font-family: ClientFont;
	    line-height: 40px;
	}
</style>
<div class="login_body_title">
	Sign In to your account with Saucepan / REVO
</div>
<div class="login_body_text">
	To register a new account, <a href="<?php echo base_url().'index.php/welcome/register'?>">Click Here</a>
</div>
<div class="card">
	<div class="card-head">
		<div class="formStage">
			<a href="<?php echo base_url().'index.php/welcome/authorizedgetwechatcode'?>"><button class="button medium weChatLoginButtonm fullWidth">Login with WeChat</button></a>
		</div>
	</div>
</div>

<!-- <div class="login_title">
	Emails
</div>
<div class="login_input">
	<input type="text" name="emails"/>
</div>
<div class="login_title">
	Password
</div>
<div class="login_input">
	<input type="text" name="passwords" />
</div>

<div class="address_save_btn" style="width: calc(100% - 30px);margin-left:15px;">
	LOGIN
</div>

<div class="login_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/password_list'?>';">
	Forgot Password ?
</div>
<div class="login_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/register'?>';">
	Register
</div> -->
<!-- <button style="margin-top: 100px;">开始注册</button>
<div class="gologin">去登录拉</div>

<div class="gocookie">拿cookie</div> -->
<script>
	
	// var setoken= getCookie("token");
	// var token_expiry= getCookie("token_expiry");
	// var myDate = new Date();
	// //     var stringTime=myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+' '+'16:39:00'
	// console.log(token_expiry,myDate)
	// var timestamp = new Date(token_expiry).getTime()
	// var timestamp1 = Date.parse(new Date());
	// console.log(timestamp,timestamp1)

	// if(timestamp<=timestamp1){
	// 	console.log('token已经失效')
	// 		// window.location.href ="<?php echo base_url().'index.php/welcome/login'?>" ;
	// }else if(timestamp>timestamp1){
	// 	window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
	// }else{
	// 	console.log('token未知效')
	// 	// window.location.href ="<?php echo base_url().'index.php/welcome/login'?>" ;
	// }
	// if(setoken!=null){
	// 	window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
	// }
	// console.log("刚开始获取的token",setoken)
	$.ajax({
	
	 type: 'POST',
	 url: "<?php echo base_url().'index.php/sessiones/get?token&user&token_expiry'?>",
	 cache:false,
	 dataType: "json", 
	 // data: formData,
	 processData: false,
	 contentType: false, //data: {key:value}, 
	 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
	 success: function(data){
	    //函数参数 "data" 为请求成功服务端返回的数据

			var timestamp = data.token_expiry;
			var timestamp1 =  ( new  Date()).valueOf()/1000;
			
			if(timestamp<=timestamp1){
				
				
			}else if(timestamp>timestamp1){
				
				window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
			}else{
				
			}
			
	},
	});
	$(".address_save_btn").click(function(){

		console.log("emails:",$( "input[name='emails']").val(),"passwords:",$( "input[name='passwords']").val())
		var formData = new FormData();
		formData.append('email',$( "input[name='emails']").val());
		formData.append('password', $( "input[name='passwords']").val());
		// formData.append('email', 'customer@customer.com');
		// formData.append('password', 'customer');
		formData.append('lang', 'en'); 
		// console.log(formData.get("email"));
		var nowDate = new Date();
		var year = nowDate.getFullYear();
		var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
		var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
		var hour = nowDate.getHours()< 10 ? "0" + nowDate.getHours() : nowDate.getHours();
		var minute = nowDate.getMinutes()< 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
		var second = nowDate.getSeconds()< 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
		var date_time=year + "-" + month + "-" + date+" "+hour+":"+minute;
		formData.append('date_time', date_time); 
		$.ajax({
		
		 type: 'POST',
		 url: 'https://www.mygkselss.com/market/apis/sign_in' ,
		 cache:false,
		 dataType: "json", 
		 data: formData,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(data){
		    //函数参数 "data" 为请求成功服务端返回的数据
				console.log(data)  
				console.log(data.response.token_id)  
				// SetCookie('token',data.response.token_id,);
				// SetCookie('user_id',data.response.users_system_id);
				// SetCookie('user_id',data.response.users_system_id);
				// SetCookie('token_expiry',data.response.token_expiry);
				
				// if(data.response.token_id!=null){
				// 	window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
				// }
				 // var myDate = new Date;
				 //    var year = myDate.getFullYear(); //获取当前年
				 //    var mon = myDate.getMonth() + 1; //获取当前月
				 //    var date = myDate.getDate(); //获取当前日
				 //    // var h = myDate.getHours();//获取当前小时数(0-23)
				 //    // var m = myDate.getMinutes();//获取当前分钟数(0-59)
				 //    // var s = myDate.getSeconds();//获取当前秒
				 //    var week = myDate.getDay();
				 //    var weeks = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
				 //    console.log(year, mon, date, weeks[week])
				 //    $("#time").html(year + "年" + mon + "月" + date + "日" + weeks[week]);
				 
				 
				$.ajax({
				
				 type: 'POST',
				 url: "<?php echo base_url().'index.php/sessiones/set?token='?>"+data.response.token_id+"&user="+data.response.users_system_id+"&token_expiry="+data.response.token_expiry+"",
				 cache:false,
				 dataType: "json", 
				 // data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("232323232",data)  
						
						
						if(data.status==1){
							window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
						}
				},
				});
		},
		});
		
		})
	$("button").click(function(){
	  $.ajax({
	  
	   //请求类型，这里为POST
	   type: 'get',
	   //你要请求的api的URL
	   url: 'http://39.109.123.207/v1/user/register' ,
	   //是否使用缓存
	   cache:false,
	   //数据类型，这里我用的是json
	   dataType: "json", 
	   //必要的时候需要用JSON.stringify() 将JSON对象转换成字符串
	   data: {c_phone:"15800315657", c_pwd:"123456"}, //data: {key:value}, 
	   //添加额外的请求头
	   headers : {'Content-type':'application/x-www-form-urlencoded'},
	   //请求成功的回调函数
	   success: function(data){
	      //函数参数 "data" 为请求成功服务端返回的数据
		console.log(data)  
		SetCookie('token',data.data.token);
	  },
	  });
	  // $.post(" http://39.109.123.207/v1/user/login", {c_phone:"15800315656", c_pwd:"123456"},xmlhttp.setRequestHeader(“Content-type”,”application/x-www-form-urlencoded”); function(data){
		  
	  //   console.log(data)
	  // });
	});
	$(".gologin").click(function(){

	  $.ajax({
	  
	   //请求类型，这里为POST
	   type: 'get',
	   //你要请求的api的URL
	   url: 'http://39.109.123.207/v1/user/login' ,
	   //是否使用缓存
	   cache:false,
	   //数据类型，这里我用的是json
	   dataType: "json", 
	   //必要的时候需要用JSON.stringify() 将JSON对象转换成字符串
	   data: {c_phone:"15800315657", c_pwd:"123456"}, //data: {key:value}, 
	   //添加额外的请求头
	   headers : {'Content-type':'application/x-www-form-urlencoded'},
	   //请求成功的回调函数
	   success: function(data){
	      //函数参数 "data" 为请求成功服务端返回的数据
		console.log(data.data.token)  
		// var  head = new Headers();
		// head.append('token',data.data.token);
		// console.log("token",head.get('token'));
		
		SetCookie('token',data.data.token);
	  },
	  });
	  // $.post(" http://39.109.123.207/v1/user/login", {c_phone:"15800315656", c_pwd:"123456"},xmlhttp.setRequestHeader(“Content-type”,”application/x-www-form-urlencoded”); function(data){
		  
	  //   console.log(data)
	  // });
	});
	
	
	
	
	
</script>
<?php $this->load->view('default/home_footer')?>
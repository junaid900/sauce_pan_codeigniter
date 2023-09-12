<?php $this->load->view('default/home_header')?>


<div class="login_title" style="margin-top:120px;">
	First Name (Required)
</div>
<div class="login_input">
	<input type="text" name=" first_name"/>
</div>
<div class="login_title">
	Last Name (Required)
</div>
<div class="login_input">
	<input type="text" name="last_name" />
</div>
<div class="login_title">
	Email (Required)
</div>
<div class="login_input">
	<input type="text"  name="email"/>
</div>


<div class="login_title">
	Phone (Required)
</div>
<div class="login_input">
	<input type="number" name="phone" />
</div>
<div class="login_title">
	Password (Required)
</div>
<div class="login_input">
	<input type="text" name="password" />
</div>


<div class="address_save_btn" style="width: calc(100% - 30px);margin-left:15px;">
	Register
</div>

<div class="login_btn" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/password_list'?>';">
	Forgot Password ?
</div>
<a class="login_btn" href="javascript:history.back(-1)" style="margin-bottom: 50px;;">
	←  Return
</a>
<script>
	$(".address_save_btn").click(function(){
		var last_name=$( "input[name='last_name']").val()
		var first_name=$( "input[name='first_name']").val()
		var email=$( "input[name='email']").val()
		var phone=$( "input[name='phone']").val()
		var password=$( "input[name='password']").val()
		var formData = new FormData();
		//验证邮箱
		var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!reg.test(email))
		{
			alert("邮箱格式不对");
			return false;
		}
		var regphone=/^1[34578]\d{9}$/;
		if(!regphone.test(phone))
		{
			alert("手机格式不对");
			return false;
		}
		formData.append('last_name',last_name);
		formData.append('first_name',first_name);
		formData.append('email',email);
		formData.append('mobile',phone);
		formData.append('password',password);
		
		$.ajax({
		
		 type: 'POST',
		 url: 'https://www.mygkselss.com/market/apis/sign_up' ,
		 cache:false,
		 dataType: "json", 
		 data: formData,
		 processData: false,
		 contentType: false, //data: {key:value}, 
		 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
		 success: function(data){
		    //函数参数 "data" 为请求成功服务端返回的数据
				console.log(data)  
				if(data.message=='successfully loggedIn'){
					console.log("注册成功");
					return;
					var formData = new FormData();
					// formData.append('email',$( "input[name='emails']").val());
					// formData.append('password', $( "input[name='passwords']").val());
					formData.append('email', email);
					formData.append('password', password);
					formData.append('lang', 'en'); 
					// console.log(formData.get("email"));
					
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
							SetCookie('token',data.response.token_id,);
							SetCookie('user_id',data.response.users_system_id);
							SetCookie('user_id',data.response.users_system_id);
							SetCookie('token_expiry',data.response.token_expiry);
							
							if(data.response.token_id!=null){
								window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
							}
					},
					});
				}else if(data.status==0){
					alert("该邮箱已经注册")
				}
		},
		});

	})
</script>
<?php $this->load->view('default/home_footer')?>
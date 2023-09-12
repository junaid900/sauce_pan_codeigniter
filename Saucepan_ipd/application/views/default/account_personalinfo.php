<?php $this->load->view('default/home_header')?>

<a class="login_btn" href="javascript:history.back(-1)" style="margin-top:90px;">
	←  <?php if($this->langtype=='_ch'){echo "上一步";}else{echo "Return";}?>
</a>
<div style="width: calc(100% - 20px);padding:0 10px;margin:20px 0;float: left;">
	 <?php if($this->langtype=='_ch'){echo "个人信息";}else{echo "Personal Information";}?>
</div>
<div class="login_title" >
	<?php if($this->langtype=='_ch'){echo "姓";}else{echo "Family Name";}?>
</div>
<div class="login_input">
	<input type="text" name="first_name" />
</div>
<div class="login_title">
	<?php if($this->langtype=='_ch'){echo "名";}else{echo "First Name";}?>
</div>
<div class="login_input">
	<input type="text" name="last_name" />
</div>
<div class="login_title">
	<?php if($this->langtype=='_ch'){echo "电话";}else{echo "Phone";}?>
</div>
<div class="login_input">
	<input type="text" name="phone" />
</div>


<div class="login_title">
	<?php if($this->langtype=='_ch'){echo "邮件";}else{echo "E-Mail";}?>
</div>
<div class="login_input">
	<input type="text" name="email" />
</div>



<div class="address_save_btn" style="width: calc(100% - 30px);margin-left:15px;">
	<?php if($this->langtype=='_ch'){echo "保存";}else{echo "SAVE";}?>
</div>
<div class="address_save_btns" style="width: calc(100% - 30px);margin-left:15px;display: none;">
	<?php if($this->langtype == '_ch'){echo '加载中...';}else{echo 'Loading...';}?>
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
	</div>
</div>
<script>
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
			// console.log(timestamp1)
			var setoken= data.token;
			var user_id= data.user;
			var formData = new FormData();
			formData.append('token', setoken);
			formData.append('user_id', user_id);
			
			 if(timestamp>timestamp1){
				$.ajax({
				
				 type: 'POST',
				 url: 'https://www.mygkselss.com/market/apis/get_profile',
				 cache:false,
				 traditional:true,
				 dataType: "json", 
				 data: formData,
				 processData: false,
				 contentType: false, //data: {key:value}, 
				 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
				 success: function(data){
				    //函数参数 "data" 为请求成功服务端返回的数据
						console.log("个人信息",data)  
						$(".loading_bg").hide();
						$("input[name='first_name']").val(data.response.first_name)
						$("input[name='last_name']").val(data.response.last_name)
						$("input[name='phone']").val(data.response.mobile)
						$("input[name='email']").val(data.response.email)
						
						
				},
				});
				$(".address_save_btn").click(function(){
					$(".address_save_btn").css("display","none")
					$(".address_save_btns").css("display","block")
					formData.append('first_name', $("input[name='first_name']").val());
					formData.append('last_name', $("input[name='last_name']").val());
					formData.append('mobile', $("input[name='phone']").val());
					formData.append('email', $("input[name='email']").val());
					$.ajax({
					
					 type: 'POST',
					 url: 'https://www.mygkselss.com/market/apis/update_profile',
					 cache:false,
					 traditional:true,
					 dataType: "json", 
					 data: formData,
					 processData: false,
					 contentType: false, //data: {key:value}, 
					 headers : {'ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'}, 
					 success: function(data){
					    //函数参数 "data" 为请求成功服务端返回的数据
							console.log("修改成功个人信息",data)  
							window.location.reload()
							
							
					},
					});
				})
			}
			
	},
	});
	
	
	
	
	
	
</script>

<?php $this->load->view('default/home_footer')?>
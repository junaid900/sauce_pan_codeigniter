<?php $this->load->view('wechat/home_header')?>
<div class="new_saucepan" style="display: block;">
	<div class="new_saucepan_body">
		<div class="title">
			Almost Done!<br> One more step!
			<div class="line"></div>
		</div>
		<div style="width:calc(100% - 20px);margin-left:10px;margin-bottom:-50px;">
			<div style="float:left;width:100%;text-align:center;">
				<img style="width:120px;height:120px;border-radius:50%;"  class="header_img" src=""/>
			</div>
			<div class="name_list" style="float:left;width:100%;text-align:center;margin-top:5px;">
				
			</div>
		</div>
		<div class="input_box">
			<input placeholder="Please enter your First Name"  type="text" name="first_name"/>
			<input placeholder="Please enter your Last Name"  type="text" name="last_name"/>
			<input placeholder="Please enter your Phone"  type="text" name="phone" />
			<input placeholder="Please enter your Email"   type="text" name="email"/>
		</div>
		<div class="btn">Complete</div>
	</div>
</div>
<div class="consumption_prompt_body" >
	<div class="body">
		<div class="consumption_bg delete_prompt_btn"></div>
		<div class="addrsss_section">
			<div class="addrsss_section_title">
				<div class="left_text"><?php if($this->langtype=='_ch'){echo "提示";}else{echo "Prompt";}?></div>
				<div class="right_delete delete_prompt_btn" >
					<img style='width:20px' src="<?php echo base_url().'themes/default/images/delete_add.png'?>" />
				</div>
			</div>
			
			<div class="section_box">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".delete_prompt_btn").click(function(){
		$(".consumption_prompt_body").fadeOut()
	})
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
						$("input[name='phone']").val(data.response.mobile)
						$("input[name='email']").val(data.response.email)
						if(data.response.wechat_nickname!=''){
													 $(".name_list").html(data.response.wechat_nickname)
													 $(".header_img").attr("src",data.response.wechat_avatar)
													 
						}else{
													  $(".name_list").html(data.response.first_name+data.response.last_name)
						}
			
						
						
						
				},
				});
				$(".btn").click(function(){
					console.log($("input[name='first_name']").val())
					
					if($("input[name='first_name']").val()==''){
						console.log("执行了")
						$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "名字不能为空";}else{echo "First Name cannot be empty";}?>")
						$(".consumption_prompt_body").fadeIn();
						return;
					}
					
					if($("input[name='last_name']").val()==''){
						$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "姓不能为空";}else{echo "Last Name cannot be empty";}?>")
						$(".consumption_prompt_body").fadeIn();
						return;
					}
					if($("input[name='phone']").val()==''){
						$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "电话不能为空";}else{echo "Phone cannot be empty";}?>")
						$(".consumption_prompt_body").fadeIn();
						return;
					}
					if($("input[name='email']").val()==''){
						$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "邮件不能为空";}else{echo "Email cannot be empty";}?>")
						$(".consumption_prompt_body").fadeIn();
						return;
					}
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
							window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
							
							
					},
					});
				})
			}
			
	},
	});
	
	
	
</script>

<?php $this->load->view('wechat/home_footer')?>
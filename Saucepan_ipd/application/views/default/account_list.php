<?php $this->load->view('default/home_header')?>
<div class="account_headerimg" style="background:url('') center center / cover no-repeat;">
	
</div>
<div class="name_list" style="width: 100%;float: left;font-size: 19.5px;text-align: center;margin-top:10px;">

</div>
<div style="width: 100%;float: left;font-size: 13px;text-align: center;margin-top:10px;">
	 Saucepan / REVO 
	 <?php if($this->langtype == '_ch'){
	 		echo '账户';
	 	}else{
	 		echo 'Account';
	 	}
	 ?>
</div>
<div onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_personalinfo'?>';" style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo '个人信息';
		}else{
			echo 'Personal Information';
		}
	?>
</div>
<!-- <div onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/authorizedgetwechatcode'?>';" style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php //if($this->langtype == '_ch'){echo '获取code';}else{echo 'Personal Information';}?>
</div> -->
<div onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_address_list'?>';" style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo '保存的地址';
		}else{
			echo 'Saved Addresses';
		}
	?>
</div>
<div onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_orderhistory'?>';" style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo '订单';
		}else{
			echo 'Order History';
		}
	?>
</div>
<div onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_invoices'?>';" style="display: none;width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo '发票';
		}else{
			echo 'Invoices';
		}
	?>
</div>
<div class="points_btn"  style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo 'SP Points';
		}else{
			echo 'SP Points';
		}
	?>
</div>
<!-- onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_loyaltypoints'?>';" -->
<div  style="width: calc(100% - 20px);padding:15px 0px;margin-left:10px;margin-top:10px;box-shadow: 1px 1px 1px rgba(43,43,43,.3);float: left;text-align: center;color: #000;font-size: 14px;;">
	<?php if($this->langtype == '_ch'){
			echo 'Refer Saucepan to a friend - receive 50RMB';
		}else{
			echo 'Refer Saucepan to a friend - receive 50RMB';
		}
	?>
</div>
<!-- onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_referral'?>';" -->
<div class="password_list_btn" style="    width: calc(100% - 20px);margin-left:10px;" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/product'?>';">
	<?php if($this->langtype == '_ch'){
			echo '返回商店';
		}else{
			echo 'Return to Shop';
		}
	?>
</div>

<div class="login_btn" href="" style="margin-bottom: 50px;;">
	<?php if($this->langtype=='_ch'){echo "退出";}else{echo "SIGN OUT";}?>
</div>
<div class="loading_bg" style="width: 100%;height: 100%;position: fixed;top:0;left:0;background-color: white;">
	<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;position: absolute;top:0;">
		<img style='width:50px' src="<?php echo base_url().'themes/default/images/ajax_loading.gif'?>" />
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
	$(".points_btn").click(function(){
		$(".consumption_prompt_body .section_box").text("<?php if($this->langtype=='_ch'){echo "我们正在维护SP points, 请等待.";}else{echo "We are updating SP points at moment and will be back soon. ";}?>")
		$(".consumption_prompt_body").fadeIn();
	})
	$(".delete_prompt_btn").click(function(){
		$(".consumption_prompt_body").fadeOut()
	})
	// var setoken= getCookie("token");
	// var setoken2= getCookie("user_id");
	// console.log(setoken,setoken2)
	// var token_expiry= getCookie("token_expiry");
	// var myDate = new Date();
	// //     var stringTime=myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+' '+'16:39:00'
	// console.log(token_expiry,myDate)
	// var timestamp = new Date(token_expiry).getTime()
	// var timestamp1 = Date.parse(new Date());
	// console.log(timestamp,timestamp1)
	
	// if(timestamp<=timestamp1){
	// 	console.log('token已经失效')
	// 		window.location.href ="<?php echo base_url().'index.php/welcome/login'?>" ;
	// }else if(timestamp>timestamp1){
	// 	// window.location.href ="<?php echo base_url().'index.php/welcome/account_list'?>" ;
	// }else{
	// 	console.log('token未知效')
	// 	window.location.href ="<?php echo base_url().'index.php/welcome/login'?>" ;
	// }
	// $(".login_btn").click(function(){
		
	// 	var stringTime=myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+' '+'01:00:00'
	// 	SetCookie('token_expiry',stringTime);
	// 	window.location.href ="<?php echo base_url().'index.php/welcome/'?>" ;
	// })
	
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
						if(data.response.first_name!=''){
													 $(".name_list").html(data.response.wechat_nickname)
													  $(".account_headerimg").css("background-image","url("+data.response.wechat_avatar+")")
													 
						}else{
													  $(".name_list").html(data.response.first_name+data.response.last_name)
						}
			
				
						
						
				},
				});
			}
			
	},
	});
	
	
	
</script>
<?php $this->load->view('default/home_footer')?>
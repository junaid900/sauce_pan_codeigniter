<?php 
$menu = $this->session->userdata('menu');
$lang = $this->session->userdata('lang');

$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>
<div id="mobile_menubg" style="display:none;">
	
</div>
<div id="mobile_menu" style="display:none;">
		<table id="mobile_menutabheight">
				<tr>
					<td class="leftline"></td>
					<td>
						<div class="logobox">
							<span onclick="toreditecturl()"><img alt="GreenGorgeous Logo" title="GreenGorgeous Logo" src="<?php if($this->langtype=='_ch'){echo base_url().'themes/default/images/logo.jpg';}else{echo base_url().'themes/default/images/logo.jpg';}?>"/></span>
						</div>
						<div onclick="tohidetest()" class="closebox">
							<img alt="close menu" title="close menu" src="<?php echo base_url().'themes/default/images/mobile_close_01.png'?>"/>
						</div>
					</td>
				</tr>
				<tr>
					<td class="leftline"></td>
					<td class="contentpadding">
				 		<div class="contentdiv">
				 			<div class="mobileloginboxorinfobox headerviews_checklogin_mo">
		 						
				 			</div>
				 			<div class="nav">
				 			
				 			<div class="mobileloginboxorinfobox">
			 					<a href="<?php echo base_url().'index.php/welcome/#do'?>" class="contentloginuser"><span class="name" style="font-size: 12px;"> <?php 
								if($this->langtype == '_ch'){
									echo '';
								}else{
									echo '';
								}
							?></span></a>
				 			</div>
				 			
				 			
				 			
				 			</div>
				 			<div style="border:2px dashed #555;float:left;width:100%;margin:10px auto;"></div>
				 			<div class="mobileloginboxorinfobox" style="display:none;">
			 					<a href="" class="contentloginuser"><span class="name" style="font-size: 12px;">
			 					 <?php 
								if($this->langtype == '_en'){
									echo 'Language';
								}else if($this->langtype == '_ch'){
									echo '语言';
								}else{
									echo '語言';
								}
							?>
			 					</span></a>
				 			</div>
				 			<div class="mobileloginboxorinfobox" style="display:none;">
			 					<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>" class="contentloginuser" style="text-indent:20px;font-size: 12px;"><span class="name" >
			 					  ◆  English
			 					</span></a>
				 			</div>
				 			<div class="mobileloginboxorinfobox" style="display:none;">
			 					<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>" class="contentloginuser" style="text-indent:20px;font-size: 12px;"><span class="name">
			 					   ◆ 简体中文
			 					</span></a>
				 			</div>
				 		</div>
					</td>
				</tr>
			</table>
			
</div>
<div class="header_list_two" style="display:none;">
	<div class="subarea">
		<div class="caidanbg"></div>
		<div class="caidan">
			<div class="content">
				<div class="languagearea" >
					<?php if($lang == 'en'){?>
						<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>">中文</a>
					<?php }else{?>
						<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>">EN</a>
					<?php }?>
				</div>
				<div id="menu_mobile_logo">
					
					<a href="<?php echo base_url()?>"><img alt="" title="GreenGorgeous Logo" src="<?php if($this->langtype=='_ch'){echo base_url().'themes/default/images/logo.jpg';}else{echo base_url().'themes/default/images/logo.jpg';}?>"/></a>
				</div>
				<?php $setokenphp='';?>
				
				<div class="rightmenuactionarea" onclick="javascript:location.href='<?php echo base_url().'index.php/wechat/tologin'?>';" style="display: none;">
					<?php if($this->langtype == '_ch'){
							echo '登录';}else{echo 'Login';}?>
				</div>
				<div class="rightmenuactionarea rightmenuactionareas" onclick="javascript:location.href='<?php echo base_url().'index.php/welcome/account_list'?>';" style="    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    height: 15px;">
					
				</div>
				
			</div>
		</div>
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
			console.log("哈哈",data,data.token_expiry)  
			var timestamp = data.token_expiry;
			var timestamp1 =  ( new  Date()).valueOf()/1000;
			console.log(timestamp,timestamp1)
			// if(timestamp==0){
			// 	console.log("无登录状态")
			// 	$(".rightmenuactionarea").css("display","block")
			// 	$(".rightmenuactionareas").css("display","none")
			// }
			// if(timestamp<=timestamp1){
			// 	console.log('头部token已经失效')
			// 	$(".rightmenuactionarea").css("display","block")
			// 	$(".rightmenuactionareas").css("display","none")
			// }else 
			if(timestamp>timestamp1){
				console.log('头部token有效')
				$(".header_list_two").css("display","block")
				$(".rightmenuactionarea").css("display","none")
				$(".rightmenuactionareas").css("display","-webkit-box")
				
			}else{
				window.location.href = "<?php echo base_url().'index.php/wechat/tologin'?>";
				console.log('头部token未知效')
				$(".rightmenuactionarea").css("display","-webkit-box")
				$(".rightmenuactionareas").css("display","none")
				return;
			}
			
	},
	});
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
					$(".rightmenuactionareas").text(data)
						console.log("头部个人信息",data)  
						// $(".loading_bg").hide();
						// $(".name_list").html(data.response.first_name+data.response.last_name)
						
						 if(data.response.wechat_nickname!=null){
							  $(".rightmenuactionareas").html(data.response.wechat_nickname)
						 }else{
							  $(".rightmenuactionareas").html(data.response.first_name)
						 }
						
						
				},
				});
			}
			
	},
	});
$(".name").click(function(){

	$('#menu_control_01').show();
	$('#menu_control_02').hide();
	$('#menu_mobile_logo').parent().parent().show();
	$('#mobile_menu, #mobile_menubg').animate({height:"hide"},300,function (data){

	});
})
</script>
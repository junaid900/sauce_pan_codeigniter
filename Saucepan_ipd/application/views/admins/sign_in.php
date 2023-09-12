<?php $this->load->view('./default/home_header')?>

    <style>
		body, html {
		    margin: 0;
		    padding: 0;
		    width: 100%;
		    position: relative;
		    height: 100%;
		}
		.header_list_two,.header_list_one{display: none;}
        /* .img {width: 60%;}

        .info_box {width: 80%;float: left;margin-left: 10%;margin-bottom: 50px;background-color: #FFFFFF;}
        .info_box .box .box_bg .box_img img{float:left;width:100%;}
        .info_box .box .box_bg .box_img img{float:left;width:100%;}
        .info_box .img{float: left;width: 46%;padding-bottom:100%}
        .info_box .content{float: left;width: 54%;}
        .form_box {color: #101010;margin-top: 33px;width:80%;margin-left: 20%;font-size: 14px;}
        .form_box input[type='text']{width: 70%;height: 38px;padding-left: 10px;border-radius: 4px;margin-top: 10px;}
        .form_box .error_box{visibility:hidden;color: #CF1322;font-size: 12px;} */
    /*   @media screen and (max-width: 1000px) {
            .info_box {width: 90%;margin-left: 5%;}
            .info_box1{display: block !important;}
            .img{width: 100% !important;margin-right: 0 !important;}
            .content{width: 100% !important;}
        } */
		.login_body .login_body_section{width: 100%;height: 100%;float:left;overflow: auto;}
		.login_body .login_body_section .img{width: 46%;height: 100%;float:left;;}
		.login_body .login_body_section .box_section{width: calc(54% - 30px);float:left;margin-left:calc(46% + 0px);;}
		.login_body .login_body_section .box_section .logo{width: 186px;float:left;margin-top:25px;;margin-left: 30px;}
		.login_body .login_body_section .box_section .form_box{width: 450px;margin-left:calc(50% - 200px);float:left;margin-top: 97px;}
		.login_body .login_body_section .box_section .form_box .title{width: 100% ;float:left;}
		.login_body .login_body_section .box_section .form_box div{width: 100% ;float:left;}
		.login_body .login_body_section .box_section .form_box .title_text{width: 100% ;float:left;font-size: 14px;}
		.login_body .login_body_section .box_section .form_box .name{width: 100% ;float:left;font-size: 14px;}
		.login_body .login_body_section .box_section .form_box .input_box{width: 100% ;float:left;margin-top:10px;}
		.login_body .login_body_section .box_section .form_box .input_box input{width: 100%;float:left;}
		.login_body .login_body_section .box_section .form_box .error_box{width: 100% ;float:left;margin-top:5px;font-size: 12px;color: #CF1322;display: none;}
		.login_body .login_body_section .box_section .form_box .protocol_box{width: 100% ;float:left;margin-top:12px;font-size: 12px;color: #999999;display: flex;justify-content: left;align-items: center;}
		.login_body .login_body_section .box_section .form_box .protocol_box input{margin-top:1px;margin-right: 10px;;}
		.login_body .login_body_section .box_section .form_box .protocol_box .rember{display: flex;justify-content: left;align-items: center;}
    </style>
<div class="login_body" style="width:100%;height:100%;float:left;background-color: #F7F7F7;position: relative;float:left;">
    <div class="login_body_section" style="position:absolute;height: 100%;width: 100%;float:left;;">
        <div class="img" style="background: url(<?php echo base_url().'/themes/default/images/5ff9b05c7e589.jpg'?>) 0 0 / cover no-repeat;position: fixed;left: 0;right: 0;">
			
        </div>
        <div class="box_section">
			<div style="width: 100%;float:left;;" >
				<img class="logo" onclick="javascript:location.href='<?php echo base_url().'index.php/'?>';" src="<?php echo base_url().'/themes/default/images/logo.png'?>" alt="">
			</div>
			
			<div class="form_box">
				<div  class="title" style="font-size: 28px;font-weight: bold" ><?php if($this->langtype=='_en'){echo "Admin";}else{echo "后台中心";}?></div>

				<div  class="name" style="margin-top: 12px;margin-top: 58px;"><?php if($this->langtype=='_en'){echo "Email Address";}else{echo "Adresse électronique";}?></div>
				<div  class="input_box"><input name="user_email" type="text" placeholder="<?php if($this->langtype=='_en'){echo "Email";}else{echo "électronique";}?>"></div>
				<div  class="error_box email_format_error"><?php if($this->langtype=='_en'){echo "Please enter a valid email address.";}else{echo "S'il vous plaît, mettez une adresse email valide.";}?></div>
				<div  class="error_box email_not_exist"><?php if($this->langtype=='_en'){echo "Email does not exist.";}else{echo "L'e-mail n'existe pas.";}?></div>
				<div  class="error_box email_password_not_match"><?php if($this->langtype=='_en'){echo "Email password does not match.";}else{echo "Le mot de passe de l'e-mail ne correspond pas.";}?></div>
				<div  class="name" style="margin-top: 12px;margin-top: 28px;"><?php if($this->langtype=='_en'){echo "Password";}else{echo "Mot de passe";}?></div>
				<div  class="input_box"><input name="password" autocomplete="new-password" type="password" placeholder="·········"></div>
				<div  class="error_box password_error"><?php if($this->langtype=='_en'){echo "Passwords don’t match.";}else{echo "Les mots de passe ne correspondent pas.";}?></div>
				<div  class="error_box error_box2"><?php if($this->langtype=='_en'){echo "You have reached the limitation of errors inputting, please try again later.";}else{echo "Vous avez atteint la limite de saisie des erreurs, veuillez réessayer plus tard.";}?></div>

				<div class="sign_in" style="width: 188px;cursor: pointer;background-color: #465c62;border-radius: 4px;color: #f7f297;text-align: center;padding: 10px 20px;margin-top: 48px;margin-left: calc(50% - 114px);">
                    <?php if($this->langtype=='_en'){echo "Sign In";}else{echo "Se connecter";}?>
				</div>
			</div>
        </div>
    </div>
</div>
<script>
    
	$(".sign_in").click(function(){
		// var user_email = $("input[name='user_email']").val();
		// var password = $("input[name='password']").val();
		
		
		
		$.ajax({
		
		 //请求类型，这里为POST
		 type: 'POST',
		 //你要请求的api的URL
		 url: 'https://jhantech.com/market/apis/sign_in' ,
		 //是否使用缓存
		 cache:false,
		 //数据类型，这里我用的是json
		 dataType: "json", 
		 //必要的时候需要用JSON.stringify() 将JSON对象转换成字符串
		 data: {lang:'en',email:"customer@customer.com", password:"customer"}, //data: {key:value}, 
		 //添加额外的请求头
		 headers : {'Content-type':'application/json','ApiKey':'XXXXXX-XXXXXX-JUnsa1988938922039:012900929'},
	
         
		 //请求成功的回调函数
		 success: function(data){
		    //函数参数 "data" 为请求成功服务端返回的数据
				console.log(data)  
		},
		});
	})
  


</script>
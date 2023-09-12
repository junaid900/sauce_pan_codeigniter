<?php $this->load->view('default/home_header')?>

    <style>
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
        <div class="img" style="background: url(<?php echo base_url().'/themes/default/images/login_2.png'?>) 0 0 / cover no-repeat;position: fixed;left: 0;right: 0;">
			
        </div>
        <div class="box_section">
			<div style="width: 100%;float:left;;" >
				<img class="logo" onclick="javascript:location.href='<?php echo base_url().'index.php/'?>';" src="<?php echo base_url().'/themes/default/images/logo.png'?>" alt="">
			</div>
			
			<div class="form_box">
				<div  class="title" style="font-size: 28px;font-weight: bold" >Let's Get Started</div>
				<div  style="margin-top: 18px;" class="title_text">Find the best hygienist deal for you and your family!</div>
				
				<div  class="name" style="margin-top: 12px;margin-top: 58px;">Email Address</div>
				<div  class="input_box"><input type="text" placeholder="Email"></div>
				<div  class="error_box">Please enter a valid email address.</div>
				<div  class="name" style="margin-top: 12px;margin-top: 28px;">Password</div>
				<div  class="input_box"><input type="text" placeholder="·········"></div>
				<div  class="error_box">Passwords don’t match.</div>
				<div  class="error_box error_box2">You have reached the limitation of errors inputting, please try again later.</div>
				
				<div  class="protocol_box">
					<div class="rember">
						<input type="checkbox">
						<div>
							Remember Me
						</div>
					</div>
					<div style="text-align: right;color: #1069D2;cursor: pointer;" onclick="javascript:location.href='<?php echo base_url().'index.php/login/sign_email'?>';">
						Forget Password
					</div>
				</div>


				<div style="width: 188px;cursor: pointer;background-color: #1069D2;border-radius: 4px;color: white;text-align: center;padding: 10px 20px;margin-top: 48px;margin-left: calc(50% - 114px);">
					Sign In
				</div>
				<div style="width: 228px;margin-left: calc(50% - 114px);margin-top: 18px;font-size: 12px;margin-bottom: 70px;display: flex;justify-content: space-between;align-items: center;">
					<span>Don’t have an account?</span>
					<a href="<?php echo base_url().'index.php/login/sign_up'?>" style="color:#1069D2;">Sign Up</a>
				</div>
			</div>
        </div>
    </div>
</div>
<?php $this->load->view('admins/home_header')?>
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
<?php
    // if(isset($_COOKIE[DB_PRE().'admin_info'])){
    //     $admin_info = unserialize($_COOKIE[DB_PRE().'admin_info']);
    //     $admin_id = $admin_info['uid'];
    //     $admin_username = $admin_info['user_name'];
    // }else{
    //     $admin_id = 0;
    //     $admin_username = '';
    //     redirect ( base_url () . 'index.php/admin' );
    // }

?>
    <style>
		.header_list_two,.header_list_one{display: none;}
		html,body{background-color: #F2F5F9;}
		.clinics_header_nav{width:180px;height:100%;float:left;position: fixed;top:0;left:0;background-color: white;z-index: 1;height: calc(100% - 0px);}
		.clinics_header_nav .logo{width:136px;float:left;margin-left: calc(50% - 68px);margin-top:20px;}
		.clinics_header_nav .logo img{width: 100%;float: left;}
		.clinics_header_nav .nav_box{width: 100%;float:left;}
		.clinics_header_nav .nav_box .box{width: calc(100% - 10px);border-radius:0 10px 10px 0;padding:17px 0;float:left;display: flex;justify-content: center;align-items: center;margin-top:30px;cursor: pointer;}
		.clinics_header_nav .nav_box .box .ico_box{width: 20px;float: left;}
		.clinics_header_nav .nav_box .box .ico_box .ico{width: 20px;}
		/* .clinics_header_nav .nav_box .box .ico_box .ico:nth-child(1){display: none;} */
		.clinics_header_nav .nav_box .box .title{float: left;margin-left: 12px;font-size: 14px;width: 90px;}
		.clinics_header_nav .log_box{position: absolute;bottom: 0;left:0;display: flex;justify-content: center;align-items: center;width: 100%;height: 100px;border-top:1px solid rgba(222,222,222,1);cursor: pointer;background-color: #FFFFFF;}
		.clinics_header_nav .log_box .ico_box{width: 20px;float: left;}
		.clinics_header_nav .log_box .ico_box .ico{width: 20px;}
		.clinics_header_nav .log_box .title{float: left;margin-left: 12px;font-size: 14px;width: 90px;color: #1069D2;font-weight: bold;}
		.clinics_header_information{position: fixed;top:0;width: calc(100% - 212px);padding: 0 16px;margin-left:180px;height: 68px;display: flex;justify-content: space-between;align-items: center;border-bottom:1px solid rgba(214,224,237,1);background-color:white;z-index: 4;}
		.clinic_on{background-color: #F2F5F9;width: calc(100% - 14px);border-left: 4px solid #465c62;}
		.clinic_on .title{color: #000000;}
	/* 	.clinic_on .ico_box .ico:nth-child(1){display: block !important;}
		.clinic_on .ico_box .ico:nth-child(2){display: none !important;} */
		.clinic_off{background-color: rgba(70,92,98,0);width: calc(100% - 14px);border-left: 4px solid white;}
		.clinic_off .title{color:#000000}
		/* .clinic_off .ico_box .ico:nth-child(1){display: none !important;}
		.clinic_off .ico_box .ico:nth-child(2){display: block !important;} */
		.clinics_body{width:calc(100% - 180px);margin-left:180px;;float:left;margin-top:69px;background-color: #F2F5F9;;}
		.clinics_body .clinics_body_wecome{background-color: white;float:left;padding: 28px;border-radius:8px;margin-top:28px;margin-left:16px;}
	
		.
	</style>
<div class="clinics_header_nav" style="">
        <div class="logo">
			<img   src="<?php echo base_url().'/themes/default/images/logo.png'?>" alt="">
        </div>
        <div class="nav_box" style="height: calc(100% - 147px);overflow-y: auto;">
        	
			
			
			<div class="box <?php if($menu == 'home'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome';?>';">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/home.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_dashboard_off.png'?>" alt=""> -->
				</div>
				<div  class="title" style="" ><?php if($this->langtype=='_en'){echo "Home";}else{echo "主页";}?></div>
			</div>
			<div class="box <?php if($menu == 'cms'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/clinics_cms';?>';">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/orders.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_dashboard_off.png'?>" alt=""> -->
				</div>
				<div  class="title" style="" ><?php if($this->langtype=='_en'){echo "Orders";}else{echo "订单";}?></div>
			</div>
			
			
			<div class="box <?php if($menu == 'user'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="javascript:location.href='<?php echo base_url().'index.php/admins/welcome/user';?>';">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/products.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_user_off.png'?>" alt=""> -->
				</div>
				<div  class="title" style="" ><?php if($this->langtype=='_en'){echo "Products";}else{echo "产品";}?></div>
			</div>
			
			
			
			
			
			<div class="box <?php if($menu == 'category'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="location.href='<?php echo base_url().'index.php/admins/welcome/category_list';?>'">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/category.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_service_off.png'?>" alt=""> -->
				</div>
				<div class="title" style=""><?php if($this->langtype=='_en'){echo "Category";}else{echo "分类";}?> </div>
			</div>
			
			<div class="box <?php if($menu == 'booking'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="location.href='<?php echo base_url().'index.php/admins/welcome/booking';?>'">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/customers.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_booking_off.png'?>" alt=""> -->
				</div>
				<div class="title" style=""><?php if($this->langtype=='_en'){echo "Customers";}else{echo "客户";}?></div>
			</div>
			<div style="" class="box <?php if($menu == 'toadd_clinic'){echo 'clinic_on';}else{echo 'clinic_off';}?>" onclick="location.href='<?php echo base_url().'index.php/admins/clinic/toadd_clinic';?>'">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/help.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/clinic_clinic_profile_off.png'?>" alt=""> -->
				</div>
				<div  class="title" style="" ><?php if($this->langtype=='_en'){echo "Help Center";}else{echo "帮助中心";}?></div>
			</div>
			
			
			
			<div style="" class="box">
				<div class="ico_box">
					<img  class="ico" src="<?php echo base_url().'/themes/default/images/ico/settings.png'?>" alt="">
					<!-- <img  class="ico" src="<?php echo base_url().'/themes/default/images/client_settings_off.png'?>" alt=""> -->
				</div>
				<div  class="title" style="" ><?php if($this->langtype=='_en'){echo "Settings";}else{echo "设置";}?>   </div>
			</div>
			
        </div>
		<div class="log_box">
			<div class="ico_box">
				<img  class="ico" src="<?php echo base_url().'/themes/default/images/client_log_out.png'?>" alt="">
			</div>
			<div onclick="location.href='<?php echo base_url().'index.php/login/logout'?>'"  class="title" style="" >Logout</div>
		</div>
</div>

<div class="clinics_header_information">
	<div style="width:270px;height: 38px;line-height: 38px;color: white;text-align: center;font-size:16px;border-radius:4px;float: left;display: flex;justify-content: left;align-items: center;">
		
		
		<?php if($menu == 'home'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/ico/home.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Home";}else{echo "主页";}?>
			</div>
		<?php }else if($menu == 'category'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/ico/category.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Category";}else{echo "分类";}?>
			</div>
			
		<?php }else if($menu == 'clinic'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/clinic_clinic_profile_title.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Clinics";}else{echo "Clinics";}?>
			</div>
		<?php }else if($menu == 'product'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/clinic_service_title.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Service";}else{echo "Service";}?>
			</div>
		<?php }else if($menu == 'booking'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/clinic_booking_title.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Bookings";}else{echo "Bookings";}?>
			</div>
		<?php }else if($menu == 'toadd_clinic'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/clinic_booking_title.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "Toadd Clinic";}else{echo "Toadd Clinic";}?>
			</div>
		<?php }else if($menu == 'cms'){?>
			<img  style="width:24px;float:left;" src="<?php echo base_url().'/themes/default/images/clinic_booking_title.png'?>" alt="">
			<div style="margin-left:13px;float:left;font-size: 16px;color: #000000;font-weight: bold;">
				<?php if($this->langtype=='_en'){echo "cms";}else{echo "cms";}?>
			</div>
		<?php }?>
	</div>
	
	<div style="float:left;;position:relative;margin-left: 100px;">
		<div style="float:left;;position:relative;margin-left: 100px;;" class="contact_software">
			<img style="width: 20px;float: left;margin-top:6px;"  src="<?php echo base_url().'themes/default/images/di.png'?>" alt="">
			<select onchange="toselectlanguage(this.value)" style="float: left;margin-left:5px;background: url(<?php echo base_url()?>themes/default/images/select_arrow_blue.png) no-repeat scroll right center rgba(0,0,0,0);appearance: none;-moz-appearance: none;-webkit-appearance: none;width:70px;height: 35px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;border:none;">
				<option value="ch" <?php if($lang == 'ch'){echo 'selected';}?>>CN</option>
				<option value="en" <?php if($lang == 'en'){echo 'selected';}?>>EN</option>
				
			</select>
		</div>
	
	    <div style="float:left;text-align: center;margin-right: 100px;margin-left: 29px;cursor: pointer;display: none;" class="contact_software ">
	       
	            <div style="float:left;padding:5px 10px;border: 1px solid #101010;color:#101010;border-radius: 4px;cursor: pointer;" class="contact_software" onclick="javascript:location.href='<?php echo base_url().'index.php/admin'?>';">
	                <?php if($this->langtype=='_en'){echo "Sign in";}else{echo "se connecter";}?>
	            </div>
	        
	    </div>
	</div>
</div>

<script>
	function toselectlanguage(lang){
		location.href = baseurl+"index.php/welcome/changelanguage/"+lang+"/<?php echo $current_url_encode?>";
	}
</script>
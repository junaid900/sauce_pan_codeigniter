<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />		<title>Saucepan</title>		<link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/logo.jpg?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/base.css?date=<?php echo CACHE_USETIME()?>" />		<script src="<?php echo base_url()?>themes/default/js/jquery-1.11.0.min.js?date=<?php echo CACHE_USETIME()?>"></script>	<!-- 	<script src="<?php echo base_url()?>themes/default/js/cookie.js?date=<?php echo CACHE_USETIME()?>"></script> -->
				<script type="text/javascript">			var baseurl='<?php echo base_url()?>';		</script>	</head><body style="<?php if($this->langtype=='_ch'){echo "font-family:Noto;";}else{echo "font-family: 'ClientFont'";}?>;"><?php 
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

<div class="header_list_two" style="">
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
				
				<div class="rightmenuactionarea" onclick="javascript:location.href='<?php echo base_url().'index.php/wechat/tologin'?>';" style="text-align: right;opacity:0;">
					null
				</div>
				
				
			</div>
		</div>
	</div>
	
</div>
<!-- <script src="<?php echo base_url()?>themes/default/js/timetk.js?date=<?php echo CACHE_USETIME()?>"></script> -->
<style>
	html,body{width: 100%;float:left;position: relative;height: 100%;;}
</style>
<div class="home_banners" style="background:url('<?php echo base_url().'themes/default/images/home_banner.jpg'?>') center center / cover no-repeat;">
	
</div>
 
<div class="home_menu_body">
	<a href="<?php echo base_url().'index.php/welcome/product'?>"  class="box boxs" style="background:url('<?php echo base_url().'themes/default/images/saucepan.jpg'?>') center center / cover no-repeat;">
		
	</a>
	<a href="https://www.mygksel.com/revo/index.php/home"  class="box" style="background:url('<?php echo base_url().'themes/default/images/revo.jpg'?>') center center / cover no-repeat;">
		
	</a>
	<a href="<?php echo base_url().'index.php/welcome/product_categories'?>"  class="box" style="background:url('<?php echo base_url().'themes/default/images/wineshop.jpg'?>') center center / cover no-repeat;">
		
	</a>
</div>
<div class="home_footer_body">
	Where health & happiness come together<?php // echo apiimage_url()?>
</div>
<script>
	
</script>
<?php $this->load->view('default/home_footer')?>
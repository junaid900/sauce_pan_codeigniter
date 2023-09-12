<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<title>Saucepan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/jquery-1.7.2.min.js?date=<?php echo CACHE_USETIME()?>'></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
	<link rel="shortcut icon" href="<?php echo base_url()?>themes/default/images/ez.ico?date=<?php echo CACHE_USETIME()?>" type="image/x-icon" />
</head>
<?php 
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
$current_url = current_url().$get_str;
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
$menu = $this->session->userdata('menu');
?>
<script type="text/javascript">
	var baseurl='<?php echo base_url()?>';
	var cdnurl='<?php echo CDN_URL()?>';
	var currenturl='<?php echo $current_url?>';
	var current_url_encode='<?php echo $current_url_encode?>';
	var langtype = '<?php echo $this->langtype?>';
</script>


<body>
<?php 
if(isset($_COOKIE[DB_PRE().'admininfo'])){
	$admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
	$admin_id = $admininfo['admin_id'];
	$admin_username = $admininfo['admin_username'];
}else{
	$admin_id = 0;
	$admin_username = '';
}
?>
<div class="Frame_Header">
	<img class="logo" style="width: 150px;margin-top:20px;" src="<?php echo CDN_URL().'themes/default/images/ezdesign_logo2.png'?>"/>
	<div class="infomation">
		<div class="infoarea">
			<div class="inforight">
				<div class="info">Hello!</div>
				<div class="userinfo"><?php echo $admin_username;?></div>
				<div class="logout"><a href="<?php echo base_url().'index.php/admin/logout'?>">【<?php echo lang('cy_logout')?>】</a></div>
			</div>
		</div>
	
		<div class="languagearea">
			<div class="language">
				<a href="<?php echo base_url().'index.php/welcome/changelanguage/en/'.$current_url_encode?>" style="font-weight:bold;font-size:14px;;margin-right:10px;<?php if($this->langtype == '_en'){echo 'text-decoration:underline;font-size:16px;';}?>">EN</a>
				<a href="<?php echo base_url().'index.php/welcome/changelanguage/ch/'.$current_url_encode?>" style="font-weight:bold;font-size:14px;margin-right:10px;<?php if($this->langtype == '_ch'){echo 'text-decoration:underline;font-size:16px;';}?>">CN</a>
			</div>
		</div>
		
	</div>
</div>
<div class="Frame_Leftmenu">
	<div class="list">
		<?php 
			$group_id = 0;
			$isonthissection = 0;
			if($menu == 'dashboard'){
				$isonthissection = 1;
			}
		?>
		<!-- 
		<ul group_id = "<?php echo $group_id?>" class="menugroup">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?> onclick="javascript:location.href='<?php echo base_url().'index.php/admins/dashboard'?>';">
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_dashboard_'.$isonthissection.'.png';?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_dashboard_white.png'?>"/>
					<?php if($this->langtype == '_ch'){echo '仪表盘';}else{echo 'Dashboard';}?>
				</a>
			</li>
		</ul>
		 -->
		<?php 
			$group_id = 1;
			$isonthissection = 0;
			if($menu == 'cms_banner' || $menu == 'dishlist' || $menu == 'menulist'){
				$isonthissection = '1_bak';
			}
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_cms_'.$isonthissection.'.png'?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_cms_white.png'?>"/>
						<?php if($this->langtype == '_ch'){echo '内容管理';}else{echo 'Manage Content';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'cms_banner'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/cms/bannersublist/2'?>"><?php if($this->langtype == '_ch'){echo '内容管理';}else{echo 'Manage Content';}?></a></font></li>
			<!--
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'dishlist'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/cms/dishlist'?>">Manage Nutrizone</a></font></li>
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'menulist'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/cms/menulist'?>">Manage Menus</a></font></li>
			-->
		</ul>
		
		<?php 
			$group_id = 2;
			$isonthissection = 0;
			if($menu == 'servicecategory' || $menu == 'service'){
				$isonthissection = 1;
			}
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup" style="display: none;">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_service_'.$isonthissection.'.png'?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_service_1.png'?>"/>
					<?php if($this->langtype == '_ch'){echo '服务';}else{echo 'Service';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'servicecategory'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/service/subcategorylist/39'?>"><?php if($this->langtype == '_ch'){echo '管理分类';}else{echo 'Manage Categories';}?></a></font></li>
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'service'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/service/index'?>"><?php if($this->langtype == '_ch'){echo '管理服务';}else{echo 'Manage Service';}?></a></font></li>
		</ul>
		
		
		
		<?php 
			$group_id = 139;
			$isonthissection = 0;
			if($menu == 'eventcategory' || $menu == 'event'){
				$isonthissection = 1;
			}
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup" style="display: none;">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_event_'.$isonthissection.'.png'?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_event_1.png'?>"/>
					<?php if($this->langtype == '_ch'){echo '活动';}else{echo 'Event';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li style="display: none;"><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'eventcategory'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/event/subcategorylist/39'?>"><?php if($this->langtype == '_ch'){echo '管理标签';}else{echo 'Manage Labels';}?></a></font></li>
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'event'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/event/index'?>"><?php if($this->langtype == '_ch'){echo '管理活动';}else{echo 'Manage Event';}?></a></font></li>
		</ul>
		
		
		


        <?php
			$group_id = 140;
			$isonthissection = 0;
			if($menu == 'articlecategory' || $menu == 'article'){
				$isonthissection = 1;
			}
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
                    <img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_news_'.$isonthissection.'.png'?>"/>
                    <img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_news_white.png'?>"/>
                    <?php if($this->langtype == '_ch'){echo '关于我们';}else{echo 'About Us';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'article'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/article/index'?>"><?php if($this->langtype == '_ch'){echo '管理关于我们';}else{echo 'Manage About Us';}?></a></font></li>
		</ul>



		
		<?php 
			$group_id = 137;
			$isonthissection = 0;
			if($menu == 'newscategory' || $menu == 'news'){
				$isonthissection = 1;
			}
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup" style="display: none;">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_news_'.$isonthissection.'.png'?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_news_white.png'?>"/>
					<?php if($this->langtype == '_ch'){echo '描述';}else{echo 'Description';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li style="display:none;"><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'newscategory'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/news/subcategorylist/39'?>"><?php if($this->langtype == '_ch'){echo '管理分类';}else{echo 'Manage Categories';}?></a></font></li>
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'news'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/news/index'?>"><?php if($this->langtype == '_ch'){echo '管理描述';}else{echo 'Manage Description';}?></a></font></li>
		</ul>
		
			
		
	
			
		
		
		
		
		
		
		<?php 
			$group_id = 202;
			$isonthissection = 0;
			if($menu == 'contactus'){
				$isonthissection = '1_bak';
			}
			
			$con = array('contactus_type_IN'=>'1, 2', 'isread'=>0);
			$count_contactus = $this->ContactusModel->getcontactuslist($con, 1);
		?>
		<ul group_id = "<?php echo $group_id?>" class="menugroup">
			<li>
				<a<?php if($isonthissection == 1){echo ' class="active"';}else{echo ' class="notactive"';}?>>
					<img class="icon" src="<?php echo base_url().'themes/default/images/admin/icon1_message_'.$isonthissection.'.png'?>"/>
					<img class="icon_white" src="<?php echo base_url().'themes/default/images/admin/icon1_message_0.png'?>"/>
					<?php if($this->langtype == '_ch'){echo '联系我们';}else{echo 'Contact Us';}?>
					<?php if($count_contactus > 0){echo '<label  style="margin: 0px 0px 0px 0px;color:red;">('.$count_contactus.')</label >';}?>
					<img class="arr_up <?php if($isonthissection != 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_up.png'?>"/>
					<img class="arr_do <?php if($isonthissection == 1){echo 'displaynone';}?>" src="<?php echo base_url().'themes/default/images/arrow_do.png'?>"/>
				</a>
			</li>
		</ul>
		<ul id = "groupsublist_<?php echo $group_id?>" class="<?php if($isonthissection != 1){echo 'displaynone';}?>" style="background: #1f2427;">
			<li><span style="width:21px;">&nbsp;</span><font><a <?php if($menu == 'contactus'){echo 'class="subactive" ';}?>href="<?php echo base_url().'index.php/admins/contactus/index'?>"><?php if($this->langtype == '_ch'){echo '联系我们';}else{echo 'Contact Us';}?></a></font> <?php if($count_contactus > 0){echo '<font><a href="javascript:;" style="color:red;">('.$count_contactus.')</a></font>';}?></li>
		</ul>
		
	</div>
</div>


<div class="Frame_Leftmenu_footer" style="position:absolute;left:0px;width:235px;height:40px;line-height:40px;color:white;bottom:0px;background: #252d2f;z-index:1;">
	<div style="float: left;width:235px;display:none;">
		<div class="oooon" style="float: left;margin-left:6px;color:white;cursor:pointer;" onclick="toshousuoleftmenu()">
			<div style="float: left;margin-top:12px;margin-left:5px;">
				<img style="width:14px" src="<?php echo base_url().'themes/default/images/backend_leftmenu_l.png'?>"/>
			</div>
			<div style="float: left;">
				<a href="javascript:;" style="float: left;margin-left:5px;color:#a8a8a8;" onclick="toshousuoleftmenu()">Collapse Menu</a>
			</div>
		</div>
		
		<div class="ooooff" style="display:none;float: left;margin-left:6px;color:white;cursor:pointer;" onclick="tohideleftmenu()">
			<div style="float: left;margin-top:13px;margin-left:5px;">
				<img style="width:14px" src="<?php echo base_url().'themes/default/images/backend_leftmenu_r.png'?>"/>
			</div>
		</div>
	</div>
</div>
<script>
	function toshousuoleftmenu(){
		$('.Frame_Body').animate({'left':'65px'});
		$('.Frame_Leftmenu_footer').animate({'width':'40px'});
		$('.Frame_Leftmenu').animate({'width':'40px'}, function (){
			$('.Frame_Leftmenu_footer').find('.oooon').hide();
			$('.Frame_Leftmenu_footer').find('.ooooff').show();
		});
	}
	function tohideleftmenu(){
		$('.Frame_Body').animate({'left':'260px'});
		$('.Frame_Leftmenu_footer').animate({'width':'235px'});
		$('.Frame_Leftmenu').animate({'width':'235px'}, function (){
			$('.Frame_Leftmenu_footer').find('.oooon').show();
			$('.Frame_Leftmenu_footer').find('.ooooff').hide();
		});
	}
</script>





<div class="Frame_Body">

<?php if(isset($url)){?><div class="gksel_navigation"><?php echo $url;?></div><?php }?>
	
<div class="gksel_delete_box_bg"></div>
<div class="gksel_delete_box">
	<table>
		<tr>
			<td>
				<div class="gksel_delete_content">
					<div class="close"><img onclick="toclose_deletebox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div class="control">
						<div class="yes" onclick="del()"><?php if($this->langtype == '_ch'){echo '确定';}else{echo 'OK';}?></div>
						<div class="no" onclick="toclose_deletebox()"><?php if($this->langtype == '_ch'){echo '关闭';}else{echo 'Cancel';}?></div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

